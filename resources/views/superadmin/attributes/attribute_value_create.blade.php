<form action="{{ route('superadmin.attributes.attributeValueStore') }}" method="POST">
    @csrf
    <input type="hidden" name="attribute_id" value="{{ $id }}">
    
    <div class="mb-3">
        <label for="name" class="form-label">{{ get_phrase('Value Name') }}</label>
        <input type="text" name="value" class="form-control form-control-lg" placeholder="New value" required>
      </div>
    <!-- Submit -->
    <button type="submit" class="btn btn-primary w-100 py-2">
        <i class="bi bi-plus-circle me-1"></i> {{ get_phrase('Add Value') }}
      </button>
  </form>