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
          <a href="#">{{ get_phrase('Order List') }}</a>
        </li>
        
      </ul>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-6">
                        <form method="GET" action="{{ route('superadmin.orders.index') }}">
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
                            <th>Order Number</th>
                            <th>User Name</th>
                            <th>Amount</th>
                            <th>Order Status</th>
                            <th>Notes</th>
                            <th>View Products</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $key => $order)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->total_amount}}</td>
                                    @if ($order->order_status == 'pending')
                                        <td><span class="badge badge-warning">Pending</span></td>
                                    @elseif($order->order_status == 'rejected')
                                        <td><span class="badge badge-danger">Rejected</span></td>
                                    @elseif($order->order_status == 'approved')
                                        <td><span class="badge badge-success">Accepted</span></td>
                                    @endif
                                <td><p>{{ $order->notes}}</p></td>
                                <td><a href="{{ route('superadmin.orders.order_items', ['id' => $order->id]) }}" class="btn btn-primary btn-border btn-round">View</a></td>
                                <td>
                                    <a href="javascript:;" 
                                        class="btn btn-sm btn-success status-update-btn" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Approve Order"
                                        onclick="confirmStatusModal('{{ route('superadmin.orders.bulk-order-status', ['status' => 'approved', 'id' => $order->id]) }}', 'updateStatus')">
                                        <i class="far fa-check-circle"></i>
                                    </a>

                                    <a href="javascript:;" 
                                        class="btn btn-sm btn-danger status-update-btn" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Reject Order" onclick="confirmStatusModal('{{ route('superadmin.orders.bulk-order-status', ['status' => 'rejected', 'id' => $order->id]) }}', 'ajax_update')">
                                        <i class="fas fa-times"></i> 
                                    </a>
                                </td>
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
            @if ($orders->previousPageUrl())
                <a href="{{ $orders->previousPageUrl() }}"><li><</li></a>
            @endif
            @for ($i = 1; $i <= $orders->lastPage(); $i++)
                <a href="{{ $orders->url($i) }}" class="{{ $orders->currentPage() == $i ? 'is-active' : '' }}"><li>{{ $i }}</li></a>
            @endfor
            @if ($orders->nextPageUrl())
                <a href="{{ $orders->nextPageUrl() }}"><li>></li></a>
            @endif
            </ul>
        </div>
    </div>
</div>

@endsection