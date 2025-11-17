@extends('superadmin.navigation')
@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div class="d-flex justify-content-between">
      <h3 class="fw-bold mb-3">{{get_phrase('Product')}}</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="#">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">{{ get_phrase('Product List') }}</a>
        </li>
        
      </ul>
    </div>

    <a href="{{ route('superadmin.products.create') }}" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Add"><i class="fa fa-plus"></i> {{ get_phrase('Add Product') }}
    </a>
</div>


@include('components.product.product_list', ['products' => $products, 'search_route' => route('superadmin.products.index'), 'edit_route' => 'superadmin.products.edit', 'delete_route' => 'superadmin.products.delete'])

@endsection