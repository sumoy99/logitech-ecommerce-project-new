<form action="{{ route('superadmin.category.sub_category_store') }}" method="POST" enctype="multipart/form-data" class="">
    @csrf
  
    <h4 class="mb-4 text-primary fw-semibold">{{$category->name}}</h4>
    
    <!-- Parent Category -->
    <input type="hidden" class="form-control form-control-lg" id="parent_id" name="parent_id" value="{{$category->id}}">

    <!-- Category Name -->
    <div class="mb-3">
      <label for="name" class="form-label">{{ get_phrase('Subcategory Name') }}</label>
      <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Type category name" required>
    </div>
    
    <!-- Image Upload -->
    <div class="mb-3">
      <label for="photo" class="form-label">{{ get_phrase('Category Image') }}</label>
      <input class="form-control" type="file" id="image" name="image" accept="image/*">
      <div class="form-text">Max size: 2MB. Accepted: JPG, PNG</div>
    </div>

    <div class="form-group mb-3">
      <label for="meta_title" class="form-label">{{ get_phrase('Meta Title') }}</label>
      <input type="text" id="meta_title" name="meta_title" class="form-control" placeholder="Meta title" required>
      <small id="metatitleCharCount" class="text-muted">0 / 100 characters</small>
    </div>

    <div class="form-group mb-3">
        <label for="meta_desc">{{ get_phrase('Meta Description') }}</label>
        <textarea class="form-control" id="meta_desc" name="meta_desc" rows="5" style="height: 156px;"></textarea>
        <small id="descCharCount" class="text-muted">0 / 200 characters</small>
    </div>

    <div class="form-group mb-3">
        <label for="seo_desc">{{ get_phrase('SEO Description') }}</label>
        <textarea class="form-control" id="seo_desc" name="seo_desc" rows="5" style="height: 156px;"></textarea>
        <small id="seo_descCharCount" class="text-muted">0 / 200 characters</small>
    </div>

    <!-- Status -->
    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" id="status" name="status" checked>
      <label class="form-check-label" for="status">{{ get_phrase('Active Status') }}</label>
    </div>
  
    <!-- Submit -->
    <button type="submit" class="btn btn-primary w-100 py-2">
      <i class="bi bi-plus-circle me-1"></i> {{ get_phrase('Add Sub Category') }}
    </button>
  </form>

<script>
  // JS for text Character limit
    function setCharLimit(textareaId, counterId, maxChars) {
        const textarea = document.getElementById(textareaId);
        const counter = document.getElementById(counterId);

        textarea.addEventListener('input', function () {
            let length = this.value.length;
            if (length > maxChars) {
                this.value = this.value.substring(0, maxChars);
                length = maxChars;
            }

            counter.textContent = `${length} / ${maxChars} characters`;
            counter.style.color = length === maxChars ? 'red' : 'gray';
        });
    }

    // Apply limit for both textareas
    setCharLimit('meta_title', 'metatitleCharCount', 100);
    setCharLimit('meta_desc', 'descCharCount', 200);
    setCharLimit('seo_desc', 'seo_descCharCount', 200);
</script>
  