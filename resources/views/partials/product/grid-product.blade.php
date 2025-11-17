<style>

</style>
@php
    $thumbnail = $product->productFile->thumbnail;
    $hover_image = $product->productFile?->hover_image;
@endphp
<div class="card-product-grid type-1 bg_white style-8 border-line">
    <div class="card-product-wrapper">
        <a href="{{ route('frontend.product_details', ['product_slug' => $product->slug, 'id' => $product->id]) }}" class="product-img">
            <img class="lazyload img-product"
                data-src="{{ $thumbnail ? asset('assets/upload/products/thumbnails/' . $thumbnail) : asset('assets/backend/assets/img/placeholder.png') }}"
                src="{{ $thumbnail ? asset('assets/upload/products/thumbnails/' . $thumbnail) : asset('assets/backend/assets/img/placeholder.png') }}" alt="image-product">
            <img class="lazyload img-hover"
                data-src="{{ $hover_image ? asset('assets/upload/products/hover_images/' . $hover_image) : asset('assets/backend/assets/img/placeholder.png') }}"
                src="{{ $hover_image ? asset('assets/upload/products/hover_images/' . $hover_image) : asset('assets/backend/assets/img/placeholder.png') }}" alt="image-product">
        </a>

        @if ($product->stock_status == 'Out of stock')
            <div class="sold-out">
                <span>Sold out</span>
            </div>
        @endif
        
       
        <div class="list-product-btn absolute-2">
            @if (auth()->check())
                @php
                    $wishList = DB::table('wish_lists')->where('product_id', $product->id)->where('user_id', auth()->user()->id)->first();
                @endphp
                @if (!empty($wishList))
                    <a href="{{route('frontend.customer.wishListRemove', ['id' => $wishList->id])}}"
                        class="box-icon bg_white wishlist btn-icon-action">
                        <span class="icon icon-delete"></span>
                        <span class="tooltip">Remove from Wishlist</span>
                        <span class="icon icon-delete"></span>
                    </a>
                @else
                    <a href="{{route('frontend.customer.wishListStore', ['id' => $product->id])}}"
                        class="box-icon bg_white wishlist btn-icon-action">
                        <span class="icon icon-heart"></span>
                        <span class="tooltip">Add to Wishlist</span>
                        <span class="icon icon-delete"></span>
                    </a>
                @endif
            @else
                <a href="{{route('frontend.customer.wishListStore', ['id' => $product->id])}}"
                    class="box-icon bg_white wishlist btn-icon-action">
                    <span class="icon icon-heart"></span>
                    <span class="tooltip">Add to Wishlist</span>
                    <span class="icon icon-delete"></span>
                </a>
            @endif
            
            {{-- <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
                class="box-icon bg_white compare btn-icon-action">
                <span class="icon icon-compare"></span>
                <span class="tooltip">Add to Compare</span>
                <span class="icon icon-check"></span>
            </a> --}}
            <a href="javascript:void(0)"
                data-bs-toggle="modal"
                data-bs-target="#quick_view"
                data-id="{{ $product->id }}"
                class="box-icon bg_white quickview tf-btn-loading">
                <span class="icon icon-view"></span>
                <span class="tooltip">Quick View</span>
            </a>
        </div>
        @php
            $discountData = $product->active_discount;
        @endphp


        {{-- @if ($product->active_discount_type == 'flash_deal' && $product->flash_deal_end_date)
            @php
                $flashDeal = json_decode($product->flash_deal);
                $endDate = null;

                if (isset($flashDeal->flas_date_range) && str_contains($flashDeal->flas_date_range, 'to')) {
                    [$start, $end] = array_map('trim', explode('to', $flashDeal->flas_date_range));
                    $endDate = \Carbon\Carbon::parse($end)->endOfDay();
                }
            @endphp

            @if($endDate && now()->lt($endDate))
                <div class="countdown-box">
                    <div class="js-countdown" data-timer="{{ $endDate->timestamp  }}" data-labels="d :,h :,m :,s"></div>
                </div>
            @endif
        @endif --}}

        

        @if ($discountData['discount'])
            <div class="on-sale-wrap text-end">
                <div class="on-sale-item">
                    -{{ $discountData['discount'] }}{{ $discountData['type'] == 'percent' ? '%' : currency() }}
                </div>
            </div>
        @endif
        
        @if ($product->stock_status == 'Upcoming')
            <div class="on-sale-wrap text-start">
                <div class="on-sale-item pre-order">Pre-Order</div>
            </div>
        @endif

       @if ($product->active_discount_type == 'flash_deal' && $product->flash_deal_end_date)
            @php
                $flashDeal = json_decode($product->flash_deal);

                $flashDealTitles = [
                    'end-season' => 'End of Season',
                    'w-sale' => 'Winter Sale',
                    'electronic' => 'Electronic',
                    'f-deal' => 'Flash Deal',
                    'f-sale' => 'Flash Sale',
                ];

                $flashDealTitle = $flashDealTitles[$flashDeal->title] ?? ucfirst(str_replace('-', ' ', $flashDeal->title));
            @endphp

            <div class="on-sale-wrap text-start">
                <div class="on-sale-item pre-order">{{ $flashDealTitle }}</div>
            </div>
        @endif

            {{-- <div class="demo-label">
                @if ($product->stock_status == 'Upcoming')
                <span class="demo-new">Pre-Order</span>
                @endif
                @if ($discountData['discount'])
                <span class="demo-hot">-{{ $discountData['discount'] }}{{ $discountData['type'] == 'percent' ? '%' : currency() }}</span>
                @endif
            </div> --}}
        
    </div>
    <div class="card-product-info text-center">
        <a href="{{ route('frontend.product_details', ['product_slug' => $product->slug, 'id' => $product->id]) }}" class="title link fw-6">{{ ucfirst($product->name) }}</a>
            @if(Route::currentRouteName() == 'frontend.category_products')
                <div class="features_des">
                    @if($product->features->isNotEmpty())
                    <ul>
                        @foreach($product->features as $feature)
                            <li class="features_des_item">
                                <strong>{{ ucfirst($feature->feature_name) }}:</strong>
                                {{ ucfirst($feature->feature_value) ?? '-' }}
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            @endif
                 
            @php
                $finalPrice = $product->final_price;
                $originalPrice = $product->price;
            @endphp

            @if ($finalPrice < $originalPrice)
           
                <span class="price">
                    <span class="fw-4 text-sale price current-price text-muted text-decoration-line-through">
                        {{ currency($originalPrice) }}
                    </span>

                    <span class="text_primary text_red-1 price current-price">
                        {{ currency($finalPrice) }}
                    </span>
                </span>
            @else
                <span class="price current-price">
                    {{ currency($originalPrice) }}
                </span>
            @endif

        @if ($product->colorImages->isNotEmpty())
            <ul class="list-color-product justify-content-center">
                @foreach($product->colorImages as $index => $colorImage)
                    @php
                        $colorName = $colorImage->color->name ?? 'Unnamed';
                        $colorCode = $colorImage->color->hex_code ?? '#ccc';
                        $firstImage = is_array($colorImage->images) && count($colorImage->images) > 0 
                            ? $colorImage->images[0] 
                            : 'assets/backend/assets/img/placeholder.png';
                    @endphp

                    <li class="list-color-item color-swatch {{ $index === 0 ? 'active' : '' }}">
                        <span class="tooltip">{{ $colorName }}</span>

                        <!-- Color swatch -->
                        <span class="swatch-value" style="background-color: {{ $colorCode }};"></span>

                        <img class="lazyload"
                            data-src="{{ asset('assets/upload/products/colors/' . $firstImage) }}"
                            src="{{ asset('assets/upload/products/colors/' . $firstImage) }}"
                            alt="{{ $colorName }} image">
                    </li>
                @endforeach
            </ul>
            @else
            <div style="margin-bottom: 27px;"></div>
        @endif
            @if ($product->stock_status == 'Out of stock')
                <a  data-bs-toggle="modal" disabled class="ad-t-cart-btn tf-btn tf-btn-loading">
                    OUT OF STOCK
                </a>
            @elseif ($product->stock_status == 'Upcoming')
                <a  data-bs-toggle="modal" disabled class="ad-t-cart-btn tf-btn tf-btn-loading">
                    UPCOMING
                </a>
            @else
                <a href="#" class="ad-t-cart-btn tf-btn tf-btn-loading add-to-cart" data-id="{{ $product->id }}">
                    ADD TO CART
                </a>
            @endif
        
    </div>
</div>
