{{-- <div class="modal fade header-login-modal" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-20px">
                    <h4 class="al-title-24px text-center">Log In</h4>
                </div>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="user-name" class="form-label fsh-form-label">{{get_phrase('Email')}}</label>
                        <input type="email" type="email" name="email" placeholder="Enter your email"  :value="old('email')" required autofocus autocomplete="username" class="form-control fsh-form-control" id="user-name" placeholder="">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 error-ntfy-reg" />
                    </div>
                    <div class="mb-20px">
                        <label for="user-password1" class="form-label fsh-form-label">{{ get_phrase('Password') }}</label>
                        <div class="input-password-wrap">
                            <div class="password-icons lock toggle-password" toggle=".password-field1">
                                <img class="eye-unlock" src="{{asset('public/assets/frontend/image-icons/eye-gray-20.svg')}}" alt="">
                                <img class="eye-lock" src="{{asset('public/assets/frontend/image-icons/eye-slash-gray-20.svg')}}" alt="">
                            </div>
                            <input type="password" name="password" class="form-control fsh-form-control password-field1" id="user-password1" required placeholder="Enter your password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 error-ntfy-reg" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-3 flex-wrap justify-content-between">
                            <div class="form-check form-checkbox">
                                <input class="form-check-input form-checkbox-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label form-checkbox-label" for="flexCheckDefault">
                                    Rememebr me
                                </label>
                            </div>
                            <a href="#" class="al-title-14px text-link" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password ?</a>
                        </div>
                    </div>
                    <button type="submit" class="btn fsh-btn-dark w-100 mb-12px">LOG IN</button>
                    <a href="javascript:void(0)" class="btn fsh-btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#createAccountModal">CREATE ACCOUNT</a>
                </form>
            </div>
        </div>
    </div>
</div> --}}


<div class="modal modalCentered fade form-sign-in modal-part-content" id="login">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Log in</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="tf-login-form">
                    <form class="" action="{{ route('login') }}" method="POST" accept-charset="utf-8">
                        @csrf
                        <div class="tf-field style-1">
                            <input class="tf-field-input tf-input" placeholder=" " type="text" name="email" required autofocus>
                            <label class="tf-field-label" for="">Email or Phone *</label>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 error-ntfy-reg" />
                        </div>
                        <div class="tf-field style-1">
                            <input class="tf-field-input tf-input" placeholder=" " type="password" name="password" required autocomplete="current-password">
                            <label class="tf-field-label" for="">Password *</label>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 error-ntfy-reg" />
                        </div>
                        <div>
                            <a href="#forgotPassword" data-bs-toggle="modal" class="btn-link link">Forgot your
                                password?</a>
                        </div>
                        <div class="bottom">
                            <div class="w-100">
                                <button type="submit"
                                    class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center"><span>Log
                                        in</span></button>
                            </div>
                            <div class="w-100">
                                <a href="#register" data-bs-toggle="modal" class="btn-link fw-6 w-100 link">
                                    New customer? Create your account
                                    <i class="icon icon-arrow1-top-left"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>