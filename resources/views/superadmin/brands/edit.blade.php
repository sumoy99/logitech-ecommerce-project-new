<form action="{{ route('superadmin.brands.update', ['id' => $brand->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="name" class="form-label">{{ get_phrase('Brand Name') }}</label>
        <input type="text" name="name" id="name" value="{{ $brand->name }}" class="form-control" placeholder="Brand name" required>
        <small id="nameCharCount" class="text-muted">0 / 50 characters</small>
    </div>

    <div class="form-group">
        <label for="description">{{ get_phrase('Description') }}</label>
        <textarea class="form-control" id="description" name="description" rows="5">{{ $brand->description }}</textarea>
        <small id="descCharCount" class="text-muted">0 / 300 characters</small>
    </div>

    <div class="form-group">
        <label for="website" class="form-label">{{ get_phrase('Brand Website') }} (URL)</label>
        <input type="text" name="website" value="{{ $brand->website }}" class="form-control" placeholder="Website URL">
    </div>

    <div class="form-group">
        <label for="meta_title" class="form-label">{{ get_phrase('Meta title') }}</label>
        <input type="text" name="meta_title" id="meta_title" value="{{ $brand->meta_title }}"  class="form-control" placeholder="Meta title" required>
    </div>

    <div class="form-group">
        <label for="meta_description">{{ get_phrase('Meta Description') }}</label>
        <textarea class="form-control" id="meta_description" name="meta_description"  rows="5" style="height: 156px;">{{ $brand->meta_description }}</textarea>
        <small id="metaCharCount" class="text-muted">0 / 160 characters</small>
    </div>

    <!-- Image Upload -->
    <div class="form-group">
        <label for="logo" class="form-label">{{ get_phrase('Brand Logo') }}</label>
        <input class="form-control" type="file" id="logo" name="logo" accept="image/*" onchange="previewLogo(this)">
        <div class="form-text">Max size: 2MB. Accepted: JPG, PNG</div>

        {{-- Image preview --}}
        <div class="mt-3">
            <img id="logoPreview" src="{{ $brand->logo ? asset('assets/upload/brands/' . $brand->logo) : asset('assets/backend/assets/img/placeholder.png') }}" alt="Current Logo" height="80" style="border: 1px solid #ddd; padding: 5px;">
        </div>
    </div>

    <div class="form-check form-switch mb-3">
        <input class="form-check-input" type="checkbox" name="status" id="status" {{ $brand->status ? 'checked' : '' }}>
        <label class="form-check-label" for="status">Active</label>
    </div>

    <button type="submit" class="btn btn-primary w-100">Update Brand</button>
</form>

{{-- JS for live preview --}}
<script>
    function previewLogo(input) {
        const preview = document.getElementById('logoPreview');
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
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
