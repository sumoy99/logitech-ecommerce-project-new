@extends('superadmin.navigation')
   
@section('content')
<style>
    .nav-tabs {
        border-bottom: 2px solid #dee2e6;
    }

    .nav-tabs .nav-link {
        border: none;
        border-radius: 0;
        color: #6c757d;
        font-weight: 500;
        padding: 12px 20px;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link.active {
        color: #0d6efd;
        background-color: #f8f9fa;
        border-bottom: 3px solid #0d6efd;
        font-weight: 600;
    }

    .table {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        background-color: #fff;
    }

    .table th {
        background-color: #f0f2f5;
        color: #495057;
        font-weight: 600;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .btn-success {
        padding: 6px 12px;
        font-size: 14px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #198754;
    }

    .tab-content {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
    }

    .nav-item {
        margin-right: 10px;
    }

    .container {
        max-width: 1000px;
    }

    tbody tr:hover {
        background-color: #f8f9fa;
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

<div class="container">
    <ul class="nav nav-tabs" id="referralTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#requests">Withdraw Requests</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="unpaid-tab" data-bs-toggle="tab" href="#unpaid" role="tab">Unpaid</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="paid-tab" data-bs-toggle="tab" href="#paid" role="tab">Paid</a>
        </li>
    </ul>
    <div class="tab-content mt-3" id="referralTabContent">
        <div class="tab-pane fade show active" id="requests" role="tabpanel">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Account Number</th>
                        <th>Status</th>
                        <th>Requested At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($withdraw_requests as $req)
                    @php
                        $couponCode = $req->user->name;
                    @endphp
                        <tr>
                            <td>{{ $req->user->name }}</td>
                            <td>৳{{ number_format($req->amount, 2) }}</td>
                            <td>{{ ucwords($req->payment_method) }}</td>
                            <td>{{ $req->account_number }}</td>
                            <td><span class="badge bg-{{ $req->status == 'pending' ? 'warning' : ($req->status == 'approved' ? 'success' : 'danger') }}">{{ ucfirst($req->status) }}</span></td>
                            <td>{{ $req->created_at->format('d M Y') }}</td>
                            <td>
                                @if($req->status == 'pending')
                                <form action="{{ route('superadmin.payment_history.approveWithdraw', ['id' => $req->id, 'couponCode' => $req->user->referral_code]) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                    <form action="{{ route('superadmin.payment_history.rejectWithdraw', $req->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                @else
                                    <em>N/A</em>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No withdrawal requests.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Unpaid Tab --}}
        <div class="tab-pane fade" id="unpaid" role="tabpanel">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Referrer</th>
                        <th>Coupon Code</th>
                        <th>Referrals</th>
                        <th>Total Earning</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($unpaid as $row)
                    <tr>
                        <td>{{ $row['referrer']->name }}</td>
                        <td>{{ $row['coupon_code'] }}</td>
                        <td>{{ $row['referral_count'] }}</td>
                        <td>৳{{ number_format($row['total_earning'], 2) }}</td>
                        <td>
                            <form method="POST" action="{{ route('superadmin.payment_history.markReferralAsPaid', $row['coupon_code']) }}">
                                @csrf
                                <button class="btn btn-success btn-sm">Mark as Paid</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5">No unpaid referrals.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paid Tab --}}
        <div class="tab-pane fade" id="paid" role="tabpanel">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Referrer</th>
                        <th>Coupon Code</th>
                        <th>Referrals</th>
                        <th>Total Paid</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($paid as $row)
                    <tr>
                        <td>{{ $row['referrer']->name }}</td>
                        <td>{{ $row['coupon_code'] }}</td>
                        <td>{{ $row['referral_count'] }}</td>
                        <td>৳{{ number_format($row['total_earning'], 2) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4">No paid referrals.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection