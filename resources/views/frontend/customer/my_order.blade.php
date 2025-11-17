@extends('frontend.layouts.account')

@section('account-content')
    <div class="my-account-content account-order">
        <div class="wrap-account-order">
            <table>
                <thead>
                    <tr>
                        <th class="fw-6">#</th>
                        <th class="fw-6">Order ID</th>
                        <th class="fw-6">Date</th>
                        <th class="fw-6">Status</th>
                        <th class="fw-6">Total</th>
                        <th class="fw-6">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr class="tf-order-item">
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>{{$order->order_number}}</td>
                            <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                @if ($order->order_status == 'pending')
                                    <td><span class="badge badge-warning">On hold</span></td>
                                @elseif($order->order_status == 'rejected')
                                    <td><span class="badge badge-danger">Rejected</span></td>
                                @elseif($order->order_status == 'approved')
                                    <td><span class="badge badge-success">Accepted</span></td>
                                @endif
                            <td>
                                {{currency($order->total_amount)}}
                            </td>
                            <td>
                                <a href="{{route('frontend.customer.order_item', ['id' => $order->id])}}"
                                    class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center">
                                    <span>View</span>
                                </a>
                            </td>
                        </tr>   
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection