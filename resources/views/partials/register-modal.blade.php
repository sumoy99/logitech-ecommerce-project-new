{{-- <style>
    .tf-field.style-1 .tf-input {
        padding: 6px 18px 6px;
        height: 47px;
        border: 1px solid var(--line) !important;
    }
</style> --}}

<div class="modal modalCentered fade form-sign-in modal-part-content" id="register">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Register</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="tf-login-form">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <input type="hidden" name="role_id" value="3">

                        <div class="tf-field style-1">
                            <input type="text" name="name" id="property1" placeholder=" " value="{{ old('name') }}" required class="tf-field-input tf-input">
                            <label class="tf-field-label fw-4 text_black-2" for="property1">Name *</label>
                            @error('name')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="tf-field style-1">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder=" " required class="tf-field-input tf-input">
                            <label class="tf-field-label fw-4 text_black-2" >Email *</label>
                            @error('email')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="tf-field style-1">
                            <input type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder=" " required class="tf-field-input tf-input">
                            <label class="tf-field-label fw-4 text_black-2" >Phone Number *</label>
                            @error('phone_number')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="tf-field style-1">
                            <input type="password" name="password" placeholder=" " required class="tf-field-input tf-input">
                            <label class="tf-field-label fw-4 text_black-2" >Password *</label>
                            @error('password')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="tf-field style-1">
                            
                            <input type="password" name="password_confirmation" placeholder=" " required class="tf-field-input tf-input">
                            <label class="tf-field-label fw-4 text_black-2" >Confirm Password  *</label>
                        </div>

                        <div class="bottom">
                            <button type="submit" class="tf-btn btn-fill w-100 justify-content-center">Register</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>