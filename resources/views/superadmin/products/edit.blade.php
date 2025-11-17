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
          <a href="#">{{ get_phrase('Product Edit') }}</a>
        </li>
        
      </ul>
    </div>
    <a href="{{ route('superadmin.products.index') }}" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back"><i class="fas fa-arrow-circle-left"></i> {{ get_phrase('Back') }}
    </a>
</div>

    @include('components.product.form', ['action' => route('superadmin.products.update', ['id' => $product->id])])
@endsection