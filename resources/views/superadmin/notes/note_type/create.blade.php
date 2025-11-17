<form action="{{ route('superadmin.notes.note_type.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group mb-3">
        <label for="title" class="form-label">{{ get_phrase('Type Name') }}</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="Type name" required>
        <small id="titleCharCount" class="text-muted">0 / 30 characters</small>
    </div>

    <div class="form-check form-switch mb-3">
        <input class="form-check-input" type="checkbox" name="status" id="status" checked>
        <label class="form-check-label" for="status">Active</label>
    </div>

    <button type="submit" class="btn btn-primary w-100">{{ get_phrase('Add Types') }}</button>
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
    setCharLimit('title', 'titleCharCount', 50);
</script>
