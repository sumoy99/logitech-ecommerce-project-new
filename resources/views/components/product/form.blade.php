<form method="POST" action="{{ $action }}" id="productForm" enctype="multipart/form-data">
    @csrf
     {{-- <div class="form-group">
        <label>Product Name</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $product->title ?? '') }}">
    </div> --}}


    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Left Side Tabs -->
                <div class="col-3 col-md-2">
                    <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd" id="v-pills-tab-without-border" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" data-bs-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                        <a class="nav-link" data-bs-toggle="pill" href="#key-features" role="tab" aria-controls="key-features" aria-selected="true">Key Features</a>
                        <a class="nav-link" data-bs-toggle="pill" href="#files-media" role="tab" aria-controls="files-media">Files & Media</a>
                        <a class="nav-link" data-bs-toggle="pill" href="#price-stock" role="tab" aria-controls="price-stock">Price & Stock</a>
                        <a class="nav-link" data-bs-toggle="pill" href="#seo" role="tab" aria-controls="seo">SEO</a>
                        <a class="nav-link" data-bs-toggle="pill" href="#shiping" role="tab" aria-controls="shiping">Shipping</a>
                    </div>
                </div>

                <!-- Right Side Content -->
                <div class="col-9 col-md-10">
                    <div class="tab-content" id="v-pills-without-border-tabContent">
                        @include('components.product.general')
                        @include('components.product.key_features')
                        @include('components.product.files-media')
                        @include('components.product.price-stock')
                        @include('components.product.seo')
                        @include('components.product.shiping')
                        

                        <!-- Hidden input to store status -->
                        <input type="hidden" name="status" id="statusInput" value="1">

                        <div class="d-flex justify-content-start gap-2 mt-3">
                            

                            <!-- ✅ Next Button -->
                            <button type="button" id="nextTabBtn" class="btn btn-primary">Next</button>
                            <!-- Clear -->
                            <button type="button" id="clearBtn" class="btn btn-secondary">Clear</button>
                            <!-- Dropdown Submit -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown">
                                    Submit
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-status="1">Save & Publish</a></li>
                                    <li><a class="dropdown-item" href="#" data-status="0">Save & Unpublish</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>

       


    // Dropdown Submit Logic (optional)
    // document.querySelectorAll('.dropdown-item[data-status]').forEach(item => {
    //         item.addEventListener('click', function(e) {
    //             e.preventDefault();
    //             document.getElementById('statusInput').value = this.getAttribute('data-status');
    //             // Submit form if needed
    //             document.querySelector('form')?.submit();
    //         });
    //     });
    // });

    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            // Get selected status
            const status = this.getAttribute('data-status');
            // Set it to hidden input
            document.getElementById('statusInput').value = status;
            // Submit the form
            document.getElementById('productForm').submit();
        });
    });

    // document.addEventListener("DOMContentLoaded", function() {
    //     const form = document.getElementById("productForm");
    //     const inputs = form.querySelectorAll("input, textarea, select");
    //     const submitBtn = document.getElementById("submitBtn");
    //     const clearBtn = document.getElementById("clearBtn");

    //     if ($('#summernote').length) {
    //         $('#summernote').summernote({
    //             height: 200,
    //         });

    //         const savedSummernote = localStorage.getItem("form_long_description");
    //         if (savedSummernote) {
    //             $('#summernote').summernote('code', savedSummernote);
    //         }

    //         $('#summernote').on('summernote.change', function(we, contents) {
    //             localStorage.setItem("form_long_description", contents);
    //         });
    //     }

    //     if ($('.select2').length) {
    //         $('.select2').select2();

    //         $('.select2').each(function() {
    //             const saved = localStorage.getItem("form_" + this.name);
    //             if (saved) {
    //                 const values = JSON.parse(saved);
    //                 $(this).val(values).trigger('change');
    //             }
    //         });

    //         $('.select2').on('change', function() {
    //             const selectedValues = $(this).val();
    //             localStorage.setItem("form_" + this.name, JSON.stringify(selectedValues));
    //         });
    //     }

    //     inputs.forEach(input => {
    //         const saved = localStorage.getItem("form_" + input.name);
    //         if (saved && input.id !== "summernote" && !$(input).hasClass('select2')) {
    //             if (input.type === "checkbox") {
    //                 input.checked = saved === "true";
    //             } else if (input.multiple) {
    //                 const values = JSON.parse(saved);
    //                 [...input.options].forEach(opt => {
    //                     opt.selected = values.includes(opt.value);
    //                 });
    //             } else {
    //                 input.value = saved;
    //             }
    //         }
    //     });

    //     inputs.forEach(input => {
    //         input.addEventListener("input", () => saveField(input));
    //         input.addEventListener("change", () => saveField(input));
    //     });

    //     function saveField(input) {
    //         if ($(input).hasClass('select2') || input.id === "summer    note") return;

    //         if (input.type === "checkbox") {
    //             localStorage.setItem("form_" + input.name, input.checked);
    //         } else if (input.multiple) {
    //             const selectedValues = [...input.selectedOptions].map(o => o.value);
    //             localStorage.setItem("form_" + input.name, JSON.stringify(selectedValues));
    //         } else {
    //             localStorage.setItem("form_" + input.name, input.value);
    //         }
    //     }

    //     //  Clear function
    //     function clearFormData() {
    //         inputs.forEach(input => {
    //             localStorage.removeItem("form_" + input.name);
    //             if (input.type === "checkbox") {
    //                 input.checked = false;
    //             } else if (input.multiple) {
    //                 [...input.options].forEach(opt => opt.selected = false);
    //                 if ($(input).hasClass('select2')) $(input).val(null).trigger('change');
    //             } else if (input.id === "summernote") {
    //                 $('#summernote').summernote('code', '');
    //                 localStorage.removeItem("form_long_description");
    //             } else {
    //                 input.value = "";
    //             }
    //         });
    //     }

    //     if (submitBtn) submitBtn.addEventListener("click", clearFormData);
    //     if (clearBtn) clearBtn.addEventListener("click", clearFormData);
    // });
</script>

{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("productForm");

        function validateRequiredFields() {
            let isValid = true;

            const requiredFields = form.querySelectorAll("[required]");

            requiredFields.forEach(field => {
                const errorMsgEl = field.parentElement.querySelector("small.text-danger");
                if (!errorMsgEl) return;

                if (field.type === "checkbox") {
                    if (!field.checked) {
                        field.classList.add("error-border");
                        errorMsgEl.textContent = "This field is required.";
                        errorMsgEl.classList.remove("d-none");
                        isValid = false;
                    } else {
                        field.classList.remove("error-border");
                        errorMsgEl.classList.add("d-none");
                    }
                } else if (field.value.trim() === "") {
                    field.classList.add("error-border");
                    errorMsgEl.textContent = "This field is required.";
                    errorMsgEl.classList.remove("d-none");
                    isValid = false;
                } else {
                    field.classList.remove("error-border");
                    errorMsgEl.classList.add("d-none");
                }
            });

            return isValid;
        }

        // Submit event
        form.addEventListener("submit", function(e) {
            if (!validateRequiredFields()) {
                e.preventDefault(); 
            }
        });

        // Input/change event — auto remove error
        form.querySelectorAll("[required]").forEach(field => {
            field.addEventListener("input", () => validateRequiredFields());
            field.addEventListener("change", () => validateRequiredFields());
        });

        // Clear button
        const clearBtn = document.getElementById("clearBtn");
        if (clearBtn) {
            clearBtn.addEventListener("click", () => {
                form.reset();
                form.querySelectorAll(".error-border").forEach(el => el.classList.remove("error-border"));
                form.querySelectorAll("small.text-danger").forEach(el => {
                    el.classList.add("d-none");
                    el.textContent = "";
                });
            });
        }
    });
</script> --}}



