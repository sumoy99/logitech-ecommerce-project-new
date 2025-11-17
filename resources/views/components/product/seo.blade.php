<div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="v-pills-messages-tab-nobd">
    <div class="card-header2  mb-4" style="">
        <h4 class="card-title text-secondary">SEO Meta Tags</h4>
    </div>
    <div class="mb-3">
        <label for="meta_title" class="form-label fw-semibold me-3">Meta Title:</label>
        <input type="text" name="meta_title" id="meta_title" class="form-control form-control-sm" value="{{ old('meta_title', $productSeo->meta_title ?? '') }}" placeholder="Meta Title">
    </div>

    <div class="mb-3">
        <label for="meta_description" class="form-label fw-semibold me-3">Meta Description</label>
        <textarea class="form-control" id="meta_description" name="meta_description"  placeholder="Meta Description" rows="5" >{{ old('meta_title', $productSeo->meta_description ?? '') }}</textarea>
        <small id="metaDesCharCount" class="text-muted">0 / 200 characters</small>
    </div>

    <div class="mb-3">
        <label for="meta_keywords" class="form-label fw-semibold me-3">Meta Keywords</label>
        <input name="meta_keywords" class="form-control tagify" value="{{ old('meta_keywords', $productSeo->meta_keywords ?? '') }}" placeholder="Type and press enter">
    </div>

    <div class="mb-3">
        <label for="meta_image" class="form-label fw-semibold me-3">{{ get_phrase('Meta Image:') }}</label>
        <input class="form-control" type="file" id="meta_image" name="meta_image" accept="image/*" onchange="previewLogo(this, 'meta_imagePreview')">
        
        {{-- Live preview area --}}
        @if (Route::is('superadmin.products.edit'))
            @if(!empty($productSeo?->meta_image))
                <div class="mt-3">
                    <img id="meta_imagePreview" src="{{ asset('assets/upload/products/meta/' . $productSeo->meta_image) }}" alt="Preview" height="80" style="border: 1px solid #ddd; padding: 5px;">
                </div>
            @endif
        @else
            <div class="mt-3">
                <img id="meta_imagePreview" src="#" alt="Preview" height="80" style="display: none; border: 1px solid #ddd; padding: 5px;">
            </div>
        @endif
        
    </div>
    <div class="card-header2  mb-4" style="">
        <h4 class="card-title text-secondary">Og Tags</h4>
    </div>
    <div class="mb-3">
        <label for="og_title" class="form-label fw-semibold me-3">Og Title:</label>
        <input type="text" name="og_title" id="og_title" class="form-control form-control-sm" value="{{ old('og_title', $productSeo->og_title ?? '') }}" placeholder="Og Title">
    </div>

    <div class="mb-3">
        <label for="og_description" class="form-label fw-semibold me-3">Og Description</label>
        <textarea class="form-control" id="og_description" name="og_description" placeholder="Og Description" rows="5" >{{ old('og_description', $productSeo->og_description ?? '') }}</textarea>
        <small id="ogdesCharCount" class="text-muted">0 / 200 characters</small>
    </div>

    <div class="mb-3">
        <label for="og_keywords" class="form-label fw-semibold me-3">Og Keywords</label>
        <input name="og_keywords" class="form-control tagify" value="{{ old('og_keywords', $productSeo->og_keywords ?? '') }}" placeholder="Type and press enter">
    </div>

    <div class="mb-3">
        <label for="og_image" class="form-label fw-semibold me-3">{{ get_phrase('Og Image:') }}</label>
        <input class="form-control" type="file" id="og_image" name="og_image" accept="image/*" onchange="previewLogo(this, 'meta_imagePreview')">
        
        {{-- Live preview area --}}
        <div class="mt-3">
            <img id="meta_imagePreview" src="#" alt="Preview" height="80" style="display: none; border: 1px solid #ddd; padding: 5px;">
        </div>
    </div>

    <div class="mb-3">
        <label for="index_status" class="form-label fw-semibold me-3">Index Status</label>
        <select class="form-select form-control" name="index_status" id="defaultSelect">
                <option value="index" {{ old('index_status', $productSeo->index_status ?? '') == 'index' ? 'selected' : '' }}>Index</option>
                <option value="noindex" {{ old('index_status', $productSeo->index_status ?? '') == 'noindex' ? 'selected' : '' }}>Noindex</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="follow_status" class="form-label fw-semibold me-3">Follow Status</label>
        <select class="form-select form-control" name="follow_status" id="defaultSelect">
                <option value="follow" {{ old('follow_status', $productSeo->follow_status ?? '') == 'follow' ? 'selected' : '' }}>Follow</option>
                <option value="nofollow" {{ old('follow_status', $productSeo->follow_status ?? '') == 'nofollow' ? 'selected' : '' }}>Nofollow</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="canonical_url" class="form-label fw-semibold me-3">Canonical url:</label>
        <input type="text" name="canonical_url" id="canonical_url" class="form-control form-control-sm" value="{{ old('canonical_url', $productSeo->canonical_url ?? '') }}" placeholder="Canonical Url">
    </div>

</div>

<script>
     function previewLogo(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            preview.src = '#';
        }
    }

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
    setCharLimit('meta_description', 'metaDesCharCount', 150);
    setCharLimit('og_description', 'ogdesCharCount', 200);
</script>