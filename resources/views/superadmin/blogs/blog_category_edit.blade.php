<div class="eForm-layouts">
    <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('superadmin.blogs.blog_category_update', ['id' => $blog_category->id]) }}">
        @csrf 
        <div class="form-row">
			<div class="fpb-7">
                <label for="category_name" class="eForm-label">{{ get_phrase('Category Name') }}</label>
                <input type="text" class="form-control eForm-control" id="category_name" name = "category_name" value="{{$blog_category->category_name }}" placeholder="{{$blog_category->category_name }}" required>
            </div>
            <div class="fpb-7 pt-2">
                <button class="btn-form" type="submit">{{ get_phrase('Update') }}</button>
            </div>
		</div>
	</form>
</div>