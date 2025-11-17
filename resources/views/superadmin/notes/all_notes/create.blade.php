<form action="{{ route('superadmin.notes.all_notes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Parent Category -->
    <div class="mb-3">
        <label for="type_id" class="form-label">{{ get_phrase('Select Type') }}*</label>
        <select class="form-select form-select-lg" id="type_id" name="type_id">
        @foreach ($noteTypes as $noteType)
            <option value="{{ $noteType->id }}">{{ ucfirst($noteType->title) }}</option>
        @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="title" class="form-label">{{ get_phrase('Title') }}*</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="Note title" required>
        <small id="titleCharCount" class="text-muted">0 / 200 characters</small>
    </div>

    <div class="form-group">
        <label for="description">{{ get_phrase('Description') }}*</label>
        <textarea class="form-control" id="description" name="description" rows="5" style="height: 156px;"></textarea>
        <small id="desCharCount" class="text-muted">0 / 1000 characters</small>
    </div>

    <div class="mb-3">
        <label for="visibility" class="form-label">{{ get_phrase('Visibility') }}*</label>
        <select class="form-select form-select-lg" id="visibility" name="visibility">
            <option value="customer">All Users</option>
            <option value="customer">Customer</option>
            <option value="vendor">Vendor</option>
            <option value="marcent">Marcent</option>
        </select>
    </div>

    <div class="form-check form-switch mb-3">
        <input class="form-check-input" type="checkbox" name="status" id="status" checked>
        <label class="form-check-label" for="status">Active</label>
    </div>

    <button type="submit" class="btn btn-primary w-100">{{ get_phrase('Add Note') }}</button>
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
    setCharLimit('title', 'titleCharCount', 200);
    setCharLimit('description', 'desCharCount', 1000);
</script>
