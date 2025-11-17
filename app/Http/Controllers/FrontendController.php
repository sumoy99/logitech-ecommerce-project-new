<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;
use App\Models\User;


use App\Models\Category;
use App\Models\Product;
use App\Models\BannerImage;
use App\Models\Marquee;
use App\Models\CompanyLogo;
use App\Models\Color;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    public function frontendView()
    {
        log_visit();

        $page_data['categories'] = Category::with('children')
            ->whereNull('parent_id')
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        $featuredProductsByCategory = collect();
        $usedProductIds = []; 

        foreach ($page_data['categories'] as $category) {
            $product = Product::with([
                    'category',
                    'brand',
                    'features',
                    'warranty',
                    'productFile',
                    'productSeo',
                    'productShipping',
                    'attributes',
                    'colorImages'
                ])
                ->where('featured', 1)
                ->where('status', 1)
                ->whereJsonContains('category_id', (string) $category->id)
                ->whereNotIn('id', $usedProductIds) 
                ->orderBy('id', 'DESC')
                ->first();

            if ($product) {
                $featuredProductsByCategory->push($product);

                $usedProductIds[] = $product->id;
            }
        }

        $page_data['featuredProductsByCategory'] = $featuredProductsByCategory;

        $today = Carbon::today();

        $page_data['flashDealProducts'] = Product::with([
                'category',
                'brand',
                'productFile',
            ])
            ->where('status', 1)
            ->whereNotNull('flash_deal')
            ->get()
            ->filter(function ($product) use ($today) {
                $deal = json_decode($product->flash_deal, true);
                if (!isset($deal['flas_date_range'])) return false;

                // Parse date range
                [$start, $end] = array_map('trim', explode('to', $deal['flas_date_range']));
                $startDate = Carbon::parse($start);
                $endDate = Carbon::parse($end);

                return $today->between($startDate, $endDate);
            })
            ->values();

        $page_data['banners'] = BannerImage::where('status', 1)->orderBy('id', 'DESC')->get();

        $page_data['marquees'] = Marquee::where('status', 1)->orderBy('created_at', 'DESC')->paginate(20);

        $page_data['companyLogos'] = CompanyLogo::where('status', 1)->orderBy('id', 'DESC')->get();

        return view('frontend.index', $page_data);
    }


    public function category_products_view($category_slug, $id)
    {
        $category = Category::with('children')->findOrFail($id);

        
        $categoryIds = $this->getAllChildCategoryIds($category);

        $products = Product::with('features', 'colorImages')
            ->where(function ($query) use ($categoryIds) {
                foreach ($categoryIds as $catId) {
                    $query->orWhereJsonContains('category_id', (string)$catId);
                }
            })
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate(20);
            

        $brandIds = $products->pluck('brand_id')->unique()->filter()->values();

        $colorIds = collect();
        foreach ($products as $product) {
            if (!empty($product->colors)) {
                $ids = json_decode($product->colors, true);
                if (is_array($ids)) {
                    $colorIds = $colorIds->merge($ids);
                }
            }
        }

        $colorIds = $colorIds->unique()->values();
        $colors = Color::whereIn('id', $colorIds)->get();
        $subcategories = $category->children;

        $page_data = [
            'category' => $category,
            'products' => $products,
            'brandIds' => $brandIds,
            'colors' => $colors,
            'subcategories' => $subcategories,
        ];

        return view('frontend.category_products', $page_data);
    }

    private function getAllChildCategoryIds($category, $ids = null)
    {
        if ($ids === null) {
            $ids = collect([$category->id]);
        }

        if ($category->children->isEmpty()) {
            return $ids;
        }

        foreach ($category->children as $child) {
            $ids->push($child->id);
            $ids = $this->getAllChildCategoryIds($child, $ids); 
        }

        return $ids;
    }

    public function filter_by_subcategory(Request $request)
    {
        $subcategoryId = $request->subcategory_id;

        $products = Product::whereJsonContains('category_id', (string)$subcategoryId)
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate(20);

        return view('partials.product.product_grid_layout', compact('products'))->render();
    }

    public function product_details_view($product_slug, $id)
    {
        $product = Product::with('category', 'brand', 'features', 'warranty', 'productFile', 'productSeo', 'productShipping', 'attributes', 'colorImages')->findOrFail($id);

        $categoryIds = json_decode($product->category_id, true);

        $categories = Category::whereIn('id', $categoryIds)->get();

        $parentCategory = $categories->whereNull('parent_id')->first();

        if (!$parentCategory && $categories->isNotEmpty()) {
            $child = $categories->first();
            if ($child->parent_id) {
                $parentCategory = Category::find($child->parent_id);
            }
        }

        $childCategories = collect();
        if ($parentCategory) {
            $childCategories = Category::where('parent_id', $parentCategory->id)
                ->whereIn('id', $categoryIds)
                ->get();
        }

        $relatedProducts = Product::where('id', '!=', $product->id)
            ->whereJsonContains('category_id', (string)$categoryIds[0])
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->take(8)
            ->get();

        $page_data = [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'parentCategory' => $parentCategory,
            'childCategories' => $childCategories,
        ];

        $allProducts = collect([$product])->merge($relatedProducts)->values();

        $ids = $allProducts->pluck('id');
        $index = $ids->search($product->id);

        $page_data['prevProduct'] = $index > 0 ? $allProducts[$index - 1] : null;
        $page_data['nextProduct'] = $index < $ids->count() - 1 ? $allProducts[$index + 1] : null;


        return view('frontend.product_details', $page_data);
    }

    public function quickView($id)
    {
        $product = getFullProduct($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return view('partials.quick-view-modal', compact('product'));
    }

    public function searchProduct(Request $request)
    {
        $query = trim($request->input('q'));

        if (empty($query)) {
            return redirect()->back()->with('error', 'Please enter a search term.');
        }

        $categoryIds = \App\Models\Category::where('name', 'LIKE', "%{$query}%")
                        ->pluck('id')
                        ->toArray();

        $brandIds = \App\Models\Brand::where('name', 'LIKE', "%{$query}%")
                        ->pluck('id')
                        ->toArray();

        $products = Product::select('*')
                    ->where(function ($q) use ($query, $categoryIds, $brandIds) {
                    $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('short_description', 'LIKE', "%{$query}%")
                    ->orWhere('long_description', 'LIKE', "%{$query}%")
                    ->orWhere('tags', 'LIKE', "%{$query}%")
                    ->orWhere('sku', 'LIKE', "%{$query}%");

                    if (!empty($categoryIds)) {
                        $q->orWhereIn('category_id', $categoryIds);
                    }

                    if (!empty($brandIds)) {
                        $q->orWhereIn('brand_id', $brandIds);
                    }
                })
            ->orderByDesc('created_at')
            ->with(['productFile', 'category', 'brand'])
            ->paginate(20);

        return view('frontend.search-products', compact('products', 'query'));
    }


    public function ajaxSearch(Request $request)
    {
        $query = trim($request->input('q'));

        if (!$query) {
            return response()->json([]);
        }

        $products = Product::with('productFile')
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                ->orWhere('short_description', 'LIKE', "%{$query}%")
                ->orWhere('tags', 'LIKE', "%{$query}%")
                ->orWhere('sku', 'LIKE', "%{$query}%");
            })
            ->take(6)
            ->get(['id', 'name', 'slug', 'price']);

        if ($products->isNotEmpty()) {
            $results = $products->map(function ($product) {
                $image = $product->productFile && $product->productFile->thumbnail
                    ? asset('assets/upload/products/thumbnails/' . $product->productFile->thumbnail)
                    : asset('assets/backend/assets/img/placeholder.png');

                return [
                    'type' => 'product',
                    'name' => $product->name,
                    'price' => number_format($product->price, 2),
                    'image' => $image,
                    'url' => route('frontend.product_details', [$product->slug, $product->id]),
                ];
            });

            return response()->json($results);
        }

        $categories = \App\Models\Category::where('name', 'LIKE', "%{$query}%")
                        ->take(5)
                        ->get(['id', 'name', 'slug']);

        // $brands = \App\Models\Brand::where('name', 'LIKE', "%{$query}%")
        //                 ->take(5)
        //                 ->get(['id', 'name', 'slug']);

        $results = collect();

        foreach ($categories as $cat) {
            $results->push([
                'type' => 'category',
                'name' => $cat->name,
                'image' => $cat->image ? asset('assets/upload/category/' . $cat->image) : asset('assets/backend/assets/img/placeholder.png'), // default category icon
                'url' => route('frontend.category_products', ['category_slug' => $cat->slug, 'id' => $cat->id]),
            ]);
        }

        // foreach ($brands as $brand) {
        //     $results->push([
        //         'type' => 'brand',
        //         'name' => $brand->name,
        //         'image' => asset('assets/frontend/images/icons/brand.png'), // default brand icon
        //         'url' => route('frontend.brand.products', [$brand->slug, $brand->id]),
        //     ]);
        // }

        if ($results->isEmpty()) {
            $results->push([
                'type' => 'none',
                'name' => 'No results found',
                'image' => asset('assets/backend/assets/img/placeholder.png'),
                'url' => '#',
            ]);
        }

        return response()->json($results);
    }


    public function developerView()
    {
        return view('frontend.developer.index');
    }

    public function getCities($region)
    {
        $divisions = Cache::rememberForever('divisions_data', function () {
            $raw = json_decode(file_get_contents(public_path('assets/location/divisions.json')), true);
            return collect($raw)->firstWhere('type', 'table')['data'] ?? [];
        });

        $districts = Cache::rememberForever('districts_data', function () {
            $raw = json_decode(file_get_contents(public_path('assets/location/districts.json')), true);
            return collect($raw)->firstWhere('type', 'table')['data'] ?? [];
        });

        $divisionId = collect($divisions)
            ->first(fn($d) => str_contains(strtolower($d['name']), strtolower($region)))['id'] ?? null;

        if (!$divisionId) {
            return response()->json([]);
        }

        $filteredDistricts = collect($districts)
            ->where('division_id', $divisionId)
            ->pluck('name')
            ->values();

        return response()->json($filteredDistricts);
    }

    public function getAreas($city)
    {
        $districts = Cache::rememberForever('districts_data', function () {
            $raw = json_decode(file_get_contents(public_path('assets/location/districts.json')), true);
            return collect($raw)->firstWhere('type', 'table')['data'] ?? [];
        });

        $upazilas = Cache::rememberForever('upazilas_data', function () {
            $raw = json_decode(file_get_contents(public_path('assets/location/upazilas.json')), true);
            return collect($raw)->firstWhere('type', 'table')['data'] ?? [];
        });

        $districtId = collect($districts)
            ->first(fn($d) => str_contains(strtolower($d['name']), strtolower($city)))['id'] ?? null;

        if (!$districtId) {
            return response()->json([]);
        }

        $filteredUpazilas = collect($upazilas)
            ->where('district_id', $districtId)
            ->pluck('name')
            ->values();

        return response()->json($filteredUpazilas);
    }

































































    public function contact_usView()
    {
        return view('frontend.contact_us');
    }

    public function messsage_store(Request $request)
    {
        // Validation rules
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ];

    // Custom error messages
    $messages = [
        'name.required' => 'Name field is required',
        'name.string' => 'Name must be a string',
        'name.max' => 'Name may not be greater than 255 characters',
        'email.required' => 'Email field is required',
        'email.email' => 'Email must be a valid email address',
        'email.max' => 'Email may not be greater than 255 characters',
        'phone.required' => 'Email field is required',
        'message.required' => 'Message field is required',
        'message.string' => 'Message must be a string',
    ];

    // Validate the incoming request
    $validator = Validator::make($request->all(), $rules, $messages);

    // If validation fails, redirect back with errors
    if ($validator->fails()) {
        return redirect()->back()->with('warning', $validator->errors()->first());
    }

        $data = new Message();
        $data->id = $request->id;
        $data->name = $request->name;
        $data->email = $request->email;          
        $data->phone = $request->phone;          
        $data->message = $request->message;          
        $data->status = $request->status;      
        $data->sent_date = $request->sent_date;      
        $data->save();

        $find_email = json_decode(get_settings('contact_email'), true); // Passing true as the second argument to json_decode to decode as an associative array
        $firstemail = $find_email[0];

        if(!empty(get_settings('smtp_user')) && (get_settings('smtp_pass')) && (get_settings('smtp_host')) && (get_settings('smtp_port'))){
            Mail::to($firstemail)->send(new Message_form_user($data));
        }
        return redirect()->back()->with('success', 'Message sent successfully.');
    }
    
    public function servicesView()
    {   
        $projects = Item::with('category')->orderBy('created_at', 'desc')->paginate(6);
        $categories = Project_category::withCount('projects')->orderBy('created_at', 'desc')->get();
        $agency_progresses = Agency_progress::get();
        $services = Service::get();
        $packages = Package::get();
        return view('frontend.services', compact('agency_progresses', 'services', 'packages', 'projects', 'categories'));
    }

    public function services_detailsView()
    {
        $projects = Item::with('category')->orderBy('created_at', 'desc')->paginate(20);
        $categories = Project_category::withCount('projects')->orderBy('created_at', 'desc')->get();
        return view('frontend.services_details', compact('projects', 'categories'));
    }

    public function about_usView()
    {   
        $teamMembers = TeamMember::paginate(8);
        $partner_logos = Partner_logo::get();
        $testimonials = Testimonial::get();
        $services = Service::get();
        return view('frontend.about_us', compact('services', 'testimonials', 'partner_logos', 'teamMembers'));
    }

    public function our_teamsView()
    {   
        $agency_progresses = Agency_progress::get();
        $teamMembers = TeamMember::all();
        return view('frontend.our_team', compact('teamMembers', 'agency_progresses'));
    }

    public function team_detailsView($id)
    {
        $teamMember = TeamMember::where('id', $id)->first();
        return view('frontend.team_details', compact('teamMember'));
    }
    // public function itemView(Request $request)
    // {
    //     $search = $request->input('search');
    //     $categoryId = $request->input('category_id');
    //     $licenses = $request->input('licenses');
    //     $sortBy = $request->input('sort_by');

    //     $query = Item::with('category');

    //     // Search filter
    //     if (!empty($search)) {
    //         $query->where('item_title', 'LIKE', "%{$search}%");
    //     }

    //     // Category filter
    //     if (!empty($categoryId)) {
    //         $query->where('item_category', $categoryId);
    //     }

    //     // License filter
    //     if (!empty($licenses)) {
    //         $query->where(function ($q) use ($licenses) {
    //             if (in_array('free', $licenses)) {
    //                 $q->Where('price', '=', 0);
    //             }
    //             if (in_array('premium', $licenses)) {
    //                 $q->Where('price', '>', 0);
    //             }
    //         });
    //     }
        

    //     // Sort filter
    //     if ($sortBy === 'popular') {
    //         $query->withCount('paymentHistories')->orderBy('payment_histories_count', 'desc');
    //     } elseif ($sortBy === 'high_price') {
    //         $query->orderBy('price', 'desc');
    //     } elseif ($sortBy === 'low_price') {
    //         $query->orderBy('price', 'asc');
    //     } elseif ($sortBy === 'free') {
    //         $query->orWhere('price', '=', 0);
    //     } elseif ($sortBy === 'discount') {
    //         $query->orWhere('discounted_percent', '>', 0)->orderBy('created_at', 'desc');
    //     }   else {
    //         $query->orderBy('created_at', 'desc'); // default
    //     }

    //     $items = $query->paginate(9)->appends($request->query());

    //     $categories = Project_category::withCount('projects')->orderBy('created_at', 'desc')->get();

    //     return view('frontend.item', compact('categories', 'items', 'search'));
    // }

    public function itemView(Request $request)
    {
        log_visit();

        $search = $request->input('search');
        $categoryId = $request->input('category_id');
        $licenses = $request->input('licenses');
        $sortBy = $request->input('sort_by');

        $query = Item::with('category');

        // Search filter
        if (!empty($search)) {
            $query->where('item_title', 'LIKE', "%{$search}%");
        }

        // Category filter
        $selectedCategoryName = 'All Items';
        if (!empty($categoryId)) {
            $query->where('item_category', $categoryId);

            $category = Project_category::find($categoryId);
            if ($category) {
                $selectedCategoryName = $category->category_name;
            }
        }

        // License filter
        if (!empty($licenses)) {
            $query->where(function ($q) use ($licenses) {
                if (in_array('free', $licenses)) {
                    $q->Where('price', '=', 0);
                }
                if (in_array('premium', $licenses)) {
                    $q->Where('price', '>', 0);
                }
            });
        }

        // Sort filter
        if ($sortBy === 'popular') {
            $query->withCount('paymentHistories')->orderBy('payment_histories_count', 'desc');
        } elseif ($sortBy === 'high_price') {
            $query->orderBy('price', 'desc');
        } elseif ($sortBy === 'low_price') {
            $query->orderBy('price', 'asc');
        } elseif ($sortBy === 'free') {
            $query->orWhere('price', '=', 0);
        } elseif ($sortBy === 'discount') {
            $query->orWhere('discounted_percent', '>', 0)->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'desc'); // default
        }

        $items = $query->paginate(9)->appends($request->query());

        $categories = Project_category::withCount('projects')->orderBy('created_at', 'desc')->get();

        return view('frontend.item', compact('categories', 'items', 'search', 'selectedCategoryName'));
    }



    public function projects_detailsView($slug, $id, Request $request)
    {
        log_visit($id);
        $user_id = auth()->check() ? auth()->user()->id : null;

        $payment = null;
        if ($user_id) {
            $payment = PaymentHistory::where('item_id', $id)
                ->where('user_id', $user_id)
                ->orderBy('created_at', 'desc')
                ->first();
        }

        $categories = Project_category::withCount('projects')->orderBy('created_at', 'desc')->get();
        $items = Item::with('category')->orderBy('created_at', 'desc')->paginate(4);
        $item = Item::where('id', $id)->first();

        $show = $request->input('show', 5);

        $comments = Comment::with(['replies.user', 'user'])
        ->where('item_id', $item->id)
        ->whereNull('parent_id') // Only root level comments
        ->orderBy('created_at', 'desc')
        ->get();

        $countComment = Comment::with(['replies.user', 'user'])
        ->where('item_id', $item->id)
        ->whereNull('parent_id') // Only root level comments
        ->count();

        $allReviews = Review::where('item_id', $id)->with('user')->latest()->get();
        $averageRating = round(Review::where('item_id', $id)->avg('rating'), 1);

        $totalCommentCount = Comment::where('item_id', $id)
            ->whereNull('parent_id')
            ->count();
        $totalDownloadCount = DownloadHistory::where('item_id', $id)
            ->count();

        return view('frontend.project_details', compact('allReviews', 'averageRating', 'countComment', 'item', 'categories', 'items', 'payment', 'comments', 'totalCommentCount', 'show', 'totalDownloadCount'));
    }



    public function blogsView(Request $request)
    {
        // Retrieve all blog keywords from the database
        $keywords = All_blog::pluck('blog_keywords');

        // Initialize an array to store keyword counts
        $keywordCounts = [];

        // Process each keyword string
        foreach ($keywords as $keywordString) {
            if ($keywordString) {
                // Split the string into individual keywords
                $individualKeywords = explode(',', $keywordString);

                // Trim whitespace and count each keyword
                foreach ($individualKeywords as $keyword) {
                    $keyword = Str::of($keyword)->trim()->lower(); // Normalize the keyword to a string

                    if ($keyword->isNotEmpty()) {
                        $keyword = (string) $keyword; // Ensure keyword is a string
                        if (isset($keywordCounts[$keyword])) {
                            $keywordCounts[$keyword]++;
                        } else {
                            $keywordCounts[$keyword] = 1;
                        }
                    }
                }
            }
        }

        // Sort the keywords by count in descending order
        arsort($keywordCounts);

        // Convert the associative array to a collection and get the top 10 keywords
        $popularKeywords = collect($keywordCounts)->take(10);

            $search = $request->input('search') ?? "";
    
            if($search != "") {
                $blogs = All_blog::where('blog_title', 'LIKE', "%{$search}%")
                    ->orWhere('blog_description', 'LIKE', "%{$search}%")
                    ->orWhere('blog_keywords', 'LIKE', "%{$search}%")
                    ->get();
                    $blog_categories = Blog_category::withCount('blogs')->orderBy('created_at', 'desc')->get();
                    $latest_blogs = All_blog::with('category')->orderBy('created_at', 'desc')->paginate(3);
            } else {
                $blogs = All_blog::with('category')->orderBy('created_at', 'desc')->paginate(10);
                $latest_blogs = All_blog::with('category')->orderBy('created_at', 'desc')->paginate(3);
                $blog_categories = Blog_category::withCount('blogs')->orderBy('created_at', 'desc')->get();
            }
    
    
            return view('frontend.blogs', compact('blogs', 'blog_categories', 'popularKeywords', 'latest_blogs', 'search'));

        return view('frontend.blogs', compact('blogs', 'blog_categories', 'popularKeywords', 'latest_blogs', 'search'));
    }

    public function category_wise_blogView(Request $request , $id)
    {
        $keywords = All_blog::pluck('blog_keywords');

        $keywordCounts = [];

        foreach ($keywords as $keywordString) {
            if ($keywordString) {
                $individualKeywords = explode(',', $keywordString);

                foreach ($individualKeywords as $keyword) {
                    $keyword = Str::of($keyword)->trim()->lower(); 

                    if ($keyword->isNotEmpty()) {
                        $keyword = (string) $keyword;
                        if (isset($keywordCounts[$keyword])) {
                            $keywordCounts[$keyword]++;
                        } else {
                            $keywordCounts[$keyword] = 1;
                        }
                    }
                }
            }
        }

        arsort($keywordCounts);

        $popularKeywords = collect($keywordCounts)->take(10);

        $search = $request->input('search') ?? "";
    
            if($search != "") {
                $blogs = All_blog::where('blog_title', 'LIKE', "%{$search}%")
                    ->orWhere('blog_description', 'LIKE', "%{$search}%")
                    ->orWhere('blog_keywords', 'LIKE', "%{$search}%")
                    ->get();
                    $blog_categories = Blog_category::withCount('blogs')->orderBy('created_at', 'desc')->get();
                    $latest_blogs = All_blog::with('category')->orderBy('created_at', 'desc')->paginate(3);
            } else {
                $blogs = All_blog::with('category')->orderBy('created_at', 'desc')->paginate(10);
                $latest_blogs = All_blog::with('category')->orderBy('created_at', 'desc')->paginate(3);
                $blog_categories = Blog_category::withCount('blogs')->orderBy('created_at', 'desc')->get();
            }

        $latest_blogs = All_blog::with('category')->orderBy('created_at', 'desc')->paginate(3);
        $blogs = All_blog::with('category')->where('blog_category', $id )->get();
        $blog_categories = Blog_category::withCount('blogs')->orderBy('created_at', 'desc')->get();
        return view('frontend.category_wise_blog', compact( 'latest_blogs', 'blogs', 'blog_categories', 'popularKeywords', 'search'));
    }

    public function blog_detailsView(Request $request , $id)
    {
        $keywords = All_blog::pluck('blog_keywords');

        $keywordCounts = [];

        foreach ($keywords as $keywordString) {
            if ($keywordString) {
                // Split the string into individual keywords
                $individualKeywords = explode(',', $keywordString);

                // Trim whitespace and count each keyword
                foreach ($individualKeywords as $keyword) {
                    $keyword = Str::of($keyword)->trim()->lower(); // Normalize the keyword to a string

                    if ($keyword->isNotEmpty()) {
                        $keyword = (string) $keyword; // Ensure keyword is a string
                        if (isset($keywordCounts[$keyword])) {
                            $keywordCounts[$keyword]++;
                        } else {
                            $keywordCounts[$keyword] = 1;
                        }
                    }
                }
            }
        }

        // Sort the keywords by count in descending order
        arsort($keywordCounts);

        // Convert the associative array to a collection and get the top 10 keywords
        $popularKeywords = collect($keywordCounts)->take(10);

        $search = $request->input('search') ?? "";
    
            if($search != "") {
                $blogs = All_blog::where('blog_title', 'LIKE', "%{$search}%")
                    ->orWhere('blog_description', 'LIKE', "%{$search}%")
                    ->orWhere('blog_keywords', 'LIKE', "%{$search}%")
                    ->get();
                    $blog_categories = Blog_category::withCount('blogs')->orderBy('created_at', 'desc')->get();
                    $latest_blogs = All_blog::with('category')->orderBy('created_at', 'desc')->paginate(3);
            } else {
                $blogs = All_blog::with('category')->orderBy('created_at', 'desc')->paginate(10);
                $latest_blogs = All_blog::with('category')->orderBy('created_at', 'desc')->paginate(3);
                $blog_categories = Blog_category::withCount('blogs')->orderBy('created_at', 'desc')->get();
            }

        $blog = All_blog::where('id', $id)->first();
        $latest_blogs = All_blog::with('category')->orderBy('created_at', 'desc')->paginate(3);

        $blog_categories = Blog_category::withCount('blogs')->orderBy('created_at', 'desc')->get();
        return view('frontend.blog_details', compact('blog', 'popularKeywords', 'latest_blogs', 'blog_categories', 'search'));
    }

    public function loadMoreComments(Request $request, $item_id)
    {

        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 5);

        $comments = Comment::with('replies')
            ->where('item_id', $item_id)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($limit)
            ->get();

        $commentData = [];

        foreach ($comments as $comment) {
            $user = User::where('id', $comment->user_id)->first();
            $replies = [];

            foreach ($comment->replies as $reply) {
                $replyUser = User::where('id', $reply->user_id)->first();
                $replies[] = [
                    'name' => $replyUser->name,
                    'feadback' => $reply->feadback,
                    'time' => $reply->created_at->diffForHumans()
                ];
            }

            $commentData[] = [
                'name' => $user->name,
                'image' => $user->image ? asset('public/assets/upload/user_image/' . $user->image) : asset('public/assets/frontend/img/user_default.png'),
                'feadback' => $comment->feadback,
                'time' => $comment->created_at->diffForHumans(),
                'replies' => $replies
            ];
        }

        return response()->json($commentData);
    }

    public function replyComment(Request $request, $id)
    {
        $parentComment = Comment::findOrFail($id);

        Comment::create([
            'item_id' => $parentComment->item_id,
            'user_id' => auth()->user()->id,
            'feadback' => $request->feadback,
            'parent_id' => $parentComment->id,
        ]);

        return back()->with('success', 'Reply added!');
    }

    public function filterItems(Request $request)
    {

        $query = Item::query();
    
        if ($request->filled('category_id')) {
            $query->where('item_category', $request->category_id);
        }
    
        if ($request->licenses) {
            $query->where(function ($q) use ($request) {
                if (in_array('free', $request->licenses)) {
                    $q->orWhere('price', 0);
                }
                if (in_array('premium', $request->licenses)) {
                    $q->orWhere('price', '>', 0);
                }
            });
        }
    
        // 🔀 Sorting
        if ($request->sort_by == 'high_price') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort_by == 'low_price') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort_by == 'popular') {
            $query->withCount(['paymentHistories as total_sales' => function ($q) {
                $q->select(\DB::raw("count(*)"));
            }])->orderByDesc('total_sales');
        } elseif ($request->sort_by == 'all') {
            $query->latest(); 
        }elseif ($request->sort_by == 'popular') {
            $query->where('lebel', 'populer'); // Match the homepage logic
        }
        
        // Category filter
        $selectedCategoryName = 'All Items';
        if (!empty($request->category_id)) {
            $query->where('item_category', $request->category_id);
        
            $category = Project_category::find($request->category_id);
            if ($category) {
                $selectedCategoryName = $category->category_name;
            }
        }
        
        

    
        $items = $query->paginate(9); // 🧾 Make sure pagination is applied
    
        return view('frontend.filtered-items', compact('items', 'selectedCategoryName'))->render();
        
        
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        $results = Item::where('item_title', 'like', '%' . $query . '%')->get(['id', 'item_title']);

        return response()->json($results);
    }
    




    
}
