<form action="{{ route('superadmin.attributes.attributes_store') }}" method="POST" enctype="multipart/form-data" class="">
    @csrf
    <!-- Attributes Name -->
    <div class="mb-3">
      <label for="name" class="form-label">{{ get_phrase('Attributes Name') }}</label>
      <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Type attributes name" required>
    </div>

    <div class="form-group">
        <label for="type">Input Type</label>
        <select name="type" class="form-control">
            <option value="text">Text</option>
            <option value="select">Dropdown</option>
            <option value="checkbox">Checkbox</option>
            <option value="radio">Radio</option>
        </select>
    </div>

    <!-- Submit -->
    <button type="submit" class="btn btn-primary w-100 py-2">
      <i class="bi bi-plus-circle me-1"></i> {{ get_phrase('Add Attributes') }}
    </button>
  </form>
  