{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
@extends('frontend.navigation')
@section('content') 
<!-- page-title -->
{{-- <div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center">Register</div>
    </div>
</div> --}}
<!-- /page-title -->

<section class="flat-spacing-10">
    <div class="container">
        <div class="form-register-wrap">
            <div class="flat-title align-items-start gap-0 mb_30 px-0">
                <h5 class="mb_18">Register</h5>
                <p class="text_black-2">Sign up for early Sale access plus tailored new arrivals, trends and
                    promotions. To opt out, click unsubscribe in our emails</p>
            </div>
            <div>
                <form action="{{ route('register') }}" id="register-form" method="POST">
                        @csrf
                        <input type="hidden" name="role_id" value="3">

                        <div class="tf-field style-1 mb_15">
                            <input type="text" name="name" id="property1" placeholder=" " value="{{ old('name') }}" required class="tf-field-input tf-input">
                            <label class="tf-field-label fw-4 text_black-2" for="property1">Name *</label>
                            @error('name')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="tf-field style-1 mb_15">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder=" " required class="tf-field-input tf-input">
                            <label class="tf-field-label fw-4 text_black-2" >Email *</label>
                            @error('email')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="tf-field style-1 mb_15">
                            <input type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder=" " required class="tf-field-input tf-input">
                            <label class="tf-field-label fw-4 text_black-2" >Phone Number *</label>
                            @error('phone_number')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="tf-field style-1 mb_15">
                            <input type="password" name="password" placeholder=" " required class="tf-field-input tf-input">
                            <label class="tf-field-label fw-4 text_black-2" >Password *</label>
                            @error('password')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="tf-field style-1 mb_15">
                            
                            <input type="password" name="password_confirmation" placeholder=" " required class="tf-field-input tf-input">
                            <label class="tf-field-label fw-4 text_black-2" >Confirm Password  *</label>
                        </div>

                        <div class="bottom mb_20">
                            <button type="submit" class="tf-btn btn-fill w-100 justify-content-center">Register</button>
                        </div>
                        <div class="text-center ">
                                <a href="{{url('/login')}}" class="tf-btn btn-line">Already have an account? Log in here<i
                                        class="icon icon-arrow1-top-left"></i></a>
                            </div>
                    </form>
            </div>
        </div>
    </div>
</section>
@endsection
