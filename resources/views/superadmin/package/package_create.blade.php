<div class="eForm-layouts">
    <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('superadmin.package.add') }}">
        @csrf 
        <div class="form-row">
			<div class="fpb-7">
                <label for="name" class="eForm-label">{{ get_phrase('Name') }}</label>
                <input type="text" class="form-control eForm-control" id="name" name = "name" placeholder="Provide package name" required>
            </div>
            
            <div class="fpb-7">
                <label for="price" class="eForm-label">{{ get_phrase('Package price') }}</label>
                <input type="number" min="0" class="form-control eForm-control" id="price" name = "price" placeholder="Provide package price" required>
            </div>

            <div class="fpb-7">
                <label for="status" class="eForm-label">{{ get_phrase('Status') }}</label>
                <select name="status" id="status" class="form-select eForm-select eChoice-multiple-with-remove">
                    <option value="">{{ get_phrase('Select a status') }}</option>
                    <option value="1">{{ get_phrase('Active') }}</option>
                    <option value="0">{{ get_phrase('Deactive') }}</option>
                </select>
            </div>
 
            <div class="fpb-7">
                <label for="features" class="eForm-label">{{ get_phrase('Features') }}</label>
                <div class="new_div">
                    <div class="row">
                        <div class="col-sm-9" id="inputContainer">
                            <input type="text" name="features[]" class="eForm-control form-control" placeholder="{{get_phrase('Write Features')}}">
                        </div>
                        <div class="col-sm-3 p-0">
                            <button type="button" onclick="appendInput()" class="btn btn-icon feature_btn btn-success"><i class="bi bi-plus"></i></button>
                            <button type="button"  onclick="removeInput()" class="btn btn-icon feature_btn btn-danger"> <i class="bi bi-dash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="fpb-7">
                <label for="description" class="eForm-label">{{ get_phrase('Description') }}</label>
                <textarea class="form-control eForm-control" id="address" name = "description" rows="2" placeholder="Provide a short description" required></textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="type" value="1" id="gridCheck1"/>
                <label class="eForm-check-label" for="gridCheck1">{{ get_phrase('Popular')}}</label>
              </div>
            <div class="fpb-7 pt-2">
                <button class="btn-form" type="submit">{{ get_phrase('Create package') }}</button>
            </div>
		</div>
	</form>
</div>

<script>
    function appendInput() {
      var container = document.getElementById('inputContainer');
      var newInput = document.createElement('input');
      newInput.setAttribute('type', 'text');
      newInput.setAttribute('placeholder', '{{get_phrase('Write service')}}');
      newInput.setAttribute('class', 'eForm-control mt-2');
      newInput.setAttribute('name', 'features[]');
      container.appendChild(newInput);
    }

    function removeInput() {
      var container = document.getElementById('inputContainer');
      var inputs = container.getElementsByTagName('input');
      if (inputs.length > 1) {
        container.removeChild(inputs[inputs.length - 1]);
      }
    }
</script>