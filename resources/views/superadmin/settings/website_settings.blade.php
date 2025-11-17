@extends('superadmin.navigation')
   
@section('content')
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Website Settings') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Settings') }}</a></li>
                        <li><a href="#">{{ get_phrase('Website Settings') }}</a></li>
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
                            <p class="column-title">{{ get_phrase('HOME SETTINGS') }}</p>
                            <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('superadmin.settings.system_settings.update') }}">
                                @csrf 
                                <div class="fpb-7">
                                    <label for="banner_title" class="eForm-label">{{ get_phrase('Banner Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('banner_title') }}" id="banner_title" name = "banner_title" >
                                </div>
                                <div class="fpb-7">
                                    <label for="banner_subtitle" class="eForm-label">{{ get_phrase('Banner Sub Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('banner_subtitle') }}" id="banner_subtitle" name = "banner_subtitle" >
                                </div>
                                <div class="fpb-7">
                                    <label for="lets_work" class="eForm-label">{{ get_phrase('Lets Work Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('lets_work') }}" id="lets_work" name = "lets_work" >
                                </div>
                                <div class="fpb-7">
                                    <label for="contact_title" class="eForm-label">{{ get_phrase('Contact Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('contact_title') }}" id="contact_title" name = "contact_title" >
                                </div>
                                <div class="fpb-7">
                                    <label for="contact_subtitle" class="eForm-label">{{ get_phrase('Contact Subtitle') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('contact_subtitle') }}" id="contact_subtitle" name = "contact_subtitle" >
                                </div>
                                <div class="fpb-7">
                                    <label for="features" class="eForm-label">{{ get_phrase('Contact Email') }}</label>
                                    <div class="new_div">
                                        <div class="row">
                                            @php
                                                $contact_emails = json_decode( get_settings('contact_email') );
                                            @endphp
                                            <div class="col-sm-9" id="inputContainer">
                                                @if(empty(get_settings('contact_email')))
                                                    <input type="email" name="contact_email[]" class="eForm-control form-control mb-2" placeholder="{{get_phrase('Contact Email')}}">
                                                @else
                                                @foreach ($contact_emails as $contact_email)
                                                    <input type="email" name="contact_email[]" class="eForm-control form-control mb-2" value="{{$contact_email}}" placeholder="{{get_phrase('Contact Email')}}">
                                                @endforeach
                                                @endif
                                                
                                            </div>
                                            <div class="col-sm-3 p-0">
                                                <button type="button" onclick="appendInput()" class="btn btn-icon feature_btn btn-success"><i class="bi bi-plus"></i></button>
                                                <button type="button"  onclick="removeInput()" class="btn btn-icon feature_btn btn-danger"> <i class="bi bi-dash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fpb-7">
                                    <label for="Number" class="eForm-label">{{ get_phrase('Contact Number') }}</label>
                                    <div class="new_div">
                                        <div class="row">
                                            @php
                                                $contact_numbers = json_decode( get_settings('contact_number') );  
                                            @endphp
                                            <div class="col-sm-9" id="inputContainerTwo">
                                                @if(empty(get_settings('contact_number')))
                                                <input type="number" name="contact_number[]" class="eForm-control form-control mb-2" placeholder="{{get_phrase('Contact Number')}}">
                                                @else
                                                @foreach ($contact_numbers as $contact_number)
                                                <input type="number" name="contact_number[]" class="eForm-control form-control mb-2" value="{{$contact_number}}" placeholder="{{get_phrase('Contact Number')}}">
                                                @endforeach
                                                @endif
                                               
                                            </div>
                                            <div class="col-sm-3 p-0">
                                                <button type="button" onclick="appendInputTwo()" class="btn btn-icon feature_btn btn-success"><i class="bi bi-plus"></i></button>
                                                <button type="button"  onclick="removeInputTwo()" class="btn btn-icon feature_btn btn-danger"> <i class="bi bi-dash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fpb-7">
                                    <label for="location" class="eForm-label">{{ get_phrase('Location') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('location') }}" id="location" name = "location" >
                                </div>
                                <div class="fpb-7">
                                    <label for="location_url" class="eForm-label">{{ get_phrase('Location URL') }} <span style="font-size: 10px; color:rgba(4, 16, 26, 0.386);">({{ get_phrase('Google map URL') }})</span></label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('location_url') }}" id="location_url" name = "location_url" >
                                </div>

                                <div class="fpb-7">
                                    <label for="working_start_day" class="eForm-label">{{get_phrase('Work Start Day')}}</label>
                                    <select name="working_start_day" id="preloader" class="form-select eForm-select eChoice-multiple-with-remove"  >
                                        <option value="Saturday" {{ get_settings('working_start_day') == 'Saturday' ? 'selected':'' }} >{{ get_phrase('Saturday') }}</option>
                                        <option value="Sunday" {{ get_settings('working_start_day') == 'Sunday' ? 'selected':'' }} >{{ get_phrase('Sunday') }}</option>
                                        <option value="Monday" {{ get_settings('working_start_day') == 'Monday' ? 'selected':'' }} >{{ get_phrase('Monday') }}</option>
                                        <option value="Tuesday" {{ get_settings('working_start_day') == 'Tuesday' ? 'selected':'' }} >{{ get_phrase('Tuesday') }}</option>
                                        <option value="Wednesday" {{ get_settings('working_start_day') == 'Wednesday' ? 'selected':'' }} >{{ get_phrase('Wednesday') }}</option>
                                        <option value="Thursday" {{ get_settings('working_start_day') == 'Thursday' ? 'selected':'' }} >{{ get_phrase('Thursday') }}</option>
                                        <option value="Friday" {{ get_settings('working_start_day') == 'Friday' ? 'selected':'' }} >{{ get_phrase('Friday') }}</option>
                                    </select>
                                </div>
                                <div class="fpb-7">
                                    <label for="working_end_day" class="eForm-label">{{get_phrase('Work End Day')}}</label>
                                    <select name="working_end_day" id="preloader" class="form-select eForm-select eChoice-multiple-with-remove" >
                                        <option value="Saturday" {{ get_settings('working_end_day') == 'Saturday' ? 'selected':'' }} >{{ get_phrase('Saturday') }}</option>
                                        <option value="Sunday" {{ get_settings('working_end_day') == 'Sunday' ? 'selected':'' }} >{{ get_phrase('Sunday') }}</option>
                                        <option value="Monday" {{ get_settings('working_end_day') == 'Monday' ? 'selected':'' }} >{{ get_phrase('Monday') }}</option>
                                        <option value="Tuesday" {{ get_settings('working_end_day') == 'Tuesday' ? 'selected':'' }} >{{ get_phrase('Tuesday') }}</option>
                                        <option value="Wednesday" {{ get_settings('working_start_day') == 'Wednesday' ? 'selected':'' }} >{{ get_phrase('Wednesday') }}</option>
                                        <option value="Thursday" {{ get_settings('working_end_day') == 'Thursday' ? 'selected':'' }} >{{ get_phrase('Thursday') }}</option>
                                        <option value="Friday" {{ get_settings('working_end_day') == 'Friday' ? 'selected':'' }} >{{ get_phrase('Friday') }}</option>
                                    </select>
                                </div>
                                <div class="fpb-7">
                                    <label for="working_start_time" class="eForm-label">{{ get_phrase('Working Start Time') }}</label>
                                    <input type="time" class="form-control eForm-control" value="{{ get_settings('working_start_time') }}" id="working_start_time" name = "working_start_time" >
                                </div>
                                <div class="fpb-7">
                                    <label for="working_end_time" class="eForm-label">{{ get_phrase('Working End Time') }}</label>
                                    <input type="time" class="form-control eForm-control" value="{{ get_settings('working_end_time') }}" id="working_end_time" name = "working_end_time" >
                                </div>

                                @php
                                    $socials = json_decode(get_settings('social_media_icon'), true);
                                @endphp
                                @if(!empty($socials))
                                @foreach ($socials as $key => $social)
                                    <div class="fpb-7">
                                        <div id="social_media_icon_url">
                                            <div class="d-flex mt-2">
                                                <div class="flex-grow-1 mb-3">
                                                    <div class="form-group">
                                                        <label class="eForm-label">{{ get_phrase('Social Media Icon') }}</label>
                                                        <input type="text" class="eForm-control form-control mb-2 icon-picker" name="social_media_icon[]" value="{{ $social['social_media_icon'] }}" placeholder="Social Media Icon" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="eForm-label">{{ get_phrase('Social Media Name') }}</label>
                                                        <input type="text" value="{{ $social['social_media_name'] }}" name="social_media_name[]" class="eForm-control form-control mb-2" placeholder="{{ get_phrase('Social Media Name') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="eForm-label">{{ get_phrase('Social Media Url') }}</label>
                                                        <input type="text" name="social_media_url[]" class="eForm-control form-control mb-2" value="{{ $social['social_media_url'] }}" placeholder="{{ get_phrase('Social Media Url') }}">
                                                    </div>
                                                    
                                                </div>
                                                @if( $key == 0)
                                                <div class="" style="padding-top: 35px; padding-left: 13px;">
                                                    <button type="button" class="btn btn-success btn-sm" name="button" onclick="appendFats()"> <i class="fa fa-plus"></i></button>
                                                </div>
                                                @else
                                                <div class="" style="padding-top: 35px; padding-left: 13px;">
                                                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0; margin-left: 5px;" name="button" onclick="removeFats(this)"> <i class="fa fa-minus"></i></button>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                <div class="fpb-7">
                                    <div id="social_media_icon_url">
                                        <div class="d-flex mt-2">
                                            <div class="flex-grow-1 mb-3">
                                                <div class="form-group">
                                                    <label class="eForm-label">{{ get_phrase('Social Media Icon') }}</label>
                                                    <input type="text" class="eForm-control form-control mb-2 icon-picker" name="social_media_icon[]" placeholder="Social Media Icon" >
                                                </div>
                                                <div class="form-group">
                                                    <label class="eForm-label">{{ get_phrase('Social Media Name') }}</label>
                                                    <input type="text" name="social_media_name[]" class="eForm-control form-control mb-2" placeholder="{{ get_phrase('Social Media Name') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="eForm-label">{{ get_phrase('Social Media Url') }}</label>
                                                    <input type="text" name="social_media_url[]" class="eForm-control form-control mb-2" placeholder="{{ get_phrase('Social Media Url') }}">
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="" style="padding-top: 35px; padding-left: 13px;">
                                                <button type="button" class="btn btn-success btn-sm" name="button" onclick="appendFats()"> <i class="fa fa-plus"></i></button>
                                            </div>
                                            
                                            <div class="" style="padding-top: 35px; padding-left: 13px;">
                                                <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0; margin-left: 5px;" name="button" onclick="removeFats(this)"> <i class="fa fa-minus"></i></button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="fpb-7">
                                    <div id="blank_social_field">
                                        <div class="d-flex mt-2 added-skill">
                                            <div class="flex-grow-1 mb-3">
                                                <div class="form-group">
                                                    <label class="eForm-label">{{ get_phrase('Social Media Icon') }}</label>
                                                    <input type="text" class="eForm-control form-control mb-2 icon-picker" name="social_media_icon[]" placeholder="Social Media Icon" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="eForm-label">{{ get_phrase('Social Media Name') }}</label>
                                                    <input type="text" name="social_media_name[]" class="eForm-control form-control mb-2" placeholder="{{ get_phrase('Social Media Name') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="eForm-label">{{ get_phrase('Social Media Url') }}</label>
                                                    <input type="text" name="social_media_url[]" class="eForm-control form-control mb-2" placeholder="{{ get_phrase('Social Media Url') }}">
                                                </div>
                                            </div>
                                            <div class="" style="padding-top: 35px; padding-left: 13px;">
                                                <button type="button" class="btn btn-success btn-sm" name="button" onclick="appendFats()"> <i class="fa fa-plus"></i></button>
                                            </div>
                                            <div class="" style="padding-top: 35px; padding-left: 13px;">
                                                <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0; margin-left: 5px;" name="button" onclick="removeFats(this)"> <i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fpb-7">
                                    <label for="fotter_top_title" class="eForm-label">{{ get_phrase('Fotter Top Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('fotter_top_title') }}" id="fotter_top_title" name = "fotter_top_title" >
                                </div>
                                <div class="fpb-7">
                                    <label for="fotter_title" class="eForm-label">{{ get_phrase('Fotter Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('fotter_title') }}" id="fotter_title" name = "fotter_title" >
                                </div>
                                <div class="fpb-7">
                                    <label for="fotter_sub_title" class="eForm-label">{{ get_phrase('Fotter Sub Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('fotter_sub_title') }}" id="fotter_sub_title" name = "fotter_sub_title" >
                                </div>
                                <div class="fpb-7">
                                    <label for="copyright_text" class="eForm-label">{{ get_phrase('Copyright Text') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('copyright_text') }}" id="copyright_text" name = "copyright_text" >
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
</div>
<div class="row">
    <div class="col-12">
        <div class="eSection-wrap">
            <div class="eMain">
                <div class="row">
                    <div class="col-md-11 pb-3">
                        <div class="eForm-layouts">
                            <p class="column-title">{{ get_phrase('HOME SETTINGS') }}</p>
                            <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('superadmin.settings.system_settings.update') }}">
                                @csrf 
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <label class="col-form-label" for="example-fileinput">{{ get_phrase('Banner Image') }}</label>
                                        <div class="eCard d-block text-center bg-light">
                                            <img src="{{ asset('public/assets/upload/home_image/'.get_settings('banner_img')) }}" class=" my-5" width="200px"
                                                alt="...">
                                            <div class="eCard-body">
                                            <input class="form-control eForm-control-file" id="formFileSm" type="file" name="banner_img">
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-md-3 text-center">
                                        <label class="col-form-label" for="example-fileinput">{{ get_phrase('Lets Work Image') }} <span style="font-size: 10px;">(643 x 303)</span></label>
                                        <div class="eCard d-block text-center bg-light">
                                            <img src="{{ asset('public/assets/upload/home_image/'.get_settings('lets_work_img')) }}" class=" my-5" width="200px"
                                                alt="...">
                                            <div class="eCard-body">
                                            <input class="form-control eForm-control-file" id="formFileSm" type="file" name="lets_work_img">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <label class="col-form-label" for="example-fileinput">{{ get_phrase('Testimonial Image') }}</label>
                                        <div class="eCard d-block text-center bg-light">
                                            <img src="{{ asset('public/assets/upload/home_image/'.get_settings('testimonial_img')) }}" class=" my-5" width="200px"
                                                alt="...">
                                            <div class="eCard-body">
                                            <input class="form-control eForm-control-file" id="formFileSm" type="file" name="testimonial_img">
                                            </div>
                                        </div>
                                    </div>
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
</div>

<script>
    function appendInput() {
      var container = document.getElementById('inputContainer');
      var newInput = document.createElement('input');
      newInput.setAttribute('type', 'text');
      newInput.setAttribute('placeholder', '{{get_phrase('Contact Email')}}');
      newInput.setAttribute('class', 'eForm-control mt-2');
      newInput.setAttribute('name', 'contact_email[]');
      container.appendChild(newInput);
    }

    function removeInput() {
      var container = document.getElementById('inputContainer');
      var inputs = container.getElementsByTagName('input');
      if (inputs.length > 1) {
        container.removeChild(inputs[inputs.length - 1]);
      }
    }

    function appendInputTwo() {
      var container = document.getElementById('inputContainerTwo');
      var newInput = document.createElement('input');
      newInput.setAttribute('type', 'text');
      newInput.setAttribute('placeholder', '{{get_phrase('Contact Number')}}');
      newInput.setAttribute('class', 'eForm-control mt-2');
      newInput.setAttribute('name', 'contact_number[]');
      container.appendChild(newInput);
    }

    function removeInputTwo() {
      var container = document.getElementById('inputContainerTwo');
      var inputs = container.getElementsByTagName('input');
      if (inputs.length > 1) {
        container.removeChild(inputs[inputs.length - 1]);
      }
    }

    var blank_faq = jQuery('#blank_social_field').html();
    $(document).ready(function () {
        jQuery('#blank_social_field').hide();    
    });
   
    function appendFats() {
      jQuery('#social_media_icon_url').append(blank_faq);
      if ($('.icon-picker').length) {
                $('.icon-picker').iconpicker();
            }
    }
    function removeFats(faqElem) {
      jQuery(faqElem).parent().parent().remove();
    }
    
     // Icon Picker
     $(function() {
            if ($('.icon-picker').length) {
                $('.icon-picker').iconpicker();
            }
        });
        // Endicon Picker
</script>
@endsection