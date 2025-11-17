@extends('superadmin.navigation')
@section('content') 


<div class="page-header d-flex justify-content-between align-items-center">
    <div class="d-flex justify-content-between">
      <h3 class="fw-bold mb-3">{{get_phrase('Colors')}}</h3>
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
          <a href="#">{{ get_phrase('Colors List') }}</a>
        </li>
      </ul>
    </div>

    <a href="javascript:;" class="btn btn-secondary" onclick="rightModal('{{ route('superadmin.color.add') }}', 'Add Color')"data-bs-toggle="tooltip" data-bs-placement="top" title="Add"><i class="fa fa-plus"></i> {{ get_phrase('Add Color') }}
    </a>
</div>

  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-3 col-sm-6">
                <form method="GET" action="{{ route('superadmin.color.index') }}">
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
           {{-- Color Table --}}
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                    <th>#</th>
                    <th>Color Name</th>
                    <th>Color Code</th>
                    <th>Preview</th>
                    <th>Status</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($colors as $index => $color)
                    @php
                        // Dynamic text color based on background
                        $hex = str_replace('#', '', $color->hex_code);
                        $r = hexdec(substr($hex, 0, 2));
                        $g = hexdec(substr($hex, 2, 2));
                        $b = hexdec(substr($hex, 4, 2));
                        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
                        $textColor = ($yiq >= 128) ? '#000' : '#fff';
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration + ($colors->currentPage() - 1) * $colors->perPage() }}</td>
                        <td>{{ $color->name }}</td>
                        <td>{{ $color->hex_code }}</td>
                        <td>
                        <span style="display:inline-block; padding:5px 12px; border-radius:5px; background:{{ $color->hex_code }}; color:{{ $textColor }};">
                            {{ $color->hex_code }}
                        </span>
                        </td>
                        <td>
                        @if($color->status == 'on')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                        </td>
                        <td>
                            <a href="javascript:;" onclick="rightModal('{{ route('superadmin.color.edit', ['id' => $color->id]) }}', 'Edit color')" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-edit"></i></a>

                            <a href="javascript:;" class="btn btn-sm btn-danger revert-btn" data-url="{{ route('superadmin.color.delete', ['id' => $color->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Color"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No colors found.</td>
                    </tr>
                    @endforelse
                </tbody>
                </table>
            </div>
        </div>
      </div>
      <div class="pagination p1">
        <ul>
          @if ($colors->previousPageUrl())
              <a href="{{ $colors->previousPageUrl() }}"><li><</li></a>
          @endif
          @for ($i = 1; $i <= $colors->lastPage(); $i++)
              <a href="{{ $colors->url($i) }}" class="{{ $colors->currentPage() == $i ? 'is-active' : '' }}"><li>{{ $i }}</li></a>
          @endfor
          @if ($colors->nextPageUrl())
              <a href="{{ $colors->nextPageUrl() }}"><li>></li></a>
          @endif
        </ul>
      </div>
    </div>
  </div>
  

 



@endsection