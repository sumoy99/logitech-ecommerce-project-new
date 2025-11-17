<form action="{{ route('superadmin.marquee.store') }}" method="POST" enctype="multipart/form-data" class="">
  @csrf
  
  <div class="mb-3">
    <label for="summernote" class="form-label">{{ get_phrase('Marquee Text') }}</label>
    <textarea class="form-control" id="summernote" name="title" rows="5"></textarea>
  </div>

  <div id="warrentyStatustFields">
        <div class="mb-3">
            <label for="position" class="form-label fw-semibold me-3">Position:</label>
            <select class="form-select form-control" name="position" required>
                <option value="">Select Position</option>
                <option value="top_header">Top Header</option>
                <option value="banner">Banner</option>
            </select>
        </div>
    </div>

  <!-- Status -->
  <div class="form-check form-switch mb-4">
    <input class="form-check-input" type="checkbox" id="status" name="status" checked>
    <label class="form-check-label" for="status">{{ get_phrase('Active Status') }}</label>
  </div>

  <!-- Submit -->
  <button type="submit" class="btn btn-primary w-100 py-2">
    <i class="bi bi-plus-circle me-1"></i> {{ get_phrase('Add Marquee') }}
  </button>
</form>