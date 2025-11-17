<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ get_settings('system_name') }} | {{ get_phrase('Reset Password') }}</title>
    <!-- all the meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- all the css files -->
    <link rel="shortcut icon" href="assets/images/logo.png" />
    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('public/assets/backend/assets/vendors/bootstrap-5.1.3/css/bootstrap.min.css') }}"
    />
    <!--Custom css-->
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/swiper-bundle.min.css"
    />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/assets/css/custom.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/assets/css/style.css') }}" />
    <!-- Datepicker css -->
    <link rel="stylesheet" href="{{ asset('public/assets/backend/assets/css/daterangepicker.css') }}" />
    <!-- Select2 css -->
    <link rel="stylesheet" href="{{ asset('public/assets/backend/assets/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/backend/assets/css/toastr.min.css') }}" />

    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('public/assets/backend/assets/vendors/bootstrap-icons-1.8.1/bootstrap-icons.css') }}"
    />
</head>


<body>
  <div class="container-fluid h-100">
    <div class="row h-100">
      <div class="col-lg-6 d-none d-lg-block p-0 h-100">
        <div class="bg-image"
          style="width: inherit; height: 100%; position: fixed; background-image: url('{{asset('public/assets/backend/assets/images/digital_agency_log_in.jpeg')}}'); background-size: cover; background-position: center;">
        </div>
        <!-- <img src="assets/images/login.png" width="100%"> -->
      </div>
      <div class="col-lg-6 p-0 h-100 position-relative">
        <div class="parent-elem">
          <div class="middle-elem">
            <div class="primary-form">
              <div class="form-logo" style="margin-bottom: 0px;">
                <img height="60px" class="mb-5"  src="{{ asset('public/assets/upload/logo/'.get_settings('dark_logo')) }}">
              </div>
              <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
              <div class="row">

                <div class="col-12">
                  <div class="login-form">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="form-group">
                            <x-input-label for="email" class="form-label" :value="__('Email')" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                          <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                              <input id="email" placeholder="Email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                          </div>
                        </div>



                        <div class="flex items-center justify-end mt-4">
                            <button class="btn btn-primary w-100">
                                {{ __('Email Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 <!--Main Jquery-->
 <script src="{{ asset('public/assets/backend/assets/vendors/jquery/jquery-3.6.0.min.js') }}"></script>
 <!--Bootstrap bundle with popper-->
 <script src="{{ asset('public/assets/backend/assets/vendors/bootstrap-5.1.3/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('public/assets/backend/assets/js/swiper-bundle.min.js') }}"></script>
 <!-- Datepicker js -->
 <script src="{{ asset('public/assets/backend/assets/js/moment.min.js') }}"></script>
 <script src="{{ asset('public/assets/backend/assets/js/daterangepicker.min.js') }}"></script>
 <!-- Select2 js -->
 <script src="{{ asset('public/assets/backend/assets/js/select2.min.js') }}"></script>
 <script src="{{ asset('public/assets/backend/assets/js/toastr.min.js') }}"></script>

 <!--Custom Script-->
 <script src="{{ asset('public/assets/backend/assets/js/script.js') }}"></script>

</body>

</html>

