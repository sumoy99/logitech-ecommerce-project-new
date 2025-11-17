<form action="{{ route('superadmin.company_logo.update',  ['id' => $company_logo->id]) }}" method="POST" enctype="multipart/form-data" class="">
  @csrf
  <div class="mb-3">
    <label for="logo" class="form-label">{{ get_phrase('Company Logo') }}</label>
    <input class="form-control" type="file" id="logo" name="logo" accept="image/*">
    <div class="form-text">Max size: 3MB. Accepted: JPG, PNG</div>
  </div>

  <!-- Status -->
  <div class="form-check form-switch mb-4">
    <input class="form-check-input" type="checkbox" id="status" name="status"  {{ $company_logo->status == '1' ? 'checked' : '' }}>
    <label class="form-check-label" for="status">{{ get_phrase('Active Status') }}</label>
  </div>

  <!-- Submit -->
  <button type="submit" class="btn btn-primary w-100 py-2">
    <i class="bi bi-plus-circle me-1"></i> {{ get_phrase('Update') }}
  </button>
</form>