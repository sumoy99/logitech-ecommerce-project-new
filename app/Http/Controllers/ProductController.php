<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductFile;
use App\Models\Brand;
use App\Models\ProductAttribute;
use App\Models\Product;
use App\Models\Color;
use App\Models\Warranty;
use App\Models\Category;
use App\Models\ProductShipping;
use App\Models\NoteType;
use App\Models\ProductSeo;
use App\Models\Product_key_feature;
use App\Models\ProductColorImage;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function all_products()
    {
        $page_data['products'] = Product::with('brand', 'category', 'warranty', 'user', 'productFile')
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%')
                    ->orWhereHas('brand', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->orderBy('id', 'DESC')
            ->paginate(20);
            
        return view('superadmin.products.index', $page_data);
    }

    public function createProducts()
    {
        $page_data['categories'] = Category::with('children')
            ->whereNull('parent_id')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        $page_data['brands'] = Brand::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

        $page_data['colors'] = Color::where('status', 'on')
            ->orderBy('id', 'DESC')
            ->get();
            
        $page_data['attributes'] = Attribute::with('values')
            ->orderBy('id', 'DESC')
            ->get();

        $page_data['warranties'] = Warranty::orderBy('id', 'DESC')
            ->get();


        return view('superadmin.products.create', $page_data);
    }

    // public function productStore(Request $request)
    // {
    //     $user_id = auth()->user()->id;

    //     $request->validate([
    //         'name' => 'required|string|unique:products,name',
    //         'category_id' => 'required|exists:categories,id',
    //         'brand_id' => 'nullable|exists:brands,id',
    //         'price' => 'required|numeric|min:0',
    //         'discount_price' => 'nullable|numeric|min:0|lt:price',
    //         'sku' => 'nullable|string|unique:products,sku',
    //         'stock_quantity' => 'nullable|integer|min:0',
    //         'short_description' => 'nullable|string|max:500',
    //         'description' => 'nullable|string',
    //         'meta_title' => 'nullable|string|max:255',
    //         'meta_description' => 'nullable|string|max:500',
    //         'status' => 'required|in:active,inactive,draft',
    //     ]);

    //     $product = Product::create([
    //         'name' => $request->name,
    //         'user_id' => $user_id,
    //         'slug' => Str::slug($request->name),
    //         'category_id' => $request->category_id,
    //         'minimum_purchase' => $request->minimum_purchase,
    //         'tags' => $request->tags,
    //         'refundable' => $request->refundable,
    //         'featured' => $request->featured,
    //         'todays_deal' => $request->todays_deal,
    //         'flash_deal' => $request->flash_deal,
    //         'brand_id' => $request->brand_id,
    //         'price' => $request->price,
    //         'discount_price' => $request->discount_price,
    //         'sku' => $request->sku,
    //         'stock_quantity' => $request->stock_quantity,
    //         'short_description' => $request->short_description,
    //         'long_description' => $request->long_description,
    //         'meta_title' => $request->meta_title,
    //         'meta_description' => $request->meta_description,
    //         'status' => $request->status,
    //     ]);

    //     return redirect()->back()->with('success', 'Product created successfully.');
    // }
    public function storeProducts(Request $request)
    {

        $user_id = auth()->user()->id;
       
        $product = new Product();
        $product->name = $request->name;
        $product->user_id = $user_id; 
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->discount_price = $request->discount_price;
        $product->discount_date_range = $request->discount_date_range;
        $product->discount_type = $request->discount_type;
        $product->price_status = $request->price_status;
        $product->stock_status = $request->stock_status;
        $product->low_stock_warning = $request->low_stock_warning;
        $product->minimum_purchase = $request->minimum_purchase;
        $product->status = $request->status;
        $product->refundable = $request->has('refundable') ? 1 : 0;
        $product->featured = $request->has('featured') ? 1 : 0;
        $product->todays_deal = $request->has('todays_deal') ? 1 : 0;

         if ($request->has('show_stock')) {
                $product->stock_visibilty_state = 1;
            } elseif ($request->has('hide_stock')) {
                $product->stock_visibilty_state = 0;
            }

        $product->flash_deal = json_encode([
            'title' => $request->flash_title,
            'discount' => $request->flas_discount,
            'type' => $request->flas_discount_type,
            'flas_date_range' => $request->flas_date_range,
        ]);

        // Vat
        $product->vat = json_encode([
            'vat' => $request->vat,
            'type' => $request->vat_type,
        ]);

        $product->tax = json_encode([
            'tax' => $request->tax,
            'type' => $request->tax_type,
        ]);

        $product->warrenty_id = $request->has('warrentyStatusToggle')
            ? $request->warrenty_id
            : null;

        if ($request->filled('tags')) {
            try {
                $tagsArray = json_decode($request->tags, true);
                $tags = collect($tagsArray)->pluck('value')->implode(',');
                $product->tags = $tags;
            } catch (\Exception $e) {
                $product->tags = $request->tags;
            }
        }

        if ($request->has('category')) {
            $product->category_id = json_encode($request->category); 
        }
        
        if ($request->has('colors')) {
            $product->colors = json_encode($request->colors); 
        }

        // Generate SKU automatically
        $lastProduct = Product::latest()->first();
        $lastId = $lastProduct ? $lastProduct->id : 0;
        $product->sku = 'PRD-SMY-' . str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);

        $product->save();   


         //  Media Save Part
        $productFile = new ProductFile();

        if ($request->hasFile('thumbnail') || $request->hasFile('gallery_image') || $request->hasFile('video_thumbnail') || $request->hasFile('videos') || $request->hasFile('pdf') || $request->youtube_link) {
            $productFile->product_id = $product->id;
            $productFile->youtube_link = $request->youtube_link ?? null;
        }

        // Thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumbPath = compressAndSaveImage($request->file('thumbnail'), 'assets/upload/products/thumbnails/', 60);
            $productFile->thumbnail = $thumbPath;
        }
        // hover-image
        if ($request->hasFile('hover_image')) {
            $hoverPath = compressAndSaveImage($request->file('hover_image'), 'assets/upload/products/hover_images/', 60);
            $productFile->hover_image = $hoverPath;
        }

        $galleryPaths = [];

        if ($request->hasFile('gallery_image')) {

            foreach ($request->file('gallery_image') as $image) {

                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                $uploadPath = 'assets/upload/products/gallery/';

                $image->move(public_path($uploadPath), $filename);

                $galleryPaths[] = $filename;
            }
        }

        $productFile->gallery_image = json_encode($galleryPaths);


        // Video thumbnail (still image)
        if ($request->hasFile('video_thumbnail')) {
            $videoThumbPath = compressAndSaveImage($request->file('video_thumbnail'), 'assets/upload/products/video_thumbnails/', 60);
            $productFile->video_thumbnail = $videoThumbPath;
        }

        //  Video File (no compression)
        if ($request->hasFile('videos')) {
            $file = $request->file('videos');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = 'assets/upload/products/videos/';
            $file->move(public_path($path), $filename);
            $productFile->videos = $path . $filename;
        }

        //  PDF
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = 'assets/upload/products/pdfs/';
            $file->move(public_path($path), $filename);
            $productFile->pdf = $path . $filename;
        }

        

        $productFile->save();

        if ($request->has('attributes')) {
        $attributes = $request->input('attributes'); // array [attribute_id => [value_id, value_id, ...], ...]

        foreach ($attributes as $attributeId => $valueIds) {
                foreach ($valueIds as $valueId) {
                    ProductAttribute::create([
                        'product_id' => $product->id,
                        'attribute_id' => $attributeId,
                        'attribute_value_id' => $valueId,
                    ]);
                }
            }
        }

        // SEO Insert
        $seo = new ProductSeo();
        $seo->product_id = $product->id;
        $seo->meta_title = $request->meta_title;
        $seo->meta_description = $request->meta_description;

        // Meta Keywords (Tagify - comma separated)
        if ($request->filled('meta_keywords')) {
            try {
                $tagsArray = json_decode($request->meta_keywords, true);
                $metaKeywords = collect($tagsArray)->pluck('value')->implode(',');
                $seo->meta_keywords = $metaKeywords;
            } catch (\Exception $e) {
                $seo->meta_keywords = $request->meta_keywords;
            }
        }

        // Meta Image
        if ($request->hasFile('meta_image')) {
            $seo->meta_image = compressAndSaveImage($request->file('meta_image'), 'assets/upload/products/meta/', 60);
        }

        // Open Graph (Og) Tags
        $seo->og_title = $request->og_title;
        $seo->og_description = $request->og_description;

        if ($request->filled('og_keywords')) {
            try {
                $tagsArray = json_decode($request->og_keywords, true);
                $ogKeywords = collect($tagsArray)->pluck('value')->implode(',');
                $seo->og_keywords = $ogKeywords;
            } catch (\Exception $e) {
                $seo->og_keywords = $request->og_keywords;
            }
        }

        if ($request->hasFile('og_image')) {
            $seo->og_image = compressAndSaveImage($request->file('og_image'), 'assets/upload/products/og/', 60);
        }

        $seo->index_status = $request->index_status ?? 'index';
        $seo->follow_status = $request->follow_status ?? 'follow';
        $seo->canonical_url = $request->canonical_url ?? null;

        $seo->save();

         // Shipping save
        $shipping = new ProductShipping();
        $shipping->product_id = $product->id;

        $shipping->cash_on_delivery = $request->has('cash_on_delivery') ? 1 : 0;

        if ($request->has('free_shipping')) {
            $shipping->shipping_type = 'free';
            $shipping->shipping_cost = 0;
        } elseif ($request->has('flat_rate')) {
            $shipping->shipping_type = 'flat';
            $shipping->shipping_cost = $request->shipping_cost ?? 0;
        } else {
            $shipping->shipping_type = 'variable';
            $shipping->shipping_cost = $request->shipping_cost ?? 0;
        }

        $shipping->shipping_days = $request->shipping_days ?? null;

        $shipping->note = $request->note ?? null;

        $shipping->save();

        $features = json_decode($request->key_features_json, true);
        

         // Save Key Features

        if (!empty($features)) {
            foreach ($features as $feature) {
                Product_key_feature::create([
                    'product_id' => $product->id,
                    'feature_name' => $feature['feature_name'],
                    'feature_value' => $feature['feature_value'] ?? null,
                ]);
            }
        }

        if ($request->has('color_images')) {
            foreach ($request->color_images as $colorId => $files) {
                $color = Color::find($colorId);
                if (!$color) continue;

                $filenames = [];
                foreach ($files as $file) {
                    $filename = $lastProduct->slug . '-' . Str::slug($color->name) . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                    $uploadPath = public_path('assets/upload/products/colors');
                    if (!file_exists($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                    }

                    $file->move($uploadPath, $filename);
                    $filenames[] = $filename;
                }

                ProductColorImage::create([
                    'product_id' => $product->id,
                    'color_id'   => $colorId,
                    'images'     => $filenames, 
                ]);
            }
        }

        session()->flash('notify', [
            'title' => 'Success!',
            'message' => 'Product created successfully!',
            'type' => 'success'
        ]);

        return redirect()->route('superadmin.products.index');
    }


    public function editProducts($id)
    {
        $page_data['product'] = Product::with('productFile', 'productSeo', 'productShipping', 'attributes.attribute', 'attributes.value')
            ->where('id', $id)
            ->firstOrFail();

        $page_data['categories'] = Category::with('children')
            ->whereNull('parent_id')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        $page_data['brands'] = Brand::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

        $page_data['colors'] = Color::where('status', 'on')
            ->orderBy('id', 'DESC')
            ->get();
            
        $page_data['attributes'] = Attribute::with('values')
            ->orderBy('id', 'DESC')
            ->get();

        $page_data['productAttribute'] = ProductAttribute::where('product_id', $id)
            ->orderBy('id', 'DESC')
            ->first();

        $page_data['features'] = Product_key_feature::where('product_id', $page_data['product']->id)->orderBy('id', 'DESC')
            ->get();

        $page_data['fileMedia'] = ProductFile::where('product_id', $page_data['product']->id)
            ->first();

        $page_data['productColors'] = ProductColorImage::where('product_id', $page_data['product']->id)->orderBy('id', 'DESC')
        ->first();

        $page_data['galleries'] = json_decode($page_data['fileMedia']->gallery_image);

        $page_data['warranties'] = Warranty::orderBy('id', 'DESC')
            ->get();

        $page_data['productSeo'] = ProductSeo::where('product_id', $id)
            ->orderBy('id', 'DESC')
            ->first();

        $page_data['productShipping'] = ProductShipping::where('product_id', $id)
            ->orderBy('id', 'DESC')
            ->first();

        $page_data['flashDeals'] = json_decode($page_data['product']->flash_deal);

        $page_data['selectedCategories'] = is_array($page_data['product']->category_id)
                    ? $page_data['product']->category_id
                    : json_decode($page_data['product']->category_id ?? '[]', true);

        return view('superadmin.products.edit', $page_data);
    }

    public function updateProducts(Request $request, $id)
    {
        // dd($request->file('gallery_image'));

        $user_id = auth()->user()->id;
        $product = Product::findOrFail($id);

        // === Basic Product Fields ===
        $product->name = $request->name;
        $product->user_id = $user_id;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->discount_price = $request->discount_price;
        $product->discount_date_range = $request->discount_date_range;
        $product->discount_type = $request->discount_type;
        $product->price_status = $request->price_status;
        $product->stock_status = $request->stock_status;
        $product->low_stock_warning = $request->low_stock_warning;
        $product->minimum_purchase = $request->minimum_purchase;
        $product->status = $request->status;
        $product->refundable = $request->has('refundable') ? 1 : 0;
        $product->featured = $request->has('featured') ? 1 : 0;
        $product->todays_deal = $request->has('todays_deal') ? 1 : 0;

        if ($request->has('show_stock')) {
            $product->stock_visibilty_state = 1;
        } elseif ($request->has('hide_stock')) {
            $product->stock_visibilty_state = 0;
        }

        $product->flash_deal = json_encode([
            'title' => $request->flash_title,
            'discount' => $request->flas_discount,
            'type' => $request->flas_discount_type,
            'flas_date_range' => $request->flas_date_range,
        ]);

        $product->vat = json_encode([
            'vat' => $request->vat,
            'type' => $request->vat_type,
        ]);

        $product->tax = json_encode([
            'tax' => $request->tax,
            'type' => $request->tax_type,
        ]);

        $product->warrenty_id = $request->has('warrentyStatusToggle') ? $request->warrenty_id : null;

        // Tags
        if ($request->filled('tags')) {
            try {
                $tagsArray = json_decode($request->tags, true);
                $tags = collect($tagsArray)->pluck('value')->implode(',');
                $product->tags = $tags;
            } catch (\Exception $e) {
                $product->tags = $request->tags;
            }
        } else {
            $product->tags = null;
        }

        // Category
        $product->category_id = $request->has('category') ? json_encode($request->category) : null;

        // Colors
        $product->colors = $request->has('colors') ? json_encode($request->colors) : null;

        $product->save();

        // === Media Update ===
        $productFile = $product->productFile ?? new ProductFile();
        $productFile->product_id = $product->id;
        $productFile->youtube_link = $request->filled('youtube_link') ? $request->youtube_link : null;

        // === Thumbnail ===
        if ($request->hasFile('thumbnail')) {
            if ($productFile->thumbnail && file_exists(public_path($productFile->thumbnail))) {
                unlink(public_path($productFile->thumbnail));
            }
            $thumbPath = compressAndSaveImage($request->file('thumbnail'), 'assets/upload/products/thumbnails/', 60);
            $productFile->thumbnail = $thumbPath;
        }

        // === Hover Image ===
        if ($request->hasFile('hover_image')) {
            if ($productFile->hover_image && file_exists(public_path($productFile->hover_image))) {
                unlink(public_path($productFile->hover_image));
            }
            $hoverPath = compressAndSaveImage($request->file('hover_image'), 'assets/upload/products/hover_images/', 60);
            $productFile->hover_image = $hoverPath;
        }

            

            $keepOldImages = json_decode($request->input('old_gallery_images'), true) ?? [];
            $newGalleryPaths = [];

            if ($request->hasFile('gallery_image')) {
                foreach ($request->file('gallery_image') as $image) {

                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();

                    $image->move(public_path('assets/upload/products/gallery/'), $filename);

                    $newGalleryPaths[] = $filename;
                }
            }

            $currentGallery = $productFile->gallery_image ? json_decode($productFile->gallery_image, true) : [];
            $toDelete = array_diff($currentGallery, $keepOldImages);

            foreach ($toDelete as $file) {
                $path = public_path($file);
                if (file_exists($path)) unlink($path);
            }

            $productFile->gallery_image = json_encode(array_merge($keepOldImages, $newGalleryPaths));



        // === Video Thumbnail ===
        if ($request->hasFile('video_thumbnail')) {
            if ($productFile->video_thumbnail && file_exists(public_path($productFile->video_thumbnail))) {
                unlink(public_path($productFile->video_thumbnail));
            }
            $videoThumbPath = compressAndSaveImage($request->file('video_thumbnail'), 'assets/upload/products/video_thumbnails/', 60);
            $productFile->video_thumbnail = $videoThumbPath;
        }

        // === Video File ===
        if ($request->hasFile('videos')) {
            if ($productFile->videos && file_exists(public_path($productFile->videos))) {
                unlink(public_path($productFile->videos));
            }
            $file = $request->file('videos');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = 'assets/upload/products/videos/';
            $file->move(public_path($path), $filename);
            $productFile->videos = $path . $filename;
        }

        // === PDF ===
        if ($request->hasFile('pdf')) {
            if ($productFile->pdf && file_exists(public_path($productFile->pdf))) {
                unlink(public_path($productFile->pdf));
            }
            $file = $request->file('pdf');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = 'assets/upload/products/pdfs/';
            $file->move(public_path($path), $filename);
            $productFile->pdf = $path . $filename;
        }

        $productFile->save();

        // === Attributes Update ===
        ProductAttribute::where('product_id', $product->id)->delete();
        if ($request->has('attributes')) {
            $attributes = $request->input('attributes');
            foreach ($attributes as $attributeId => $valueIds) {
                foreach ($valueIds as $valueId) {
                    ProductAttribute::create([
                        'product_id' => $product->id,
                        'attribute_id' => $attributeId,
                        'attribute_value_id' => $valueId,
                    ]);
                }
            }
        }

        // === SEO Update ===
        $seo = $product->productSeo ?? new ProductSeo();
        $seo->product_id = $product->id;
        $seo->meta_title = $request->meta_title;
        $seo->meta_description = $request->meta_description;

        if ($request->filled('meta_keywords')) {
            try {
                $tagsArray = json_decode($request->meta_keywords, true);
                $metaKeywords = collect($tagsArray)->pluck('value')->implode(',');
                $seo->meta_keywords = $metaKeywords;
            } catch (\Exception $e) {
                $seo->meta_keywords = $request->meta_keywords;
            }
        } else {
            $seo->meta_keywords = null;
        }

        if ($request->hasFile('meta_image')) {
            if ($seo->meta_image && file_exists(public_path($seo->meta_image))) {
                unlink(public_path($seo->meta_image));
            }
            $seo->meta_image = compressAndSaveImage($request->file('meta_image'), 'assets/upload/products/meta/', 60);
        }

        $seo->og_title = $request->og_title;
        $seo->og_description = $request->og_description;

        if ($request->filled('og_keywords')) {
            try {
                $tagsArray = json_decode($request->og_keywords, true);
                $ogKeywords = collect($tagsArray)->pluck('value')->implode(',');
                $seo->og_keywords = $ogKeywords;
            } catch (\Exception $e) {
                $seo->og_keywords = $request->og_keywords;
            }
        } else {
            $seo->og_keywords = null;
        }

        if ($request->hasFile('og_image')) {
            if ($seo->og_image && file_exists(public_path($seo->og_image))) {
                unlink(public_path($seo->og_image));
            }
            $seo->og_image = compressAndSaveImage($request->file('og_image'), 'assets/upload/products/og/', 60);
        }

        $seo->index_status = $request->index_status ?? 'index';
        $seo->follow_status = $request->follow_status ?? 'follow';
        $seo->canonical_url = $request->canonical_url ?? null;
        $seo->save();

        // === Shipping Update ===
        $shipping = $product->productShipping ?? new ProductShipping();
        $shipping->product_id = $product->id;
        $shipping->cash_on_delivery = $request->has('cash_on_delivery') ? 1 : 0;

        if ($request->has('free_shipping')) {
            $shipping->shipping_type = 'free';
            $shipping->shipping_cost = 0;
        } elseif ($request->has('flat_rate')) {
            $shipping->shipping_type = 'flat';
            $shipping->shipping_cost = $request->shipping_cost ?? 0;
        } else {
            $shipping->shipping_type = 'variable';
            $shipping->shipping_cost = $request->shipping_cost ?? 0;
        }

        $shipping->shipping_days = $request->shipping_days ?? null;
        $shipping->note = $request->note ?? null;
        $shipping->save();

        // === Key Features Update ===
        Product_key_feature::where('product_id', $product->id)->delete();
        $features = json_decode($request->key_features_json, true) ?? [];
        foreach ($features as $feature) {
            Product_key_feature::create([
                'product_id' => $product->id,
                'feature_name' => $feature['feature_name'],
                'feature_value' => $feature['feature_value'] ?? null,
            ]);
        }

        // === Color Images Update ===
        ProductColorImage::where('product_id', $product->id)->delete();
        if ($request->has('color_images')) {
            foreach ($request->color_images as $colorId => $files) {
                $color = Color::find($colorId);
                if (!$color) continue;

                $filenames = [];
                foreach ($files as $file) {
                    $filename = $product->slug . '-' . Str::slug($color->name) . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $uploadPath = public_path('assets/upload/products/colors');
                    if (!file_exists($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                    }
                    $file->move($uploadPath, $filename);
                    $filenames[] = 'assets/upload/products/colors/' . $filename;
                }

                ProductColorImage::create([
                    'product_id' => $product->id,
                    'color_id'   => $colorId,
                    'images'     => json_encode($filenames),
                ]);
            }
        }

        session()->flash('notify', [
            'title' => 'Updated!',
            'message' => 'Product updated successfully!',
            'type' => 'success'
        ]);

        return redirect()->route('superadmin.products.index');
    }

    public function deleteProducts($id)
    {
        $product = Product::findOrFail($id);

        // PRODUCT FILES
        $productFile = ProductFile::where('product_id', $product->id)->first();

        if ($productFile) {

            // Delete Thumbnail
            if ($productFile->thumbnail && file_exists(public_path($productFile->thumbnail))) {
                unlink(public_path($productFile->thumbnail));
            }

            // Delete Hover Image
            if ($productFile->hover_image && file_exists(public_path($productFile->hover_image))) {
                unlink(public_path($productFile->hover_image));
            }

            // Delete Gallery Images
            if (!empty($productFile->gallery_image)) {
                $gallery = json_decode($productFile->gallery_image, true);

                foreach ($gallery as $img) {
                    $path = 'assets/upload/products/gallery/' . $img;
                    if (file_exists(public_path($path))) {
                        unlink(public_path($path));
                    }
                }
            }

            // Delete Video Thumbnail
            if ($productFile->video_thumbnail && file_exists(public_path($productFile->video_thumbnail))) {
                unlink(public_path($productFile->video_thumbnail));
            }

            // Delete Video File
            if ($productFile->videos && file_exists(public_path($productFile->videos))) {
                unlink(public_path($productFile->videos));
            }

            // Delete PDF
            if ($productFile->pdf && file_exists(public_path($productFile->pdf))) {
                unlink(public_path($productFile->pdf));
            }

            // Delete ProductFile Record
            $productFile->delete();
        }


        // DELETE SEO
        ProductSeo::where('product_id', $product->id)->delete();

        // DELETE SHIPPING
        ProductShipping::where('product_id', $product->id)->delete();

        // DELETE ATTRIBUTES
        ProductAttribute::where('product_id', $product->id)->delete();

        // DELETE KEY FEATURES
        Product_key_feature::where('product_id', $product->id)->delete();


        // DELETE COLOR-WISE IMAGES
        $colorImages = ProductColorImage::where('product_id', $product->id)->get();

        foreach ($colorImages as $color) {
            foreach ($color->images as $img) {

                $path = public_path('assets/upload/products/colors/' . $img);

                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $color->delete();
        }


        // DELETE MAIN PRODUCT
        $product->delete();


        session()->flash('notify', [
            'title'   => 'Deleted!',
            'message' => 'Product and all related data deleted successfully.',
            'type'    => 'success'
        ]);

        return redirect()->route('superadmin.products.index');
    }

//     public function productbulkDelete(Request $request)
// {
//     $ids = $request->ids;

//     if (!$ids) {
//         return redirect()->back()->with('notify', [
//             'title' => 'Warning!',
//             'message' => 'No product selected.',
//             'type' => 'warning'
//         ]);
//     }

//     foreach ($ids as $id) {
//         $product = Product::find($id);
//         if (!$product) continue;

//         // Delete related files
//         if ($product->productFile) {
//             $pf = $product->productFile;

//             delete_file($pf->thumbnail);
//             delete_file($pf->hover_image);
//             delete_file_json($pf->gallery_image);
//             delete_file($pf->video_thumbnail);
//             delete_file($pf->videos);
//             delete_file($pf->pdf);

//             $pf->delete();
//         }

//         ProductAttribute::where('product_id', $id)->delete();
//         ProductSeo::where('product_id', $id)->delete();
//         ProductShipping::where('product_id', $id)->delete();
//         Product_key_feature::where('product_id', $id)->delete();
//         ProductColorImage::where('product_id', $id)->delete();

//         $product->delete();
//     }

//     return redirect()->back()->with('notify', [
//         'title' => 'Deleted!',
//         'message' => 'Selected products deleted successfully.',
//         'type' => 'success'
//     ]);
// }

public function productbulkDelete(Request $request)
{
    $ids = json_decode($request->ids, true);

    // dd($ids);
    // die;

    foreach ($ids as $id) {
        $this->deleteProducts($id); // your main delete function
    }

    session()->flash('notify', [
        'title' => 'Deleted!',
        'message' => 'Selected products deleted successfully.',
        'type' => 'success'
    ]);

    return redirect()->back();
}





    public function attributeView(Request $request)
    {
        $search = $request->input('search');

        $attributes = Attribute::with('values')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhereHas('values', function ($q) use ($search) {
                        $q->where('value', 'like', '%' . $search . '%');
                    });
            })
            ->orderBy('id', 'DESC')
            ->paginate(20);

        return view('superadmin.attributes.all_attributes', compact('attributes'));
    }

    public function attributeCreate()
    {
        return view('superadmin.attributes.attributes_create');
    }

    public function attributeStore(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|unique:attributes,name',
            'type' => 'nullable|string|in:text,select,checkbox,radio',
        ]);

        Attribute::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'type' => $request->type ?? 'text', 
        ]);
        
        return redirect()->back()->with('success', 'Attribute added successfully.');
    }

    public function attributeValueCreate($id)
    {
        return view('superadmin.attributes.attribute_value_create', compact('id'));
    }

    public function attributeValueStore(Request $request)
    {
        $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|string|max:255'
        ]);
    
        AttributeValue::create([
            'attribute_id' => $request->attribute_id,
            'value' => $request->value
        ]);
    
        return redirect()->back()->with('success', 'Attribute value added successfully.');
    }

    public function attributeValueUpdate(Request $request, $id)
    {
        

        $request->validate([
            'value' => 'required|string|max:255'
        ]);

        $data = AttributeValue::findOrFail($id);
        $data->value = $request->value;

        $data->save();
    
    
        return redirect()->back()->with('success', 'Attribute value updated successfully.');
    }

    public function attributeValueDelete($id)
    {
        $data = AttributeValue::findOrFail($id);

        $data->delete();

        return redirect()->back()->with('success', 'Attribute value deleted successfully!');
    }

    public function attributeEdit($id)
    {
        $attribute = Attribute::where('id', $id)->first();
        return view('superadmin.attributes.attributes_edit', compact('attribute'));
    }

    public function attributeUpdate(request $request, $id)
    {
        $data = $request->all();

        unset($data['_token']);

        Attribute::where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Attribute updated successfully!');
    }

    public function attributeDelete($id)
    {
        $attribute = Attribute::findOrFail($id);

        $attribute->delete();

        return redirect()->back()->with('success', 'Attribute deleted successfully!');
    }

    public function colorIndexView(request $request)
    {

        $search = $request->input('search');

        $colors = Color::when($search, function ($query, $search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('hex_code', 'like', '%' . $search . '%')
                            ->orWhere('status', 'like', '%' . $search . '%');
                          })
        ->orderBy('id', 'DESC')
        ->paginate(20);

        return view('superadmin.color.index', compact('colors'));
    }

    public function colorAdd()
    {
        return view('superadmin.color.add');
    }

    public function colorStore(request $request) 
    {
        $data = $request->all();

        unset($data['_token']);

        Color::create($data);

        return redirect()->back()->with('success', 'Color added successfully!');
    }

    public function colorEdit($id)
    {
        $color = Color::where('id', $id)->first();

        return view('superadmin.color.edit', compact('color'));
    }

    public function colorUpdate(request $request, $id)
    {
        $data = $request->all();

        unset($data['_token']);
        
        $data['status'] = $request->has('status') ? 'on' : 'off';

        Color::where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Color updated successfully!');
    }

    public function colorDelete($id)
    {
        $color = Color::findOrFail($id);

        $color->delete();

        return redirect()->back()->with('success', 'Color deleted successfully!');
    }



    // Brands
    public function brandsIndexView(request $request)
    {
        $search = $request->input('search');

        $brands = Brand::when($search, function ($query, $search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('slug', 'like', '%' . $search . '%')
                            ->orWhere('website', 'like', '%' . $search . '%');
                          })
        ->orderBy('id', 'DESC')
        ->paginate(20);

        return view('superadmin.brands.index', compact('brands'));
    }

    public function brandsAdd()
    {

        return view('superadmin.brands.add');
    }

    public function brandsStore(request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'logo' => 'nullable|image',
        ]);

        $uploadedImagePath = null;

        if ($request->hasFile('logo')) {
            $uploadedImagePath = compressAndSaveImage($request->file('logo'), 'assets/upload/brands/', 50);
        }

        Brand::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name),
            'logo' => $uploadedImagePath,
            'website' => $request->website,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status' => $request->has('status'),
        ]);

        return redirect()->back()->with('success', 'Brand created successfully.');
    }

    public function brandsEdit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('superadmin.brands.edit', compact('brand'));
    }

    public function brandsUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'logo' => 'nullable|image',
        ]);

        $brand = Brand::findOrFail($id); 

        $data = $request->except('_token');

        if ($request->hasFile('logo')) {
            if (!empty($brand->logo)) {
                $oldImagePath = public_path('assets/upload/brands/' . $brand->logo);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        
            $extension = $request->file('logo')->getClientOriginalExtension();
            $seoFriendlyName = Str::slug($request->name) . '-' . time() . '.' . $extension;

            $data['logo'] = compressAndSaveImage($request->file('logo'), 'assets/upload/brands/', $brand->logo, 300, 300, 70, $seoFriendlyName);

        
            $data['logo'] = $seoFriendlyName;
        }

        $data['status'] = $request->has('status') ? 1 : 0;

        $brand->update($data);

        return redirect()->back()->with('success', 'Brand updated successfully!');
    }


    public function brandsDelete($id)
    {
        $brand = Brand::findOrFail($id);

        if ($brand->logo && file_exists(public_path('assets/upload/brands/' . $brand->logo))) {
            unlink(public_path('assets/upload/brands/' . $brand->logo));
        }

        $brand->delete();

        return redirect()->back()->with('success', 'Brand deleted successfully!');
    }

    // Brands
    public function warrantyIndexView(request $request)
    {
        // session()->flash('notify', [
        //     'title' => 'Warranty',
        //     'message' => 'Welcome to warranty page.',
        //     'type' => 'success'
        // ]);

        $search = $request->input('search');

        $warranties = Warranty::when($search, function ($query, $search) {
                        $query->where('title', 'like', '%' . $search . '%');
                          })
        ->orderBy('id', 'DESC')
        ->paginate(20);

        return view('superadmin.warranty.index', compact('warranties'));
    }

    public function warrantyAdd()
    {
        return view('superadmin.warranty.create');
    }

    public function warrantyStore(request $request)
    {
        $request->validate([
            'title' => 'required|unique:warranties,title',
            'logo' => 'nullable|image',
        ]);

        $uploadedImagePath = null;

        if ($request->hasFile('logo')) {
            $uploadedImagePath = compressAndSaveImage($request->file('logo'), 'assets/upload/warranty/', 50);
        }

        Warranty::create([
            'title' => $request->title,
            'logo' => $uploadedImagePath,
        ]);

        session()->flash('notify', [
            'title' => 'Added Successfully!',
            'message' => 'New item has been added.',
            'type' => 'success'
        ]);

        return redirect()->back();
    }

    public function warrantyEdit($id)
    {
        $warranty = Warranty::findOrFail($id);
        return view('superadmin.warranty.edit', compact('warranty'));
    }

    public function warrantyUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:warranties,title,' . $id,
            'logo' => 'nullable|image',
        ]);

        $warranty = Warranty::findOrFail($id); 

        $data = $request->except('_token');

        if ($request->hasFile('logo')) {
            if (!empty($brand->logo)) {
                $oldImagePath = public_path('assets/upload/warranty/' . $warranty->logo);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        
            $extension = $request->file('logo')->getClientOriginalExtension();
            $seoFriendlyName = Str::slug($request->title) . '-' . time() . '.' . $extension;

            $data['logo'] = compressAndSaveImage($request->file('logo'), 'assets/upload/warranty/', $warranty->logo, 300, 300, 70, $seoFriendlyName);

        
            $data['logo'] = $seoFriendlyName;
        }


        $warranty->update($data);

        session()->flash('notify', [
            'title' => 'Warranty updated!',
            'message' => 'Warranty updated successfully!',
            'type' => 'success'
        ]);

        return redirect()->back();
    }


    public function warrantyDelete($id)
    {
        $warranty = Warranty::findOrFail($id);

        if ($warranty->logo && file_exists(public_path('assets/upload/warranty/' . $warranty->logo))) {
            unlink(public_path('assets/upload/warranty/' . $warranty->logo));
        }

        $warranty->delete();

        return redirect()->back()->with('success', 'Warranty deleted successfully!');
    }

    // Notes type
    public function noteTypeView(request $request)
    {
        $search = $request->input('search');

        $noteTypes = NoteType::when($search, function ($query, $search) {
                        $query->where('title', 'like', '%' . $search . '%');
                          })
        ->orderBy('id', 'DESC')
        ->paginate(20);

        return view('superadmin.notes.note_type.index', compact('noteTypes'));
    }

    public function noteTypeAdd()
    {
        return view('superadmin.notes.note_type.create');
    }

    public function noteTypeStore(request $request)
    {
        $request->validate([
            'title' => 'required|unique:note_types,title',
        ]);

        NoteType::create([
            'title' => $request->title,
            'status' => $request->has('status'),
        ]);

        session()->flash('notify', [
            'title' => 'Note Type!',
            'message' => 'Note Type created successfully!',
            'type' => 'success'
        ]);

        return redirect()->back();
    }

    public function noteTypeEdit($id)
    {
        $noteType = NoteType::findOrFail($id);
        return view('superadmin.notes.note_type.edit', compact('noteType'));
    }

    public function noteTypeUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:note_types,title,' . $id,
        ]);

        $noteType = NoteType::findOrFail($id); 

        $data = $request->except('_token');

        $data['status'] = $request->has('status') ? 1 : 0;

        $noteType->update($data);

         session()->flash('notify', [
            'title' => 'Note Type!',
            'message' => 'Note Type updated successfully!',
            'type' => 'success'
        ]);

        return redirect()->back();
    }


    public function noteTypeDelete($id)
    {
        $noteType = NoteType::findOrFail($id);

        $noteType->delete();

        return redirect()->back()->with('success', 'NoteType deleted successfully!');
    }

    // Notes
    public function noteView(request $request)
    {
        $search = $request->input('search');

        $notes = Note::when($search, function ($query, $search) {
                        $query->where('title', 'like', '%' . $search . '%');
                          })
        ->orderBy('id', 'DESC')
        ->paginate(20);

        return view('superadmin.notes.all_notes.index', compact('notes'));
    }

    public function notesAdd()
    {
        $noteTypes = NoteType::get();
        return view('superadmin.notes.all_notes.create', compact('noteTypes'));
    }

    public function notesStore(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:notes,title',
            'type_id' => 'required',
            'description' => 'nullable|string',
            'visibility' => 'required', 
            'status' => 'required', 
        ]);

        Note::create([
            'user_id' => auth()->id(),          
            'type_id' => $request->type_id,
            'title' => $request->title,
            'description' => $request->description,
            'visibility' => $request->visibility,
            'status' => $request->status,
        ]);

        session()->flash('notify', [
            'title' => 'Note!',
            'message' => 'Note created successfully!',
            'type' => 'success'
        ]);

        return redirect()->back();
    }


    public function notesEdit($id)
    {
        $page_data['noteTypes'] = NoteType::get();
        $page_data['note'] = Note::findOrFail($id);

        return view('superadmin.notes.all_notes.edit', $page_data);
    }

    public function notesUpdate(Request $request, $id)
    {
         try {
                $request->validate([
                    'title' => 'required|unique:notes,title,' . $id, // ignore current note title
                    'type_id' => 'required',
                    'description' => 'nullable|string',
                    'visibility' => 'required',
                    'status' => 'required',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                session()->flash('notify', [
                    'title' => 'Validation Error!',
                    'message' => implode(' ', $e->validator->errors()->all()),
                    'type' => 'danger'
                ]);

                return redirect()->back()->withErrors($e->validator)->withInput();
            }

        $note = Note::findOrFail($id); 

        $data = $request->except('_token');

        $data['status'] = $request->has('status') ? 1 : 0;

        $note->update($data);

         session()->flash('notify', [
            'title' => 'Note!',
            'message' => 'Note updated successfully!',
            'type' => 'success'
        ]);

        return redirect()->back();
    }


    public function notesDelete($id)
    {
        $note = Note::findOrFail($id);

        $note->delete();

        return redirect()->back()->with('success', 'Note deleted successfully!');
    }

}
