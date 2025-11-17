@extends('frontend.navigation')
@section('content') 

<style>
    /* Container for the form */
.sign-log-right {
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
  padding: 40px 40px 40px 40px;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  max-width: 500px;
  margin: auto;
}

/* Title */
.sign-log-right h1.title-30-b {
  font-weight: 700;
  font-size: 2rem;
  color: #212529;
  margin-bottom: 15px;
  letter-spacing: 1.2px;
}

/* Paragraph under title */
.sign-log-right p.fz-16-m-black-2 {
  font-size: 1rem;
  color: #495057;
  margin-bottom: 30px;
}

/* Form-group spacing */
.sign-log-right .form-group {
  margin-bottom: 25px;
}

/* Labels */
.sign-log-right label {
  display: block;
  font-weight: 600;
  color: #343a40;
  margin-bottom: 8px;
  font-size: 0.95rem;
}

/* Inputs */
.sign-log-right input.form-control {
  width: 100%;
  padding: 12px 15px;
  font-size: 1rem;
  border: 2px solid #ced4da;
  border-radius: 8px;
  transition: all 0.3s ease;
  background-color: #f8f9fa;
  color: #212529;
}

/* Disabled email input style */
.sign-log-right input[disabled],
.sign-log-right input[readonly] {
  background-color: #e9ecef;
  cursor: not-allowed;
  color: #6c757d;
}

/* Focus effect */
.sign-log-right input.form-control:focus {
  outline: none;
  border-color: #4a90e2;
  background-color: #ffffff;
  box-shadow: 0 0 8px rgba(74, 144, 226, 0.5);
}

/* Button style */
.sign-log-right button.btn-primary {
  background: linear-gradient(135deg, #4a90e2 0%, #357ABD 100%);
  border: none;
  padding: 12px 30px;
  font-size: 1.1rem;
  font-weight: 700;
  border-radius: 50px;
  color: white;
  cursor: pointer;
  transition: background 0.3s ease;
  box-shadow: 0 8px 20px rgba(53, 122, 189, 0.3);
  width: 100%;
}

/* Button hover */
.sign-log-right button.btn-primary:hover {
  background: linear-gradient(135deg, #357ABD 0%, #4a90e2 100%);
  box-shadow: 0 12px 30px rgba(53, 122, 189, 0.5);
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .sign-log-right {
    padding: 30px 20px;
    max-width: 100%;
  }
}

</style>
@if ($errors->any())
<div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<section class="section-sign-log mt-5 mb-5">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <!-- Left side -->
        <div class="col-lg-6">
          <div
            class="d-none d-sm-block sign-log-left d-flex flex-column justify-content-center align-items-center rg-70"
          >
            <div class="sign-log-img">
              <img src="{{asset('public/assets/frontend/img/relax.png')}}" alt="" />
            </div>
          </div>
        </div>
        <!-- Right Side -->
        <div class="col-lg-6">

          <!-- Form area -->
          <div class="sign-log-right box-shadow-11 p-40 p-sm-40 bd-r-5">
            <h1 class="title-30-b pb-20">Enter verification code</h1>
            <p class="fz-16-m-black-2 pb-40">
              We have just sent a verification code to {{ old('email', session('email')) }}
            </p>
            <!-- Form -->
            <form method="POST" action="{{ route('verification.code.verify') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', session('email')) }}" readonly class="form-control" required>
                </div>
        
                <div class="form-group">
                    <label for="code">Verification Code</label>
                    <input id="code" type="text" name="code" class="form-control" required maxlength="6" minlength="6" pattern="\d{6}">
                </div>
        
                <button type="submit" class="btn btn-primary mt-3">Verify</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
{{-- <div class="container">
    <h2>Email Verification</h2>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('verification.code.verify') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', session('email')) }}" readonly class="form-control" required>
        </div>

        <div class="form-group">
            <label for="code">Verification Code</label>
            <input id="code" type="text" name="code" class="form-control" required maxlength="6" minlength="6" pattern="\d{6}">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Verify</button>
    </form>
</div> --}}
@endsection