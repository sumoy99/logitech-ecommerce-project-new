@extends('superadmin.navigation')
@section('content')

<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4>{{ get_phrase('About this application') }}</h4>
            </div>
        </div>
    </div>
</div>

<?php $curl_enabled = function_exists('curl_version'); ?>
  
  <div class="row justify-content-center mt-4">
    <div class="col-xl-8">
      <div class="eSection-wrap">
        <div class="row">
            <div class="col-12 p-4">

                <p class="border-bottom mb-2 pb-2 text-13px">
                  <i class="bi bi-arrow-right-square me-3"></i> {{ get_phrase('Software version') }}
                  <span class="float-end">{{ get_settings('version') }}</span>
                </p>
                {{-- <p class="border-bottom mb-2 pb-2 text-13px">
                  <i class="bi bi-arrow-right-square me-3"></i> {{ get_phrase('Check update') }}
                  <span class="float-end">
                      <a class="about-sc-one" href="https://codecanyon.net/user/creativeitem/portfolio"
                        target="_blank">
                          <i class="bi bi-telegram"></i>
                            {{ get_phrase('Check update') }}
                      </a>
                  </span>
                </p> --}}
                <p class="border-bottom mb-2 pb-2 text-13px">
                  <i class="bi bi-arrow-right-square me-3"></i> {{ get_phrase('PHP version') }}
                  <span class="float-end">{{ phpversion() }}</span>
                </p>
                <p class="border-bottom mb-2 pb-2 text-13px">
                  <i class="bi bi-arrow-right-square me-3"></i> {{ get_phrase('Curl enable') }}
                  <span class="float-end">
                    <?php echo $curl_enabled ? '<span class="badge bg-success">'.get_phrase('Enabled').'</span>' : '<span class="badge badge-danger">'.get_phrase('disabled').'</span>'; ?>
                  </span>
                </p>
                <p class="border-bottom mb-2 pb-2 text-13px">
                  <i class="bi bi-arrow-right-square me-3"></i> {{ get_phrase('Get customer support') }}
                  <span class="float-end"><a class="about-sc-one" href="http://support.creativeitem.com" target="_blank"> <i class="bi bi-telegram"></i> {{ get_phrase('Customer support') }} </a> </span>
                </p>
            </div>
        </div>
                
      </div>
    </div>
  </div>

@endsection