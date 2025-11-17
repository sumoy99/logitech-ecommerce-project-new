<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
       'id', 'category_id', 'user_id', 'brand_id', 'name', 'slug', 'short_description', 'long_description', 'price', 'price_status', 'discount_price', 'discount_type', 'discount_date_range', 'stock', 'stock_status', 'minimum_purchase', 'tags', 'refundable', 'featured', 'todays_deal', 'flash_deal', 'vat', 'tax', 'sku', 'low_stock_warning', 'stock_visibilty_state', 'warrenty_id', 'status', 'updated_at', 'created_at'
   ];

   

   protected $table = 'products';

    // Accessor for flat_discount_price

    public function getFlatDiscountPriceAttribute()
    {
        $price = $this->price;
        $discount = $this->discount_price;
        $discountType = $this->discount_type;
        $dateRange = $this->discount_date_range;

        // Default final price = normal price
        $finalPrice = $price;

        if ($dateRange) {
            // Parse "YYYY-MM-DD to YYYY-MM-DD"
            [$startDate, $endDate] = array_map('trim', explode('to', $dateRange));

            $today = Carbon::today();

            $start = Carbon::parse($startDate);
            $end = Carbon::parse($endDate);

            // Check if today is within the range
            if ($today->between($start, $end)) {
                // Only apply discount if date is valid
                if ($discountType === 'flat') {
                    $finalPrice = $price - $discount;
                } elseif ($discountType === 'percent') {
                    $finalPrice = $price - (($price * $discount) / 100);
                }
            }
        }

        return max($finalPrice, 0);
    }

    /**
     * Check if product discount is active (based on discount_date_range)
     *
     * @return bool
     */
    // public function getIsDiscountActiveAttribute()
    // {
    //     $dateRange = $this->discount_date_range;

    //     if (!$dateRange || !str_contains($dateRange, 'to')) {
    //         return false;
    //     }

    //     [$start, $end] = array_map('trim', explode('to', $dateRange));

    //     try {
    //         $startDate = Carbon::parse($start);
    //         $endDate = Carbon::parse($end);
    //     } catch (\Exception $e) {
    //         return false; // invalid date format
    //     }

    //     $today = Carbon::today();

    //     return $today->between($startDate, $endDate);
    // }


  
    public function getActiveDiscountTypeAttribute()
    {
        $today = Carbon::today();

        // 1️⃣ Flash deal check
        if (!empty($this->flash_deal)) {
            $flash = json_decode($this->flash_deal);
            if (isset($flash->flas_date_range) && str_contains($flash->flas_date_range, 'to')) {
                [$start, $end] = array_map('trim', explode('to', $flash->flas_date_range));
                $startDate = Carbon::parse($start);
                $endDate = Carbon::parse($end);

                if ($today->between($startDate, $endDate)) {
                    return 'flash_deal';
                }
            }
        }

        // 2️⃣ Normal discount check
        if (!empty($this->discount_date_range) && $this->discount_price > 0) {
            if (str_contains($this->discount_date_range, 'to')) {
                [$start, $end] = array_map('trim', explode('to', $this->discount_date_range));
                $startDate = Carbon::parse($start);
                $endDate = Carbon::parse($end);

                if ($today->between($startDate, $endDate)) {
                    return 'normal_discount';
                }
            }
        }

        return null; // no active discount
    }


    public function getFlashDealEndDateAttribute()
    {
        if (empty($this->flash_deal)) {
            return null;
        }

        $flash = json_decode($this->flash_deal);

        if (isset($flash->flas_date_range) && str_contains($flash->flas_date_range, 'to')) {
            [$start, $end] = array_map('trim', explode('to', $flash->flas_date_range));

            try {
                $endDate = Carbon::parse($end)->endOfDay();
                $now = Carbon::now();

                // যদি এখন সময় already পেরিয়ে যায় তাহলে null
                if ($now->greaterThan($endDate)) {
                    return null;
                }

                return $endDate->diffInSeconds($now);
            } catch (\Exception $e) {
                return null; // invalid date format
            }
        }

        return null;
    }


    public function getActiveDiscountAttribute()
    {
        $today = Carbon::today();

        $activeDiscount = null;
        $activeType = null;

        // Flash deal handle
        if (!empty($this->flash_deal)) {
            $flash = json_decode($this->flash_deal);
            if (isset($flash->flas_date_range) && str_contains($flash->flas_date_range, 'to')) {
                [$start, $end] = array_map('trim', explode('to', $flash->flas_date_range));
                $startDate = Carbon::parse($start);
                $endDate = Carbon::parse($end);

                if ($today->between($startDate, $endDate)) {
                    $activeDiscount = $flash->discount;
                    $activeType = $flash->type;
                }
            }
        }

        // Normal discount handle (only if flash deal not active)
        if (!$activeDiscount && !empty($this->discount_date_range)) {
            if (str_contains($this->discount_date_range, 'to')) {
                [$start, $end] = array_map('trim', explode('to', $this->discount_date_range));
                $startDate = Carbon::parse($start);
                $endDate = Carbon::parse($end);

                if ($today->between($startDate, $endDate)) {
                    $activeDiscount = $this->discount_price;
                    $activeType = $this->discount_type;
                }
            }
        }

        // Return both info together
        return [
            'discount' => $activeDiscount,
            'type' => $activeType,
        ];
    }

    public function getFinalPriceAttribute()
    {
        $today = Carbon::today();

        $price = $this->price;
        $finalPrice = $price;

        // Step 1️⃣ - Try flash deal
        $flashDiscount = null;
        $flashType = null;

        if (!empty($this->flash_deal)) {
            $flash = json_decode($this->flash_deal);
            if (isset($flash->flas_date_range) && str_contains($flash->flas_date_range, 'to')) {
                [$start, $end] = array_map('trim', explode('to', $flash->flas_date_range));
                $startDate = Carbon::parse($start);
                $endDate = Carbon::parse($end);

                if ($today->between($startDate, $endDate)) {
                    $flashDiscount = $flash->discount;
                    $flashType = $flash->type;
                }
            }
        }

        // Step 2️⃣ - Apply flash deal if available
        if ($flashDiscount) {
            if ($flashType == 'percent') {
                $finalPrice = $price - ($price * $flashDiscount / 100);
            } elseif ($flashType == 'flat') {
                $finalPrice = $price - $flashDiscount;
            }
        } 
        // Step 3️⃣ - Otherwise apply normal discount
        elseif ($this->discount_price > 0 && !empty($this->discount_date_range)) {
            if (str_contains($this->discount_date_range, 'to')) {
                [$start, $end] = array_map('trim', explode('to', $this->discount_date_range));
                $startDate = Carbon::parse($start);
                $endDate = Carbon::parse($end);

                if ($today->between($startDate, $endDate)) {
                    if ($this->discount_type == 'percent') {
                        $finalPrice = $price - ($price * $this->discount_price / 100);
                    } elseif ($this->discount_type == 'flat') {
                        $finalPrice = $price - $this->discount_price;
                    }
                }
            }
        }

        // price never below 0
        return max(0, $finalPrice);
    }




    // public function getFinalPriceAttribute()
    // {
    //     return product_final_price(
    //         $this->price,
    //         $this->discount_price,
    //         $this->discount_type,
    //         $this->discount_date_range,
    //         $this->flash_deal
    //     );
    // }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'product_category');
    // }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function warranty()
    {
        return $this->belongsTo(Warranty::class, 'warrenty_id');
    }

    public function productFile()
    {
        return $this->hasOne(ProductFile::class, 'product_id');
    }
    
    public function productSeo()
    {
        return $this->hasOne(ProductSeo::class, 'product_id');
    }

    public function productShipping()
    {
        return $this->hasOne(ProductShipping::class, 'product_id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function features()
    {
        return $this->hasMany(Product_key_feature::class);
    }

    public function colorImages()
    {
        return $this->hasMany(ProductColorImage::class, 'product_id');
    }
        
    
    

    
}
