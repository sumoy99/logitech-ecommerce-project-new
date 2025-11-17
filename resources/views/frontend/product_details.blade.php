@extends('frontend.navigation')

    @include('partials.meta', [
    'meta_title' => optional($product->productSeo)->meta_title ?? ($product->name . ' | Logitech'),
    'meta_desc' => optional($product->productSeo)->meta_desc ?? ('Explore our latest collection of ' . $product->name . ' at Logitech. Shop trendy styles and quality products online.'),
    'meta_keywords' => optional($product->productSeo)->meta_keywords ?? ($product->name . ', fashion, shop, ecommerce, buy online, best price'),
    'image' => optional($product->productSeo)->meta_image 
        ? asset('assets/upload/product/meta/' . optional($product->productSeo)->meta_image)
        : asset('assets/backend/assets/img/placeholder.png'),
    'robots' => (optional($product->productSeo)->index_status ?? 'index') . ',' . (optional($product->productSeo)->follow_status ?? 'follow'),
    'googlebot' => (optional($product->productSeo)->index_status ?? 'index') . ',' . (optional($product->productSeo)->follow_status ?? 'follow'),
    'bingbot' => (optional($product->productSeo)->index_status ?? 'index') . ',' . (optional($product->productSeo)->follow_status ?? 'follow'),
])

    
@section('content')

@php
    $gallery_images = json_decode($product->productFile->gallery_image, true) ?? [];
@endphp


<!-- breadcrumb -->
<div class="tf-breadcrumb">
    <div class="container">
        <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
            <div class="tf-breadcrumb-list">
                <a href="{{ route('frontend.index') }}" class="text">Home</a>
                <i class="icon icon-arrow-right"></i>
                <a href="{{ route('frontend.category_products', ['category_slug' => $parentCategory->slug, 'id' => $parentCategory->id]) }}" class="text">{{ $parentCategory->name }}</a>
                {{-- <i class="icon icon-arrow-right"></i>
                <span class="text">Cotton jersey top</span> --}}
            </div>
            
            <div class="tf-breadcrumb-prev-next">
                <a href="{{ $prevProduct ? route('frontend.product_details', ['product_slug' => $prevProduct->slug, 'id' => $prevProduct->id]) : 'javascript:void(0)' }}" 
                class="tf-breadcrumb-prev hover-tooltip center {{ $prevProduct ? '' : 'disabled' }}">
                    <i class="icon icon-arrow-left"></i>
                </a>

                <a href="{{ route('frontend.category_products', ['category_slug' => $parentCategory->slug, 'id' => $parentCategory->id]) }}" 
                class="tf-breadcrumb-back hover-tooltip center">
                    <i class="icon icon-shop"></i>
                </a>

                <a href="{{ $nextProduct ? route('frontend.product_details', ['product_slug' => $nextProduct->slug, 'id' => $nextProduct->id]) : 'javascript:void(0)' }}" 
                class="tf-breadcrumb-next hover-tooltip center {{ $nextProduct ? '' : 'disabled' }}">
                    <i class="icon icon-arrow-right"></i>
                </a>

            </div>

        </div>
    </div>
