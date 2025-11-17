@php
    $thumbnail = $product->productFile?->thumbnail;
    $hover_image = $product->productFile?->hover_image;
@endphp
<div class="card-product-wrapper">
    <a href="#" class="product-img">
        <img class="lazyload img-product" data-src="{{ $thumbnail ? asset('assets/upload/products/thumbnails/' . $thumbnail) : asset('assets/backend/assets/img/placeholder.png') }}" src="{{ $thumbnail ? asset('assets/upload/products/thumbnails/' . $thumbnail) : asset('assets/backend/assets/img/placeholder.png') }}" alt="image-product">

        <img class="lazyload img-hover" data-src="{{ $hover_image ? asset('assets/upload/products/hover_images/' . $hover_image) : asset('assets/backend/assets/img/placeholder.png') }}"
            src="{{ $hover_image ? asset('assets/upload/products/hover_images/' . $hover_image) : asset('assets/backend/assets/img/placeholder.png') }}" alt="image-product">
    </a>
    @if ($product->discount_type == 'percent' && $product->discount_price > 0 && $product->is_discount_active)
        <div class="on-sale-wrap text-end">
            <div class="on-sale-item">-{{$product->discount_price}}%</div>
        </div>
        @endif
</div>
<div class="card-product-info">
    <a href="#" class="title link">{{ $product->name }}</a>
    <p class="description">{{ $product->short_description }}</p>
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
     @if(!empty($product->discount_price) && $product->is_discount_active)
        <span class="price">
            
            <span class="text_primary text_red-1  price current-price">{{ currency($product->flat_discount_price) }}</span>
            <span class="fw-4 text-sale  price current-price">{{ currency($product->price) }}</span>
        </span>
    @else
        <span class="price current-price  price current-price">{{ currency($product->price) }}</span>
    @endif

    
    
    <div class="size-list">
        <span class="size-item">S</span>
        <span class="size-item">M</span>
        <span class="size-item">L</span>
        <span class="size-item">XL</span>
    </div>
    <div class="list-product-btn">
        <a href="#"  data-id="{{ $product->id }}" data-bs-toggle="modal"
            class="box-icon quick-add style-3 hover-tooltip add-to-cart"><span
                class="icon icon-bag"></span><span class="tooltip">Quick add</span></a>
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
                        <a href="{{route('frontend.customer.wishListStore', ['id' => $product->id])}}" class="box-icon wishlist style-3 hover-tooltip"><span class="icon icon-heart"></span> <span class="tooltip">Add to Wishlist</span></a>
                    @endif
                @else
                    <a href="{{route('frontend.customer.wishListStore', ['id' => $product->id])}}" class="box-icon wishlist style-3 hover-tooltip"><span class="icon icon-heart"></span> <span class="tooltip">Add to Wishlist</span></a>
                @endif
        
        <a href="#compare" data-bs-toggle="offcanvas"
            class="box-icon compare style-3 hover-tooltip"><span
                class="icon icon-compare"></span> <span class="tooltip">Add to
                Compare</span></a>
        <a href="#quick_view" data-bs-toggle="modal"
            class="box-icon quickview style-3 hover-tooltip"><span
                class="icon icon-view"></span><span class="tooltip">Quick
                view</span></a>
    </div>
</div>