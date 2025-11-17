@extends('superadmin.navigation')
   
@section('content')
<style>
    .table td, .table th {
    vertical-align: middle;
}

.badge {
    font-size: 11px;
    font-weight: 500;
}

</style>
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Payment History') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Payment History') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="eSection-wrap-2">
            @if(count($payment_histories) > 0)
            <!-- Table -->
            <div class="table-responsive">
                <table class="table eTable eTable-2">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ get_phrase('Item') }}</th>
                    <th scope="col">{{ get_phrase('User') }}</th>
                    <th scope="col">{{ get_phrase('Amount') }}</th>
                    <th scope="col">{{ get_phrase('Type') }}</th>
                    <th scope="col">{{ get_phrase('Txn ID') }}</th>
                    <th scope="col">{{ get_phrase('Txn No') }}</th>
                    <th scope="col">{{ get_phrase('Status') }}</th>
                    <th scope="col">{{ get_phrase('Download') }}</th>
                    <th scope="col">{{ get_phrase('Purchase Code') }}</th>
                    <th scope="col">{{ get_phrase('Coupon Code') }}</th>
                    <th scope="col">{{ get_phrase('Date') }}</th>
                    <th scope="col">{{ get_phrase('Action') }}</th>
                </thead>
                <tbody>
                    @foreach($payment_histories as $key => $payment)
                    
                        <tr>
                        <th scope="row">
                            <p class="row-number">{{ $key + 1 }}</p>
                        </th>
                        <td>
                            <div
                            class="dAdmin_profile d-flex align-items-center"
                            >
                            <div class="dAdmin_profile_name  min-w-200px">
                                <h4> {{ Str::limit($payment->item->item_title ?? 'N/A', 30) }}</h4>
                            </div>
                            </div>
                        </td>
                        <td>
                            <div class="dAdmin_info_name">
                                <p>{{ $payment->user->name ?? 'N/A' }}</p>
                                <small class="text-muted">{{ $payment->user->email ?? '' }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="dAdmin_info_name">
                                @if (!empty($payment->coupon_discount))
                                @php
                                    $calculateAmount = $payment->ammount - $payment->coupon_discount;
                                @endphp
                                <p>{{ currency($calculateAmount) }}</p>
                                <p style="font-size: 10px;">{{get_phrase('Discount')}}:  {{ currency($payment->coupon_discount) }}</p>
                                @else
                                <p>{{ currency($payment->ammount) }}</p>
                                @endif
                                
                            </div>
                        </td>
                        <td>
                            <div class="dAdmin_info_name">
                                <p> {{ ucfirst($payment->payment_type) }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="dAdmin_info_name">
                                <p>{{ $payment->transaction_id }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="dAdmin_info_name">
                                <p>{{ $payment->transaction_number }}</p>
                            </div>
                        </td>
                        <td>
                            {{ucfirst($payment->payment_status)}}
                        </td>
                        <td>
                            <div class="dAdmin_info_name">
                                @if($payment->download_status)
                                    <span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill">
                                        Downloaded
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-dark px-2 py-1 rounded-pill">
                                        Not Downloaded
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="dAdmin_info_name">
                                <p>{{ $payment->purchase_code }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="dAdmin_info_name">
                                <p>{{ $payment->coupon }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="dAdmin_info_name min-w-200px">
                                <span class="text-muted">{{ $payment->created_at->format('d M Y') }}</span><br> 
                                <small class="text-muted">{{ $payment->created_at->format('h:i A') }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="dAdmin_info_name d-flex min-w-200px">
                                <a href="{{route('superadmin.payment_history.paymentApproved', ['id' => $payment->id])}}" target="" class="btn btn-success ml-3 d-none d-md-inline-block">Approved</a> 
                                <a href="{{route('superadmin.payment_history.paymentReject', ['id' => $payment->id])}}" target="" class="btn btn-outline-primary ml-3 d-none d-md-inline-block">Reject</a> 
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>

                <div class="admin-tInfo-pagi d-flex justify-content-md-between justify-content-center align-items-center flex-wrap gr-15">
                    <p class="admin-tInfo">{{ get_phrase('Showing').' 1 - '.count($payment_histories).' '.get_phrase('from').' '.$payment_histories->total().' '.get_phrase('data') }}</p>
                    <div class="admin-pagi">
                    {!! $payment_histories->appends(request()->all())->links() !!}
                    </div>
                </div>
                </div>

            </div>
            @else
            <div class="empty_box center">
                <img class="mb-3" width="150px" src="{{ asset('assets/images/empty_box.png') }}" />
                <br>
                <span class="">{{ get_phrase('No data found') }}</span>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection