<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\InvoiceMail;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\BannerImage;
use App\Models\Marquee;
use App\Models\CompanyLogo;
use App\Models\Language;
use App\Models\GlobalSettings;
use App\Models\Service;
use App\Models\Agency_progress;
use App\Models\User;
use App\Models\Message;
use App\Models\Package;
use App\Models\ServiceSetting;
use App\Models\Currency;
use App\Models\About_setting;
use App\Models\Testimonial;
use App\Models\Partner_logo;
use App\Models\TeamMember;
use App\Models\Project_category;
use App\Models\Item;
use App\Models\Blog_category;
use App\Models\Lebel;
use App\Models\All_blog;
use App\Models\ReferralWithdrawRequest;
use App\Mail\Message_reply_mail;
use App\Models\Comment;
use App\Models\PaymentHistory;
use App\Models\Invoice;
use App\Models\Visit;
use App\Notifications\PaymentNotification;
use App\Notifications\ReferralWithdrawNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Notifications\CommentReplyNotification;

class SuperadminController extends Controller
{

    //new

    public function category_list(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('children', function ($childQuery) use ($search) {
                        $childQuery->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('name')
            ->paginate(20);

        return view('superadmin.category.category_list', compact('categories', 'search'));
    }



    public function category_create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('superadmin.category.create_category', compact('categories'));
    }

    public function category_store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'image' => 'nullable|image',
        ]);

        $uploadedImagePath = null;

        if ($request->hasFile('image')) {
            $uploadedImagePath = compressAndSaveImage($request->file('image'), 'assets/upload/category/', 50);
        }

        Category::create([
            'name' => $request->name,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
            'seo_desc' => $request->seo_desc,
            'slug' => Str::slug($request->name),
            'image' => $uploadedImagePath,
            'parent_id' => $request->parent_id,
            'status' => $request->has('status'),
        ]);

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function sub_category_add($id)
    {
        
        $category = Category::where('id', $id)->first();
        
        return view('superadmin.category.sub_category_add', compact('category'));
    }

    public function sub_category_store(Request $request) 
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'image' => 'nullable|image',
        ]);


        $uploadedImagePath = null;

        if ($request->hasFile('image')) {
            $uploadedImagePath = compressAndSaveImage($request->file('image'), 'assets/upload/category/', 50);
        }

        Category::create([
            'name' => $request->name,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
            'seo_desc' => $request->seo_desc,
            'slug' => Str::slug($request->name),
            'image' => $uploadedImagePath,
            'parent_id' => $request->parent_id,
            'status' => $request->has('status'),
        ]);

        return redirect()->back()->with('success', 'Sub category created successfully.');
    }

    public function sub_category_edit($id)
    {
        $subcategory = Category::where('id', $id)->first();
        return view('superadmin.category.sub_category_edit', compact('subcategory'));
    }


    public function sub_category_update(Request $request, $id)
    {

        $subcategory = Category::findOrFail($id);
    
        $subcategory->name = $request->name;
        $subcategory->meta_title = $request->meta_title;
        $subcategory->meta_desc = $request->meta_desc;
        $subcategory->seo_desc = $request->seo_desc;
        $subcategory->status = $request->has('status') ? 1 : 0;
    
        if ($request->hasFile('image')) {

                $uploadedImagePath = compressAndSaveImage($request->file('image'), 'assets/upload/category/', 50);

            if ($subcategory->image && file_exists(public_path().'/assets/upload/category/'.$subcategory->image)) {
                unlink(public_path().'/assets/upload/category/'.$subcategory->image);
            }
            $subcategory->image = $uploadedImagePath;
        }
    
        $subcategory->save();
         
        return redirect()->back()->with('success', 'Subcategory Updated Successfully');
    }


    public function category_edit($id)
    {
        $category = Category::where('id', $id)->first();
        return view('superadmin.category.edit_category', compact('category'));
    }


    public function category_update(Request $request, $id)
    {

        $category = Category::findOrFail($id);
    
        $category->name = $request->name;
        $category->meta_title = $request->meta_title;
        $category->meta_desc = $request->meta_desc;
        $category->seo_desc = $request->seo_desc;
        $category->status = $request->has('status') ? 1 : 0;
    
        if ($request->hasFile('image')) {
            // Store the new image

                $uploadedImagePath = compressAndSaveImage($request->file('image'), 'assets/upload/category/', 50);

            // Delete the old image if it exists
            if ($category->image && file_exists(public_path().'/assets/upload/category/'.$category->image)) {
                unlink(public_path().'/assets/upload/category/'.$category->image);
            }

            $category->image = $uploadedImagePath;
        }
    
        // Save changes
        $category->save();
         
        // Redirect back or wherever needed
        return redirect()->back()->with('success', 'Category Updated Successfully');
    }

    public function sub_category_delete($id)
    {
        $subcategory = Category::findOrFail($id);

        if ($subcategory->image && file_exists(public_path('assets/upload/category/' . $subcategory->image))) {
            unlink(public_path('assets/upload/category/' . $subcategory->image));
        }

        $subcategory->delete();

        return redirect()->back()->with('success', 'Subcategories deleted successfully!');
    }

    public function category_delete($id)
    {
        $category = Category::with('children')->findOrFail($id);

        foreach ($category->children as $child) {
            if ($child->image && file_exists(public_path('assets/upload/category/' . $child->image))) {
                unlink(public_path('assets/upload/category/' . $child->image));
            }
            $child->delete();
        }

        if ($category->image && file_exists(public_path('assets/upload/category/' . $category->image))) {
            unlink(public_path('assets/upload/category/' . $category->image));
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category and its subcategories deleted successfully!');
    }


    public function order_list(Request $request)
    {
        $search = $request->input('search');

        $page_data['orders'] = Order::when($search, function ($query, $search) {
            $query->where('order_number', 'like', "%{$search}%")
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        })
        ->orderBy('created_at', 'DESC')
        ->paginate(20);

        return view('superadmin.orders.index', $page_data);
    }


    public function bulk_order_status($status, $id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = $status;
        $order->save();

        return redirect()->back()->with('success', 'Order Status Updated successfully!');
    }

    public function orderItemsList(Request $request, $id)
    {
        $search = $request->input('search');

        $page_data['orderItems'] = OrderItem::when($search, function ($query, $search) {
            $query->where('product_name', 'like', "%{$search}%")
                ->orWhereDate('created_at', $search);
        })
        ->orderBy('created_at', 'DESC')
        ->paginate(20);

        $page_data['order_id'] = $id;

        return view('superadmin.orders.order_items', $page_data);
    }


    public function bannerImage()
    {
        $page_data['banners'] = BannerImage::orderBy('created_at', 'DESC')->paginate(20);
       
        return view('superadmin.banner_image.index', $page_data);
    }

    public function bannerImageCreate()
    {
        return view('superadmin.banner_image.create');
    }

    public function bannerImageStore(Request $request)
    {
        
        try {
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'url' => 'nullable|url',
            ]);
            

            $fileName = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/upload/banner_images/'), $fileName);
            }

            $banner = new \App\Models\BannerImage();
            $banner->image = $fileName;
            $banner->url = $request->url;
            $banner->status = $request->has('status') ? 1 : 0;
            $banner->save();

            return redirect()->back()->with('success', '✅ Banner image added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '⚠️ Something went wrong: ' . $e->getMessage());
        }
    }

    public function bannerImageEdit($id)
    {
        $page_data['banner'] = BannerImage::where('id', $id)->first();

        return view('superadmin.banner_image.edit', $page_data);
    }

    public function bannerImageUpdate(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
            'url' => 'nullable|url',
        ]);

        $banner = BannerImage::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if (!empty($banner->image) && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            // Upload new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/upload/banner_images/'), $imageName);
            $banner->image = $imageName;
        }

        // Update other fields
        $banner->url = $request->url;
        $banner->status = $request->has('status') ? 1 : 0;
        $banner->save();

        return redirect()->back()->with('success', 'Banner updated successfully.');
    }

    public function bannerImageDelete($id)
    {
        $banner = BannerImage::findOrFail($id);

        if ($banner->image && file_exists(public_path('assets/upload/banner_images/' . $banner->image))) {
            unlink(public_path('assets/upload/banner_images/' . $banner->image));
        }

        $banner->delete();

        return redirect()->back()->with('success', 'Banner deleted successfully!');
    }

    // Marquee

    public function marqueeList(Request $request)
    {
         $search = $request->input('search');

        $page_data['marquees'] = Marquee::when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'DESC')
        ->paginate(20);

        return view('superadmin.marquee.index', $page_data);
    }

    public function marqueeCreate()
    {
        return view('superadmin.marquee.create');
    }

    public function marqueeStore(Request $request)
    {
        $marquee = new \App\Models\Marquee();
        $marquee->title = $request->title;
        $marquee->position = $request->position;
        $marquee->status = $request->has('status') ? 1 : 0;
        $marquee->save();
            
        return redirect()->back()->with('success', 'Marquee added successfully!');
    }


    public function marqueeEdit($id)
    {
        $page_data['marquee'] = Marquee::where('id', $id)->first();

        return view('superadmin.marquee.edit', $page_data);
    }

    public function marqueeUpdate(Request $request, $id)
    {
        $marquee = Marquee::findOrFail($id);

        $marquee->title = $request->title;
        $marquee->position = $request->position;
        $marquee->status = $request->has('status') ? 1 : 0;
        $marquee->save();

        return redirect()->back()->with('success', 'Marquee updated successfully.');
    }

    public function marqueeDelete($id)
    {
        $marquee = Marquee::findOrFail($id);

        $marquee->delete();

        return redirect()->back()->with('success', 'Marquee deleted successfully!');
    }

    //  Company Logo

    public function companyLogoList()
    {
        $page_data['company_logos'] = CompanyLogo::orderBy('created_at', 'DESC')->paginate(20);
       
        return view('superadmin.company_logo.index', $page_data);
    }

    public function companyLogoCreate()
    {
        return view('superadmin.company_logo.create');
    }

    public function companyLogoStore(Request $request)
    {
        
        try {
            $validated = $request->validate([
                'logo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);
            

            $fileName = null;
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/upload/company_logo/'), $fileName);
            }

            $banner = new \App\Models\CompanyLogo();
            $banner->logo = $fileName;
            $banner->status = $request->has('status') ? 1 : 0;
            $banner->save();

            return redirect()->back()->with('success', '✅ Company Logo image added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '⚠️ Something went wrong: ' . $e->getMessage());
        }
    }

    public function companyLogoEdit($id)
    {
        $page_data['company_logo'] = CompanyLogo::where('id', $id)->first();

        return view('superadmin.company_logo.edit', $page_data);
    }

    public function companyLogoUpdate(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
        ]);

        $companyLogo = CompanyLogo::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('logo')) {
            // Delete old image if exists
            if (!empty($companyLogo->logo) && file_exists(public_path($companyLogo->logo))) {
                unlink(public_path($companyLogo->logo));
            }

            // Upload new image
            $imageName = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('assets/upload/company_logo/'), $imageName);
            $companyLogo->logo = $imageName;
        }

        // Update other fields
        $companyLogo->status = $request->has('status') ? 1 : 0;
        $companyLogo->save();

        return redirect()->back()->with('success', 'Company Logo updated successfully.');
    }

    public function companyLogoDelete($id)
    {
        $companyLogo = CompanyLogo::findOrFail($id);

        if ($companyLogo->logo && file_exists(public_path('assets/upload/company_logo/' . $companyLogo->logo))) {
            unlink(public_path('assets/upload/company_logo/' . $companyLogo->logo));
        }

        $companyLogo->delete();

        return redirect()->back()->with('success', 'Company Logo deleted successfully!');
    }












    function superadminDashboard()
    {

        // Daily total visits
        $todayVisits = Visit::whereDate('created_at', Carbon::today())->count();

        // Last hour visits
        $hourVisits = Visit::whereDate('created_at', Carbon::today())
    ->selectRaw('HOUR(created_at) as hour, COUNT(*) as total')
    ->groupBy('hour')
    ->orderBy('hour')
    ->pluck('total', 'hour')
    ->toArray();


        // Top visited items (with item info)
        $topItems = Visit::whereNotNull('item_id')
            ->select('item_id', DB::raw('count(*) as total'))
            ->groupBy('item_id')
            ->orderByDesc('total')
            ->take(10)
            ->get();

        // Join with item table to get item names (if you want to show item title)
        $topItemsWithData = $topItems->map(function ($item) {
            $itemModel = \App\Models\Item::find($item->item_id);
            return [
                'item_id' => $item->item_id,
                'title' => $itemModel ? $itemModel->title : 'Unknown Item',
                'visits' => $item->total,
            ];
        });

        return view('superadmin.dashboard', [
            'todayVisits' => $topItemsWithData,
            'hourVisits' => $hourVisits
        ]);
        

    }
}