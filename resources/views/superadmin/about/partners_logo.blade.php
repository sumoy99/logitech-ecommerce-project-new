@extends('superadmin.navigation')
@section('content') 
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Partner Logo') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('About Us') }}</a></li>
                        <li><a href="#">{{ get_phrase('Partner Logo') }}</a></li>
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
                    <div class="col-6">
                        <div class="eForm-layouts">
                            <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('superadmin.about.partners_logo_store') }}">
                                @csrf 
                                <div class="form-row">
                        
                                    <div class="fpb-7">
                                        <label for="image" class="eForm-label">{{ get_phrase('Image') }}</label>
                                        <input type="file" class="form-control eForm-control" id="image" name = "image" required>
                                    </div>
                        
                                    <div class="fpb-7 pt-2">
                                        <button class="btn-form" type="submit">{{ get_phrase('Upload') }}</button>
                                    </div>
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
    @foreach ($partner_logos as $partner_logo)
    <div class="col-2">
        <div class="eSection-wrap">
            <div class="eMain" style="position: relative">
                <a class="delete_ico" title="{{ get_phrase('Delete Logo')}}" style="position: absolute;
                right: -10px;
                top: -11px;
                color: #dd1e1ead;" href="javascript:;"onclick="confirmModal('{{ route('superadmin.about.partners_logo_delete', $partner_logo['id']) }}', 'undefined');"><i class="fa-solid fa-trash"></i></a> 
                <img src="{{asset('public/assets/upload/about_us/partner_logo/'. $partner_logo->image)}}" height="100" width="100" alt=""> 
                
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="pagination p1">
    <ul>
      @if ($partner_logos->previousPageUrl())
          <a href="{{ $partner_logos->previousPageUrl() }}"><li><</li></a>
      @endif
      @for ($i = 1; $i <= $partner_logos->lastPage(); $i++)
          <a href="{{ $partner_logos->url($i) }}" class="{{ $partner_logos->currentPage() == $i ? 'is-active' : '' }}"><li>{{ $i }}</li></a>
      @endfor
      @if ($partner_logos->nextPageUrl())
          <a href="{{ $partner_logos->nextPageUrl() }}"><li>></li></a>
      @endif
    </ul>
  </div>
@endsection