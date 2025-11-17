<form action="{{ route('superadmin.brands.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group mb-3">
        <label for="name" class="form-label">{{ get_phrase('Brand Name') }}</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Brand name" required>
        <small id="nameCharCount" class="text-muted">0 / 50 characters</small>
    </div>

    <div class="form-group mb-3">
        <label for="description">{{ get_phrase('Description') }}</label>
        <textarea class="form-control" id="description" name="description" rows="5" style="height: 156px;"></textarea>
        <small id="descCharCount" class="text-muted">0 / 300 characters</small>
    </div>

    <div class="form-group">
        <label for="website" class="form-label">{{ get_phrase('Brand Website') }} (URL)</label>
        <input type="text" name="website" class="form-control" placeholder="Website URL">
    </div>

    <div class="form-group">
        <label for="meta_title" class="form-label">{{ get_phrase('Meta title') }}</label>
        <input type="text" name="meta_title" class="form-control" placeholder="Meta title" required>
    </div>

    <div class="form-group">
        <label for="meta_description">{{ get_phrase('Meta Description') }}</label>
        <textarea class="form-control" id="meta_description" name="meta_description" rows="5" style="height: 156px;"></textarea>
        <small id="metaCharCount" class="text-muted">0 / 160 characters</small>
    </div>

    <!-- Image Upload with Live Preview -->
    <div class="form-group">
        <label for="logo" class="form-label">{{ get_phrase('Brand Logo') }}</label>
        <input class="form-control" type="file" id="logo" name="logo" accept="image/*" onchange="previewLogo(this)">
        <div class="form-text">Max size: 2MB. Accepted: JPG, PNG</div>

        {{-- Live preview area --}}
        <div class="mt-3">
            <img id="logoPreview" src="#" alt="Preview" height="80" style="display: none; border: 1px solid #ddd; padding: 5px;">
        </div>
    </div>

    <div class="form-check form-switch mb-3">
        <input class="form-check-input" type="checkbox" name="status" id="status" checked>
        <label class="form-check-label" for="status">Active</label>
    </div>

    <button type="submit" class="btn btn-primary w-100">{{ get_phrase('Add Brands') }}</button>
</form>


<script>
    // JS for image preview 
    function previewLogo(input) {
        const preview = document.getElementById('logoPreview');
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            preview.src = '#';
        }
    }
    
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
    setCharLimit('name', 'nameCharCount', 50);
    setCharLimit('description', 'descCharCount', 300);
    setCharLimit('meta_description', 'metaCharCount', 160);
</script>
