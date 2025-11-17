@extends('superadmin.navigation')
@section('content')

<div class="page-header d-flex justify-content-between align-items-center">
    <div class="d-flex justify-content-between">
      <h3 class="fw-bold mb-3">{{get_phrase('Attributes')}}</h3>
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
          <a href="#">{{ get_phrase('Attributes List') }}</a>
        </li>
      </ul>
    </div>
    

    <a href="javascript:;" class="btn btn-primary btn-round" onclick="rightModal('{{ route('superadmin.attributes.attributes_create') }}', 'Add Attributes')" data-bs-toggle="tooltip" data-bs-placement="top" title="Add"><i class="fa fa-plus"></i> {{ get_phrase('Add Attributes') }}
    </a>
</div>


  
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-3 col-sm-6">
                <form method="GET" action="{{ route('superadmin.attributes.all_attributes') }}">
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
          <table class="table table-bordered table-striped attribute-table align-middle">
            <thead>
              <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 15%;">Name</th>
                <th style="width: 10%;">Type</th>
                <th style="width: 40%;">Values</th>
                <th style="width: 30%;">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($attributes as $key => $attribute)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td class="fw-medium">{{ $attribute->name }}</td>
                  <td class="fw-medium">{{ $attribute->type }}</td>
                  <td>
                    @if ($attribute->values->count())
                      <ul class="list-unstyled mb-0 scrollable-list">
                        @foreach ($attribute->values as $val)
                          <li class="mb-2 value-item d-flex justify-content-between align-items-center">
                            {{-- Display Mode --}}
                            <div class="value-display d-flex align-items-center justify-content-between w-100">
                              <span class="value-text">{{ $val->value }}</span>
                              <div class="action-icons d-flex gap-2 ms-2">
                                <i class="fas fa-edit text-primary edit-icon mt-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Value" style="cursor:pointer;"></i>
                                <a href="javascript:;" class="revert-btn" data-url="{{ route('superadmin.attributes.attributeValueDelete', ['id' => $val->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete value"><i class="fas fa-trash"></i></a>
                              </div>
                            </div>
  
                            {{-- Edit Mode --}}
                            <form action="{{route('superadmin.attributes.attributeValueUpdate', ['id' => $val->id])}}" method="POST" class="d-none edit-form mt-2 w-100">
                              @csrf
                              <div class="input-group input-group-sm">
                                <input type="text" name="value" value="{{ $val->value }}" class="form-control" required>
                                <button type="submit" class="btn btn-success btn-sm"  data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i class="fas fa-check"></i></button>
                                <button type="button" class="mx-2 btn btn-secondary btn-sm cancel-edit"  data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel"><i class="fas fa-minus"></i></button>
                              </div>
                            </form>
                          </li>
                        @endforeach
                      </ul>
                    @else
                      <span class="text-muted">No values</span>
                    @endif
                  </td>
                  <td>
                    <a href="javascript:;" onclick="rightModal('{{ route('superadmin.attributes.attribute_value_create', ['id' => $attribute->id]) }}', 'Add Value')" class="mb-2 btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Value"><i class="fa fa-plus"> </i> Add Value</a>
                    <a href="javascript:;" onclick="rightModal('{{ route('superadmin.attributes.attributes_edit', ['id' => $attribute->id]) }}', 'Edit Attributes')" class="mb-2 btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Attributes"><i class="fas fa-edit"></i> {{(get_phrase('Edit'))}}</a>

                    <a href="javascript:;" data-url="('{{ route('superadmin.attributes.attributes_delete', ['id' => $attribute->id]) }}', 'Add Value')" class="mb-2 revert-btn btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Attribute"><i class="fas fa-trash-alt"></i> </i> {{(get_phrase('Delete'))}}</a>

                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center text-muted">No attributes found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="pagination p1">
        <ul>
          @if ($attributes->previousPageUrl())
              <a href="{{ $attributes->previousPageUrl() }}"><li><</li></a>
          @endif
          @for ($i = 1; $i <= $attributes->lastPage(); $i++)
              <a href="{{ $attributes->url($i) }}" class="{{ $attributes->currentPage() == $i ? 'is-active' : '' }}"><li>{{ $i }}</li></a>
          @endfor
          @if ($attributes->nextPageUrl())
              <a href="{{ $attributes->nextPageUrl() }}"><li>></li></a>
          @endif
        </ul>
      </div>
    </div>
  </div>
  


<script>
    $(document).ready(function () {
      // Show icons on hover
      $('.value-item').hover(
        function () {
          $(this).find('.action-icons').removeClass('d-none');
        },
        function () {
          $(this).find('.action-icons').addClass('d-none');
        }
      );
  
      // Click edit icon
      $('.edit-icon').on('click', function () {
        const li = $(this).closest('.value-item');
        li.find('.value-display').addClass('d-none');
        li.find('.edit-form').removeClass('d-none');
      });
  
      // Cancel edit
      $('.cancel-edit').on('click', function () {
        const li = $(this).closest('.value-item');
        li.find('.edit-form').addClass('d-none');
        li.find('.value-display').removeClass('d-none');
      });
    });
  </script>



  

@endsection