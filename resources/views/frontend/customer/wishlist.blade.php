@extends('frontend.navigation')
   <title>Wish List | Logitech</title>
@section('content')

    @include('partials.page-title', ['title' => 'Wish List', 'subtitle' => ''])
<section class="flat-spacing-2">
        <div class="container">
            <div class="grid-layout wrapper-shop" data-grid="grid-6">
                @foreach ($products as $product)
                    <div class="card-product">
                        @include('partials.product.grid-product')
                    </div>
                @endforeach
                @include('partials.pagination', ['paginator' => $products])
            </div>
        </div>
</section>

@endsection