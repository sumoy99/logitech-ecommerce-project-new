<form method="POST" enctype="multipart/form-data"  class="d-block ajaxForm" action="{{ route('superadmin.about.testimonial_update', ['id' => $testimonials->id]) }}">
    @csrf
    <div class="fpb-7">
        <label for="name" class="eForm-label">Client Name</label>
        <input type="text" class="form-control eForm-control" id="title" name = "name" maxlength="50" value="{{ $testimonials->name }}">    
    </div> 
    <div class="fpb-7">
        <label for="designation" class="eForm-label">{{ get_phrase('Designation') }}</label>
        <input type="text" class="form-control eForm-control" id="designation" maxlength="50" name = "designation" placeholder="Provide designation" value="{{ $testimonials->designation }}" required>
    </div>
    <div class="fpb-7">
        <label for="description" class="eForm-label">Description</label>
        <textarea type="text" class="form-control eForm-control" maxlength="200" id="description" name = "description">{{ $testimonials->description }}</textarea>  
    </div> 
    <div class="fpb-7">
        <label for="image" class="eForm-label">Client Image (400x400)</label>
        <input type="file" class="form-control eForm-control" id="image" name = "image" value="{{ $testimonials->image }}">    
    </div> 

     <div class="fpb-7 pt-2">
        <button type="submit" class="btn-form">Update</button>
    </div>
</form>