</div>
<!-- /breadcrumb -->
<!-- default -->
<section class="flat-spacing-4 pt_0">
    <div class="tf-main-product section-image-zoom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="tf-product-media-wrap sticky-top">
                        <div class="thumbs-slider">
                            <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom"
                                data-direction="vertical">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="item">
                                            <img class="lazyload"
                                                data-src="{{ $product->productFile->thumbnail ? asset('assets/upload/products/thumbnails/' . $product->productFile->thumbnail) : asset('assets/backend/assets/img/placeholder.png') }}"
                                                src="{{ $product->productFile->thumbnail ? asset('assets/upload/products/thumbnails/' . $product->productFile->thumbnail) : asset('assets/backend/assets/img/placeholder.png') }}" alt="">
                                        </div>
                                    </div>
                                    @if ($product->productFile->videos) 
                                        <div class="swiper-slide">
                                            <div class="item position-relative">
                                                <div class="wrap-btn-viewer style-video">
                                                    <div class="icon">
                                                        <i class="icon-play"></i>
                                                    </div>
                                                </div>
                                                <img class="lazyload"
                                                    data-src="{{ asset('assets/upload/products/video_thumbnails/' . $product->productFile->video_thumbnail) }}"
                                                    src="{{ asset('assets/upload/products/video_thumbnails/' . $product->productFile->video_thumbnail) }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <!-- youtube_link video -->
                                    @php
                                        $youtube_link = $product->productFile->youtube_link ?? null;
                                        $youtube_id = null;

                                        if ($youtube_link) {
                                            preg_match(
                                                '/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([\w-]{11})/',
                                                $youtube_link,
                                                $matches
                                            );
                                            $youtube_id = $matches[1] ?? null;
                                        }
                                    @endphp

                                    {{-- Thumbnail (image + play icon) --}}
                                    @if ($youtube_id)
                                        <div class="swiper-slide">
                                            <div class="item position-relative">
                                                <div class="wrap-btn-viewer style-video">
                                                    <div class="icon">
                                                        <i class="icon-play"></i>
                                                    </div>
                                                </div>
                                                <img class="lazyload"
                                                    data-src="https://img.youtube.com/vi/{{ $youtube_id }}/hqdefault.jpg"
                                                    src="https://img.youtube.com/vi/{{ $youtube_id }}/hqdefault.jpg"
                                                    alt="YouTube Video Thumbnail">
                                            </div>
                                        </div>
                                    @endif

                                        @foreach ($gallery_images as $gallery_image)
                                            <div class="swiper-slide">
                                                <div class="item">
                                                    <img class="lazyload"
                                                        data-src="{{ $gallery_image ? asset('assets/upload/products/gallery/' . $gallery_image) : asset('assets/backend/assets/img/placeholder.png') }}"
                                                        src="{{ $gallery_image ? asset('assets/upload/products/gallery/' . $gallery_image) : asset('assets/backend/assets/img/placeholder.png') }}" alt="">
                                                </div>
                                            </div>
                                        @endforeach

                                        @php
                                            $colors = getProductColors($product);
                                        @endphp

                                        @foreach ($colors as $color)
                                            <div class="swiper-slide" data-color="{{ $color['name'] }}">
                                                @foreach ($color['images'] as $image)
                                                    <div class="item">
                                                        <img class="lazyload"
                                                            data-src="{{ asset('assets/upload/products/colors/' . $image) }}"
                                                            src="{{ asset('assets/upload/products/colors/' . $image) }}"
                                                            alt="{{ $color['name'] }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                </div>
                            </div>
                            <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                <div class="swiper-wrapper">
                                    {{-- Thumbnail --}}
                                    @if ($product->productFile && $product->productFile->thumbnail)
                                        <div class="swiper-slide">
                                            
                                            <a href="{{ asset('assets/upload/products/thumbnails/' . $product->productFile->thumbnail) }}" target="_blank" class="item" data-pswp-width="770px" data-pswp-height="1075px">
                                                <img class="tf-image-zoom lazyload" data-zoom="{{ asset('assets/upload/products/thumbnails/' . $product->productFile->thumbnail) }}"  data-src="{{ asset('assets/upload/products/thumbnails/' . $product->productFile->thumbnail) }}" src="{{ asset('assets/upload/products/thumbnails/' . $product->productFile->thumbnail) }}" alt="">
                                            </a>
                                        </div>
                                    @endif
                                    <!-- video -->
                                        @if ($product->productFile->videos) 
                                        <div class="swiper-slide" data-color="beige">
                                            <div class="item">
                                                <video playsinline="true" autoplay preload="metadata" muted controls
                                                    loop
                                                    src="{{ asset($product->productFile->videos) }}"></video>
                                            </div>
                                        </div>
                                    @endif
                                    

                                    {{-- Youtube Video --}}
                                    @if ($youtube_id)
                                        <div class="product-video product-youtube-video swiper-slide">
                                            <iframe width="100%" height="500"
                                                src="https://www.youtube.com/embed/{{ $youtube_id }}"
                                                title="YouTube video player"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                    @endif

                                    
                                    {{-- Gallery images --}}
                                    @foreach ($gallery_images as $gallery_image)
                                        @if (!empty($gallery_image))
                                            <div class="swiper-slide">
                                                <a href="{{ asset('assets/upload/products/gallery/' . $gallery_image) }}" target="_blank"
                                                    class="item" data-pswp-width="500px" data-pswp-height="500px">
                                                    <img class="tf-image-zoom lazyload" data-zoom="{{ asset('assets/upload/products/gallery/' . $gallery_image) }}" data-src="{{ asset('assets/upload/products/gallery/' . $gallery_image) }}" src="{{ asset('assets/upload/products/gallery/' . $gallery_image) }}" alt="">
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach

                                    @php
                                        $colors = getProductColors($product);
                                    @endphp

                                    @foreach ($colors as $color)
                                            @foreach ($color['images'] as $image)
                                                <div class="swiper-slide"  data-color="{{ $color['name'] }}"> 
                                                    <a href="{{ asset('assets/upload/products/colors/' . $image) }}" target="_blank" class="item" data-pswp-width="500px" data-pswp-height="500px">
                                                        <img class="tf-image-zoom lazyload"
                                                            data-zoom="{{ asset('assets/upload/products/colors/' . $image) }}"
                                                            data-src="{{ asset('assets/upload/products/colors/' . $image) }}"
                                                            src="{{ asset('assets/upload/products/colors/' . $image) }}" alt="">
                                                    </a>
                                                </div>
                                            @endforeach
                                    @endforeach

                                </div>
                                <div class="swiper-button-next button-style-arrow thumbs-next"></div>
                                <div class="swiper-button-prev button-style-arrow thumbs-prev"></div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="col-md-6">
                    <div class="tf-product-info-wrap position-relative">
                        <div class="tf-zoom-main"></div>
                        <div class="tf-product-info-list other-image-zoom">
                            @include('partials.product.product_basic_details')
                            <div class="tf-product-info-delivery-return">
                                <div class="row">
                                    @if (!empty($product->productShipping->shipping_days))
                                        <div class="col-xl-6 col-12">
                                            <div class="tf-product-delivery">
                                                <div class="icon">
                                                    <i class="icon-delivery-time"></i>
                                                </div>
                                                <p>Estimate delivery times: <span class="fw-7">{{ $product->productShipping->shipping_days }} days</span>
                                                    .</p>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if ($product->refundable == 1)
                                        <div class="col-xl-6 col-12">
                                            <div class="tf-product-delivery mb-0">
                                                <div class="icon">
                                                    <i class="icon-return-order"></i>
                                                </div>
                                                <p>{{ $product->productShipping->note }}</p>
                                            </div>
                                        </div>
                                    @endif
                                   
                                </div>
                            </div>
                            <div class="tf-product-info-trust-seal">
                                <div class="tf-product-trust-mess">
                                    <i class="icon-safe"></i>
                                    <p class="fw-6">Guarantee Safe <br> Checkout</p>
                                </div>
                                <div class="tf-payment">
                                    <img src="images/payments/visa.png" alt="">
                                    <img src="images/payments/img-1.png" alt="">
                                    <img src="images/payments/img-2.png" alt="">
                                    <img src="images/payments/img-3.png" alt="">
                                    <img src="images/payments/img-4.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="tf-sticky-btn-atc">
        <div class="container">
            <div class="tf-height-observer w-100 d-flex align-items-center">
                <div class="tf-sticky-atc-product d-flex align-items-center">
                    <div class="tf-sticky-atc-img">
                        <img class="lazyloaded" data-src={{ $product->productFile->thumbnail ? asset('assets/upload/products/thumbnails/' . $product->productFile->thumbnail) : asset('assets/backend/assets/img/placeholder.png') }}" alt=""
                            src="{{ $product->productFile->thumbnail ? asset('assets/upload/products/thumbnails/' . $product->productFile->thumbnail) : asset('assets/backend/assets/img/placeholder.png') }}">
                    </div>
                    <div class="tf-sticky-atc-title fw-5 d-xl-block d-none">{{$product->name}}</div>
                </div>
                <div class="tf-sticky-atc-infos">
                    <form class="">
                        
                        <div class="tf-sticky-atc-btns">
                            {{-- <div class="tf-product-info-quantity">
                                <div class="wg-quantity">
                                    <span class="btn-quantity minus-btn">-</span>
                                    <input type="text" name="number" value="1">
                                    <span class="btn-quantity plus-btn">+</span>
                                </div>
                            </div> --}}
                            <a href="#" class="ad-t-cart-btn tf-btn tf-btn-loading add-to-cart"  data-id="{{ $product->id }}" ><span> Add
                                    to cart</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /default -->
<!-- tabs -->
<section class="flat-spacing-17 pt_0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="widget-tabs style-has-border">
                    <ul class="widget-menu-tab">
                        <li class="item-title active">
                            <span class="inner">Description</span>
                        </li>
                        <li class="item-title">
                            <span class="inner">Additional Information</span>
                        </li>
                        <li class="item-title">
                            <span class="inner">Review</span>
                        </li>
                        <li class="item-title">
                            <span class="inner">Shipping</span>
                        </li>
                        <li class="item-title">
                            <span class="inner">Return Policies</span>
                        </li>
                    </ul>
                    <div class="widget-content-tab">
                        <div class="widget-content-inner active">
                            <div class="">
                                {!! $product->long_description !!}
                            </div>
                        </div>
                        <div class="widget-content-inner">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <h3 class="fs-16 fw-5">Product Attributes</h3>
                                    <table class="tf-pr-attrs">
                                        <tbody>
                                            <tr class="tf-attr-pa-color">
                                                <th class="tf-attr-label">Color</th>
                                                <td class="tf-attr-value">
                                                    <p>White, Pink, Black</p>
                                                </td>
                                            </tr>
                                            <tr class="tf-attr-pa-size">
                                                <th class="tf-attr-label">Size</th>
                                                <td class="tf-attr-value">
                                                    <p>S, M, L, XL</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @if($product->features->isNotEmpty())
                                <div class="col-md-6 col-sm-12">
                                    <h3 class="fs-16 fw-5">Key Features</h3>
                                        <table class="tf-pr-attrs">
                                        <tbody>
                                            @foreach ($product->features as $feature)
                                                <tr class="tf-attr-pa-">
                                                    <th class="tf-attr-label">{{ $feature->feature_name }}</th>
                                                    <td class="tf-attr-value">
                                                        <p>{{ $feature->feature_value }}</p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                            
                        </div>
                        <div class="widget-content-inner">
                            <div class="tab-reviews write-cancel-review-wrap">
                                <div class="tab-reviews-heading">
                                    <div class="top">
                                        <div class="text-center">
                                            <h1 class="number fw-6">4.8</h1>
                                            <div class="list-star">
                                                <i class="icon icon-star"></i>
                                                <i class="icon icon-star"></i>
                                                <i class="icon icon-star"></i>
                                                <i class="icon icon-star"></i>
                                                <i class="icon icon-star"></i>
                                            </div>
                                            <p>(168 Ratings)</p>
                                        </div>
                                        <div class="rating-score">
                                            <div class="item">
                                                <div class="number-1 text-caption-1">5</div>
                                                <i class="icon icon-star"></i>
                                                <div class="line-bg">
                                                    <div style="width: 94.67%;"></div>
                                                </div>
                                                <div class="number-2 text-caption-1">59</div>
                                            </div>
                                            <div class="item">
                                                <div class="number-1 text-caption-1">4</div>
                                                <i class="icon icon-star"></i>
                                                <div class="line-bg">
                                                    <div style="width: 60%;"></div>
                                                </div>
                                                <div class="number-2 text-caption-1">46</div>
                                            </div>
                                            <div class="item">
                                                <div class="number-1 text-caption-1">3</div>
                                                <i class="icon icon-star"></i>
                                                <div class="line-bg">
                                                    <div style="width: 0%;"></div>
                                                </div>
                                                <div class="number-2 text-caption-1">0</div>
                                            </div>
                                            <div class="item">
                                                <div class="number-1 text-caption-1">2</div>
                                                <i class="icon icon-star"></i>
                                                <div class="line-bg">
                                                    <div style="width: 0%;"></div>
                                                </div>
                                                <div class="number-2 text-caption-1">0</div>
                                            </div>
                                            <div class="item">
                                                <div class="number-1 text-caption-1">1</div>
                                                <i class="icon icon-star"></i>
                                                <div class="line-bg">
                                                    <div style="width: 0%;"></div>
                                                </div>
                                                <div class="number-2 text-caption-1">0</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="tf-btn btn-outline-dark fw-6 btn-comment-review btn-cancel-review">
                                            Cancel Review</div>
                                        <div
                                            class="tf-btn btn-outline-dark fw-6 btn-comment-review btn-write-review">
                                            Write a review</div>
                                    </div>
                                </div>
                                <div class="reply-comment cancel-review-wrap">
                                    <div
                                        class="d-flex mb_24 gap-20 align-items-center justify-content-between flex-wrap">
                                        <h5 class="">03 Comments</h5>
                                        <div class="d-flex align-items-center gap-12">
                                            <div class="text-caption-1">Sort by:</div>
                                            <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                                                <div class="btn-select">
                                                    <span class="text-sort-value">Most Recent</span>
                                                    <span class="icon icon-arrow-down"></span>
                                                </div>
                                                <div class="dropdown-menu">
                                                    <div class="select-item active">
                                                        <span class="text-value-item">Most Recent</span>
                                                    </div>
                                                    <div class="select-item">
                                                        <span class="text-value-item">Oldest</span>
                                                    </div>
                                                    <div class="select-item">
                                                        <span class="text-value-item">Most Popular</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="reply-comment-wrap">
                                        <div class="reply-comment-item">
                                            <div class="user">
                                                <div class="image">
                                                    <img src="images/collections/collection-circle-9.jpg"
                                                        alt="">
                                                </div>
                                                <div>
                                                    <h6>
                                                        <a href="#" class="link">Superb quality apparel that
                                                            exceeds expectations</a>
                                                    </h6>
                                                    <div class="day text_black-2">1 days ago</div>
                                                </div>
                                            </div>
                                            <p class="text_black-2">Great theme - we were looking for a theme
                                                with lots of built in features and flexibility and this was
                                                perfect. We expected to need to employ a developer to add a few
                                                finishing touches. But we actually managed to do everything
                                                ourselves. We did have one small query and the support given was
                                                swift and helpful.</p>
                                        </div>
                                        <div class="reply-comment-item type-reply">
                                            <div class="user">
                                                <div class="image">
                                                    <img src="images/collections/collection-circle-10.jpg"
                                                        alt="">
                                                </div>
                                                <div>
                                                    <h6>
                                                        <a href="#" class="link">Reply from Modave</a>
                                                    </h6>
                                                    <div class="day text_black-2">1 days ago</div>
                                                </div>
                                            </div>
                                            <p class="text_black-2">We love to hear it! Part of what we love
                                                most about Modave is how much it empowers store owners like
                                                yourself to build a beautiful website without having to hire a
                                                developer :) Thank you for this fantastic review!</p>
                                        </div>
                                        <div class="reply-comment-item">
                                            <div class="user">
                                                <div class="image">
                                                    <img src="images/collections/collection-circle-9.jpg"
                                                        alt="">
                                                </div>
                                                <div>
                                                    <h6>
                                                        <a href="#" class="link">Superb quality apparel that
                                                            exceeds expectations</a>
                                                    </h6>
                                                    <div class="day text_black-2">1 days ago </div>
                                                </div>
                                            </div>
                                            <p class="text_black-2">Great theme - we were looking for a theme
                                                with lots of built in features and flexibility and this was
                                                perfect. We expected to need to employ a developer to add a few
                                                finishing touches. But we actually managed to do everything
                                                ourselves. We did have one small query and the support given was
                                                swift and helpful.</p>
                                        </div>
                                    </div>
                                </div>
                                <form class="form-write-review write-review-wrap">
                                    <div class="heading">
                                        <h5>Write a review:</h5>
                                        <div class="list-rating-check">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text"></label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text"></label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text"></label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text"></label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text"></label>
                                        </div>
                                    </div>
                                    <div class="form-content">
                                        <fieldset class="box-field">
                                            <label class="label">Review Title</label>
                                            <input type="text" placeholder="Give your review a title"
                                                name="text" tabindex="2" value="" aria-required="true"
                                                required="">
                                        </fieldset>
                                        <fieldset class="box-field">
                                            <label class="label">Review</label>
                                            <textarea rows="4" placeholder="Write your comment here"
                                                tabindex="2" aria-required="true" required=""></textarea>
                                        </fieldset>
                                        <div class="box-field group-2">
                                            <fieldset>
                                                <input type="text" placeholder="You Name (Public)" name="text"
                                                    tabindex="2" value="" aria-required="true" required="">
                                            </fieldset>
                                            <fieldset>
                                                <input type="email" placeholder="Your email (private)"
                                                    name="email" tabindex="2" value="" aria-required="true"
                                                    required="">
                                            </fieldset>
                                        </div>
                                        <div class="box-check">
                                            <input type="checkbox" name="availability" class="tf-check"
                                                id="check1">
                                            <label class="text_black-2" for="check1">Save my name, email, and
                                                website in this browser for the next time I comment.</label>
                                        </div>
                                    </div>
                                    <div class="button-submit">
                                        <button class="tf-btn btn-fill animate-hover-btn" type="submit">Submit
                                            Reviews</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="widget-content-inner">
                            <div class="tf-page-privacy-policy">
                                <div class="title">The Company Private Limited Policy</div>
                                <p>The Company Private Limited and each of their respective subsidiary, parent
                                    and affiliated companies is deemed to operate this Website (“we” or “us”)
                                    recognizes that you care how information about you is used and shared. We
                                    have created this Privacy Policy to inform you what information we collect
                                    on the Website, how we use your information and the choices you have about
                                    the way your information is collected and used. Please read this Privacy
                                    Policy carefully. Your use of the Website indicates that you have read and
                                    accepted our privacy practices, as outlined in this Privacy Policy.</p>
                                <p>Please be advised that the practices described in this Privacy Policy apply
                                    to information gathered by us or our subsidiaries, affiliates or agents: (i)
                                    through this Website, (ii) where applicable, through our Customer Service
                                    Department in connection with this Website, (iii) through information
                                    provided to us in our free standing retail stores, and (iv) through
                                    information provided to us in conjunction with marketing promotions and
                                    sweepstakes.</p>
                                <p>We are not responsible for the content or privacy practices on any websites.
                                </p>
                                <p>We reserve the right, in our sole discretion, to modify, update, add to,
                                    discontinue, remove or otherwise change any portion of this Privacy Policy,
                                    in whole or in part, at any time. When we amend this Privacy Policy, we will
                                    revise the “last updated” date located at the top of this Privacy Policy.
                                </p>
                                <p>If you provide information to us or access or use the Website in any way
                                    after this Privacy Policy has been changed, you will be deemed to have
                                    unconditionally consented and agreed to such changes. The most current
                                    version of this Privacy Policy will be available on the Website and will
                                    supersede all previous versions of this Privacy Policy.</p>
                                <p>If you have any questions regarding this Privacy Policy, you should contact
                                    our Customer Service Department by email at marketing@company.com</p>
                            </div>
                        </div>
                        <div class="widget-content-inner">
                            <ul class="d-flex justify-content-center mb_18">
                                <li class="">
                                    <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222"
                                        margin="5px">
                                        <path fill="currentColor"
                                            d="M8.7 30.7h22.7c.3 0 .6-.2.7-.6l4-25.3c-.1-.4-.3-.7-.7-.8s-.7.2-.8.6L34 8.9l-3-1.1c-2.4-.9-5.1-.5-7.2 1-2.3 1.6-5.3 1.6-7.6 0-2.1-1.5-4.8-1.9-7.2-1L6 8.9l-.7-4.3c0-.4-.4-.7-.7-.6-.4.1-.6.4-.6.8l4 25.3c.1.3.3.6.7.6zm.8-21.6c2-.7 4.2-.4 6 .8 1.4 1 3 1.5 4.6 1.5s3.2-.5 4.6-1.5c1.7-1.2 4-1.6 6-.8l3.3 1.2-3 19.1H9.2l-3-19.1 3.3-1.2zM32 32H8c-.4 0-.7.3-.7.7s.3.7.7.7h24c.4 0 .7-.3.7-.7s-.3-.7-.7-.7zm0 2.7H8c-.4 0-.7.3-.7.7s.3.6.7.6h24c.4 0 .7-.3.7-.7s-.3-.6-.7-.6zm-17.9-8.9c-1 0-1.8-.3-2.4-.6l.1-2.1c.6.4 1.4.6 2 .6.8 0 1.2-.4 1.2-1.3s-.4-1.3-1.3-1.3h-1.3l.2-1.9h1.1c.6 0 1-.3 1-1.3 0-.8-.4-1.2-1.1-1.2s-1.2.2-1.9.4l-.2-1.9c.7-.4 1.5-.6 2.3-.6 2 0 3 1.3 3 2.9 0 1.2-.4 1.9-1.1 2.3 1 .4 1.3 1.4 1.3 2.5.3 1.8-.6 3.5-2.9 3.5zm4-5.5c0-3.9 1.2-5.5 3.2-5.5s3.2 1.6 3.2 5.5-1.2 5.5-3.2 5.5-3.2-1.6-3.2-5.5zm4.1 0c0-2-.1-3.5-.9-3.5s-1 1.5-1 3.5.1 3.5 1 3.5c.8 0 .9-1.5.9-3.5zm4.5-1.4c-.9 0-1.5-.8-1.5-2.1s.6-2.1 1.5-2.1 1.5.8 1.5 2.1-.5 2.1-1.5 2.1zm0-.8c.4 0 .7-.5.7-1.2s-.2-1.2-.7-1.2-.7.5-.7 1.2.3 1.2.7 1.2z">
                                        </path>
                                    </svg>
                                </li>
                                <li class="">
                                    <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222"
                                        margin="5px">
                                        <path fill="currentColor"
                                            d="M36.7 31.1l-2.8-1.3-4.7-9.1 7.5-3.5c.4-.2.6-.6.4-1s-.6-.5-1-.4l-7.5 3.5-7.8-15c-.3-.5-1.1-.5-1.4 0l-7.8 15L4 15.9c-.4-.2-.8 0-1 .4s0 .8.4 1l7.5 3.5-4.7 9.1-2.8 1.3c-.4.2-.6.6-.4 1 .1.3.4.4.7.4.1 0 .2 0 .3-.1l1-.4-1.5 2.8c-.1.2-.1.5 0 .8.1.2.4.3.7.3h31.7c.3 0 .5-.1.7-.4.1-.2.1-.5 0-.8L35.1 32l1 .4c.1 0 .2.1.3.1.3 0 .6-.2.7-.4.1-.3 0-.8-.4-1zm-5.1-2.3l-9.8-4.6 6-2.8 3.8 7.4zM20 6.4L27.1 20 20 23.3 12.9 20 20 6.4zm-7.8 15l6 2.8-9.8 4.6 3.8-7.4zm22.4 13.1H5.4L7.2 31 20 25l12.8 6 1.8 3.5z">
                                        </path>
                                    </svg>
                                </li>
                                <li class="">
                                    <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222"
                                        margin="5px">
                                        <path fill="currentColor"
                                            d="M5.9 5.9v28.2h28.2V5.9H5.9zM19.1 20l-8.3 8.3c-2-2.2-3.2-5.1-3.2-8.3s1.2-6.1 3.2-8.3l8.3 8.3zm-7.4-9.3c2.2-2 5.1-3.2 8.3-3.2s6.1 1.2 8.3 3.2L20 19.1l-8.3-8.4zM20 20.9l8.3 8.3c-2.2 2-5.1 3.2-8.3 3.2s-6.1-1.2-8.3-3.2l8.3-8.3zm.9-.9l8.3-8.3c2 2.2 3.2 5.1 3.2 8.3s-1.2 6.1-3.2 8.3L20.9 20zm8.4-10.2c-1.2-1.1-2.6-2-4.1-2.6h6.6l-2.5 2.6zm-18.6 0L8.2 7.2h6.6c-1.5.6-2.9 1.5-4.1 2.6zm-.9.9c-1.1 1.2-2 2.6-2.6 4.1V8.2l2.6 2.5zM7.2 25.2c.6 1.5 1.5 2.9 2.6 4.1l-2.6 2.6v-6.7zm3.5 5c1.2 1.1 2.6 2 4.1 2.6H8.2l2.5-2.6zm18.6 0l2.6 2.6h-6.6c1.4-.6 2.8-1.5 4-2.6zm.9-.9c1.1-1.2 2-2.6 2.6-4.1v6.6l-2.6-2.5zm2.6-14.5c-.6-1.5-1.5-2.9-2.6-4.1l2.6-2.6v6.7z">
                                        </path>
                                    </svg>
                                </li>
                                <li class="">
                                    <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222"
                                        margin="5px">
                                        <path fill="currentColor"
                                            d="M35.1 33.6L33.2 6.2c0-.4-.3-.7-.7-.7H13.9c-.4 0-.7.3-.7.7s.3.7.7.7h18l.7 10.5H20.8c-8.8.2-15.9 7.5-15.9 16.4 0 .4.3.7.7.7h28.9c.2 0 .4-.1.5-.2s.2-.3.2-.5v-.2h-.1zm-28.8-.5C6.7 25.3 13 19 20.8 18.9h11.9l1 14.2H6.3zm11.2-6.8c0 1.2-1 2.1-2.1 2.1s-2.1-1-2.1-2.1 1-2.1 2.1-2.1 2.1 1 2.1 2.1zm6.3 0c0 1.2-1 2.1-2.1 2.1-1.2 0-2.1-1-2.1-2.1s1-2.1 2.1-2.1 2.1 1 2.1 2.1z">
                                        </path>
                                    </svg>
                                </li>
                                <li class="">
                                    <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222"
                                        margin="5px">
                                        <path fill="currentColor"
                                            d="M20 33.8c7.6 0 13.8-6.2 13.8-13.8S27.6 6.2 20 6.2 6.2 12.4 6.2 20 12.4 33.8 20 33.8zm0-26.3c6.9 0 12.5 5.6 12.5 12.5S26.9 32.5 20 32.5 7.5 26.9 7.5 20 13.1 7.5 20 7.5zm-.4 15h.5c1.8 0 3-1.1 3-3.7 0-2.2-1.1-3.6-3.1-3.6h-2.6v10.6h2.2v-3.3zm0-5.2h.4c.6 0 .9.5.9 1.7 0 1.1-.3 1.7-.9 1.7h-.4v-3.4z">
                                        </path>
                                    </svg>
                                </li>
                                <li class="">
                                    <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222"
                                        margin="5px">
                                        <path fill="currentColor"
                                            d="M30.2 29.3c2.2-2.5 3.6-5.7 3.6-9.3s-1.4-6.8-3.6-9.3l3.6-3.6c.3-.3.3-.7 0-.9-.3-.3-.7-.3-.9 0l-3.6 3.6c-2.5-2.2-5.7-3.6-9.3-3.6s-6.8 1.4-9.3 3.6L7.1 6.2c-.3-.3-.7-.3-.9 0-.3.3-.3.7 0 .9l3.6 3.6c-2.2 2.5-3.6 5.7-3.6 9.3s1.4 6.8 3.6 9.3l-3.6 3.6c-.3.3-.3.7 0 .9.1.1.3.2.5.2s.3-.1.5-.2l3.6-3.6c2.5 2.2 5.7 3.6 9.3 3.6s6.8-1.4 9.3-3.6l3.6 3.6c.1.1.3.2.5.2s.3-.1.5-.2c.3-.3.3-.7 0-.9l-3.8-3.6z">
                                        </path>
                                    </svg>
                                </li>
                                <li class="">
                                    <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222"
                                        margin="5px">
                                        <path fill="currentColor"
                                            d="M34.1 34.1H5.9V5.9h28.2v28.2zM7.2 32.8h25.6V7.2H7.2v25.6zm13.5-18.3a.68.68 0 0 0-.7-.7.68.68 0 0 0-.7.7v10.9a.68.68 0 0 0 .7.7.68.68 0 0 0 .7-.7V14.5z">
                                        </path>
                                    </svg>
                                </li>
                            </ul>
                            <p class="text-center text-paragraph">LT01: 70% wool, 15% polyester, 10% polyamide,
                                5% acrylic 900 Grms/mt</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /tabs -->
        

        @if ($relatedProducts->count() > 0)
            <!-- product -->
            <section class="flat-spacing-1 pt_0">
                <div class="container">
                    <div class="flat-title">
                        <span class="title">You may also like</span>
                    </div>
                    <div class="hover-sw-nav hover-sw-2">
                        <div dir="ltr" class="swiper tf-sw-product-sell wrap-sw-over" data-preview="5" data-tablet="3"
                            data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3"
                            data-pagination-lg="3">
                            <div class="swiper-wrapper" style="height: auto;">
                                @foreach ($relatedProducts as $relatedProduct)
                                    <div class="swiper-slide" lazy="true">
                                        <div class="card-product">
                                            @include('partials.product.grid-product', [
                                                'product' => $relatedProduct
                                            ]) 
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="nav-sw nav-next-slider nav-next-product box-icon w_46 round"><span
                                class="icon icon-arrow-left"></span></div>
                        <div class="nav-sw nav-prev-slider nav-prev-product box-icon w_46 round"><span
                                class="icon icon-arrow-right"></span></div>
                        <div class="sw-dots style-2 sw-pagination-product justify-content-center"></div>
                    </div>
                </div>
            </section>
        <!-- /product -->
        @endif
        
@endsection


<script>

document.addEventListener('DOMContentLoaded', function () {
    const buyNowBtn = document.getElementById('buy-now-btn');
    const qtyInput = document.querySelector('.quantity-product2');
    const colorInputs = document.querySelectorAll('input[name="color_picker"]');
    const productId = "{{ $product->id }}";

    function updateBuyNowLink() {
        const color = document.querySelector('input[name="color_picker"]:checked')?.value || '';
        const qty = qtyInput.value || 1;

        const url = `{{ route('frontend.customer.buyNow') }}?id=${productId}&color=${encodeURIComponent(color)}&qty=${qty}`;
        buyNowBtn.setAttribute('href', url);
    }

    // Update link on change
    colorInputs.forEach(input => input.addEventListener('change', updateBuyNowLink));
    document.querySelectorAll('.btn-quantity').forEach(btn => {
        btn.addEventListener('click', function () {
            let val = parseInt(qtyInput.value);
            if (this.classList.contains('btn-increase')) val++;
            else if (this.classList.contains('btn-decrease') && val > 1) val--;
            qtyInput.value = val;
            updateBuyNowLink();
        });
    });

    updateBuyNowLink();
});


</script>
