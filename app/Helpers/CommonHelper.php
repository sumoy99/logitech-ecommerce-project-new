<?php
use App\Models\User;
use App\Models\Visit;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

// Global Settings
if (!function_exists('get_settings')) {
    function get_settings($key = '', $type='')
    {
        $global_settings = DB::table('global_settings')->where('key', $key)->value('value');

        if($type == 'json') {
            $global_settings = json_decode($global_settings);
        }

        return $global_settings;
    }
}
// Service Settings
if (!function_exists('service_settings')) {
    function service_settings($key = '', $type='')
    {
        $service_settings = DB::table('service_settings')->where('key', $key)->value('value');

        if($type == 'json') {
            $service_settings = json_decode($service_settings);
        }

        return $service_settings;
    }
}



if (! function_exists('phrase')) {
    function phrase($string = '') {
        return $string;
    }
}

if ( ! function_exists('get_all_language'))
{
    function get_all_language(){
        return DB::table('language')->select('name')->distinct()->get();
    }
}

if ( ! function_exists('get_phrase'))
{
    function get_phrase($phrase = '') {
        if(isset(auth()->user()->id)) {
            $active_language = User::where('id', auth()->user()->id)->value('language');
        } else {
            $active_language = get_settings('language');
        }
    

        $query = DB::table('language')->where('name', $active_language)->where('phrase', $phrase);
        if($query->get()->count() == 0){
            $translated = $phrase;

            $all_language = get_all_language();

            if($all_language->count() > 0){
                foreach($all_language as $language){

                    if(DB::table('language')->where('name', $language->name)->where('phrase', $phrase)->get()->count() == 0){
                        DB::table('language')->insert(array('name' => $language->name, 'phrase' => $phrase, 'translated' => $translated));
                    }
                }
            }else{
                DB::table('language')->insert(array('name' => 'english', 'phrase' => $phrase, 'translated' => $translated));
            }
            return $translated;
        }
        return $query->value('translated');
    }
}

// Config Settings
if (!function_exists('set_config')) {
    function set_config($key = '', $value='')
    {
        $config = json_decode(file_get_contents(base_path('config/config.json')), true);

        $config[$key] = $value;

        file_put_contents(base_path('config/config.json'), json_encode($config));
    }
}

if (!function_exists('currency')) {
    function currency($price = "")
    {
        $currency_code = DB::table('global_settings')->where('key', 'system_currency')->value('value');
        $symbol = DB::table('currency')->where('code', $currency_code)->value('symbol');
        if(!empty($price)){
            return $price.' '.$symbol;
        } else {
            return $symbol;
        }
    }
}

// Global Settings
if (!function_exists('about_settings')) {
    function about_settings($key = '', $type='')
    {
        $about_settings = DB::table('about_settings')->where('key', $key)->value('value');

        if($type == 'json') {
            $about_settings = json_decode($about_settings);
        }

        return $about_settings;
    }
}

// if (!function_exists('compressAndSaveImage')) {
//     function compressAndSaveImage($imageFile, $savePath, $oldImage = null, $width = 300, $height = 300, $quality = 70, $customFileName = null)
//     {
//         if (!$imageFile) {
//             return null;
//         }

//         $ext = $imageFile->getClientOriginalExtension();

//         $newFileName = $customFileName ?: time() . '.' . $ext;

//         $image = Image::make($imageFile);
//         $image->resize($width, $height, function ($constraint) {
//             $constraint->aspectRatio();
//             $constraint->upsize();
//         })->encode($ext, $quality);

//         if (!File::exists(public_path($savePath))) {
//             File::makeDirectory(public_path($savePath), 0755, true, true);
//         }

//         $image->save(public_path($savePath . $newFileName));

//         if ($oldImage) {
//             File::delete(public_path($savePath . $oldImage));
//         }

//         return $newFileName;
//     }
// }

if (!function_exists('compressAndSaveImage')) {
    function compressAndSaveImage($imageFile, $savePath, $oldImage = null, $width = 800, $height = 800, $quality = 90, $customFileName = null)
    {
        if (!$imageFile) {
            return null;
        }

        $ext = strtolower($imageFile->getClientOriginalExtension());
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($ext, $allowedExt)) {
            $ext = 'jpg'; // fallback
        }

        $newFileName = $customFileName ?: time() . '.' . $ext;

        $image = Image::make($imageFile);

        // 🔹 Maintain better quality resize
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // 🔹 Optional: Sharpen the image slightly to reduce blur
        $image->sharpen(5);

        // 🔹 Save with higher quality
        $image->encode($ext, $quality);

        if (!File::exists(public_path($savePath))) {
            File::makeDirectory(public_path($savePath), 0755, true, true);
        }

        $image->save(public_path($savePath . $newFileName));

        if ($oldImage) {
            File::delete(public_path($savePath . $oldImage));
        }

        return $newFileName;
    }
}






