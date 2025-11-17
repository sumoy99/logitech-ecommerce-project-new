@extends('frontend.navigation')

    @include('partials.meta', [
        'meta_title' => $category->meta_title ?? ($category->name . ' | Logitech'),
        'meta_desc' => $category->meta_desc ?? ('Explore our latest collection of ' . $category->name . ' at Logitech. Shop trendy styles and quality products online.'),
        'meta_keywords' => $category->meta_keywords ?? ($category->name . ', fashion, shop, ecommerce, buy online, best price'),
        'image' => $category->image ? asset('assets/upload/category/' . $category->image) : asset('assets/backend/assets/img/placeholder.png'),
        'robots' => 'index, follow',
        'googlebot' => 'index, follow',
        'bingbot' => 'index, follow',
    ])
    
@section('content')

    @include('partials.page-title', ['title' => $category->name, 'subtitle' => 'Shop through our latest selection of Fashion'])
    
    @include('partials.product-sidebar')
    
@endsection

   