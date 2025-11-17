@extends('superadmin.navigation')
@section('content') 

<div class="page-header d-flex justify-content-between align-items-center">
    <div class="d-flex justify-content-between">
      <h3 class="fw-bold mb-3">{{get_phrase('Brands')}}</h3>
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
          <a href="#">{{ get_phrase('Product') }}</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">{{ get_phrase('Brands List') }}</a>
        </li>
      </ul>
    </div>

    <a href="javascript:;" class="btn btn-secondary" onclick="rightModal('{{ route('superadmin.brands.add') }}', 'Add Brand')"data-bs-toggle="tooltip" data-bs-placement="top" title="Add"><i class="fa fa-plus"></i> {{ get_phrase('Add Brand') }}
    </a>
</div>


<div class="card">
    <div class="card-body table-responsive">
        <div class="row mb-3">
            <div class="col-md-3 col-sm-6">
                <form method="GET" action="{{ route('superadmin.brands.index') }}">
                  <div class="search-box">
                    <div class="InputContainer">
                      <input value="{{ request()->get('search') }}" name="search" placeholder="Search.."/>
                    </div>
                    <button type="submit" class="Icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#657789" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </button>
                  </div>
              </form> 
            </div>
          </div>
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Website</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($brands as $key => $brand)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if($brand->logo)
                                <img src="{{ $brand->logo ? asset('assets/upload/brands/' . $brand->logo) : asset('assets/backend/assets/img/placeholder.png') }}" alt="Logo" height="40">
                            @else
                                <span class="text-muted">No Logo</span>
                            @endif
                        </td>
                        <td>{{ $brand->name }}</td>
                        <td>{{ $brand->description }}</td>
                        <td>
                            @if($brand->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            @if($brand->website)
                                @php
                                    $url = Str::startsWith($brand->website, ['http://', 'https://']) 
                                        ? $brand->website 
                                        : 'http://' . $brand->website;
                                @endphp
                                <a href="{{ $url }}" target="_blank">Visit</a>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            <a href="javascript:;" onclick="rightModal('{{ route('superadmin.brands.edit', ['id' => $brand->id]) }}', 'Edit Brand')" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-edit"></i></a>

                            <a href="javascript:;" class="btn btn-sm btn-danger revert-btn" data-url="{{ route('superadmin.brands.delete', ['id' => $brand->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No brands found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection