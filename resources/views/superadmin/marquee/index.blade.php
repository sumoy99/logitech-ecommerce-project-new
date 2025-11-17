@extends('superadmin.navigation')
@section('content')

<div class="page-header d-flex justify-content-between align-items-center">
    <div class="d-flex justify-content-between">
      <h3 class="fw-bold mb-3">{{get_phrase('Marquee')}}</h3>
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
          <a href="#">{{ get_phrase('Marquee List') }}</a>
        </li>
        
      </ul>
    </div>
    
    <a href="javascript:;" class="btn btn-primary btn-round" onclick="rightModal('{{ route('superadmin.marquee.create') }}', 'Add Marquee')" data-bs-toggle="tooltip" data-bs-placement="top" title="Add"><i class="fa fa-plus"></i> {{ get_phrase('Add Marquee') }}
    </a>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <div class="row mb-3">
            <div class="col-md-3 col-sm-6">
                <form method="GET" action="{{ route('superadmin.marquee.index') }}">
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
                    <th>Title</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($marquees as $key => $marquee)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        
                        <td>{{ ucfirst($marquee->title) }}</td>

                        <td>
                            @if ($marquee->position == 'top_header')
                                Top Header
                            @elseif($marquee->position == 'banner')
                                Banner
                            @endif 
                        </td>

                        <td>
                            @if($marquee->status == 1)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="javascript:;" onclick="rightModal('{{ route('superadmin.marquee.edit', ['id' => $marquee->id]) }}', 'Edit Marquee')" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-edit"></i></a>

                            <a href="javascript:;" class="btn btn-sm btn-danger revert-btn" data-url="{{ route('superadmin.marquee.delete', ['id' => $marquee->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No Marquee found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="pagination p1">
    <ul>
        @if ($marquees->previousPageUrl())
            <a href="{{ $marquees->previousPageUrl() }}"><li><</li></a>
        @endif
        @for ($i = 1; $i <= $marquees->lastPage(); $i++)
            <a href="{{ $marquees->url($i) }}" class="{{ $marquees->currentPage() == $i ? 'is-active' : '' }}"><li>{{ $i }}</li></a>
        @endfor
        @if ($marquees->nextPageUrl())
            <a href="{{ $marquees->nextPageUrl() }}"><li>></li></a>
        @endif
    </ul>
</div>



@endsection