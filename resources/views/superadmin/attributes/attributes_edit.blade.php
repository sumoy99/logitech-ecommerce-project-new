<form action="{{ route('superadmin.attributes.attributes_update', ['id' => $attribute->id]) }}" method="POST" enctype="multipart/form-data" class="">
    @csrf
    <!-- Attributes Name -->
    <div class="mb-3">
      <label for="name" class="form-label">{{ get_phrase('Attributes Name') }}</label>
      <input type="text" value="{{$attribute->name}}" class="form-control form-control-lg" id="name" name="name" placeholder="Type attributes name" required>
    </div>

    <div class="form-group">
        <label for="type">Input Type</label>
        <select name="type" class="form-control">
            <option {{$attribute->type == 'text' ? 'selected' : ''}}value="text">Text</option>
            <option {{$attribute->type == 'select' ? 'selected' : ''}} value="select">Dropdown</option>
            <option {{$attribute->type == 'checkbox' ? 'selected' : ''}} value="checkbox">Checkbox</option>
            <option {{$attribute->type == 'radio' ? 'selected' : ''}} value="radio">Radio</option>
        </select>
    </div>

    <!-- Submit -->
    <button type="submit" class="btn btn-primary w-100 py-2">
      <i class="bi bi-plus-circle me-1"></i> {{ get_phrase('Update Attributes') }}
    </button>
  </form>
  