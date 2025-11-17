@extends('frontend.navigation')
   <title>Check Out | Logitech</title>
@section('content')

    @include('partials.page-title', ['title' => 'Check Out', 'subtitle' => 'Shop through our latest selection of Fashion'])

    <!-- page-cart -->
    <section class="flat-spacing-11">
        <div class="container">
            <div class="tf-page-cart-wrap layout-2">
                <div class="tf-page-cart-item">
                    <h5 class="fw-5 mb_20">Shipping & Billing details</h5>
                    <form id="shippingForm" class="form-checkout">
                        <div class="box grid-2">
                            <fieldset class="fieldset">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" name="name" value="{{$shippingAddress->name}}" placeholder="Please enter your full name">
                            </fieldset>
                            <fieldset class="fieldset">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{$shippingAddress->email}}" placeholder="Please enter your email">
                            </fieldset>
                        </div>

                        <div class="box grid-2">
                            <fieldset class="box fieldset">
                                <label for="phone">Phone Number</label>
                                <input type="number" id="phone"  name="phone" value="{{$shippingAddress->phone}}" placeholder="Please enter your phone number">
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="house">Building / House No / Floor / Street</label>
                                <input type="text" id="house" name="house" value="{{$shippingAddress->house}}"  placeholder="Please enter">
                            </fieldset>
                        </div>

                        <div class="box grid-2">
                            <fieldset class="box fieldset">
                                <label for="colony">Colony / Suburb / Locality / Landmark</label>
                                <input type="text" id="colony" name="colony" value="{{$shippingAddress->colony}}" placeholder="Please enter">
                            </fieldset>
                            <fieldset class="fieldset mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" name="address" value="{{$shippingAddress->address}}" placeholder="For Example: House# 123, Street# 123, ABC Road">
                            </fieldset>
                        </div>

                        <div class="box grid-2">
                            <fieldset class="box fieldset">
                                <label for="region">Region (Division)</label>
                                <select class="tf-select w-100" id="region" name="region"  data-selected="{{ $shippingAddress->region }}">
                                    <option value="">Select Region</option>
                                    <option value="Dhaka" {{$shippingAddress->region == 'Dhaka' ? 'selected': ''}}>Dhaka</option>
                                    <option value="Chittagong" {{$shippingAddress->region == 'Chittagong' ? 'selected': ''}}>Chittagong</option>
                                    <option value="Khulna" {{$shippingAddress->region == 'Khulna' ? 'selected': ''}}>Khulna</option>
                                    <option value="Rajshahi" {{$shippingAddress->region == 'Rajshahi' ? 'selected': ''}}>Rajshahi</option>
                                    <option value="Sylhet" {{$shippingAddress->region == 'Sylhet' ? 'selected': ''}}>Sylhet</option>
                                    <option value="Barisal" {{$shippingAddress->region == 'Barisal' ? 'selected': ''}}>Barisal</option>
                                    <option value="Rangpur" {{$shippingAddress->region == 'Rangpur' ? 'selected': ''}}>Rangpur</option>
                                    <option value="Mymensingh" {{$shippingAddress->region == 'Mymensingh' ? 'selected': ''}}>Mymensingh</option>
                                </select>
                            </fieldset>

                            <fieldset class="box fieldset">
                                <label for="city">City (District)</label>
                                <select class="tf-select w-100" id="city" name="city"  data-selected="{{$shippingAddress->city }}">
                                    <option value="">Select City</option>
                                </select>
                            </fieldset>
                        </div>

                        <fieldset class="box fieldset">
                            <label for="area">Area (Thana / Upazila)</label>
                            <div class="d-flex gap-2 align-items-center">
                                <select class="tf-select w-50" id="area" name="area"  data-selected="{{ $shippingAddress->area }}">
                                    <option value="">Select Area</option>
                                </select>
                                <input type="text" id="custom_area" name="custom_area" value="" placeholder="Or type area name" class="form-control" style="width: 50%;">
                            </div>
                            <small class="text-muted d-block mt-1">If your area is not listed, please type it manually.</small>
                        </fieldset>

                        <fieldset class="box fieldset">
                            <label for="note">Order notes (optional)</label>
                            <textarea name="note" value="{{$shippingAddress->note}}" id="note"></textarea>
                        </fieldset>
                    </form>
                </div>
                <div class="tf-page-cart-footer">
                    <div class="tf-cart-footer-inner">
                        <h5 class="fw-5 mb_20">Your order</h5>
                        <form id="orderForm" action="{{ route('frontend.order.place') }}" method="POST" class="tf-page-cart-checkout widget-wrap-checkout">
                            @csrf
                            <ul class="wrap-checkout-product">
                                @foreach ($cartItems as $item)
                                <input type="hidden" name="product_id[]" value="{{$item->id}}">
                                <input type="hidden" name="quantity[]" value="{{$item->quantity}}">
                                <input type="hidden" name="price[]" value="{{$item->total_price}}">
                                    <li class="checkout-product-item">
                                        <figure class="img-product">
                                            <img src="{{ $item->thumbnail ? asset('assets/upload/products/thumbnails/' . $item->thumbnail) : asset('assets/backend/assets/img/placeholder.png') }}" alt="product">
                                            <span class="quantity">{{ $item->quantity }}</span>
                                        </figure>
                                        <div class="content">
                                            <div class="info">
                                                <p class="name">{{$item->name}}</p>
                                                
                                                @foreach ($item->options as $key => $value)
                                                    <span class="variant">{{ ucfirst($key) }}: {{ $value }}</span>
                                                    @if ($key == 'color')
                                                        <input type="hidden" name="color[]" value="{{ $value }}">
                                                    @elseif($key == 'size')
                                                         <input type="hidden" name="size[]" value="{{ $value }}">
                                                    @endif
                                                @endforeach
                                                
                                            </div>
                                            <span class="price">{{ currency($item->total_price) }}</span>
                                        </div>
                                    </li>
                                @endforeach
                                
                                
                            </ul>
                            {{-- <div class="coupon-box">
                                <input type="text" placeholder="Discount code">
                                <a href="#"
                                    class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn">Apply</a>
                            </div> --}}
                            <div class="d-flex justify-content-between line pb_20">
                                <h6 class="fw-5">Total</h6>
                                <input type="hidden" name="total_amount" value="{{$totalPrice}}">
                                <h6 class="total fw-5">{{ currency($totalPrice) }}</h6>
                            </div>
                            <div class="wd-check-payment">
                                {{-- <div class="fieldset-radio mb_20">
                                    <input type="radio" name="payment" id="bank" class="tf-check" checked>
                                    <label for="bank">Direct bank transfer</label>

                                </div> --}}
                                <div class="fieldset-radio mb_20">
                                    <input type="radio" name="payment" id="delivery" class="tf-check" checked>
                                    <label for="delivery">Cash on delivery</label>
                                </div>
                                <p class="text_black-2 mb_20">Your personal data will be used to process your order,
                                    support your experience throughout this website, and for other purposes
                                    described in our <a href="privacy-policy.html"
                                        class="text-decoration-underline">privacy policy</a>.</p>
                                <div class="box-checkbox fieldset-radio mb_20">
                                    <input type="checkbox" id="check-agree" class="tf-check">
                                    <label for="check-agree" class="text_black-2">I have read and agree to the
                                        website <a href="terms-conditions.html" class="text-decoration-underline">terms and conditions</a>.</label>
                                </div>
                            </div>
                            <button type="submit"
                                class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn justify-content-center">Place
                                order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <!-- page-cart -->
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const regionSelect = document.getElementById('region');
    const citySelect = document.getElementById('city');
    const areaSelect = document.getElementById('area');
    const customArea = document.getElementById('custom_area');
    const form = document.querySelector('form');

    // Get preselected values (for edit)
    const selectedRegion = regionSelect.getAttribute('data-selected');
    const selectedCity = citySelect.getAttribute('data-selected');
    const selectedArea = areaSelect.getAttribute('data-selected');

    // Load cities when region changes or if editing
    function loadCities(region, callback) {
        if (!region) return;
        citySelect.innerHTML = '<option value="">Loading...</option>';
        fetch(`/get-cities/${region}`)
            .then(res => res.json())
            .then(data => {
                citySelect.innerHTML = '<option value="">Select City</option>';
                data.forEach(city => {
                    const selected = (city === selectedCity) ? 'selected' : '';
                    citySelect.innerHTML += `<option value="${city}" ${selected}>${city}</option>`;
                });
                if (callback) callback();
            });
    }

    // Load areas when city changes or if editing
    function loadAreas(city) {
        if (!city) return;
        areaSelect.innerHTML = '<option value="">Loading...</option>';
        fetch(`/get-areas/${city}`)
            .then(res => res.json())
            .then(data => {
                areaSelect.innerHTML = '<option value="">Select Area</option>';
                data.forEach(area => {
                    const selected = (area === selectedArea) ? 'selected' : '';
                    areaSelect.innerHTML += `<option value="${area}" ${selected}>${area}</option>`;
                });
            });
    }

    // Region change → load cities
    regionSelect.addEventListener('change', function() {
        loadCities(this.value);
    });

    // City change → load areas
    citySelect.addEventListener('change', function() {
        loadAreas(this.value);
    });

    // If editing → auto load cities & areas
    if (selectedRegion) {
        loadCities(selectedRegion, () => {
            if (selectedCity) {
                loadAreas(selectedCity);
            }
        });
    }

    // If custom area is used
    form.addEventListener('submit', function(e) {
        if (!areaSelect.value && customArea.value) {
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'area';
            hidden.value = customArea.value;
            this.appendChild(hidden);
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const orderForm = document.getElementById('orderForm');
    const shippingForm = document.getElementById('shippingForm');

    orderForm.addEventListener('submit', function(e) {
        const shippingInputs = shippingForm.querySelectorAll('input, select, textarea');

        shippingInputs.forEach(input => {
            if (input.name && input.value) {
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = input.name;
                hidden.value = input.value;
                orderForm.appendChild(hidden);
            }
        });

    });
});

</script>



