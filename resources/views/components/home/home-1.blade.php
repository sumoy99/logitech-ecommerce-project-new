 <!-- Slider -->
        <section class="flat-spacing-5 slider-gaming-accessories">
            <img class="lazyload" data-src="{{asset('assets/frontend/images/slider/banner-slider-bg-2.jpg')}}"
                src="{{asset('assets/frontend/images/slider/banner-slider-bg-2.jpg')}}" alt="collection-img">
            <div class="container ">
                <div dir="ltr" class="swiper tf-sw-recent" data-preview="1" data-tablet="2" data-mobile="1.3"
                    data-space-lg="30" data-space-md="15" data-space="15" data-pagination="1" data-pagination-md="1"
                    data-pagination-lg="1">
                    <div class="swiper-wrapper">
                        @foreach ($banners as $banner)
                            <div class="swiper-slide" lazy="true">
                                <div class="collection-item-v4 style-2 hover-img">
                                    <div class="collection-inner">
                                        <a href="#"
                                            class="collection-image img-style radius-10 o-hidden">
                                            <img class="lazyload" data-src="{{ asset('assets/upload/banner_images/' . $banner->image) }}"
                                                src="{{ asset('assets/upload/banner_images/' . $banner->image) }}" alt="collection-img">
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- /Slider -->

        <!-- Marquee -->
        <div class="tf-marquee marquee-st2 bg_primary marquee-white">
            <div class="wrap-marquee">
                @foreach ($marquees as $marquee)
                    @if ($marquee->position == 'banner')
                        <div class="marquee-item">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" height="20" viewBox="0 0 40 43">
                                    <path
                                        d="M39.3055 20.7282C34.9409 20.7138 30.3593 19.8216 26.911 16.9761C24.0125 14.584 22.2908 11.1888 21.4565 7.57174C20.9356 5.31468 20.7475 3.00458 20.762 0.694478C20.762 0.212202 20.3762 0 20 0C19.6238 0 19.238 0.212202 19.238 0.694478C19.2573 4.63468 18.7027 8.70991 16.8652 12.2498C15.1145 15.6209 12.2305 18.1722 8.65686 19.4695C6.10562 20.3955 3.39523 20.7234 0.694478 20.7331C0.212202 20.7331 0 21.1237 0 21.4999C0 21.8761 0.212202 22.2667 0.694478 22.2667C5.05908 22.2812 9.6407 23.1734 13.089 26.0188C15.9875 28.4109 17.7092 31.8061 18.5435 35.4232C19.0644 37.6802 19.2476 39.9904 19.238 42.3005C19.238 42.7827 19.6238 42.9949 20 42.9949C20.3762 42.9949 20.762 42.7827 20.762 42.3005C20.7427 38.3603 21.2973 34.285 23.1348 30.7451C24.8855 27.374 27.7695 24.8228 31.3431 23.5254C33.8944 22.5995 36.6048 22.2715 39.3055 22.2619C39.7878 22.2619 40 21.8712 40 21.4951C40 21.1189 39.7878 20.7282 39.3055 20.7282ZM26.0381 24.8662C22.8985 27.3885 20.9838 31.0924 20.0772 34.965C20.0482 35.0808 20.0289 35.2014 20 35.3171C19.5901 33.4555 18.9727 31.647 18.0854 29.9542C16.1659 26.2889 12.9829 23.5785 9.1102 22.1558C8.37714 21.8857 7.62479 21.6687 6.86279 21.4902C9.42368 20.8777 11.8544 19.8119 13.9571 18.1239C17.0967 15.6016 19.0113 11.8978 19.918 8.02508C19.947 7.90933 19.9662 7.78876 19.9952 7.67302C20.4051 9.5346 21.0224 11.3431 21.9098 13.0359C23.8293 16.7012 27.0123 19.4116 30.885 20.8343C31.618 21.1044 32.3704 21.3214 33.1324 21.4999C30.5715 22.1172 28.1408 23.1782 26.0381 24.8662Z">
                                    </path>
                                </svg>
                            </div>
                            <p class="text text_white">{{ $marquee->title }}</p>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
        <!-- /Marquee -->

        <!-- Icon box -->
        {{-- <section class="flat-spacing-3 flat-iconbox line">
            <div class="container">
                <div class="wrap-carousel wrap-mobile">
                    <div dir="ltr" class="swiper tf-sw-mobile" data-preview="1" data-space="15">
                        <div class="swiper-wrapper wrap-iconbox">
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-row">
                                    <div class="icon">
                                        <i class="icon-shipping"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title fw-5 font-readex-pro">Free Shipping</div>
                                        <p class="text_black-2">Free shipping over order $120</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-row">
                                    <div class="icon">
                                        <i class="icon-payment fs-22"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title fw-5 font-readex-pro">Flexible Payment</div>
                                        <p class="text_black-2">Pay with Multiple Credit Cards</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-row">
                                    <div class="icon">
                                        <i class="icon-return fs-20"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title fw-5 font-readex-pro">14 Day Returns</div>
                                        <p class="text_black-2">Within 30 days for an exchange</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-row">
                                    <div class="icon">
                                        <i class="icon-suport"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title fw-5 font-readex-pro">Premium Support</div>
                                        <p class="text_black-2">Outstanding premium support</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="sw-dots style-2 sw-pagination-mb justify-content-center"></div>
                </div>
            </div>
        </section> --}}
        <!-- /Icon box -->

        <!-- Collection -->
        <section class="flat-spacing-10 flat-testimonial">
            <div class="container">
                <div class="flat-title">
                    <span class="title fw-6 wow fadeInUp font-readex-pro text_black-3" data-wow-delay="0s">Shop by
                        Category</span>
                </div>
                <div class="hover-sw-nav bg_dark-2 padding-content radius-10">
                    <div dir="ltr" class="swiper tf-sw-testimonial" data-preview="6" data-tablet="4" data-mobile="2"
                        data-space-lg="70" data-space-md="15">
                        <div class="swiper-wrapper">
                            @foreach ($categories as $category)
                                <div class="swiper-slide">
                                    <div class="collection-item-circle has-bg hover-img bg_dark-2">
                                        <a href="{{ route('frontend.category_products', ['category_slug' => $category->slug, 'id' => $category->id]) }}"

                                        class="collection-image mw-100 img-style radius-5">
                                        <img class="lazyload home-category-image" data-src="{{ $category->image ? asset('assets/upload/category/' . $category->image) : asset('assets/backend/assets/img/placeholder.png') }}"
                                            alt="collection-img" src="{{ $category->image ? asset('assets/upload/category/' . $category->image) : asset('assets/backend/assets/img/placeholder.png') }}">
                                        </a>
                                        <div class="collection-content text-center">
                                            <a href="{{ route('frontend.category_products', ['category_slug' => $category->slug, 'id' => $category->id]) }}"
                                                class="link title fw-6 text_white">{{ $category->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-testimonial lg bg_dark-2"><span
                            class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-testimonial lg bg_dark-2"><span
                            class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots style-2 dots-white sw-pagination-testimonial justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Collection -->

        <!-- Hot Deals -->
        {{-- <p>{{$flashDealProducts}}</p> --}}
        @if ($flashDealProducts->count() > 0)
            <section class="flat-spacing-15 bg_light-blue-3">
                <div class="container">
                    <div class="flat-title flex-row justify-content-between px-0">
                        <span class="title fw-6 wow fadeInUp font-readex-pro text_black-3" data-wow-delay="0s">Hot
                            Deals</span>
                        <div class="tf-countdown-v3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path
                                    d="M13.5631 11.7661L10.7746 9.67465V5.41441C10.7746 4.98605 10.4283 4.6398 9.99996 4.6398C9.5716 4.6398 9.22535 4.98605 9.22535 5.41441V10.062C9.22535 10.306 9.34 10.5361 9.5352 10.6817L12.6336 13.0055C12.7673 13.1062 12.9302 13.1606 13.0975 13.1604C13.3338 13.1604 13.5662 13.0543 13.718 12.8498C13.9752 12.5081 13.9055 12.0225 13.5631 11.7661Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M10 0C4.48566 0 0 4.48566 0 10C0 15.5143 4.48566 20 10 20C15.5143 20 20 15.5143 20 10C20 4.48566 15.5143 0 10 0ZM10 18.4508C5.34082 18.4508 1.54918 14.6592 1.54918 10C1.54918 5.34082 5.34082 1.54918 10 1.54918C14.66 1.54918 18.4508 5.34082 18.4508 10C18.4508 14.6592 14.6592 18.4508 10 18.4508Z"
                                    fill="currentColor"></path>
                            </svg>
                            {{-- <div class="js-countdown" data-timer="8607500" data-labels="D,H,M,S"></div> --}}
                        </div>
                    </div>
                    <div class="wrap-carousel">
                        <div dir="ltr" class="swiper tf-sw-product-sell wrap-sw-over" data-preview="5" data-tablet="3"
                            data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3"
                            data-pagination-lg="3">
                                <div class="swiper-wrapper">
                                    @foreach ($flashDealProducts as $product)
                                        <div class="swiper-slide">
                                            <div class="card-product">
                                                @include('partials.product.grid-product')
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="sw-dots style-2 sw-pagination-sell justify-content-center"></div>
                    </div>
                </div>
            </section>
        @endif
        
        <!-- /Hot Deals -->

        <!-- Collection products -->
        <section class="flat-spacing-15">
            <div class="container">
                <div class="flat-title  flex-row justify-content-between px-0">
                    <span class="title fw-6 wow fadeInUp font-readex-pro text_black-3" data-wow-delay="0s">Collection</span>
                </div>
                <div class="wrap-carousel">
                    <div dir="ltr" class="swiper tf-sw-product-sell-1 wrap-sw-over" data-preview="4" data-tablet="3"
                        data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3"
                        data-pagination-lg="3">
                        <div class="row">
                            @foreach ($featuredProductsByCategory as $product)
                                <div class="col-lg-2 col-6">
                                    <div class="swiper-slide">
                                        <div class="card-product ">
                                             @include('partials.product.grid-product')
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Popular products -->


        <!-- brand -->
        <section class="flat-spacing-1 pt_0">
            <div class="container">
                <div dir="ltr" class="swiper tf-sw-brand" data-loop="false" data-play="false" data-preview="6"
                    data-tablet="3" data-mobile="2" data-space-lg="0" data-space-md="0">
                    <div class="swiper-wrapper">
                        @foreach ($companyLogos as $companyLogo)
                            <div class="swiper-slide">
                                <div class="brand-item">
                                    <img class="lazyload" data-src="{{ asset('assets/upload/company_logo/' . $companyLogo->logo) }}"
                                        src="{{ asset('assets/upload/company_logo/' . $companyLogo->logo) }}" alt="image-brand">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="sw-dots style-2 sw-pagination-brand justify-content-center"></div>
            </div>
        </section>
        <!-- /brand -->

        <!-- store -->
        <section class="flat-spacing-14 pb_0">
            <div class="">
                <div class="flat-location style-right map-gaming-accessories">
                    <div class="banner-map">
                        {{-- <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d84000.86305407993!2d2.265665124041157!3d48.85769609108845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2zUGEgcmksIFBow6Fw!5e0!3m2!1svi!2s!4v1730453133238!5m2!1svi!2s"
                            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.136604810773!2d90.379516!3d23.7781494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7921c87c307%3A0xc9e8456cd1e470d9!2sIDB%20Bhaban!5e0!3m2!1sen!2sbd!4v1762169747471!5m2!1sen!2sbd" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="content">
                        <h3 class="heading fw-6 font-sora wow fadeInUp" data-wow-delay="0s">Logitech Computers Store</h3>
                        <p class="subtext wow fadeInUp" data-wow-delay="0s">
                            BCS Computer City, IDB Bhaban, Dhaka 1212
                            <br>
                            support@ecomus.com
                            <br>
                            (08) 8942 1299
                        </p>
                        <p class="subtext wow fadeInUp" data-wow-delay="0s">
                            Mon - Fri, 8:30am - 10:30pm
                            <br>
                            Saturday, 8:30am - 10:30pm
                            <br>
                            Sunday Closed
                        </p>
                        <a href="contact-1.html" target="_blank"
                            class="tf-btn btn-line collection-other-link fw-4 wow fadeInUp" data-wow-delay="0s">Get
                            Directions<i class="icon icon-arrow1-top-left"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /store -->