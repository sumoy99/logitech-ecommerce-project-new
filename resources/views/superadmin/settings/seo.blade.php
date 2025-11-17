@extends('superadmin.navigation')
@section('content')
<style>
  .eNav-Tabs-vertical button.nav-link {
  margin-bottom: 12px;
  border-bottom: 1.5px solid #18191a14;
}
</style>
<div class="col-12 eSection-wrap pb-3">
  <p class="column-title">{{get_phrase('Frontend Page')}}</p>
  <div class="d-flex flex-column flex-md-row align-items-start vTabs-gap">
    <div class="nav flex-row flex-md-column nav-pills eNav-Tabs-vertical" style="flex-basis: 138px;" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <button class="nav-link active" id="v-pills-vHome-tab" data-bs-toggle="pill" data-bs-target="#v-pills-vHome" type="button" role="tab" aria-controls="v-pills-vHome" aria-selected="false">
        {{get_phrase('Home')}}
      </button>
      <button class="nav-link" id="v-pills-vProfile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-vProfile" type="button" role="tab" aria-controls="v-pills-vProfile" aria-selected="false">
        {{get_phrase('Our Service')}}
      </button>
      <button class="nav-link" id="v-pills-vMessages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-vMessages" type="button" role="tab" aria-controls="v-pills-vMessages" aria-selected="false">
        {{get_phrase('Service Details')}}
      </button>
      <button class="nav-link" id="v-pills-vSettings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-vSettings" type="button" role="tab" aria-controls="v-pills-vSettings" aria-selected="true">
        {{get_phrase('Portfolio')}}
      </button>
      <button class="nav-link" id="v-pills-About-tab" data-bs-toggle="pill" data-bs-target="#v-pills-about" type="button" role="tab" aria-controls="v-pills-about" aria-selected="true">
        {{get_phrase('About')}}
      </button>
      <button class="nav-link" id="v-pills-team-tab" data-bs-toggle="pill" data-bs-target="#v-pills-team" type="button" role="tab" aria-controls="v-pills-team" aria-selected="true">
        {{get_phrase('Team')}}
      </button>
      <button class="nav-link" id="v-pills-blogs-tab" data-bs-toggle="pill" data-bs-target="#v-pills-blogs" type="button" role="tab" aria-controls="v-pills-blogs" aria-selected="true">
        {{get_phrase('Blogs')}}
      </button>
      <button class="nav-link" id="v-pills-contact-tab" data-bs-toggle="pill" data-bs-target="#v-pills-contact" type="button" role="tab" aria-controls="v-pills-contact" aria-selected="true">
        {{get_phrase('Contact')}}
      </button>
    </div>
    <div class="tab-content eNav-Tabs-content" id="v-pills-tabContent">
      <div class="tab-pane fade active show" id="v-pills-vHome" role="tabpanel" aria-labelledby="v-pills-vHome-tab">
        <div class="row">
          <div class="col-12">
            <div class="eSection-wrap">
                <div class="eMain">
                  <div class="pb-3">
                    <div class="eForm-layouts">
                      <p class="column-title">{{get_phrase('HOME SEO SETTINGS')}}</p>
                        <form method="POST" enctype="multipart/form-data"  class="d-block ajaxForm" action="{{route('superadmin.settings.system_settings.update')}}">
                            @csrf
                            <div class="fpb-7">
                              <label for="author" class="eForm-label">{{get_phrase('Author')}}</label>
                              <input type="text" class="form-control eForm-control" value="{{ get_settings('author') }}" id="author" name = "author" >    
                            </div>

                            <div class="fpb-7">
                              <label for="publisher" class="eForm-label">{{get_phrase('Publisher')}}</label>
                              <input type="text" class="form-control eForm-control" value="{{ get_settings('publisher') }}" id="publisher" name = "publisher" >    
                            </div>

                            <div class="fpb-7">
                              <label for="og_title" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Title')}} ({{get_phrase('Page Title')}})</label>
                              <input type="text" class="form-control eForm-control" value="{{ get_settings('og_title') }}" id="og_title" name = "og_title" >    
                            </div> 

                            <div class="fpb-7">
                              <label for="og_url" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('URL')}}</label>
                              <input type="text" class="form-control eForm-control" value="{{ get_settings('og_url') }}" id="og_url" name = "og_url" >    
                            </div> 

                            <div class="fpb-7">
                              <label for="og_description" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Description')}}</label>
                              <textarea class="form-control eForm-control" id="og_description" name = "og_description" >{{ get_settings('og_description') }}</textarea>   
                            </div> 

                            <div class="fpb-7">
                                <label for="meta_description" class="eForm-label">{{get_phrase('Meta Description')}}</label>
                                <textarea type="text" class="form-control eForm-control"  id="meta_description" name = "meta_description" >{{ get_settings('meta_description') }} </textarea>  
                            </div> 
                            
                            <div class="fpb-7">
                                <label for="keywords" class="eForm-label">{{get_phrase('Keywords')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('keywords') }}" id="keywords" name = "keywords" >    
                            </div> 
                            <div class="fpb-7">
                                <label for="robots" class="eForm-label">{{get_phrase('Robots')}}</label>
                                <input type="robots" class="form-control eForm-control" value="{{ get_settings('robots') }}" id="robots" name = "robots" >    
                            </div>  
                            <div class="fpb-7">
                                <label for="canonical" class="eForm-label">{{get_phrase('Canonical')}} ({{get_phrase('URL')}})</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('canonical') }}" id="canonical" name = "canonical" >    
                            </div>   
                            
                            <div class="fpb-7">
                                <label for="twitter_card" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Card')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('twitter_card') }}" id="twitter_card" name = "twitter_card" >    
                            </div> 
                            <div class="fpb-7">
                                <label for="twitter_title" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Title')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('twitter_title') }}" id="twitter_title" name = "twitter_title" >    
                            </div> 
                            <div class="fpb-7">
                                <label for="twitter_description" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Description')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('twitter_description') }}" id="twitter_description" name = "twitter_description" >    
                            </div> 
                            <div class="fpb-7">
                              <div class="fav" style="margin-top: 5px;
                              margin-bottom: 10px;">
                                <label for="og_image" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Image')}}</label> 
                                <img src="{{asset('public/assets/upload/logo/'. get_settings('og_image'))}}" alt="" width="100" height="100">     
                              </div>
                                                 
                              <input type="file" class="form-control eForm-control" value="{{ get_settings('og_image') }}" id="og_image" name = "og_image" >    
                            </div> 
                            <div class="fpb-7">
                              <div class="fav" style="margin-top: 5px;
                              margin-bottom: 10px;">
                                <label for="twitter_image" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Image')}}</label> 
                                <img src="{{asset('public/assets/upload/logo/'. get_settings('twitter_image'))}}" alt="" width="100" height="100">     
                              </div>
                                                 
                              <input type="file" class="form-control eForm-control" value="{{ get_settings('twitter_image') }}" id="twitter_image" name = "twitter_image" >    
                            </div> 

                             <div class="fpb-7 pt-2">
                                <button type="submit" class="btn-form">{{get_phrase('Update')}}</button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade " id="v-pills-vProfile" role="tabpanel" aria-labelledby="v-pills-vProfile-tab">
        <div class="row">
          <div class="col-12">
            <div class="eSection-wrap">
                <div class="eMain">
                  <div class="pb-3">
                    <div class="eForm-layouts">
                      <p class="column-title">{{get_phrase('OUR SERVICE SEO SETTINGS')}}</p>
                        <form method="POST" enctype="multipart/form-data"  class="d-block ajaxForm" action="{{route('superadmin.settings.system_settings.update')}}">
                            @csrf
                            <div class="fpb-7">
                              <label for="og_title" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Title')}} ({{get_phrase('Page Title')}})</label>
                              <input type="text" class="form-control eForm-control" value="{{ get_settings('our_service_og_title') }}" id="og_title" name = "our_service_og_title" >    
                            </div> 

                            <div class="fpb-7">
                              <label for="og_url" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('URL')}}</label>
                              <input type="text" class="form-control eForm-control" value="{{ get_settings('our_service_og_url') }}" id="og_url" name = "our_service_og_url" >    
                            </div> 

                            <div class="fpb-7">
                              <label for="og_description" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Description')}}</label>
                              <textarea class="form-control eForm-control" id="og_description" name = "our_service_og_description" >{{ get_settings('our_service_og_description') }}</textarea>   
                            </div> 

                            <div class="fpb-7">
                                <label for="meta_description" class="eForm-label">{{get_phrase('Meta Description')}}</label>
                                <textarea type="text" class="form-control eForm-control"  id="meta_description" name = "our_service_meta_description" >{{ get_settings('our_service_meta_description') }} </textarea>  
                            </div> 
                            
                            <div class="fpb-7">
                                <label for="keywords" class="eForm-label">{{get_phrase('Keywords')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('our_service_keywords') }}" id="keywords" name = "our_service_keywords" >    
                            </div> 
                            <div class="fpb-7">
                                <label for="robots" class="eForm-label">{{get_phrase('Robots')}}</label>
                                <input type="robots" class="form-control eForm-control" value="{{ get_settings('our_service_robots') }}" id="robots" name = "our_service_robots" >    
                            </div>  
                            <div class="fpb-7">
                                <label for="canonical" class="eForm-label">{{get_phrase('Canonical')}} ({{get_phrase('URL')}})</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('our_service_canonical') }}" id="canonical" name = "our_service_canonical" >    
                            </div>   
                            
                            <div class="fpb-7">
                                <label for="twitter_card" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Card')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('our_service_twitter_card') }}" id="our_service_twitter_card" name = "our_service_twitter_card" >    
                            </div> 
                            <div class="fpb-7">
                                <label for="twitter_title" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Title')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('our_service_twitter_title') }}" id="twitter_title" name = "our_service_twitter_title" >    
                            </div> 
                            <div class="fpb-7">
                                <label for="twitter_description" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Description')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('our_service_twitter_description') }}" id="twitter_description" name = "our_service_twitter_description" >    
                            </div> 
                            <div class="fpb-7">
                              <div class="fav" style="margin-top: 5px;
                              margin-bottom: 10px;">
                                <label for="og_image" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Image')}}</label> 
                                <img src="{{asset('public/assets/upload/logo/'. get_settings('our_service_og_image'))}}" alt="" width="100" height="100">     
                              </div>
                                                 
                              <input type="file" class="form-control eForm-control" value="{{ get_settings('our_service_og_image') }}" id="og_image" name = "our_service_og_image" >    
                            </div> 
                            <div class="fpb-7">
                              <div class="fav" style="margin-top: 5px;
                              margin-bottom: 10px;">
                                <label for="twitter_image" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Image')}}</label> 
                                <img src="{{asset('public/assets/upload/logo/'. get_settings('our_service_twitter_image'))}}" alt="" width="100" height="100">     
                              </div>
                                                 
                              <input type="file" class="form-control eForm-control" value="{{ get_settings('our_service_twitter_image') }}" id="twitter_image" name = "our_service_twitter_image" >    
                            </div> 
                             <div class="fpb-7 pt-2">
                                <button type="submit" class="btn-form">{{get_phrase('Update')}}</button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-vMessages" role="tabpanel" aria-labelledby="v-pills-vMessages-tab">
        <div class="row">
          <div class="col-12">
            <div class="eSection-wrap">
                <div class="eMain">
                  <div class="pb-3">
                    <div class="eForm-layouts">
                      <p class="column-title">{{get_phrase('SERVICE DETAILS SEO SETTINGS')}}</p>
                        <form method="POST" enctype="multipart/form-data"  class="d-block ajaxForm" action="{{route('superadmin.settings.system_settings.update')}}">
                            @csrf
                            <div class="fpb-7">
                              <label for="og_title" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Title')}} ({{get_phrase('Page Title')}})</label>
                              <input type="text" class="form-control eForm-control" value="{{ get_settings('service_details_og_title') }}" id="og_title" name = "service_details_og_title" >    
                            </div> 

                            <div class="fpb-7">
                              <label for="og_url" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('URL')}}</label>
                              <input type="text" class="form-control eForm-control" value="{{ get_settings('service_details_og_url') }}" id="og_url" name = "service_details_og_url" >    
                            </div> 

                            <div class="fpb-7">
                              <label for="og_description" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Description')}}</label>
                              <textarea class="form-control eForm-control" id="og_description" name = "service_details_og_description" >{{ get_settings('service_details_og_description') }}</textarea>   
                            </div> 

                            <div class="fpb-7">
                                <label for="meta_description" class="eForm-label">{{get_phrase('Meta Description')}}</label>
                                <textarea type="text" class="form-control eForm-control"  id="meta_description" name = "service_details_meta_description" >{{ get_settings('service_details_meta_description') }} </textarea>  
                            </div> 
                            
                            <div class="fpb-7">
                                <label for="keywords" class="eForm-label">{{get_phrase('Keywords')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('service_details_keywords') }}" id="keywords" name = "service_details_keywords" >    
                            </div> 
                            <div class="fpb-7">
                                <label for="robots" class="eForm-label">{{get_phrase('Robots')}}</label>
                                <input type="robots" class="form-control eForm-control" value="{{ get_settings('service_details_robots') }}" id="robots" name = "service_details_robots" >    
                            </div>  
                            <div class="fpb-7">
                                <label for="canonical" class="eForm-label">{{get_phrase('Canonical')}} ({{get_phrase('URL')}})</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('service_details_canonical') }}" id="canonical" name = "service_details_canonical" >    
                            </div>   
                            
                            <div class="fpb-7">
                                <label for="twitter_card" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Card')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('service_details_twitter_card') }}" id="our_service_twitter_card" name = "service_details_twitter_card" >    
                            </div> 
                            <div class="fpb-7">
                                <label for="twitter_title" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Title')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('service_details_twitter_title') }}" id="twitter_title" name = "service_details_twitter_title" >    
                            </div> 
                            <div class="fpb-7">
                                <label for="twitter_description" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Description')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('service_details_twitter_description') }}" id="twitter_description" name = "service_details_twitter_description" >    
                            </div> 

                            <div class="fpb-7">
                              <div class="fav" style="margin-top: 5px;
                              margin-bottom: 10px;">
                                <label for="og_image" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Image')}}</label> 
                                <img src="{{asset('public/assets/upload/logo/'. get_settings('service_details_og_image'))}}" alt="" width="100" height="100">     
                              </div>
                                                 
                              <input type="file" class="form-control eForm-control" value="{{ get_settings('service_details_og_image') }}" id="og_image" name = "service_details_og_image" >    
                            </div> 
                            <div class="fpb-7">
                              <div class="fav" style="margin-top: 5px;
                              margin-bottom: 10px;">
                                <label for="twitter_image" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Image')}}</label> 
                                <img src="{{asset('public/assets/upload/logo/'. get_settings('service_details_twitter_image'))}}" alt="" width="100" height="100">     
                              </div>
                                                 
                              <input type="file" class="form-control eForm-control" value="{{ get_settings('service_details_twitter_image') }}" id="twitter_image" name = "service_details_twitter_image" >    
                            </div> 

                             <div class="fpb-7 pt-2">
                                <button type="submit" class="btn-form">{{get_phrase('Update')}}</button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade " id="v-pills-vSettings" role="tabpanel" aria-labelledby="v-pills-vSettings-tab">
        <div class="row">
          <div class="col-12">
            <div class="eSection-wrap">
                <div class="eMain">
                  <div class="pb-3">
                    <div class="eForm-layouts">
                      <p class="column-title">{{get_phrase('PORTFOLIO SEO SETTINGS')}}</p>
                        <form method="POST" enctype="multipart/form-data"  class="d-block ajaxForm" action="{{route('superadmin.settings.system_settings.update')}}">
                            @csrf

                            <div class="fpb-7">
                              <label for="og_title" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Title')}} ({{get_phrase('Page Title')}})</label>
                              <input type="text" class="form-control eForm-control" value="{{ get_settings('portfolio_og_title') }}" id="og_title" name = "portfolio_og_title" >    
                            </div> 

                            <div class="fpb-7">
                              <label for="og_url" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('URL')}}</label>
                              <input type="text" class="form-control eForm-control" value="{{ get_settings('portfolio_og_url') }}" id="og_url" name = "portfolio_og_url" >    
                            </div> 

                            <div class="fpb-7">
                              <label for="og_description" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Description')}}</label>
                              <textarea class="form-control eForm-control" id="og_description" name = "portfolio_og_description" >{{ get_settings('portfolio_og_description') }}</textarea>   
                            </div> 

                            <div class="fpb-7">
                                <label for="meta_description" class="eForm-label">{{get_phrase('Meta Description')}}</label>
                                <textarea type="text" class="form-control eForm-control"  id="meta_description" name = "portfolio_meta_description" >{{ get_settings('portfolio_meta_description') }} </textarea>  
                            </div> 
                            
                            <div class="fpb-7">
                                <label for="keywords" class="eForm-label">{{get_phrase('Keywords')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('portfolio_keywords') }}" id="keywords" name = "portfolio_keywords" >    
                            </div> 
                            <div class="fpb-7">
                                <label for="robots" class="eForm-label">{{get_phrase('Robots')}}</label>
                                <input type="robots" class="form-control eForm-control" value="{{ get_settings('portfolio_robots') }}" id="robots" name = "portfolio_robots" >    
                            </div>  
                            <div class="fpb-7">
                                <label for="canonical" class="eForm-label">{{get_phrase('Canonical')}} ({{get_phrase('URL')}})</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('portfolio_canonical') }}" id="canonical" name = "portfolio_canonical" >    
                            </div>   
                            
                            <div class="fpb-7">
                                <label for="twitter_card" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Card')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('portfolio_twitter_card') }}" id="twitter_card" name = "portfolio_twitter_card" >    
                            </div> 
                            <div class="fpb-7">
                                <label for="twitter_title" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Title')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('portfolio_twitter_title') }}" id="twitter_title" name = "portfolio_twitter_title" >    
                            </div> 
                            <div class="fpb-7">
                                <label for="twitter_description" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Description')}}</label>
                                <input type="text" class="form-control eForm-control" value="{{ get_settings('portfolio_twitter_description') }}" id="twitter_description" name = "portfolio_twitter_description" >    
                            </div> 

                            <div class="fpb-7">
                              <div class="fav" style="margin-top: 5px;
                              margin-bottom: 10px;">
                                <label for="og_image" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Image')}}</label> 
                                <img src="{{asset('public/assets/upload/logo/'. get_settings('portfolio_og_image'))}}" alt="" width="100" height="100">     
                              </div>
                                                 
                              <input type="file" class="form-control eForm-control" value="{{ get_settings('portfolio_og_image') }}" id="og_image" name = "portfolio_og_image" >    
                            </div> 
                            <div class="fpb-7">
                              <div class="fav" style="margin-top: 5px;
                              margin-bottom: 10px;">
                                <label for="twitter_image" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Image')}}</label> 
                                <img src="{{asset('public/assets/upload/logo/'. get_settings('portfolio_twitter_image'))}}" alt="" width="100" height="100">     
                              </div>
                                                 
                              <input type="file" class="form-control eForm-control" value="{{ get_settings('portfolio_twitter_image') }}" id="twitter_image" name = "portfolio_twitter_image" >    
                            </div> 

                             <div class="fpb-7 pt-2">
                                <button type="submit" class="btn-form">{{get_phrase('Update')}}</button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-about" role="tabpanel" aria-labelledby="v-pills-about-tab">
        <div class="row">
          <div class="col-12">
            <div class="eSection-wrap">
                <div class="eMain">
                  <div class="pb-3">
                    <div class="eForm-layouts">
                      <p class="column-title">{{get_phrase('ABOUT SEO SETTINGS')}}</p>
                      <form method="POST" enctype="multipart/form-data"  class="d-block ajaxForm" action="{{route('superadmin.settings.system_settings.update')}}">
                        @csrf

                        <div class="fpb-7">
                          <label for="og_title" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Title')}} ({{get_phrase('Page Title')}})</label>
                          <input type="text" class="form-control eForm-control" value="{{ get_settings('about_og_title') }}" id="og_title" name = "about_og_title" >    
                        </div> 

                        <div class="fpb-7">
                          <label for="og_url" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('URL')}}</label>
                          <input type="text" class="form-control eForm-control" value="{{ get_settings('og_url') }}" id="about_og_url" name = "about_og_url" >    
                        </div> 

                        <div class="fpb-7">
                          <label for="og_description" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Description')}}</label>
                          <textarea class="form-control eForm-control" id="og_description" name = "about_og_description" >{{ get_settings('about_og_description') }}</textarea>   
                        </div> 

                        <div class="fpb-7">
                            <label for="meta_description" class="eForm-label">{{get_phrase('Meta Description')}}</label>
                            <textarea type="text" class="form-control eForm-control"  id="meta_description" name = "about_meta_description" >{{ get_settings('about_meta_description') }} </textarea>  
                        </div> 
                        
                        <div class="fpb-7">
                            <label for="keywords" class="eForm-label">{{get_phrase('Keywords')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('about_keywords') }}" id="keywords" name = "about_keywords" >    
                        </div> 
                        <div class="fpb-7">
                            <label for="robots" class="eForm-label">{{get_phrase('Robots')}}</label>
                            <input type="robots" class="form-control eForm-control" value="{{ get_settings('about_robots') }}" id="robots" name = "about_robots" >    
                        </div>  
                        <div class="fpb-7">
                            <label for="canonical" class="eForm-label">{{get_phrase('Canonical')}} ({{get_phrase('URL')}})</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('about_canonical') }}" id="canonical" name = "about_canonical" >    
                        </div>   
                        
                        <div class="fpb-7">
                            <label for="twitter_card" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Card')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('about_twitter_card') }}" id="twitter_card" name = "about_twitter_card" >    
                        </div> 
                        <div class="fpb-7">
                            <label for="twitter_title" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Title')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('about_twitter_title') }}" id="twitter_title" name = "about_twitter_title" >    
                        </div> 
                        <div class="fpb-7">
                            <label for="twitter_description" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Description')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('about_twitter_description') }}" id="twitter_description" name = "about_twitter_description" >    
                        </div> 

                        <div class="fpb-7">
                          <div class="fav" style="margin-top: 5px;
                          margin-bottom: 10px;">
                            <label for="og_image" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Image')}}</label> 
                            <img src="{{asset('public/assets/upload/logo/'. get_settings('about_og_image'))}}" alt="" width="100" height="100">     
                          </div>
                                             
                          <input type="file" class="form-control eForm-control" value="{{ get_settings('about_og_image') }}" id="og_image" name = "about_og_image" >    
                        </div>

                         <div class="fpb-7 pt-2">
                            <button type="submit" class="btn-form">{{get_phrase('Update')}}</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-team" role="tabpanel" aria-labelledby="v-pills-team-tab">
        <div class="row">
          <div class="col-12">
            <div class="eSection-wrap">
                <div class="eMain">
                  <div class="pb-3">
                    <div class="eForm-layouts">
                      <p class="column-title">{{get_phrase('TEAM SEO SETTINGS')}}</p>
                      <form method="POST" enctype="multipart/form-data"  class="d-block ajaxForm" action="{{route('superadmin.settings.system_settings.update')}}">
                        @csrf

                        <div class="fpb-7">
                          <label for="og_title" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Title')}} ({{get_phrase('Page Title')}})</label>
                          <input type="text" class="form-control eForm-control" value="{{ get_settings('team_og_title') }}" id="og_title" name = "team_og_title" >    
                        </div> 

                        <div class="fpb-7">
                          <label for="og_url" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('URL')}}</label>
                          <input type="text" class="form-control eForm-control" value="{{ get_settings('team_og_url') }}" id="og_url" name = "team_og_url" >    
                        </div> 

                        <div class="fpb-7">
                          <label for="og_description" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Description')}}</label>
                          <textarea class="form-control eForm-control" id="og_description" name = "team_og_description" >{{ get_settings('team_og_description') }}</textarea>   
                        </div> 

                        <div class="fpb-7">
                            <label for="meta_description" class="eForm-label">{{get_phrase('Meta Description')}}</label>
                            <textarea type="text" class="form-control eForm-control"  id="meta_description" name = "team_meta_description" >{{ get_settings('team_meta_description') }} </textarea>  
                        </div> 
                        
                        <div class="fpb-7">
                            <label for="keywords" class="eForm-label">{{get_phrase('Keywords')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('team_keywords') }}" id="keywords" name = "team_keywords" >    
                        </div> 
                        <div class="fpb-7">
                            <label for="robots" class="eForm-label">{{get_phrase('Robots')}}</label>
                            <input type="robots" class="form-control eForm-control" value="{{ get_settings('team_robots') }}" id="robots" name = "team_robots" >    
                        </div>  
                        <div class="fpb-7">
                            <label for="canonical" class="eForm-label">{{get_phrase('Canonical')}} ({{get_phrase('URL')}})</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('team_canonical') }}" id="canonical" name = "team_canonical" >    
                        </div>   
                        
                        <div class="fpb-7">
                            <label for="twitter_card" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Card')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('team_twitter_card') }}" id="twitter_card" name = "team_twitter_card" >    
                        </div> 
                        <div class="fpb-7">
                            <label for="twitter_title" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Title')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('team_twitter_title') }}" id="twitter_title" name = "team_twitter_title" >    
                        </div> 
                        <div class="fpb-7">
                            <label for="twitter_description" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Description')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('team_twitter_description') }}" id="twitter_description" name = "team_twitter_description" >    
                        </div> 
                        <div class="fpb-7">
                          <div class="fav" style="margin-top: 5px;
                          margin-bottom: 10px;">
                            <label for="og_image" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Image')}}</label> 
                            <img src="{{asset('public/assets/upload/logo/'. get_settings('team_og_image'))}}" alt="" width="100" height="100">     
                          </div>
                                             
                          <input type="file" class="form-control eForm-control" value="{{ get_settings('team_og_image') }}" id="og_image" name = "team_og_image" >    
                        </div>
                         <div class="fpb-7 pt-2">
                            <button type="submit" class="btn-form">{{get_phrase('Update')}}</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-blogs" role="tabpanel" aria-labelledby="v-pills-blogs-tab">
        <div class="row">
          <div class="col-12">
            <div class="eSection-wrap">
                <div class="eMain">
                  <div class="pb-3">
                    <div class="eForm-layouts">
                      <p class="column-title">{{get_phrase('BLOGS SEO SETTINGS')}}</p>
                      <form method="POST" enctype="multipart/form-data"  class="d-block ajaxForm" action="{{route('superadmin.settings.system_settings.update')}}">
                        @csrf

                        <div class="fpb-7">
                          <label for="og_title" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Title')}} ({{get_phrase('Page Title')}})</label>
                          <input type="text" class="form-control eForm-control" value="{{ get_settings('blog_og_title') }}" id="og_title" name = "blog_og_title">    
                        </div> 

                        <div class="fpb-7">
                          <label for="og_url" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('URL')}}</label>
                          <input type="text" class="form-control eForm-control" value="{{ get_settings('blog_og_url') }}" id="og_url" name = "blog_og_url" >    
                        </div> 

                        <div class="fpb-7">
                          <label for="og_description" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Description')}}</label>
                          <textarea class="form-control eForm-control" id="og_description" name = "blog_og_description" >{{ get_settings('blog_og_description') }}</textarea>   
                        </div> 

                        <div class="fpb-7">
                            <label for="meta_description" class="eForm-label">{{get_phrase('Meta Description')}}</label>
                            <textarea type="text" class="form-control eForm-control"  id="meta_description" name = "blog_meta_description" >{{ get_settings('blog_meta_description') }} </textarea>  
                        </div> 
                        
                        <div class="fpb-7">
                            <label for="keywords" class="eForm-label">{{get_phrase('Keywords')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('blog_keywords') }}" id="keywords" name = "blog_keywords" >    
                        </div> 
                        <div class="fpb-7">
                            <label for="robots" class="eForm-label">{{get_phrase('Robots')}}</label>
                            <input type="robots" class="form-control eForm-control" value="{{ get_settings('blog_robots') }}" id="robots" name = "blog_robots" >    
                        </div>  
                        <div class="fpb-7">
                            <label for="canonical" class="eForm-label">{{get_phrase('Canonical')}} ({{get_phrase('URL')}})</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('blog_canonical') }}" id="canonical" name = "blog_canonical" >    
                        </div>   
                        
                        <div class="fpb-7">
                            <label for="twitter_card" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Card')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('blog_twitter_card') }}" id="twitter_card" name = "blog_twitter_card" >    
                        </div> 
                        <div class="fpb-7">
                            <label for="twitter_title" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Title')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('blog_twitter_title') }}" id="twitter_title" name = "blog_twitter_title" >    
                        </div> 
                        <div class="fpb-7">
                            <label for="twitter_description" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Description')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('blog_twitter_description') }}" id="twitter_description" name = "blog_twitter_description" >    
                        </div> 

                        <div class="fpb-7">
                          <div class="fav" style="margin-top: 5px;
                          margin-bottom: 10px;">
                            <label for="og_image" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Image')}}</label> 
                            <img src="{{asset('public/assets/upload/logo/'. get_settings('blog_og_image'))}}" alt="" width="100" height="100">     
                          </div>
                                             
                          <input type="file" class="form-control eForm-control" value="{{ get_settings('blog_og_image') }}" id="og_image" name = "blog_og_image" >    
                        </div>

                         <div class="fpb-7 pt-2">
                            <button type="submit" class="btn-form">{{get_phrase('Update')}}</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-contact" role="tabpanel" aria-labelledby="v-pills-contact-tab">
        <div class="row">
          <div class="col-12">
            <div class="eSection-wrap">
                <div class="eMain">
                  <div class="pb-3">
                    <div class="eForm-layouts">
                      <p class="column-title">{{get_phrase('CONTACT SEO SETTINGS')}}</p>
                      <form method="POST" enctype="multipart/form-data"  class="d-block ajaxForm" action="{{route('superadmin.settings.system_settings.update')}}">
                        @csrf

                        <div class="fpb-7">
                          <label for="og_title" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Title')}} ({{get_phrase('Page Title')}})</label>
                          <input type="text" class="form-control eForm-control" value="{{ get_settings('contact_og_title') }}" id="og_title" name = "contact_og_title" >    
                        </div> 

                        <div class="fpb-7">
                          <label for="og_url" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('URL')}}</label>
                          <input type="text" class="form-control eForm-control" value="{{ get_settings('contact_og_url') }}" id="og_url" name = "contact_og_url" >    
                        </div> 

                        <div class="fpb-7">
                          <label for="og_description" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Description')}}</label>
                          <textarea class="form-control eForm-control" id="og_description" name = "contact_og_description" >{{ get_settings('contact_og_description') }}</textarea>   
                        </div> 

                        <div class="fpb-7">
                            <label for="meta_description" class="eForm-label">{{get_phrase('Meta Description')}}</label>
                            <textarea type="text" class="form-control eForm-control"  id="meta_description" name = "contact_meta_description" >{{ get_settings('contact_meta_description') }} </textarea>  
                        </div> 
                        
                        <div class="fpb-7">
                            <label for="keywords" class="eForm-label">{{get_phrase('Keywords')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('contact_keywords') }}" id="keywords" name = "contact_keywords" >    
                        </div> 
                        <div class="fpb-7">
                            <label for="robots" class="eForm-label">{{get_phrase('Robots')}}</label>
                            <input type="robots" class="form-control eForm-control" value="{{ get_settings('contact_robots') }}" id="robots" name = "contact_robots" >    
                        </div>  
                        <div class="fpb-7">
                            <label for="canonical" class="eForm-label">{{get_phrase('Canonical')}} ({{get_phrase('URL')}})</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('contact_canonical') }}" id="canonical" name = "contact_canonical" >    
                        </div>   
                        
                        <div class="fpb-7">
                            <label for="twitter_card" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Card')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('contact_twitter_card') }}" id="twitter_card" name = "contact_twitter_card" >    
                        </div> 
                        <div class="fpb-7">
                            <label for="twitter_title" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Title')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('contact_twitter_title') }}" id="twitter_title" name = "contact_twitter_title" >    
                        </div> 
                        <div class="fpb-7">
                            <label for="twitter_description" class="eForm-label">{{get_phrase('Twitter')}}:{{get_phrase('Description')}}</label>
                            <input type="text" class="form-control eForm-control" value="{{ get_settings('contact_twitter_description') }}" id="twitter_description" name = "contact_twitter_description" >    
                        </div>

                        <div class="fpb-7">
                          <div class="fav" style="margin-top: 5px;
                          margin-bottom: 10px;">
                            <label for="og_image" class="eForm-label">{{get_phrase('OG')}}:{{get_phrase('Image')}}</label> 
                            <img src="{{asset('public/assets/upload/logo/'. get_settings('contact_og_image'))}}" alt="" width="100" height="100">     
                          </div>
                                             
                          <input type="file" class="form-control eForm-control" value="{{ get_settings('contact_og_image') }}" id="og_image" name = "contact_og_image" >    
                        </div>

                         <div class="fpb-7 pt-2">
                            <button type="submit" class="btn-form">{{get_phrase('Update')}}</button>
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
</div>

@endsection