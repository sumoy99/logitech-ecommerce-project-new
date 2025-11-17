@extends('frontend.layouts.account')

@section('account-content')
    <div class="my-account-content account-order">
        <div class="wrap-account-order">
            <table>
                <thead>
                    <tr>
                        <th class="fw-6">#</th>
                        <th class="fw-6">Product</th>
                        <th class="fw-6">Quantity</th>
                        <th class="fw-6">Price</th>
                        <th class="fw-6">Subtotal</th>
                        <th class="fw-6">Color</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $key => $orderItem)
                            @php
                                $product = getFullProduct($orderItem->product_id);
                                
                                $thumbnail = $product->productFile->thumbnail;
                            @endphp
                        <tr class="tf-order-item">
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                <div class="d-flex">
                                    <img src="{{ $thumbnail ? asset('assets/upload/products/thumbnails/' . $thumbnail) : asset('assets/backend/assets/img/placeholder.png') }}" width="30px" height="30px" alt=""> 
                                    <a href="{{ route('frontend.product_details', ['product_slug' => $product->slug, 'id' => $product->id]) }}" class="mx-2">{{$product->name}}</a>
                                </div>
                            </td>

                            <td>
                                {{$orderItem->quantity}}
                            </td>

                            <td>
                                {{currency($orderItem->price)}}
                            </td>
                            
                            <td>
                                {{currency($orderItem->subtotal)}}
                            </td>
                            <td>
                                {{$orderItem->color}}
                            </td>
                            
                        </tr>   
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection