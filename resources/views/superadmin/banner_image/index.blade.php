@extends('superadmin.navigation')
@section('content')
{{-- ✅ Custom CSS Styling --}}
<style>
  .banner-card {
    transition: all 0.3s ease-in-out;
    cursor: pointer;
  }
  .banner-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  }
  .banner-overlay {
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
  }
  .banner-card:hover .banner-overlay {
    opacity: 1;
  }
  .object-fit-cover {
    object-fit: cover;
  }
  .banner_btn{
    font-size: 9px;
    padding: 3px 9px;
  }
</style>
<div class="page-header d-flex justify-content-between align-items-center">
    <div class="d-flex justify-content-between">
      <h3 class="fw-bold mb-3">{{get_phrase('Banner Image')}}</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="#">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">{{ get_phrase('All Banner Image') }}</a>
        </li>
        
      </ul>
    </div>
    

    <a href="javascript:;" class="btn btn-primary btn-round" onclick="rightModal('{{ route('superadmin.banner_image.create') }}', 'Add Image')" data-bs-toggle="tooltip" data-bs-placement="top" title="Add"><i class="fa fa-plus"></i> {{ get_phrase('Add Image') }}
    </a>

</div>
<div class="card shadow-sm border-0">
    <div class="card-body">
        @if($banners->count() > 0)
            <div class="row g-4">
                @foreach($banners as $banner)
                    <div class="col-md-4 col-lg-3 col-sm-6">
                        {{-- Serial Number --}}
                        <span class="badge mb-2   badge-secondary">
                            #{{ $loop->iteration }}
                        </span>
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden banner-card position-relative">
                            
                            {{-- Banner Image --}}
                            <div class="ratio ratio-16x9">
                            <img src="{{ asset('assets/upload/banner_images/' . $banner->image) }}" 
                                class="object-fit-cover w-100 h-100" 
                                alt="Banner Image">
                            </div>

                            {{-- Overlay on Hover --}}
                            <div class="banner-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center bg-dark bg-opacity-75 text-white opacity-0 transition">
                                @if($banner->url)
                                    <a href="{{ $banner->url }}" target="_blank" class="btn btn-sm btn-light mb-2 px-3">
                                    <i class="bi bi-link-45deg me-1"></i> Visit URL
                                    </a>
                                @endif
                            </div>

                            {{-- Status Badge --}}
                            <div class="position-absolute top-0 left-0 mt-2 me-2 mx-2">
                                @if($banner->status == 1)
                                    <span class="badge bg-success rounded-pill shadow">{{ get_phrase('Active') }}</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill shadow">{{ get_phrase('Inactive') }}</span>
                                @endif
                            </div>
                            <div class="position-absolute top-0 left-0 end-0 mt-2 me-2">
                                <a href="javascript:;"  onclick="rightModal('{{ route('superadmin.banner_image.edit', ['id' => $banner->id]) }}', 'Edit Image')" class="btn btn-sm btn-warning banner_btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-edit"></i></a>

                                <a href="javascript:;" class="btn btn-sm btn-danger revert-btn banner_btn" data-url="{{route('superadmin.banner_image.delete', ['id' => $banner->id])}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Image"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-muted py-5">
                <i class="bi bi-image-alt display-4 d-block mb-3"></i>
                <p class="mb-0">{{ get_phrase('No banners uploaded yet.') }}</p>
            </div>
        @endif
    </div>
</div>
    

<div class="pagination p1">
    <ul>
        @if ($banners->previousPageUrl())
            <a href="{{ $banners->previousPageUrl() }}"><li><</li></a>
        @endif
        @for ($i = 1; $i <= $banners->lastPage(); $i++)
            <a href="{{ $banners->url($i) }}" class="{{ $banners->currentPage() == $i ? 'is-active' : '' }}"><li>{{ $i }}</li></a>
        @endfor
        @if ($banners->nextPageUrl())
            <a href="{{ $banners->nextPageUrl() }}"><li>></li></a>
        @endif
    </ul>
</div>


{{-- ✅ Success message --}}
@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

{{-- ❌ Error message --}}
@if (session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

{{-- 🧾 Validation errors (shows exactly which field is wrong) --}}
@if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <ul class="mb-0">
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif



@endsection