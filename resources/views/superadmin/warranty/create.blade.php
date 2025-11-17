<form action="{{ route('superadmin.warranty.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group mb-3">
        <label for="title" class="form-label">{{ get_phrase('Title') }}</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="Warranty title" required>
        <small id="titleCharCount" class="text-muted">0 / 50 characters</small>
    </div>

    <!-- Image Upload with Live Preview -->
    <div class="form-group">
        <label for="logo" class="form-label">{{ get_phrase('Logo') }}</label>
        <input class="form-control" type="file" id="logo" name="logo" accept="image/*" onchange="previewLogo(this)">
        <div class="form-text">Max size: 2MB. Accepted: JPG, PNG</div>

        {{-- Live preview area --}}
        <div class="mt-3">
            <img id="logoPreview" src="#" alt="Preview" height="80" style="display: none; border: 1px solid #ddd; padding: 5px;">
        </div>
    </div>

    <button type="submit" class="btn btn-primary w-100">{{ get_phrase('Add Warranty') }}</button>
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
    setCharLimit('title', 'titleCharCount', 50);
</script>