if (!function_exists('log_visit')) {
    function log_visit($id = null)
    {
        $ip     = request()->ip();
        $page   = request()->path();
        $key    = 'visit_' . md5($ip . '_' . $page); // unique key for page+IP

        if (!Cache::has($key)) {
            try {
                Visit::create([
                    'user_id'    => auth()->check() ? auth()->id() : null,
                    'ip_address' => $ip,
                    'page'       => $page,
                    'item_id'    => $id,
                ]);

                // Prevent future insert for 10 minutes from same IP/page
                Cache::put($key, true, now()->addMinutes(10));
            } catch (\Exception $e) {
                \Log::error('Visit log failed: ' . $e->getMessage());
            }
        }
    }
}


if (!function_exists('product_final_price')) {
    /**
     * Get final product price considering discount and flash deal.
     *
     * @param  float $price
     * @param  float|null $discount_price
     * @param  string|null $discount_type   ('percent' or 'flat')
     * @param  string|null $discount_date_range   ('2025-10-01 to 2025-10-15')
     * @param  string|array|null $flash_deal   (JSON string or array: {"discount":10,"type":"percent"})
     * @return float
     */
    function product_final_price($price, $discount_price = null, $discount_type = null, $discount_date_range = null, $flash_deal = null)
    {
        $finalPrice = $price;

        $isDiscountActive = false;
        if ($discount_date_range) {
            $dates = explode(' to ', $discount_date_range);
            if (count($dates) === 2) {
                $start = Carbon::parse($dates[0]);
                $end = Carbon::parse($dates[1]);
                $today = Carbon::today();
                $isDiscountActive = $today->between($start, $end);
            }
        }

        if ($isDiscountActive && $discount_price && $discount_type) {
            if ($discount_type === 'percent') {
                $finalPrice = $price - ($price * ($discount_price / 100));
            } elseif ($discount_type === 'flat') {
                $finalPrice = max($price - $discount_price, 0);
            }
        }

        if ($flash_deal) {
            if (is_string($flash_deal)) {
                $flash_deal = json_decode($flash_deal, true);
            }

            if (is_array($flash_deal) && isset($flash_deal['discount'], $flash_deal['type'])) {
                $fdDiscount = $flash_deal['discount'];
                $fdType = $flash_deal['type'];

                if ($fdType === 'percent') {
                    $finalPrice = $price - ($price * ($fdDiscount / 100));
                } elseif ($fdType === 'flat') {
                    $finalPrice = max($price - $fdDiscount, 0);
                }
            }
        }

        return round($finalPrice, 2);
    }
}

if (!function_exists('getProductColors')) {
    /**
     * Get all color images and info for a product
     *
     * @param \App\Models\Product $product
     * @return array
     */
    function getProductColors($product)
    {
        $colors = [];

        foreach ($product->colorImages as $colorImage) {
            $colors[] = [
                'id' => $colorImage->color->id ?? null,
                'name' => $colorImage->color->name ?? 'Unnamed',
                'hex_code' => $colorImage->color->hex_code ?? '#000000',
                'images' => $colorImage->images ?? [], // already casted as array
            ];
        }

        return $colors;
    }
}

if (!function_exists('getFullProduct')) {
    /**
     * Get full product data with all relationships.
     *
     * @param int $productId
     * @return \App\Models\Product|null
     */
    function getFullProduct($productId)
    {
        return Product::with([
            'category',
            'brand',
            'features',
            'warranty',
            'productFile',
            'productSeo',
            'productShipping',
            'attributes',
            'colorImages.color', // color relationship ধরছে
        ])->find($productId);
    }
}

    // if (!function_exists('getAllProducts')) {
    //     /**
    //      * Get all products with full relationships (optional pagination).
    //      *
    //      * @param int|null $perPage
    //      * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
    //      */
    //     function getAllProducts($perPage = null)
    //     {
    //         $query = Product::with([
    //             'category',
    //             'brand',
    //             'features',
    //             'warranty',
    //             'productFile',
    //             'productSeo',
    //             'productShipping',
    //             'attributes',
    //             'colorImages.color',
    //         ]);

    //         return $perPage ? $query->paginate($perPage) : $query->get();
    //     }
    // }

    if (!function_exists('getAllProducts')) {
        function getAllProducts($perPage = null, $productIds = null)
        {
            $query = Product::with([
                'category',
                'brand',
                'features',
                'warranty',
                'productFile',
                'productSeo',
                'productShipping',
                'attributes',
                'colorImages.color',
            ]);

            if ($productIds) {
                $query->whereIn('id', $productIds);
            }

            return $perPage ? $query->paginate($perPage) : $query->get();
        }
    }


    function delete_file($path) {
    if ($path && file_exists(public_path($path))) {
        unlink(public_path($path));
    }
}

function delete_file_json($json) {
    if (!$json) return;
    $files = json_decode($json, true) ?? [];
    foreach ($files as $file) {
        delete_file($file);
    }
}




?>