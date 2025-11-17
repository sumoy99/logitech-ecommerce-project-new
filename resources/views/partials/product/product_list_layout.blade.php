<div class="tf-list-layout" id="listLayout">
    @foreach ($products as $product)
        <div class="card-product list-layout" data-availability="{{ $product->stock_status}}" data-brand="{{ $product->brand->name}}">
            @include('partials.product.list-product')
        </div>
    @endforeach
    
   @include('partials.pagination', ['paginator' => $products])
</div>