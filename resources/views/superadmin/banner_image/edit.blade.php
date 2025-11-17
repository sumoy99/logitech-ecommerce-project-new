<form action="{{ route('superadmin.banner_image.update', ['id' => $banner->id] ) }}" method="POST" enctype="multipart/form-data" class="">
  @csrf
  <div class="mb-3">
    <label for="photo" class="form-label">{{ get_phrase('Banner Image') }}</label>
    <input class="form-control" type="file" id="image" name="image" accept="image/*">
    <div class="form-text">Max size: 3MB. Accepted: JPG, PNG</div>
  </div>

  <div class="mb-3">
    <label for="url" class="form-label">{{ get_phrase('URL') }}</label>
    <input type="text" class="form-control form-control-lg" id="url" value="{{$banner->url}}" name="url" placeholder="Enter redirect URL">
  </div>

  <!-- Status -->
  <div class="form-check form-switch mb-4">
    <input class="form-check-input" type="checkbox" id="status" name="status" {{ $banner->status == '1' ? 'checked' : '' }}>
    <label class="form-check-label" for="status">{{ get_phrase('Active Status') }}</label>
  </div>

  <!-- Submit -->
  <button type="submit" class="btn btn-primary w-100 py-2">
    <i class="bi bi-plus-circle me-1"></i> {{ get_phrase('Update Image') }}
  </button>
</form>