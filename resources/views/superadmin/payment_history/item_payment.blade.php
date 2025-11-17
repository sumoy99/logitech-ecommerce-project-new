@extends('superadmin.navigation')
   
@section('content')
<div class="container">
    <h2>Invoice Management</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>User</th>
                <th>Amount</th>
                <th>transaction_id</th>
                <th>transaction_number</th>
                <th>image</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as  $key => $invoice)
            <tr>
                <td>#{{ $key + 1 }}</td>
                <td>{{ $invoice->user->name ?? 'N/A' }}</td>
                <td>{{ currency($invoice->amount) }}</td>
                <td>{{ $invoice->transaction_id }}</td>
                <td>{{ $invoice->transaction_number }}</td>
                <td>
                    @if($invoice->image)
                        @php
                            $extension = pathinfo($invoice->image, PATHINFO_EXTENSION);
                        @endphp
                
                        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <!-- Image view button -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal{{ $invoice->id }}">
                                View Image
                            </button>
                
                            <!-- Image Modal -->
                            <div class="modal fade" id="imageModal{{ $invoice->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $invoice->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalLabel{{ $invoice->id }}">Transaction Image</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('public/assets/upload/payment/' . $invoice->image) }}" alt="Transaction Image" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                        @elseif(strtolower($extension) == 'pdf')
                            <!-- PDF download button -->
                            <a href="{{asset('public/assets/upload/payment/' . $invoice->image) }}" class="btn btn-info btn-sm" download>
                                Download PDF
                            </a>
                        @else
                            Unknown File
                        @endif
                    @else
                        N/A
                    @endif
                </td>
                
                <td>
                    @if($invoice->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($invoice->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </td>
                <td>{{ $invoice->created_at->format('d M Y') }}</td>
                <td>
                    @if($invoice->status == 'pending')
                        <a href="{{route('superadmin.payment_history.paymentApproved', ['id' => $invoice->id])}}" target="" class="btn btn-success ml-3 d-none d-md-inline-block">Approved</a> 

                        <a href="{{route('superadmin.payment_history.paymentReject', ['id' => $invoice->id])}}" target="" class="btn btn-outline-primary ml-3 d-none d-md-inline-block">Reject</a> 
                    @else
                        <button class="btn btn-secondary btn-sm" disabled>No Action</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
