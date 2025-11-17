@extends('superadmin.navigation')
@section('content')
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15">
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('All Blogs') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Blogs') }}</a></li>
                        <li><a href="#">{{ get_phrase('All Blogs') }}</a></li>
                    </ul>
                </div>
                <div class="export-btn-area">
                    <div class="export-btn-area">
                      <a href="{{ route('superadmin.blogs.add_blog') }}" class="export_btn" ><i class="bi bi-plus"></i>{{ get_phrase('Add Blog') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @foreach ($blogs as $blog)
    <div class="col-md-6">
      <div class="eCard">
        <div class="row g-0 align-items-center">
          <div class="col-md-4">
            <img
              src="{{ asset('public/assets/upload/blog/' . $blog->blog_thumbnail) }}"
              class="eCard-img-top img-fluid rounded-0"
              alt="..."
            />
          </div>
          <div class="col-md-8">
            <div class="eCard-body">
              <h5 class="eCard-title">{{$blog->blog_title}}</h5>
              <p class="eCard-text" style="min-height: 44px;">
                {{ $blog->category->category_name ?? 'No category' }}
              </p>
              <div class="adminTable-action" style="margin-left: 0;">
                <button
                  type="button"
                  class="eBtn eBtn-black dropdown-toggle"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                    {{get_phrase('Actions')}} 
                </button>
                <ul
                  class="dropdown-menu dropdown-menu-end eDropdown-menu-2 eDropdown-table-action"
                >
                  <li>
                    <a class="dropdown-item" href="{{ route('superadmin.blogs.edit_blog', ['id' => $blog->id]) }}"> {{get_phrase('Edit')}}</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('superadmin.blogs.delete_blog', ['id' => $blog->id]) }}', 'undefined');">{{get_phrase('Delete')}}</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  <div class="pagination p1">
    <ul>
      @if ($blogs->previousPageUrl())
          <a href="{{ $blogs->previousPageUrl() }}"><li><</li></a>
      @endif
      @for ($i = 1; $i <= $blogs->lastPage(); $i++)
          <a href="{{ $blogs->url($i) }}" class="{{ $blogs->currentPage() == $i ? 'is-active' : '' }}"><li>{{ $i }}</li></a>
      @endfor
      @if ($blogs->nextPageUrl())
          <a href="{{ $blogs->nextPageUrl() }}"><li>></li></a>
      @endif
    </ul>
  </div>
  </div>
@endsection