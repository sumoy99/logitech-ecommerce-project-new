@extends('superadmin.navigation')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css">
<style>
    .label-info {
        background-color: rgb(111, 16, 87);
        padding: 3px 10px 4px 10px;
        font-size: 11px;
        border-radius: 5px;
    }

    .bootstrap-tagsinput {
        width: 100%;
        height: 40px;
    }
</style>
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
                      <a href="{{ route('superadmin.blogs.all_blog') }}" class="export_btn" ><i class="fa-solid fa-backward" style="margin-right: 5px;"></i> {{ get_phrase('Back') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="eSection-wrap">
        <div class="eMain">
            <div class="row">
                <div class="col-12">
                    <div class="eSection-wrap">
                        <div class="eMain">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm"
                                        action="{{ route('superadmin.blogs.update_blog' , ['id' => $blogs->id]) }}">
                                        @csrf
                                        <div class="fpb-7">
                                            <label for="blog_title" class="eForm-label">{{get_phrase(' Blog Title')}} </label>
                                            <input type="text" class="form-control eForm-control" id="blog_title"
                                                name="blog_title" maxlength="80" placeholder="Provide your blog title"  value="{{$blogs->blog_title}}" required>
                                            @if ($errors->has('blog_title'))
                                             <span class="text-danger">{{$errors->first('blog_title')}}</span>
                                             @endif
                                        </div>

                                        <div class="fpb-7">
                                            <label for="blog_subtitle" class="eForm-label">{{get_phrase(' Blog Subtitle')}} </label>
                                            <input type="text" class="form-control eForm-control" id="blog_subtitle"
                                                name="blog_subtitle" maxlength="120" value="{{$blogs->blog_subtitle}}" placeholder="Provide your blog subtitle" required>
                                            @if ($errors->has('blog_subtitle'))
                                             <span class="text-danger">{{$errors->first('blog_subtitle')}}</span>
                                             @endif
                                        </div>

                                        <div class="fpb-7">
                                            <label for="blog_category" class="eForm-label"> {{get_phrase(' Blog Category')}}</label>

                                            <select name="blog_category" class="form-select eForm-select eChoice-multiple-without-remove" required>
                                                <option disabled>Select a category</option>
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}" {{ $blogs->blog_category == $category->id ?  'selected':'' }}>{{$category->category_name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('blog_category'))
                                                <span class="text-danger">{{$errors->first('blog_category')}}</span>
                                                @endif

                                        </div>

                                        <div class="fpb-7">
                                            <label for="blog_keywords" class="eForm-label">Keyword</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control eForm-control" id="blog_keywords"
                                                    name="blog_keywords[]" value="{{$blogs->blog_keywords}}" data-role="tagsinput" >

                                                @if ($errors->has('blog_keywords'))
                                                <span class="text-danger">{{$errors->first('blog_keywords')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="fpb-7">
                                            <label for="blog_description" class="eForm-label">{{get_phrase(' Blog Description')}}</label>
                                            <div class="form-group">
                                                <textarea name="blog_description"  id="summernote">{!! $blogs->blog_description !!}</textarea>
                                            </div>
                                        </div>


                                        <div class="fpb-7">
                                            <label for="blog_date" class="eForm-label">{{get_phrase(' Blog Date')}} </label>
                                            <input type="date" class="form-control eForm-control" id="blog_date"
                                                name="blog_date" maxlength="80" value="{{ $blogs->blog_date }}" placeholder="Provide your blog date" required>
                                            @if ($errors->has('blog_date'))
                                             <span class="text-danger">{{$errors->first('blog_date')}}</span>
                                             @endif
                                        </div>

                                        <div class="fpb-7">
                                            <label for="blog_thumbnail" class="eForm-label">{{get_phrase(' Blog Thumbnail')}}</label>
                                            <div class="form-group">
                                                <input type="file" class="form-control eForm-control" id="blog_thumbnail"
                                                name="blog_thumbnail" value="{{ $blogs->blog_thumbnail }}" accept="image/*" >
                                                @if ($errors->has('blog_thumbnail'))
                                                <span class="text-danger">{{$errors->first('blog_thumbnail')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="fpb-7 pt-2">
                                            <button type="submit" class="btn-form">{{get_phrase('Update')}} </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script>
    $('#summernote').summernote({
        placeholder: 'Write here your blog desciption...',
        tabsize: 2,
        height: 300,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
</script>
@endsection