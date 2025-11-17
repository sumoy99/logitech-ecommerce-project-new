@extends('superadmin.navigation')
@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div class="d-flex justify-content-between">
      <h3 class="fw-bold mb-3">{{get_phrase('Orders')}}</h3>
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
          <a href="#">{{ get_phrase('Order Item List') }}</a>
        </li>
        
      </ul>
      
    </div>
    <a href="{{route('superadmin.orders.index')}}" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Back"><i class="fas fa-arrow-circle-left"></i> Back
    </a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-6">
                        <form method="GET" action="{{ route('superadmin.orders.order_items', ['id' => $order_id]) }}">
                        <div class="search-box">
                            <div class="InputContainer">
                                <input value="{{ request()->get('search') }}" name="search" placeholder="Search.."/>
                            </div>
                            <button type="submit" class="Icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#657789" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            </button>
                        </div>
                    </form> 
                    </div>
                </div>
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                            <th>Quantity</th>
                            <th>Color</th>
                            <th>Date</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orderItems as $key => $orderProduct)
                            @php
                                $product = getFullProduct($orderProduct->product_id);
                                
                                $thumbnail = $product->productFile->thumbnail;
                            @endphp
                            <tr>
                                
                                <td>{{ $key + 1 }}</td>
                                <td> <img src="{{ $thumbnail ? asset('assets/upload/products/thumbnails/' . $thumbnail) : asset('assets/backend/assets/img/placeholder.png') }}" width="50" height="50" alt=""> </td>
                                <td><a href="{{ route('frontend.product_details', ['product_slug' => $product->slug, 'id' => $product->id]) }}" target="_blank">{{$product->name}}</a></td> 
                                <td>{{ $orderProduct->price }}</td>
                                <td>{{ $orderProduct->subtotal }}</td>
                                <td>{{ $orderProduct->quantity }}</td>
                                <td>{{ $orderProduct->color }}</td>
                                <td>{{ $orderProduct->created_at->format('d M Y, h:i A') }}</td>

                                {{-- <td>
                                    <a href="javascript:;" onclick="rightModal('{{ route('superadmin.notes.note_type.edit', ['id' => $noteType->id]) }}', 'Edit Brand')" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-edit"></i></a>

                                    <a href="javascript:;" class="btn btn-sm btn-danger revert-btn" data-url="{{ route('superadmin.notes.note_type.delete', ['id' => $noteType->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No Order found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination p1">
            <ul>
            @if ($orderItems->previousPageUrl())
                <a href="{{ $orderItems->previousPageUrl() }}"><li><</li></a>
            @endif
            @for ($i = 1; $i <= $orderItems->lastPage(); $i++)
                <a href="{{ $orderItems->url($i) }}" class="{{ $orderItems->currentPage() == $i ? 'is-active' : '' }}"><li>{{ $i }}</li></a>
            @endfor
            @if ($orderItems->nextPageUrl())
                <a href="{{ $orderItems->nextPageUrl() }}"><li>></li></a>
            @endif
            </ul>
        </div>
    </div>
</div>

@endsection