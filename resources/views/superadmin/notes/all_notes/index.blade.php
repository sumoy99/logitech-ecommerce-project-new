@extends('superadmin.navigation')
@section('content') 

<div class="page-header d-flex justify-content-between align-items-center">
    <div class="d-flex justify-content-between">
      <h3 class="fw-bold mb-3">{{get_phrase('Notes')}}</h3>
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
          <a href="#">{{ get_phrase('Note List') }}</a>
        </li>
      </ul>
    </div>

    <a href="javascript:;" class="btn btn-secondary" onclick="rightModal('{{ route('superadmin.notes.all_notes.create') }}', 'Add Note')"data-bs-toggle="tooltip" data-bs-placement="top" title="Add"><i class="fa fa-plus"></i> {{ get_phrase('Add Note') }}
    </a>
</div>

<div class="card">
    <div class="card-body table-responsive">
    <div class="row mb-3">
    <div class="col-md-3 col-sm-6">
        <form method="GET" action="{{ route('superadmin.notes.all_notes.index') }}">
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
            <th>User</th>
            <th>Title</th>
            <th>Description</th>
            <th>Type</th>
            <th>Visibility</th>
            <th>Status</th>
            <th width="150">Actions</th>
        </tr>
    </thead>
        <tbody>
            @forelse($notes as $key => $note)
            @php
                $user = DB::table('users')->where('id', $note->user_id)->first();
                $type = DB::table('note_types')->where('id', $note->type_id)->first();
            @endphp
                <tr>
                    <td>{{ $key + 1 }}</td>
                    @if (!empty($user))
                        <td>{{ ucfirst($user->name) }}</td>
                        @else
                        <td>Null</td>
                    @endif
                    
                    <td>{{ ucfirst($note->title) }}</td>
                    <td>{{ ucfirst($note->description) }}</td>

                    @if (!empty($type))
                        <td>{{ ucfirst($type->title) }}</td>
                        @else
                        <td>Null</td>
                    @endif
                    
                    <td>{{ ucfirst($note->visibility) }}</td>
                    <td>
                        @if($note->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="javascript:;" onclick="rightModal('{{ route('superadmin.notes.all_notes.edit', ['id' => $note->id]) }}', 'Edit Note')" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-edit"></i></a>

                        <a href="javascript:;" class="btn btn-sm btn-danger revert-btn" data-url="{{ route('superadmin.notes.all_notes.delete', ['id' => $note->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No Type found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>


@endsection