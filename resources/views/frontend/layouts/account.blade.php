@extends('frontend.navigation')

<title>Account | Logitech</title>

@section('content')
    @include('partials.page-title', [
        'title' => $title ?? 'My Account',
        'subtitle' => $subtitle ?? 'Shop through our latest selection of Fashion'
    ])

    <section class="flat-spacing-11">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="wrap-sidebar-account">
                        <ul class="my-account-nav">
                            <li><a href="{{url('my-account')}}" class="my-account-nav-item {{ request()->is('my-account*') ? 'active':'' }}">Dashboard</a></li>
                            <li><a href="{{url('my-orders')}}" class="my-account-nav-item {{ request()->is('my-orders*') ||  request()->is('order-item*')? 'active':'' }}">Orders</a></li>
                            <li><a href="" class="my-account-nav-item">Address</a></li>
                            <li><a href="" class="my-account-nav-item">Account Details</a></li>
                            <li><a href="" class="my-account-nav-item">Wishlist</a></li>
                            <li><a href="" class="my-account-nav-item">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    @yield('account-content')
                </div>
            </div>
        </div>
    </section>
@endsection