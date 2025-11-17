@extends('frontend.navigation')

   <title>{{$query}} | Logitech</title>

@section('content')


<!-- breadcrumb -->
    <div class="tf-breadcrumb">
        <div class="container">
            <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
                <div class="tf-breadcrumb-list">
                    <a href="{{ route('frontend.index') }}" class="text">Home</a>
                    <i class="icon icon-arrow-right"></i>
                    <a href="" class="text"></a>
                    {{-- <i class="icon icon-arrow-right"></i> --}}
                    <span class="text">{{$query}}</span>
                </div>
                
                <div class="tf-breadcrumb-prev-next">
                    <a href="#" class="tf-breadcrumb-prev hover-tooltip center">
                        <i class="icon icon-arrow-left"></i>
                    </a>
                    <a href="#" class="tf-breadcrumb-back hover-tooltip center">
                        <i class="icon icon-shop"></i>
                    </a>
                    <a href="#" class="tf-breadcrumb-next hover-tooltip center">
                        <i class="icon icon-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
<!-- /breadcrumb -->

<!-- Collection products -->
        <section class="flat-spacing-15">
            <div class="container">
                <div class="wrap-carousel">
                    <div dir="ltr" class="swiper tf-sw-product-sell-1 wrap-sw-over" data-preview="4" data-tablet="3"
                        data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3"
                        data-pagination-lg="3">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-lg-2 col-md-4 col-sm-4 col-6">
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

{{-- @foreach ($products as $product)
name: {{$product->name}}
    
@endforeach --}}
@endsection