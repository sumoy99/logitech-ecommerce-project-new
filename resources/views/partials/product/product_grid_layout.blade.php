<div class="tf-grid-layout wrapper-shop tf-col-4" id="gridLayout">
    @foreach ($products as $product)
        <div class="card-product grid" data-availability="{{ $product->stock_status}}" data-brand="{{ $product->brand->name}}">
            @include('partials.product.grid-product')
        </div>
    @endforeach 
    @include('partials.pagination', ['paginator' => $products])
</div>