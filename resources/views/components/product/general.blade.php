<div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="v-pills-home-tab-nobd">
    <div class="card-header2 mb-4">
        <h4 class="card-title text-secondary">General Information</h4>
    </div>

    <div class="row">
        <div class="col-7">
            <!-- Product Name -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold me-3">Product Name *</label>
                <input type="text" name="name" id="name" class="form-control form-control-sm"
                    value="{{ old('name', $product->name ?? '') }}" placeholder="Product Name" required>
                <small id="nameCharCount" class="text-muted">0 / 150 characters</small>
            </div>

            <!-- Short Description -->
            <div class="mb-3">
                <label for="short_description" class="form-label fw-semibold me-3">Short Description</label>
                <textarea class="form-control" id="short_description" name="short_description" placeholder="Short Description" rows="5">{{ old('short_description', $product->short_description ?? '') }}</textarea>
                <small id="desCharCount" class="text-muted">0 / 200 characters</small>
            </div>
        </div>

        <div class="col-5">
            <!-- Category -->
            @php
                // Fallback to old() if form validation fails
                $selectedCategories = old('category', $selectedCategories ?? []);
            @endphp
           
         <div class="mb-3">
            <label class="form-label fw-semibold me-3">Select Categories *</label>
            <div class="position-relative">
                <select id="categorySelect" name="category[]" multiple
                    class="select2 form-select shadow-sm rounded-3 custom-multiselect"
                    data-placeholder="Select categories..." required>
                    
                    @if($categories->count() > 0)
                        @include('components.product._category_options', [
                            'categories' => $categories,
                            'selectedCategories' => $selectedCategories,
                            'level' => 0
                        ])
                    @else
                        <option disabled>No categories found</option>
                    @endif
                </select>
            </div>
        </div>


            <!-- Brand -->
            <div class="mb-3">
                <label for="brand_id" class="form-label fw-semibold me-3">Select Brand</label>
                <select class="form-select form-control" name="brand_id" id="brand_id">
                    <option value="">Select brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ old('brand_id', $product->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Minimum Purchase -->
            <div class="mb-3">
                <label for="minimum_purchase" class="form-label fw-semibold me-3">Minimum Purchase Qty *</label>
                <input type="number" name="minimum_purchase" id="minimum_purchase" class="form-control form-control-sm"
                    value="{{ old('minimum_purchase', $product->minimum_purchase ?? '') }}" placeholder="Minimum Purchase Qty" required>
            </div>
        </div>
    </div>

    <!-- Long Description -->
    <div class="mb-3">
        <label for="long_description" class="form-label fw-semibold me-3">Description</label>
        <textarea class="form-control" id="summernote" name="long_description" rows="5">{{ old('long_description', $product->long_description ?? '') }}</textarea>
    </div>

    <!-- Tags -->
    <div class="mb-3">
        <label for="tags" class="form-label fw-semibold me-3">Tags</label>
        <input id="tags" name="tags" class="form-control tagify" placeholder="Type and press enter"
            value="{{ old('tags', $product->tags ?? '') }}">
    </div>

    <!-- Refund -->
    <div class="card-header2 mb-4">
        <h4 class="card-title text-secondary">Refund</h4>
    </div>

    <div class="form-switch-wrapper d-flex mb-3">
        <div class="col-3">
            <label class="form-label fw-semibold d-block mb-2">Refundable?</label>
        </div>
        <div class="col-9">
            <label class="switch">
                <input type="checkbox" name="refundable"
                    {{ old('refundable', $product->refundable ?? false) ? 'checked' : '' }}>
                <span class="slider"></span>
            </label>
        </div>
    </div>

    <!-- Status -->
    <div class="card-header2 mb-4">
        <h4 class="card-title text-secondary">Status</h4>
    </div>

    <div class="form-switch-wrapper d-flex mb-3">
        <div class="col-3">
            <label class="form-label fw-semibold d-block mb-2">Featured</label>
        </div>
        <div class="col-9">
            <label class="switch">
                <input type="checkbox" name="featured"
                    {{ old('featured', $product->featured ?? false) ? 'checked' : '' }}>
                <span class="slider"></span>
            </label>
            <p>If you enable this, this product will be granted as a featured product.</p>
        </div>
    </div>

    <div class="form-switch-wrapper d-flex mb-3">
        <div class="col-3">
            <label class="form-label fw-semibold d-block mb-2">Todays Deal</label>
        </div>
        <div class="col-9">
            <label class="switch">
                <input type="checkbox" name="todays_deal"
                    {{ old('todays_deal', $product->todays_deal ?? false) ? 'checked' : '' }}>
                <span class="slider"></span>
            </label>
            <p>If you enable this, this product will be granted as a todays deal product.</p>
        </div>
    </div>

    <!-- Flash Deal -->
    <div class="card-header2 mb-4">
        <h4 class="card-title text-secondary">
            Flash Deal <span>(If you want to select this product as a flash deal, you can use it)</span>
        </h4>
    </div>

    
   <div class="mb-3">
        <label for="flash_title" class="form-label fw-semibold d-block mb-2">Add To Flash</label>
        <select class="form-select form-control" name="flash_title">
            <option value="">Choose Flash Title</option>
            @foreach(['end-season'=>'End of Season', 'w-sale'=>'Winter Sale', 'electronic'=>'Electronic', 'f-deal'=>'Flash Deal', 'f-sale'=>'Flash Sale'] as $key => $val)
                <option value="{{ $key }}" 
                    {{ old('flash_title', $flashDeals->title ?? '') == $key ? 'selected' : '' }}>
                    {{ $val }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="flas_discount" class="form-label fw-semibold me-3">Discount</label>
        <input type="number" name="flas_discount" id="flas_discount" class="form-control form-control-sm"
            value="{{ old('flas_discount', $flashDeals->discount ?? '') }}" placeholder="0">
    </div>

    <div class="mb-3">
        <label for="flas_discount_type" class="form-label fw-semibold me-3">Discount Type</label>
        <select class="form-select form-control" name="flas_discount_type">
            <option value="">Choose discount type</option>
            <option value="flat" {{ old('flas_discount_type', $flashDeals->type ?? '') == 'flat' ? 'selected' : '' }}>Flat</option>
            <option value="percent" {{ old('flas_discount_type', $flashDeals->type ?? '') == 'percent' ? 'selected' : '' }}>Percent</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="discount_date_range" class="form-label fw-semibold me-3">Discount Date Range:</label>
        <input type="text" name="flas_date_range" 
            value="{{ old('flas_date_range', $flashDeals->flas_date_range ?? '') }}" 
            id="discount_date_range"
            class="form-control form-control-sm"
            placeholder="Select date range">
    </div>

    <!-- Warranty -->
    <div class="card-header2 mb-4">
        <h4 class="card-title text-secondary">Warranty</h4>
    </div>

    <div class="form-switch-wrapper d-flex mb-3">
        <div class="col-3">
            <label class="form-label fw-semibold d-block mb-2">Warranty</label>
        </div>
        <div class="col-9">
            <label class="switch">
                <input type="checkbox" name="warrentyStatusToggle" id="warrentyStatusToggle"
                    {{ old('warrentyStatusToggle', $product->warrenty_id ?? false) ? 'checked' : '' }}>
                <span class="slider"></span>
            </label>
        </div>
    </div>

    <div id="warrentyStatustFields" style="{{ old('warrentyStatusToggle', $product->warrenty_id ?? false) ? '' : 'display:none;' }}">
        <div class="mb-3">
            <label for="warrenty_id" class="form-label fw-semibold me-3">Select Warranty:</label>
            <select class="form-select form-control" name="warrenty_id">
                <option value="">Select Warranty</option>
                @foreach ($warranties as $warranty)
                    <option value="{{ $warranty->id }}"
                        {{ old('warrenty_id', $product->warrenty_id ?? '') == $warranty->id ? 'selected' : '' }}>
                        {{ $warranty->title }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>


<script>    

$(document).ready(function() {
    $('#categorySelect').select2({
        placeholder: "Select categories..."
    });

    // Laravel JSON array set as default selected
    var selectedCategories = @json($selectedCategories);
    $('#categorySelect').val(selectedCategories).trigger('change');
});


    $('#warrentyStatusToggle').on('change', function() {
        if ($(this).is(':checked')) {
        $('#warrentyStatustFields').slideDown(200);
        } else {
        $('#warrentyStatustFields').slideUp(200);
        $('#warrenty_status').val('');
        }
    });

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
    setCharLimit('name', 'nameCharCount', 150);
    setCharLimit('short_description', 'desCharCount', 200);
</script>


