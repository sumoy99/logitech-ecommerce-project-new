<form action="{{ route('superadmin.marquee.update', ['id' => $marquee->id]) }}" method="POST" enctype="multipart/form-data" class="">
  @csrf
  
  <div class="mb-3">
    <label for="title" class="form-label">{{ get_phrase('Marquee Title') }}</label>
    <input type="text" class="form-control form-control-lg" id="title" value="{{$marquee->title}}" name="title" placeholder="Enter Marquee Title">
  </div>

  <div id="warrentyStatustFields">
      <div class="mb-3">
          <label for="position" class="form-label fw-semibold me-3">Position:</label>
          <select class="form-select form-control" name="position" required>
              <option value="">Select Position</option>
              <option value="top_header" {{ $marquee->position == 'top_header' ? 'selected' : '' }}>Top Header</option>
              <option value="banner" {{ $marquee->position == 'banner' ? 'selected' : '' }}>Banner</option>
          </select>
      </div>
  </div>

  <!-- Status -->
  <div class="form-check form-switch mb-4">
    <input class="form-check-input" type="checkbox" id="status" name="status"  {{ $marquee->status == '1' ? 'checked' : '' }}>
    <label class="form-check-label" for="status">{{ get_phrase('Active Status') }}</label>
  </div>

  <!-- Submit -->
  <button type="submit" class="btn btn-primary w-100 py-2">
    <i class="bi bi-plus-circle me-1"></i> {{ get_phrase('Update Marquee') }}
  </button>
</form>