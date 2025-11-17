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
                        <li><a href="#">{{ get_phrase('System Settings') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-7">
        <div class="eSection-wrap">
            <div class="eMain">
                <div class="row">
                    <div class="col-md-11 pb-3">
                        <div class="eForm-layouts">
                            <p class="column-title">{{ get_phrase('SYSTEM SETTINGS') }}</p>
                            <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('superadmin.settings.system_settings.update') }}">
                                @csrf 
                                <div class="fpb-7">
                                    <label for="system_name" class="eForm-label">{{ get_phrase('System Name') }}</label>
                                    
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('system_name') }}" id="system_name" name = "system_name" required>
                                    
                                </div>
                                <div class="fpb-7">
                                    <label for="system_title" class="eForm-label">{{ get_phrase('System Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('system_title') }}" id="system_title" name = "system_title" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="navbar_title" class="eForm-label">{{ get_phrase('Navbar Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('navbar_title') }}" id="navbar_title" name = "navbar_title" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="system_email" class="eForm-label">{{ get_phrase('System Email') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('system_email') }}" id="system_email" name = "system_email" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="phone" class="eForm-label">{{ get_phrase('Phone') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('phone') }}" id="phone" name = "phone" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="fax" class="eForm-label">{{ get_phrase('Fax') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('fax') }}" id="fax" name = "fax" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="language" class="eForm-label">{{ get_phrase('System Language') }}</label>
                                    <select class="form-select eForm-select eChoice-multiple-with-remove" id="language" name="language" required>
                                        <?php $languages = get_all_language(); ?>
                                        <?php foreach ($languages as $language): ?>
                                        <option value="{{ $language->name  }}" {{ get_settings('language') == $language->name ?  'selected':'' }}>{{ ucfirst($language->name) }}</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="fpb-7">
                                    <label for="address" class="eForm-label">{{ get_phrase('Address') }}</label>
                                    <textarea class="form-control eForm-control" id="address" name = "address" rows="5" required>{{ get_settings('address') }}</textarea>
                                </div>
                                <div class="fpb-7">
                                    <label for="preloader" class="eForm-label">Website Preloader</label>
                                    <select name="preloader" id="preloader" class="form-select eForm-select eChoice-multiple-with-remove"  required>
                                        <option value="0" {{ get_settings('preloader') == '0' ? 'selected':'' }} >Disabled</option>
                                        <option value="1" {{ get_settings('preloader') == '1' ? 'selected':'' }} >Enable</option>
                                    </select>
                                  </div>
                                <div class="fpb-7">
                                    <label for="name" class="eForm-label">{{ get_phrase('Timezone') }}</label>
                                    <select class="form-select eForm-select eChoice-multiple-with-remove" id="timezone" name="timezone" required>
                                        <?php $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL); ?>
                                        <?php foreach ($tzlist as $tz): ?>
                                        <option value="{{ $tz  }}" {{ get_settings('timezone') == $tz ?  'selected':'' }}>{{ $tz  }}</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
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
                                
                                 <div class="fpb-7 pt-2">
                                    <button type="submit" class="btn-form">{{ get_phrase('Submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="eSection-wrap">
            <div class="eMain">
                <div class="row">
                    <div class="col-md-12 pb-3">
                        <p class="column-title">{{get_phrase('PRODUCT UPDATE')}}</p>
                        <div class="eForm-file">
                            <form action="{{route('backend.product.update')}}" method="post" enctype="multipart/form-data">
                                @CSRF
                                <div class="mb-3">
                                    <label for="formFileSm" class="eForm-label">{{get_phrase('File')}}</label>
                                    <input class="form-control eForm-control-file" id="formFileSm" type="file" name="file">
                                </div>
                                <button type="submit" class="btn-form float-end">{{get_phrase('Update')}}</button>
                            </form>
                        </div>
                    </div>
                    <span class="eBadge ebg-info mb-1 p-2"><?php echo 'Maximum upload size'; ?>: <?php echo ini_get('upload_max_filesize'); ?></span>
                    <span class="eBadge ebg-info mb-1 p-2"><?php echo 'Post max size'; ?>: <?php echo ini_get('post_max_size'); ?></span>
                    <span class="eBadge ebg-danger mb-1 p-2"><?php echo '"post_max_size" '."Has to be bigger than".' "upload_max_filesize"'; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="eSection-wrap">
        <div class="eMain">
            <div class="row">
                <div class="col-md-12 pb-3">
                    <p class="column-title">{{ get_phrase('SYSTEM LOGO') }}</p>
                    <div class="eForm-file">
                        <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('superadmin.settings.system_settings.update') }}">
                            @csrf 
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <label class="col-form-label" for="example-fileinput">{{ get_phrase('Dark logo') }}</label>
                                    <div class="eCard d-block text-center bg-light">
                                        <img src="{{ asset('public/assets/upload/logo/'.get_settings('dark_logo')) }}" class="mx-4 my-5" width="200px"
                                            alt="...">
                                        <div class="eCard-body">
                                            <input class="form-control eForm-control-file" id="formFileSm" type="file" name="dark_logo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <label class="col-form-label" for="example-fileinput">{{ get_phrase('Light logo') }}</label>
                                    <div class="eCard d-block text-center bg-secondary">
                                        <img src="{{ asset('public/assets/upload/logo/'.get_settings('light_logo')) }}" class="mx-4 my-5" width="200px"
                                            alt="...">
                                        <div class="eCard-body">
                                        <input class="form-control eForm-control-file" id="formFileSm" type="file" name="light_logo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <label class="col-form-label" for="example-fileinput">{{ get_phrase('Fotter Logo') }}</label>
                                    <div class="eCard d-block text-center bg-light">
                                        <img src="{{ asset('public/assets/upload/logo/'.get_settings('fotter_logo')) }}" class="mx-4 my-5" width="53px" height="60px"
                                            alt="...">
                                        <div class="eCard-body">
                                        <input class="form-control eForm-control-file" id="formFileSm" type="file" name="fotter_logo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <label class="col-form-label" for="example-fileinput">{{ get_phrase('Favicon') }}</label>
                                    <div class="eCard d-block text-center bg-light">
                                        <img src="{{ asset('public/assets/upload/logo/'.get_settings('favicon')) }}" class="mx-4 my-5" width="53px" height="60px"
                                            alt="...">
                                        <div class="eCard-body">
                                        <input class="form-control eForm-control-file" id="formFileSm" type="file" name="favicon">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn-form">{{ get_phrase('Update Logo') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    $('#email_details').bind('input propertychange', function() {
              var currentLength = $('#email_details').val().length;
              var remaining_character = 200 - currentLength;
              $('#remaining_character').text(remaining_character);
              copyTheMessageToForm();
            });  
    $('#warning_text').bind('input propertychange', function() {
              var currentLength = $('#warning_text').val().length;
              var remaining_character = 150 - currentLength;
              $('#remaining_character_warning').text(remaining_character);
              copyTheMessageToForm();
            });  

</script>

@endsection