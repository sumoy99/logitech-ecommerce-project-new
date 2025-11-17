<style>
    .gallery-uploader {
        border: 2px dashed #cbd5e1;
        border-radius: 14px;
        padding: 40px;
        text-align: center;
        background: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(8px);
        transition: 0.25s ease;
        cursor: pointer;
    }

    .gallery-uploader:hover {
        border-color: #6366f1;
        background: rgba(99, 102, 241, 0.05);
    }

    .gallery-uploader .icon {
        font-size: 40px;
        color: #6366f1;
        font-weight: bold;
        margin-bottom: 10px;
    }

    #clearAllGallery {
        position: absolute;
        right: 21px;
        top: 46px;
        border: 1.5px solid;
    }

    .gallery-preview-img {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0px 3px 10px rgba(0,0,0,0.15);
        transition: 0.25s ease;
    }

    .gallery-preview-img:hover {
        transform: scale(1.03);
        box-shadow: 0px 5px 16px rgba(0,0,0,0.20);
    }

    .preview-box {
        position: relative;
    }

    .remove-preview-btn {
        position: absolute;
        top: 6px;
        right: 6px;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        text-align: center;
        font-size: 14px;
        cursor: pointer;
        box-shadow: 0px 2px 6px rgba(0,0,0,0.2);
        transition: 0.2s;
    }

    .remove-preview-btn:hover {
        background: #ef4444;
        color: white;
    }
</style>

<div class="tab-pane fade" id="files-media" role="tabpanel" aria-labelledby="v-pills-profile-tab-nobd">
    <div class="card-header2  mb-4" style="">
        <h4 class="card-title text-secondary">Product Files & Media</h4>
    </div>

    <div class="mb-4 position-relative">

        <label class="form-label fw-semibold fs-6">Gallery Images <span class="text-muted">(Multiple)</span></label>

        <div class="gallery-uploader" id="galleryDropzone">
            <div class="icon">⬆</div>
            <div class="fw-bold fs-5">Upload Product Gallery</div>
            <div class="text-muted small">Click or drag images — JPG, PNG, GIF</div>
            <div class="text-muted small mt-1">Recommended size: <strong>900×900 px</strong></div>
        </div>

        <button type="button" id="clearAllGallery" class="btn btn-sm btn-outline-danger">
            Clear All
        </button>

        <input type="file" id="galleryInput" name="gallery_image[]" accept="image/*" multiple style="display:none">

        <div id="galleryPreviews" class="row g-3 mt-3"></div>

        <input type="hidden" name="old_gallery_images" id="oldGalleryImagesInput">
    </div>
    
    <!-- Image Upload with Live Preview -->
    <div class="mb-3">
        <label for="logo" class="form-label fw-semibold me-3">{{ get_phrase('Thumbnail Image:') }}</label>
        <input class="form-control" type="file" id="logo" name="thumbnail" accept="image/*" onchange="previewLogo(this, 'logoPreview')">
        <div class="form-text">Max size: 2MB. Accepted: JPG, PNG</div>
        <p class="input_sugg_tx">
            This image is visible in all product boxes. Minimum dimensions required: 195px width X 195px height.
        </p>

        {{-- Live preview area --}}
        @if (Route::is('superadmin.products.edit'))
            <div class="mt-3">
                <img id="logoPreview" src="{{ asset('assets/upload/products/thumbnails/' . $fileMedia->thumbnail) }}" alt="Preview" height="80" style=" border: 1px solid #ddd; padding: 5px;">
            </div>
        @else
            <div class="mt-3">
                <img id="logoPreview" src="" alt="Preview" height="80" style="display: none; border: 1px solid #ddd; padding: 5px;">
            </div>
        @endif
        
    </div>

    <div class="mb-3">
        <label for="logo" class="form-label fw-semibold me-3">{{ get_phrase('Hover Image:') }}</label>
        <input class="form-control" type="file" id="logo" name="hover_image" accept="image/*" onchange="previewLogo(this, 'logoPreview')">
        <div class="form-text">Max size: 2MB. Accepted: JPG, PNG</div>
        <p class="input_sugg_tx">
            This image is visible in all product boxes. Minimum dimensions required: 195px width X 195px height.
        </p>

        {{-- Live preview area --}}
        @if (Route::is('superadmin.products.edit'))
                <div class="mt-3">
                    <img id="logoPreview" src="{{ asset('assets/upload/products/hover_images/' . $fileMedia->hover_image) }}" alt="Preview" height="80" style="border: 1px solid #ddd; padding: 5px;">
                </div>
        @else
            <div class="mt-3">
                <img id="logoPreview" src="#" alt="Preview" height="80" style="display: none; border: 1px solid #ddd; padding: 5px;">
            </div>
        @endif
        
    </div>
    <!-- Video Upload with Live Preview -->
    <div class="mb-3">
        <label for="video" class="form-label fw-semibold me-3">{{ get_phrase('Video:') }}</label>
        <input class="form-control" type="file" id="video" name="videos" accept="video/*" onchange="previewVideo(this)">
        <div class="form-text">Accepted: video</div>
        <p class="input_sugg_tx">Try to upload videos under 30 seconds for better performance.</p>

        <!-- Live preview area -->
        @if (Route::is('superadmin.products.edit'))
            <div class="mt-3">
                <video id="videoPreview" src="{{ asset($fileMedia->videos) }}" height="120" style=" border: 1px solid #ddd; padding: 5px;" controls></video>
            </div>  
        @else
            <div class="mt-3">
                <video id="videoPreview" height="120" style="display: none; border: 1px solid #ddd; padding: 5px;" controls></video>
            </div>
        @endif
        
    </div>
    <!-- Image Upload with Live Preview -->
    <div class="mb-3">
        <label for="videoThumbnail" class="form-label fw-semibold me-3">{{ get_phrase('Video Thumbnail:') }}</label>
        <input class="form-control" type="file" id="videoThumbnail" name="video_thumbnail" accept="image/*" onchange="previewLogo(this, 'videoThumbnailPreview')">
        <p class="input_sugg_tx">
            Add thumbnails in the same order as your videos. If you upload only one image, it will be used for all videos.
        </p>

        {{-- Live preview area --}}
        @if (Route::is('superadmin.products.edit'))
            <div class="mt-3">
                <img id="videoThumbnailPreview" src="{{ asset('assets/upload/products/video_thumbnails/' .$fileMedia->video_thumbnail) }}" alt="Preview" height="80" style="border: 1px solid #ddd; padding: 5px;">
            </div>
        @else
            <div class="mt-3">
                <img id="videoThumbnailPreview" src="#" alt="Preview" height="80" style="display: none; border: 1px solid #ddd; padding: 5px;">
            </div>
        @endif
        
    </div>

    <div class="mb-3">
        <label for="youtube_link" class="form-label fw-semibold me-3">{{ get_phrase('Youtube video / shorts link') }} (URL)</label>
        <input type="text" name="youtube_link" class="form-control" value="{{ old('youtube_link', $fileMedia->youtube_link ?? '') }}" placeholder="Youtube video / shorts URL">
        <p class="input_sugg_tx">
           Use proper link without extra parameter. Don't use short share link/embeded iframe code.
        </p>
    </div>

    <div class="mb-3">
        <label for="pdf" class="form-label fw-semibold me-3">{{ get_phrase('PDF Specification:') }}</label>
        <input class="form-control" type="file" id="videoThumbnail" name="pdf" accept="pdf/*">
    </div>
    

