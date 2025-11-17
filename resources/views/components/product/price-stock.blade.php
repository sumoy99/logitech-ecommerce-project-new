<style>
/* Simple switch style */
.switch {
  position: relative;
  display: inline-block;
  width: 45px;
  height: 24px;
}
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}
/* .slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0;
  right: 0; bottom: 0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 24px;
} */
.slider:before {
  position: absolute;
  content: "";
  height: 18px; width: 18px;
  left: 3px; bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}
/* input:checked + .slider {
  background-color: #28a745;
} */
input:checked + .slider:before {
  transform: translateX(20px);
}
</style>


<div class="tab-pane fade" id="price-stock" role="tabpanel" aria-labelledby="v-pills-messages-tab-nobd">
    <div class="card-header2  mb-4" style="">
        <h4 class="card-title text-secondary">Product Price + Stock</h4>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label fw-semibold me-3">Price:*</label>
        <input type="number" name="price" id="price" class="form-control form-control-sm" value="{{ old('price', $product->price ?? '') }}" placeholder="Price" required>
    </div>
    <div class="form-switch-wrapper d-flex mb-3">
        <div class="col-3">
            <label class="form-label fw-semibold d-block mb-2">Discount?</label>
        </div>
        <div class="col-9">
            <label class="switch">
                <input 
                    type="checkbox" 
                    id="discountToggle" 
                    name="discount"
                    {{ !empty(old('discount_price', $product->discount_price ?? '')) ? 'checked' : '' }}>
                <span class="slider"></span>
            </label>
        </div>
    </div>

    <div id="discountFields" style="{{ empty(old('discount_price', $product->discount_price ?? '')) ? 'display:none;' : '' }}" >
        <div class="mb-3">
            <label for="discount_price" class="form-label fw-semibold me-3">Discount Price:</label>
            <input type="number" value="{{ old('discount_price', $product->discount_price ?? '') }}" name="discount_price" id="discount_price"
                class="form-control form-control-sm"
                placeholder="Enter discount price">
        </div>

        <div class="mb-3">
            <label for="discount_date_range" class="form-label fw-semibold me-3">Discount Date Range:</label>
            <input type="text" name="discount_date_range" value="{{ old('discount_date_range', $product->discount_date_range ?? '') }}" id="discount_date_range"
                class="form-control form-control-sm"
                placeholder="Select date range">
        </div>
            
        <div class="mb-3">
            <label for="discount_type" class="form-label fw-semibold me-3">Discount type</label>
            <select class="form-select form-control" name="discount_type" id="defaultSelect">
                    <option value="flat" {{ old('discount_type', $product->discount_type ?? '') == 'flat' ? 'selected' : '' }}>Flat</option>
                    <option value="percent" {{ old('discount_type', $product->discount_type ?? '') == 'percent'  ? 'selected' : '' }}>Percent</option>
            </select>
        </div>
    </div>

    <div class="form-switch-wrapper d-flex mb-3">
        <div class="col-3">
            <label class="form-label fw-semibold d-block mb-2">Show Price status?</label>
        </div>
        <div class="col-9">
            <label class="switch">
            <input type="checkbox" {{ !empty(old('price_status', $product->price_status ?? '')) ? 'checked' : '' }} id="priceStatusToggle">
            <span class="slider"></span>
            </label>
        </div>
    </div>

    <div id="priceStatustFields" style="{{ empty(old('price_status', $product->price_status ?? '')) ? 'display:none;' : '' }}">
        <div class="mb-3">
            <label for="price_status" class="form-label fw-semibold me-3">Price status:</label>
            <select class="form-select form-control" name="price_status" id="defaultSelect">
                <option value="official"{{ old('price_status', $product->price_status ?? '') == 'official' ? 'selected' : '' }}>Official</option>
                <option value="unofficial"{{ old('price_status', $product->price_status ?? '') == 'unofficial' ? 'selected' : '' }}>Unofficial</option>
                <option value="expected"{{ old('price_status', $product->price_status ?? '') == 'expected' ? 'selected' : '' }}>Expected</option>
            </select>
        </div>
    </div>

    <div class="mb-3">
      <label for="colors" class="form-label fw-semibold me-3">Colors:</label>
      <div class="position-relative">
          <select id="colorSelect" name="colors[]" multiple
              class="select2 form-select shadow-sm rounded-3"
              data-placeholder="Select Colors...">
              @foreach($colors as $color)
                  <option value="{{ $color->id }}"
                      @if(isset($productColors) && in_array($color->id, $productColors->pluck('color_id')->toArray())) selected @endif>
                      {{ $color->name }}
                  </option>
              @endforeach
          </select>
      </div>
  </div>

    {{-- Dynamic color-wise image upload section --}}
    <div id="colorImageSections"></div>
    
    <div class="mb-3">
        <label class="form-label fw-semibold me-3">Select Attributes</label>
        <div class="position-relative">
            <select id="attributeSelect" multiple class="select2 form-select shadow-sm rounded-3"
                    data-placeholder="Select attributes...">
                @foreach($attributes as $attribute)
                    <option value="{{ $attribute->id }}" 
                        {{ old('productAttribute', $productAttribute->attribute_id ?? '') == $attribute->id ? 'selected' : '' }}>
                        {{ $attribute->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Dynamic fields will be added here -->
    <div id="attributeFieldsContainer"></div>

    <div class="card-header2  mb-4" style="">
        <h4 class="card-title text-secondary">Stock</h4>
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label fw-semibold me-3">Stock Quantity:*</label>
        <input type="number" name="stock" id="stock" class="form-control form-control-sm" value="{{ old('stock', $product->stock ?? '') }}" placeholder="Enter stock quantity" required>
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label fw-semibold me-3">Stock status:*</label>
        <select class="form-select form-control" name="stock_status" required id="defaultSelect">
                <option value="In stock" {{ old('stock_status', $product->stock_status ?? '') == 'In stock' ? 'selected' : '' }}>In stock</option>
                <option value="Out of stock"{{ old('stock_status', $product->stock_status ?? '') == 'Out of stock' ? 'selected' : '' }}>Out of stock</option>
                <option value="Upcoming"{{ old('stock_status', $product->stock_status ?? '') == 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
        </select>
    </div>

    <div class="card-header2  mb-4" style="">
        <h4 class="card-title text-secondary">Low Stock Quantity Warning</h4>
    </div>

    <div class="mb-3">
        <label for="low_stock_warning" class="form-label fw-semibold me-3">Quantity*:</label>
        <input type="number" value="{{ old('low_stock_warning', $product->low_stock_warning ?? '') }}" name="low_stock_warning" id="low_stock_warning"
            class="form-control form-control-sm"
            placeholder="Quantity" required>
    </div>

    <div class="card-header2  mb-4" style="">
        <h4 class="card-title text-secondary">Stock Visibility State</h4>
    </div>

    <div class="form-switch-wrapper d-flex mb-3">
        <div class="col-3">
            <label class="form-label fw-semibold d-block mb-2">Show Stock Quantity</label>
        </div>
        <div class="col-9">
            <label class="switch">
            <input type="checkbox" id="stockQuantity" {{ old('stock_visibilty_state', $product->stock_visibilty_state ?? '') == '1' ? 'checked' : '' }} name="show_stock">
            <span class="slider"></span>
            </label>
        </div>
    </div>

    <div class="form-switch-wrapper d-flex mb-3">
        <div class="col-3">
            <label class="form-label fw-semibold d-block mb-2">Hide Stock</label>
        </div>
        <div class="col-9">
            <label class="switch">
                <input type="checkbox" id="hideStock" {{ old('stock_visibilty_state', $product->stock_visibilty_state ?? '') == '0' ? 'checked' : '' }} name="hide_stock">
                <span class="slider"></span>
            </label>
        </div>
    </div>

    <div class="card-header2  mb-4" style="">
        <h4 class="card-title text-secondary">Vat & TAX</h4>
    </div>
    @if (Route::is('superadmin.products.edit'))
        @php
            $vats = json_decode($product->vat);
            $taxes = json_decode($product->tax);
        @endphp
    @endif
    
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="vat" class="form-label fw-semibold me-3">Vat:</label>
                <input type="number" name="vat" id="vat" class="form-control form-control-sm" value="{{ old('vat', $vats->vat ?? '') }}" placeholder="Enter vat">
            </div>
        </div>
        <div class="col-6">
            <label for="stock" class="form-label fw-semibold me-3">Type:</label>
            <select class="form-select form-control" name="vat_type" id="defaultSelect">
                    <option value="flat" {{ old('vat_type', $vats->type ?? '') == 'flat' ? 'selected' : '' }}>Flat</option>
                    <option value="percent" {{ old('vat_type', $vats->type ?? '') == 'percent' ? 'selected' : '' }}>Percent</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="tax" class="form-label fw-semibold me-3">Tax:</label>
                <input type="number" name="tax" id="tax" class="form-control form-control-sm" value="{{ old('tax', $taxes->tax ?? '') }}" placeholder="Enter tax">
            </div>
        </div>
        <div class="col-6">
            <label for="stock" class="form-label fw-semibold me-3">Type:</label>
            <select class="form-select form-control" name="tax_type" id="defaultSelect">
                    <option value="flat" {{ old('tax_type', $taxes->type ?? '') == 'percent' ? 'selected' : '' }}>Flat</option>
                    <option value="percent" {{ old('tax_type', $taxes->type ?? '') == 'percent' ? 'selected' : '' }}>Percent</option>
            </select>
        </div>
    </div>

</div>
<script>
$(document).ready(function() {
    // Initialize Select2
    $('#colorSelect').select2({
        placeholder: "Select Colors...",
        allowClear: true
    });

    const container = document.getElementById('colorImageSections');

    // On color select change
    $('#colorSelect').on('change', function() {
        const selectedColors = $(this).val() || []; // array of selected color IDs
        container.innerHTML = ''; // clear previous sections

        selectedColors.forEach(colorId => {
            const colorName = $(this).find('option[value="'+colorId+'"]').text();

            const section = document.createElement('div');
            section.classList.add('mb-4', 'p-3', 'border', 'rounded');
            section.innerHTML = `
                <h6 class="fw-bold mb-2">${colorName} Images</h6>
                <input type="file" name="color_images[${colorId}][]" multiple accept="image/*"
                       class="form-control mb-2 color-image-input" data-color-id="${colorId}">
                <div class="preview-area d-flex flex-wrap gap-2" id="preview-${colorId}"></div>
                <button type="button" class="btn btn-sm btn-danger mt-2 remove-all" data-color-id="${colorId}">
                    Remove All ${colorName} Images
                </button>
            `;
            container.appendChild(section);
        });
    });

    // Image preview
    $(document).on('change', '.color-image-input', function() {
        const colorId = $(this).data('color-id');
        const previewDiv = document.getElementById(`preview-${colorId}`);
        previewDiv.innerHTML = '';

        Array.from(this.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const imgContainer = document.createElement('div');
                imgContainer.classList.add('position-relative');

                imgContainer.innerHTML = `
                    <img src="${event.target.result}" class="img-thumbnail me-2 mb-2" 
                         style="width:100px;height:100px;object-fit:cover;">
                    <button type="button" 
                            class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image"
                            data-index="${index}" data-color-id="${colorId}">
                        &times;
                    </button>
                `;
                previewDiv.appendChild(imgContainer);
            };
            reader.readAsDataURL(file);
        });
    });

    // Remove all images
    $(document).on('click', '.remove-all', function() {
        const colorId = $(this).data('color-id');
        $(`#preview-${colorId}`).html('');
        $(`.color-image-input[data-color-id='${colorId}']`).val('');
    });

    // Remove single image
    $(document).on('click', '.remove-image', function() {
        $(this).closest('div.position-relative').remove();
        // Note: actual file input array is not modified; just for preview.
    });
});
</script>
<script>
  $(document).ready(function () {

    // Initialize date range picker
    $('#discount_date_range').daterangepicker({
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear',
        format: 'YYYY-MM-DD'
      }
    });

    // Show selected date range in input
    $('#discount_date_range').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('#discount_date_range').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });

    // Toggle discount fields visibility
    $('#discountToggle').on('change', function() {
      if ($(this).is(':checked')) {
        $('#discountFields').slideDown(200);
      } else {
        $('#discountFields').slideUp(200);
        $('#discount_price').val('');
        $('#discount_date_range').val('');
      }
    });

    $('#priceStatusToggle').on('change', function() {
      if ($(this).is(':checked')) {
        $('#priceStatustFields').slideDown(200);
      } else {
        $('#priceStatustFields').slideUp(200);
        $('#price_status').val('');
      }
    });

    $('#stockQuantity').on('change', function() {
      if ($(this).is(':checked')) {
        $('#hideStock').prop('checked', false);
      }
    });

    $('#hideStock').on('change', function() {
      if ($(this).is(':checked')) {
        $('#stockQuantity').prop('checked', false);
      }
    });

  });