{{-- <script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("productForm");
    const inputs = form.querySelectorAll("input, textarea, select");
    const submitBtn = document.getElementById("submitBtn");
    const clearBtn = document.getElementById("clearBtn");

    /* ---------------------------------------
        SUMMERNOTE
    --------------------------------------- */
    if ($('#summernote').length) {
        $('#summernote').summernote({ height: 200 });

        const savedSummernote = localStorage.getItem("form_long_description");
        if (savedSummernote) {
            $('#summernote').summernote('code', savedSummernote);
        }

        $('#summernote').on('summernote.change', function(we, contents) {
            localStorage.setItem("form_long_description", contents);
        });
    }

    /* ---------------------------------------
        SELECT2
    --------------------------------------- */
    if ($('.select2').length) {
        $('.select2').select2();

        $('.select2').each(function() {
            const saved = localStorage.getItem("form_" + this.name);
            if (saved) {
                const values = JSON.parse(saved);
                $(this).val(values).trigger('change');
            }
        });

        $('.select2').on('change', function() {
            const selectedValues = $(this).val();
            localStorage.setItem("form_" + this.name, JSON.stringify(selectedValues));
        });
    }

    /* ---------------------------------------
        NORMAL INPUTS
    --------------------------------------- */
    inputs.forEach(input => {
        if (input.type === "file") return;
        const saved = localStorage.getItem("form_" + input.name);

        if (saved && input.id !== "summernote" && !$(input).hasClass('select2')) {
            if (input.type === "checkbox") {
                input.checked = saved === "true";
            } else if (input.multiple) {
                const values = JSON.parse(saved);
                [...input.options].forEach(opt => {
                    opt.selected = values.includes(opt.value);
                });
            } else {
                input.value = saved;
            }
        }
    });

    inputs.forEach(input => {
        if (input.type === "file") return;
        input.addEventListener("input", () => saveField(input));
        input.addEventListener("change", () => saveField(input));
    });

    function saveField(input) {
        if (input.type === "file" || $(input).hasClass('select2') || input.id === "summernote") return;

        if (input.type === "checkbox") {
            localStorage.setItem("form_" + input.name, input.checked);
        } else if (input.multiple) {
            const selectedValues = [...input.selectedOptions].map(o => o.value);
            localStorage.setItem("form_" + input.name, JSON.stringify(selectedValues));
        } else {
            localStorage.setItem("form_" + input.name, input.value);
        }
    }

    /* ---------------------------------------
        FIXED CLEAR FUNCTION
    --------------------------------------- */
    function clearFormData() {
        // 🔸 Step 1: remove all saved "form_" keys
        Object.keys(localStorage).forEach(key => {
            if (key.startsWith("form_")) {
                localStorage.removeItem(key);
            }
        });

        // 🔸 Step 2: clear all field values
        inputs.forEach(input => {
            if (input.type === "checkbox") {
                input.checked = false;
            } else if (input.multiple) {
                [...input.options].forEach(opt => opt.selected = false);
                if ($(input).hasClass('select2')) $(input).val(null).trigger('change');
            } else if (input.id === "summernote") {
                $('#summernote').summernote('code', '');
            } else if (input.type === "file") {
                input.value = "";
            } else {
                input.value = "";
            }
        });

        // 🔸 Step 3: clear previews
        const previewDiv = document.getElementById('previews');
        if (previewDiv) previewDiv.innerHTML = "";
        localStorage.removeItem("form_gallery_previews");
    }

    if (submitBtn) submitBtn.addEventListener("click", clearFormData);
    if (clearBtn) clearBtn.addEventListener("click", clearFormData);

    /* ---------------------------------------
       🖼️ GALLERY PREVIEW SAVE (Optional)
    --------------------------------------- */
    // const fileInput = document.getElementById('fileInput');
    // if (fileInput) {
    //     fileInput.addEventListener('change', function () {
    //         const files = Array.from(this.files);
    //         const readers = files.map(file => {
    //             return new Promise(resolve => {
    //                 const reader = new FileReader();
    //                 reader.onload = e => resolve(e.target.result);
    //                 reader.readAsDataURL(file);
    //             });
    //         });
    //         Promise.all(readers).then(results => {
    //             localStorage.setItem("form_gallery_previews", JSON.stringify(results));
    //             renderPreviews(results);
    //         });
    //     });

    //     function renderPreviews(dataUrls) {
    //         const previewDiv = document.getElementById('previews');
    //         if (!previewDiv) return;
    //         previewDiv.innerHTML = "";
    //         dataUrls.forEach(url => {
    //             const img = document.createElement('img');
    //             img.src = url;
    //             img.height = 80;
    //             img.style.margin = "5px";
    //             img.style.border = "1px solid #ccc";
    //             img.style.borderRadius = "6px";
    //             previewDiv.appendChild(img);
    //         });
    //     }

    //     const savedPreviews = JSON.parse(localStorage.getItem("form_gallery_previews") || "[]");
    //     if (savedPreviews.length) renderPreviews(savedPreviews);
    // }
});
</script> --}}


</form>