</div>



<script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropzone = document.getElementById('galleryDropzone');
            const fileInput = document.getElementById('galleryInput');
            const previewsContainer = document.getElementById('galleryPreviews');
            const clearAllBtn = document.getElementById('clearAllGallery');
            const oldGalleryInput = document.getElementById('oldGalleryImagesInput');

            // Load existing images from Blade
            const existingImages = @json($galleries ?? []);
            const imageBasePath = "{{ asset('assets/upload/products/gallery/') }}/";

            let newFiles = []; // For new uploads
            let keptOldImages = new Set(existingImages); // Track which old images to keep

            // Render a preview (new or old)
            function renderPreview(fileOrName, isExisting = false) {
                const id = isExisting ? 'old-' + fileOrName : 'new-' + Date.now() + Math.random();
                const div = document.createElement('div');
                div.className = 'col-3 position-relative';
                div.dataset.filename = isExisting ? fileOrName : fileOrName.name;

                const img = document.createElement('img');
                img.src = isExisting ? (imageBasePath + fileOrName) : URL.createObjectURL(fileOrName);
                img.className = 'img-thumbnail w-100';
                img.style.height = '120px';
                img.style.objectFit = 'cover';

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
                removeBtn.innerHTML = '×';
                removeBtn.onclick = (e) => {
                    e.preventDefault();
                    if (isExisting) {
                        keptOldImages.delete(fileOrName);
                    } else {
                        newFiles = newFiles.filter(f => f !== fileOrName);
                    }
                    div.remove();
                    updateHiddenInput();
                    updateFileInput();
                };

                div.appendChild(img);
                div.appendChild(removeBtn);
                previewsContainer.appendChild(div);

                if (!isExisting) {
                    img.onload = () => URL.revokeObjectURL(img.src);
                }
            }

            // Update hidden input with kept old images
            function updateHiddenInput() {
                oldGalleryInput.value = JSON.stringify(Array.from(keptOldImages));
            }

            // Update file input with new files
            function updateFileInput() {
                const dt = new DataTransfer();
                newFiles.forEach(file => dt.items.add(file));
                fileInput.files = dt.files;
            }

            // Handle file selection
            function handleFiles(files) {
                Array.from(files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        newFiles.push(file);
                        renderPreview(file, false);
                    }
                });
                updateFileInput();
            }

            // Drag & Drop
            ['dragenter', 'dragover'].forEach(event => {
                dropzone.addEventListener(event, e => {
                    e.preventDefault();
                    dropzone.classList.add('border-primary', 'bg-light');
                });
            });

            ['dragleave', 'drop'].forEach(event => {
                dropzone.addEventListener(event, e => {
                    e.preventDefault();
                    dropzone.classList.remove('border-primary', 'bg-light');
                });
            });

            dropzone.addEventListener('drop', e => {
                handleFiles(e.dataTransfer.files);
            });

            dropzone.addEventListener('click', () => fileInput.click());
            fileInput.addEventListener('change', () => handleFiles(fileInput.files));

            // Clear All
            clearAllBtn.addEventListener('click', () => {
                newFiles = [];
                keptOldImages.clear();
                previewsContainer.innerHTML = '';
                updateHiddenInput();
                updateFileInput();
            });

            // Load existing images
            existingImages.forEach(img => renderPreview(img, true));
            updateHiddenInput();
        });

        // JS for image preview 
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

    function previewVideo(input) {
        const preview = document.getElementById('videoPreview');

        // Hide preview if no file selected
        if (!input.files || !input.files[0]) {
            preview.style.display = 'none';
            preview.src = '';
            return;
        }

        const file = input.files[0];
        const fileType = file.type;

        // Check if the file is actually a video
        if (!fileType.startsWith('video/')) {
            alert('Please select a valid video file.');
            input.value = ''; // clear invalid file
            preview.style.display = 'none';
            return;
        }

        // Create object URL for the video
        const videoURL = URL.createObjectURL(file);
        preview.src = videoURL;
        preview.style.display = 'block';
    }
</script>