</script>
<script>
$(document).ready(function () {
    const attributeData = @json($attributes);
    const existingAttributes = @json($productAttributes ?? []);

    // Initialize Select2
    $('.select2').select2({
        placeholder: "Select options...",
        width: '100%',
        allowClear: true,
        closeOnSelect: false,
    });

    const container = $('#attributeFieldsContainer');

    // 1️⃣ Preselect saved attributes
    const preselectedAttrIds = existingAttributes.map(a => a.attribute_id.toString());
    $('#attributeSelect').val(preselectedAttrIds).trigger('change');

    // 2️⃣ Build saved attribute fields
    preselectedAttrIds.forEach(attrId => {
        const attribute = attributeData.find(a => a.id == attrId);
        if (!attribute) return;

        const label = attribute.name;
        const options = attribute.values.map(v => 
            `<option value="${v.id}">${v.value}</option>`
        ).join('');

        const fieldHtml = `
            <div class="mb-3 attribute-field" id="attribute-field-${attrId}">
                <label class="form-label fw-semibold">${label}</label>
                <select name="attributes[${attrId}]" class="select2 form-select shadow-sm rounded-3"
                        data-placeholder="Select ${label}...">
                    ${options}
                </select>
            </div>
        `;

        container.append(fieldHtml);
        const selectField = container.find(`#attribute-field-${attrId} .select2`);
        selectField.select2({
            placeholder: `Select ${label}...`,
            width: '100%',
            allowClear: true,
            closeOnSelect: true,
        });

        // Preselect saved value
        const savedAttr = existingAttributes.find(a => a.attribute_id == attrId);
        if (savedAttr) {
            selectField.val(savedAttr.attribute_value_id.toString()).trigger('change');
        }
    });

    // 3️⃣ Handle change event (add/remove fields dynamically)
    $('#attributeSelect').on('change', function () {
        const selectedIds = $(this).val() || [];

        // Add new fields
        selectedIds.forEach(attrId => {
            if (container.find(`#attribute-field-${attrId}`).length) return;

            const attribute = attributeData.find(a => a.id == attrId);
            if (!attribute) return;

            const label = attribute.name;
            const options = attribute.values.map(v => 
                `<option value="${v.id}">${v.value}</option>`
            ).join('');

            const fieldHtml = `
                <div class="mb-3 attribute-field" id="attribute-field-${attrId}">
                    <label class="form-label fw-semibold">${label}</label>
                    <select name="attributes[${attrId}]" class="select2 form-select shadow-sm rounded-3"
                            data-placeholder="Select ${label}...">
                        ${options}
                    </select>
                </div>
            `;

            container.append(fieldHtml);
            container.find(`#attribute-field-${attrId} .select2`).select2({
                placeholder: `Select ${label}...`,
                width: '100%',
                allowClear: true,
                closeOnSelect: true,
            });
        });

        // Remove fields if deselected
        container.find('.attribute-field').each(function () {
            const fieldId = $(this).attr('id').replace('attribute-field-', '');
            if (!selectedIds.includes(fieldId)) {
                $(this).remove();
            }
        });
    });
});
</script>




