@extends('superadmin.navigation')
@section('content')
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('System Settings') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Settings') }}</a></li>
                        <li><a href="#">{{ get_phrase('Payment Settings') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="eSection-wrap">
            <div class="title">
                <h3>{{ get_phrase('Global Currency'); }}</h3>
            </div>
            <div class="eMain">
                <div class="row">
                    <div class="col-md-6 pb-3">
                        <div class="eForm-layouts">
                            <form method="POST" class="col-12 live-class-settings-form" action="{{ route('superadmin.settings.update_payment_settings') }}" id="live-class-settings-form">
                                @csrf <!-- {{ csrf_field() }} -->

                                <div class="fpb-7">
                                    <label for="global_currency" class="eForm-label">{{ get_phrase('Global Currency'); }}</label>
                                    <select class="form-select eForm-select eChoice-multiple-with-remove" id = "global_currency" name="global_currency" required>
                                        <option value="">{{ get_phrase('Select system currency'); }}</option>
                                        <?php
                                        foreach ($currencies as $currency):?>
                                        <option value="{{ $currency['code']; }}"
                                          {{ $global_currency == $currency['code'] ? 'selected':''; }}> {{ $currency['code']; }}
                                        </option>
                                      <?php endforeach; ?>
                                    </select>
                                </div>
                                

                                <div class="fpb-7">
                                    <label for="currency_position" class="eForm-label">{{ get_phrase('Currency Position'); }}</label>
                                    <select class="form-select eForm-select eChoice-multiple-with-remove"  id = "currency_position" name="currency_position" required>
                                        <option value="left" {{ $global_currency_position == 'left' ? 'selected':''; }} >{{ get_phrase('Left'); }}</option>
                                        <option value="right" {{ $global_currency_position == 'right' ? 'selected':''; }} >{{ get_phrase('Right'); }}</option>
                                        <option value="left-space" {{ $global_currency_position == 'left-space' ? 'selected':''; }} >{{ get_phrase('Left with a space'); }}</option>
                                        <option value="right-space" {{ $global_currency_position == 'right-space' ? 'selected':''; }} >{{ get_phrase('Right with a space'); }}</option>
                                      </select>
                                </div>

                                <input type="hidden" id="method" name="method" value="currency">


                                <div class="fpb-7 pt-2">
                                    <button type="submit" class="btn-form" onclick="">{{ get_phrase('Update Currency'); }}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection