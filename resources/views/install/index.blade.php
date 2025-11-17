<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Creativeitem Software Installation" />
	<meta name="author" content="Creativeitem" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{ asset('public/assets/backend/assets/uploads/logo/favicon.png') }}">
	<title>Installation Digital Agency</title>
	
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/assets/vendors/bootstrap-5.1.3/css/bootstrap.min.css') }}">

    <!--Custom css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/assets/css/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/assets/css/style.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/assets/vendors/bootstrap-icons-1.8.1/bootstrap-icons.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/assets/css/datatables.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/assets/calender/main.css') }}">

    <!--Toaster css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/assets/css/toastr.min.css') }}">


    <!--Main Jquery-->
    <script src="{{ asset('public/assets/backend/assets/vendors/jquery/jquery-3.6.0.min.js') }}"></script>


</head>
<body class="page-body">

<div class="page-container horizontal-menu">


	<header class="navbar navbar-fixed-top ins-one">
		<div class="navbar-inner">
			<!-- logo -->
			<div class="navbar-brand">
				<a href="#" style="margin-left: 20px">
					<img width="50" height="50" src="{{ asset('public/assets/backend/assets/images/digital_agency_logo.png') }}" alt="">
				</a>
				<span class="logo_name" style="color: #fff;">Nexaflux</span>
				<span class="logo_name ms-4">Installation</span>
			</div>
		</div>
	</header>
	<div class="main_content">
		@yield('content')
	</div>

	<!--Main Jquery-->
	<script src="{{ asset('public/assets/backend/assets/vendors/jquery/jquery-3.6.0.min.js') }}"></script>
	<!--Bootstrap bundle with popper-->
	<script src="{{ asset('public/assets/backend/assets/vendors/bootstrap-5.1.3/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('public/assets/backend/assets/js/swiper-bundle.min.js') }}"></script>

	<!--Custom Script-->
    <script src="{{ asset('public/assets/backend/assets/js/script.js') }}"></script>

    <script src="{{ asset('public/assets/backend/assets/calender/main.js') }}"></script>
	<script src="{{ asset('public/assets/backend/assets/calender/locales-all.js') }}"></script>


    <!--old-->

    <script src="{{ asset('public/assets/backend/assets/js/custom.js') }}"></script>

    <script src="{{ asset('public/assets/backend/assets/js/daterangepicker.min.js') }}"></script>

    <script src="{{ asset('public/assets/backend/assets/js/moment.min.js') }}"></script>

</body>
</html>
