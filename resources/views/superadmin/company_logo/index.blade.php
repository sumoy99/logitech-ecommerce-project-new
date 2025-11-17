@extends('superadmin.navigation')
@section('content')

<div class="page-header d-flex justify-content-between align-items-center">
    <div class="d-flex justify-content-between">
      <h3 class="fw-bold mb-3">{{get_phrase('Company Logo')}}</h3>
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
          <a href="#">{{ get_phrase('All Company Logo') }}</a>
        </li>
        
      </ul>
    </div>
    

    <a href="javascript:;" class="btn btn-primary btn-round" onclick="rightModal('{{ route('superadmin.company_logo.create') }}', 'Add Logo')" data-bs-toggle="tooltip" data-bs-placement="top" title="Add"><i class="fa fa-plus"></i> {{ get_phrase('Add Logo') }}
    </a>

</div>
<div class="card shadow-sm border-0">
    <div class="card-body">
        @if($company_logos->count() > 0)
            <div class="row g-4">
                @foreach($company_logos as $company_logo)
                    <div class="col-md-4 col-lg-3 col-sm-6">
                        {{-- Serial Number --}}
                        <span class="badge mb-2   badge-secondary">
                            #{{ $loop->iteration }}
                        </span>
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden banner-card position-relative">
                            
                            {{-- Banner Image --}}
                            <div class="ratio ratio-16x9">
                            <img src="{{ asset('assets/upload/company_logo/' . $company_logo->logo) }}" 
                                class="object-fit-cover w-100 h-100" 
                                alt="Company Logo">
                            </div>


                            {{-- Status Badge --}}
                            <div class="position-absolute top-0 left-0 mt-2 me-2 mx-2">
                                @if($company_logo->status == 1)
                                    <span class="badge bg-success rounded-pill shadow">{{ get_phrase('Active') }}</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill shadow">{{ get_phrase('Inactive') }}</span>
                                @endif
                            </div>
                            <div class="position-absolute top-0 left-0 end-0 mt-2 me-2">
                                <a href="javascript:;"  onclick="rightModal('{{ route('superadmin.company_logo.edit', ['id' => $company_logo->id]) }}', 'Edit Logo')" class="btn btn-sm btn-warning banner_btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-edit"></i></a>

                                <a href="javascript:;" class="btn btn-sm btn-danger revert-btn banner_btn" data-url="{{route('superadmin.company_logo.delete', ['id' => $company_logo->id])}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete logo"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-muted py-5">
                <i class="bi bi-image-alt display-4 d-block mb-3"></i>
                <p class="mb-0">{{ get_phrase('No company logos uploaded yet.') }}</p>
            </div>
        @endif
    </div>
</div>
    
<div class="pagination p1">
    <ul>
        @if ($company_logos->previousPageUrl())
            <a href="{{ $company_logos->previousPageUrl() }}"><li><</li></a>
        @endif
        @for ($i = 1; $i <= $company_logos->lastPage(); $i++)
            <a href="{{ $company_logos->url($i) }}" class="{{ $company_logos->currentPage() == $i ? 'is-active' : '' }}"><li>{{ $i }}</li></a>
        @endfor
        @if ($company_logos->nextPageUrl())
            <a href="{{ $company_logos->nextPageUrl() }}"><li>></li></a>
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