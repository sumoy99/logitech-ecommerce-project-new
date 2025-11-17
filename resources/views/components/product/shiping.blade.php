{{-- <style>
    .hidden { display: none; }
    .zone-row { border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; border-radius: 5px; }
    label { display: block; margin-top: 5px; }
    button { margin-top: 10px; }
</style> --}}
<div class="tab-pane fade" id="shiping" role="tabpanel" aria-labelledby="v-pills-messages-tab-nobd">
    <div class="card-header2  mb-4" style="">
        <h4 class="card-title text-secondary">Shipping Configuration</h4>
    </div>
    {{-- <form id="shippingForm">
        <label for="shipping_type">Shipping Type:</label>
        <select id="shipping_type" name="shipping_type">
            <option value="free">Free</option>
            <option value="flat">Flat</option>
            <option value="variable">Variable</option>
        </select>

        <!-- Flat shipping -->
        <div id="flat_fields" class="hidden">
            <label for="flat_shipping_cost">Flat Shipping Cost:</label>
            <input type="number" id="flat_shipping_cost" name="flat_shipping_cost" min="0" step="0.01">
        </div>

        <!-- Variable shipping -->
        <div id="variable_fields" class="hidden">
            <h3>Shipping Zones</h3>
            <div id="zones_container"></div>
            <button type="button" onclick="addZone()">+ Add Zone</button>
        </div>

    </form> --}}
    <div class="form-switch-wrapper d-flex mb-3">
        <div class="col-3">
            <label class="form-label fw-semibold d-block mb-2">Cash On Delivery</label>
        </div>
        <div class="col-9">
            <label class="switch">
            <input type="checkbox" {{ old('cash_on_delivery', $productShipping->cash_on_delivery ?? '') == '1' ? 'checked' : '' }} name="cash_on_delivery" id="cashOnDelivery">
            <span class="slider"></span>
            </label>
        </div>
    </div>

    <div class="form-switch-wrapper d-flex mb-3">
        <div class="col-3">
            <label class="form-label fw-semibold d-block mb-2">Free Shipping</label>
        </div>
        <div class="col-9">
            <label class="switch">
            <input type="checkbox"{{ old('shipping_cost', $productShipping->shipping_cost ?? '') > 0 ? 'checked' : '' }} name="free_shipping" id="freeShipping">
            <span class="slider"></span>
            </label>
        </div>
    </div>

    <div class="form-switch-wrapper d-flex mb-3">
        <div class="col-3">
            <label class="form-label fw-semibold d-block mb-2">Flat Rate</label>
        </div>
        <div class="col-9">
            <label class="switch">
            <input type="checkbox" name="flat_rate" id="flatRate">
            <span class="slider"></span>
            </label>
        </div>
    </div>

    <div class="mb-3" id="shippingCostWrapper" style="display:none;">
        <label for="flas_discount" class="form-label fw-semibold me-3">Shipping cost</label>
        <input type="number"  id="flas_discount" value="{{ old('shipping_cost', $productShipping->shipping_cost ?? '')}}" name="shipping_cost" class="form-control form-control-sm" placeholder="0">
    </div>

    <div class="card-header2  mb-4" style="">
        <h4 class="card-title text-secondary">Estimate Shipping Time</h4>
    </div>

    <div class="mb-3">
        <label for="flas_discount" class="form-label fw-semibold me-3">Shipping Days</label>
        <input type="text" value="{{ old('shipping_days', $productShipping->shipping_days ?? '')}}" id="flas_discount" name="shipping_days" class="form-control form-control-sm" placeholder="e.g. 1 to 3">
    </div>

    <div class="mb-3">
        <label for="note" class="form-label fw-semibold me-3">Note</label>
        <textarea class="form-control" id="note" name="note"  placeholder="Write Note" rows="5" >{{ old('note', $productShipping->note ?? '')}}</textarea>
        <small id="noteCharCount" class="text-muted">0 / 200 characters</small>
    </div>

</div>

<script>
    const freeShipping = document.getElementById('freeShipping');
    const flatRate = document.getElementById('flatRate');
    const shippingCostWrapper = document.getElementById('shippingCostWrapper');

    if (!freeShipping.checked && !flatRate.checked) {
        freeShipping.checked = true; // default
        shippingCostWrapper.style.display = 'none';
    }

    freeShipping.addEventListener('change', () => {
        if (freeShipping.checked) {
            flatRate.checked = false;
            shippingCostWrapper.style.display = 'none';
        } else {
            flatRate.checked = true;
            shippingCostWrapper.style.display = 'block';
        }
    });

    flatRate.addEventListener('change', () => {
        if (flatRate.checked) {
            freeShipping.checked = false;
            shippingCostWrapper.style.display = 'block';
        } else {
            freeShipping.checked = true;
            shippingCostWrapper.style.display = 'none';
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
    setCharLimit('note', 'noteCharCount', 200);

</script>

{{-- <script>
    const shippingType = document.getElementById('shipping_type');
    const flatFields = document.getElementById('flat_fields');
    const variableFields = document.getElementById('variable_fields');
    const zonesContainer = document.getElementById('zones_container');

    function toggleFields() {
        const type = shippingType.value;
        flatFields.classList.add('hidden');
        variableFields.classList.add('hidden');

        if (type === 'flat') {
            flatFields.classList.remove('hidden');
        } else if (type === 'variable') {
            variableFields.classList.remove('hidden');
        }
    }

    // Initial toggle
    toggleFields();
    shippingType.addEventListener('change', toggleFields);

    // Add a new zone row
    function addZone() {
        const zoneRow = document.createElement('div');
        zoneRow.className = 'zone-row';

        zoneRow.innerHTML = `
            <label>Zone Name:</label>
            <input type="text" name="zone_name[]" required>
            
            <label>Cost per kg:</label>
            <input type="number" name="cost_per_kg[]" min="0" step="0.01" required>
            
            <label>Cost per km:</label>
            <input type="number" name="cost_per_km[]" min="0" step="0.01" required>
            
            <label>Minimum Charge:</label>
            <input type="number" name="min_charge[]" min="0" step="0.01">
            
            <label>Maximum Charge:</label>
            <input type="number" name="max_charge[]" min="0" step="0.01">
            
            <button type="button" onclick="removeZone(this)">Remove</button>
        `;

        zonesContainer.appendChild(zoneRow);
    }

    // Remove a zone row
    function removeZone(button) {
        const row = button.parentElement;
        zonesContainer.removeChild(row);
    }
</script> --}}