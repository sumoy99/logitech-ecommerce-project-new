<ul class="category-tree-list ps-0">
  @foreach($categories as $cat)
    <li class="category-node">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
          <button class="toggle-btn btn btn-sm btn-link p-0 me-1" 
                  data-bs-toggle="collapse" 
                  data-bs-target="#collapse-{{ $cat->id }}" 
                  aria-expanded="false">
            @if($cat->children->count() > 0)
              <i class="fas fa-caret-right text-muted"></i>
            @endif
          </button>

          <img src="{{ $cat->image ? asset('assets/upload/category/' . $cat->image) : asset('assets/backend/assets/img/placeholder.png') }}" style="height: 20px;
    width: 20px;
    border-radius: 50%;
    margin-right: 5px;
}" class="card-img-top category-img" alt="Category Image">
          <span class="fw-semibold small">{{ $cat->name }}</span>
          <span class="badge ms-2 {{ $cat->status ? 'bg-success' : 'bg-danger' }}">
            {{ $cat->status ? 'Active' : 'Inactive' }}
          </span>
        </div>

        <div>
          <a href="javascript:;" onclick="rightModal('{{ route('superadmin.category.sub_category_add', ['id' => $cat->id]) }}', 'Add sub category')" class="text-primary me-2"><i class="fa fa-plus"></i></a>
          <a href="javascript:;" onclick="rightModal('{{ route('superadmin.category.sub_category_edit', ['id' => $cat->id]) }}', 'Edit sub category')" class="text-secondary me-2"><i class="fas fa-edit"></i></a>
          <a href="javascript:;" class="text-danger revert-btn" data-url="{{ route('superadmin.category.sub_category_delete', ['id' => $cat->id]) }}"><i class="fas fa-trash-alt"></i></a>
        </div>
      </div>

      @if($cat->children->count() > 0)
        <div class="collapse ps-4 mt-1" id="collapse-{{ $cat->id }}">
          @include('superadmin.category._subcategory_tree', ['categories' => $cat->children])
        </div>
      @endif
    </li>
  @endforeach
</ul>
