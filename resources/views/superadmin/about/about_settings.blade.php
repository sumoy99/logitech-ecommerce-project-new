@extends('superadmin.navigation')
@section('content') 
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('About Settings') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('About Us') }}</a></li>
                        <li><a href="#">{{ get_phrase('About Settings') }}</a></li>
                    </ul>
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
                    <div class="col-md-6 pb-3">
                        <div class="eForm-layouts">
                            <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('superadmin.about.about_update') }}">
                                @csrf 
                                <div class="fpb-7">
                                    <label for="banner_video_url" class="eForm-label">{{ get_phrase('Banner Video URL') }} <small>(Youtube video URL)</small> </label>
                                    <input type="text" class="form-control eForm-control" value="{{ about_settings('banner_video_url') }}" id="banner_video_url" name = "banner_video_url">
                                </div>

                                <div class="fpb-7">
                                    <label for="banner_video_thumbnail" class="eForm-label">{{ get_phrase('Banner Video Thumbnail') }}</label>
                                    <input type="file" class="form-control eForm-control" value="{{ about_settings('banner_video_thumbnail') }}" id="banner_video_thumbnail" name = "banner_video_thumbnail"  accept="image/*">
                                </div>


                                <p class="column-title" style="margin-top: 11px;">{{ get_phrase('About Us')}}</p>

                                <div class="fpb-7">
                                    <label for="aboout_us_title" class="eForm-label">{{ get_phrase('Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ about_settings('aboout_us_title') }}" id="aboout_us_title" name = "aboout_us_title">
                                </div>
                                <div class="fpb-7">
                                    <label for="aboout_us_subtitle" class="eForm-label">{{ get_phrase('Sub Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ about_settings('aboout_us_subtitle') }}" id="aboout_us_subtitle" name = "aboout_us_subtitle">
                                </div>
                                <div class="fpb-7">
                                    <label for="aboout_us_des" class="eForm-label">{{ get_phrase('Short Description') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ about_settings('aboout_us_des') }}" id="aboout_us_des" name = "aboout_us_des">
                                </div>
                                <div class="fpb-7">
                                    <label for="about_us_img" class="eForm-label">{{ get_phrase('About Us Image') }}</label>
                                    <input type="file" class="form-control eForm-control" value="{{ about_settings('about_us_img') }}" id="about_us_img" name = "about_us_img" accept="image/*">
                                </div>

                                <div class="fpb-7">
                                    <label for="about_us_list" class="eForm-label">{{ get_phrase('About Us List') }}</label>
                                    <div class="new_div">
                                        <div class="row">
                                            @php
                                                $about_us_lists = json_decode( about_settings('about_us_list') );
                                            @endphp
                                            <div class="col-sm-9" id="inputContainer">
                                                @if(empty(about_settings('about_us_list')))
                                                    <input type="text" name="about_us_list[]" class="eForm-control form-control mb-2" placeholder="{{get_phrase('About Us List')}}">
                                                @else
                                                @foreach ($about_us_lists as $about_us_list)
                                                    <input type="text" name="about_us_list[]" class="eForm-control form-control mb-2" value="{{$about_us_list}}" placeholder="{{get_phrase('About Us List')}}">
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

                                <p class="column-title" style="margin-top: 11px;">{{ get_phrase('How We Are')}}</p>

                                <div class="fpb-7">
                                    <label for="how_we_are_title" class="eForm-label">{{ get_phrase('Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ about_settings('how_we_are_title') }}" id="how_we_are_title" name = "how_we_are_title">
                                </div>
                                <div class="fpb-7">
                                    <label for="how_we_are_subtitle" class="eForm-label">{{ get_phrase('Sub Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ about_settings('how_we_are_subtitle') }}" id="how_we_are_subtitle" name = "how_we_are_subtitle">
                                </div>
                                <div class="fpb-7">
                                    <label for="how_we_are_des" class="eForm-label">{{ get_phrase('Short Description') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ about_settings('how_we_are_des') }}" id="how_we_are_des" name = "how_we_are_des">
                                </div>
                                <div class="fpb-7">
                                    <label for="how_we_are_img" class="eForm-label">{{ get_phrase('Image') }}</label>
                                    <input type="file" class="form-control eForm-control" value="{{ about_settings('how_we_are_img') }}" id="how_we_are_img" name = "how_we_are_img" accept="image/*">
                                </div>

                                <p class="column-title" style="margin-top: 11px;">{{ get_phrase('Testimonials')}}</p>
                                <div class="fpb-7">
                                    <label for="testimonials_title" class="eForm-label">{{ get_phrase('Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ about_settings('testimonials_title') }}" id="testimonials_title" name = "testimonials_title">
                                </div>
                                <div class="fpb-7">
                                    <label for="testimonials_subtitle" class="eForm-label">{{ get_phrase('Sub Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ about_settings('testimonials_subtitle') }}" id="testimonials_subtitle" name = "testimonials_subtitle">
                                </div>

                                <p class="column-title" style="margin-top: 11px;">{{ get_phrase('Partners')}}</p>
                                <div class="fpb-7">
                                    <label for="partners_title" class="eForm-label">{{ get_phrase('Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ about_settings('partners_title') }}" id="partners_title" name = "partners_title">
                                </div>
                                <div class="fpb-7">
                                    <label for="partaner_subtitle" class="eForm-label">{{ get_phrase('Sub Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ about_settings('partaner_subtitle') }}" id="partaner_subtitle" name = "partaner_subtitle">
                                </div>
                                <div class="fpb-7 pt-2">
                                    <button type="submit" class="btn-form">{{ get_phrase('Save') }}</button>
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
      newInput.setAttribute('placeholder', '{{get_phrase('About List')}}');
      newInput.setAttribute('class', 'eForm-control mt-2');
      newInput.setAttribute('name', 'about_us_list[]');
      container.appendChild(newInput);
    }

    function removeInput() {
      var container = document.getElementById('inputContainer');
      var inputs = container.getElementsByTagName('input');
      if (inputs.length > 1) {
        container.removeChild(inputs[inputs.length - 1]);
      }
    }
</script>
@endsection 