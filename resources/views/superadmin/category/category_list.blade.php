@extends('superadmin.navigation')
@section('content') 
<style>
.category-tree-list {
  list-style: none;
  margin: 0;
  padding: 0;
}

.category-node {
  padding: 4px 0;
  position: relative;
}

.category-node .toggle-btn {
  width: 18px;
  height: 18px;
  text-align: center;
  line-height: 18px;
  border: none;
}

.category-node .toggle-btn:focus {
  box-shadow: none;
}

.category-node .collapse {
  border-left: 1px dashed #ddd;
  margin-left: 8px;
  padding-left: 8px;
}

.category-node i.fa-caret-right {
  transition: transform 0.2s ease;
}

.category-node .collapse.show ~ .toggle-btn i.fa-caret-right {
  transform: rotate(90deg);
}



</style>

<div class="page-header d-flex justify-content-between align-items-center">
    <div class="d-flex justify-content-between">
      <h3 class="fw-bold mb-3">{{get_phrase('Category')}}</h3>
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
          <a href="#">{{ get_phrase('Category List') }}</a>
        </li>
      </ul>
    </div>

    <a href="javascript:;" class="btn btn-secondary" onclick="rightModal('{{ route('superadmin.category.create_category') }}', 'Add Category')"data-bs-toggle="tooltip" data-bs-placement="top" title="Add"><i class="fa fa-plus"></i> {{ get_phrase('Add Category') }}
    </a>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4 col-sm-6">
                <form method="GET" action="{{ route('superadmin.category.category_list') }}">
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
        <div class="row">
          @forelse($categories as $category)
            <div class="col-md-6 col-lg-4 col-xl-4 mb-4">
              <div class="card category-card shadow-sm border-0">
                <img src="{{ $category->image ? asset('assets/upload/category/' . $category->image) : asset('assets/backend/assets/img/placeholder.png') }}"
                    class="card-img-top category-img" alt="Category Image">

                <div class="card-body pb-2">
                  <h6 class="fw-semibold d-flex justify-content-between align-items-center mb-3">
                    {{ $category->name }}
                    <span class="badge {{ $category->status ? 'bg-success' : 'bg-danger' }}">
                      {{ $category->status ? 'Active' : 'Inactive' }}
                    </span>
                  </h6>

                  <div class="category-tree">
                    @include('superadmin.category._subcategory_tree', ['categories' => $category->children])
                  </div>
                </div>

                <div class="card-footer bg-white text-center py-2 border-top">
                  <a href="javascript:;" onclick="rightModal('{{ route('superadmin.category.sub_category_add', ['id' => $category->id]) }}', 'Add sub category')" class="btn btn-sm btn-outline-primary me-1"><i class="fa fa-plus"></i></a>
                  <a href="javascript:;" onclick="rightModal('{{ route('superadmin.category.edit_category', ['id' => $category->id]) }}', 'Edit category')" class="btn btn-sm btn-outline-secondary me-1"><i class="fas fa-edit"></i></a>
                  <a href="javascript:;" class="btn btn-sm btn-outline-danger revert-btn" data-url="{{ route('superadmin.category.category_delete', ['id' => $category->id]) }}"><i class="fas fa-trash-alt"></i></a>
                </div>
              </div>
            </div>


          @empty
            <div class="text-center text-muted py-5">{{get_phrase('No categories found')}}.</div>
          @endforelse
        
          <div class="pagination p1">
            <ul>
              @if ($categories->previousPageUrl())
                  <a href="{{ $categories->previousPageUrl() }}"><li><</li></a>
              @endif
              @for ($i = 1; $i <= $categories->lastPage(); $i++)
                  <a href="{{ $categories->url($i) }}" class="{{ $categories->currentPage() == $i ? 'is-active' : '' }}"><li>{{ $i }}</li></a>
              @endfor
              @if ($categories->nextPageUrl())
                  <a href="{{ $categories->nextPageUrl() }}"><li>></li></a>
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

