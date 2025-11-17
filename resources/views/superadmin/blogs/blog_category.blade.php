@extends('superadmin.navigation')
@section('content')
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15">
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Blogs Category') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Blogs') }}</a></li>
                        <li><a href="#">{{ get_phrase('Blogs Category') }}</a></li>
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
                            <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('superadmin.blogs.blog_category_store') }}">
                                @csrf 
                                <div class="form-row">
                        
                                    <div class="fpb-7">
                                        <label for="category_name" class="eForm-label">{{ get_phrase('Category Name') }}</label>
                                        <input type="text" class="form-control eForm-control" id="category_name" name = "category_name" required>
                                    </div>
                        
                                    <div class="fpb-7 pt-2">
                                        <button class="btn-form" type="submit">{{ get_phrase('Create') }}</button>
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
    @foreach ($categories as $count => $category)
    <div class="col-2">
        <div class="eSection-wrap">
            <div class="eMain" style="position: relative">
                <div class="adminTable-action">
                    <span
                    style="font-size: 15px; border-radius: 18px; position: absolute; top: -15px; right: -9px; cursor: pointer;"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    </span>
                    <ul
                      class="dropdown-menu dropdown-menu-end eDropdown-menu-2 eDropdown-table-action"
                    >
                      <li>
                        <a class="dropdown-item" href="javascript:;" onclick="rightModal('{{ route('superadmin.blogs.blog_category_edit', ['id' => $category->id]) }}', '{{ get_phrase('Edit Category') }}')">{{ get_phrase('Edit') }}</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('superadmin.blogs.blog_categoryDelete', ['id' => $category->id]) }}', 'undefined');">{{ get_phrase('Delete')}}</a>
                      </li>
                    </ul>
                </div> 
                <span style="font-size: 14px; font-weight: 600; color:#181c32;">{{$count +1 }}. </span>
                <span style="font-size: 14px; font-weight: 600; color:#181c32;">{{$category->category_name }}</span>
                
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection