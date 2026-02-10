<main class="main-content">
    <div class="header">
        <div>
            <h1>Add New Product</h1>
            <p style="color: #64748b; margin-top: 0.3rem;">Welcome back, <?php echo $username; ?>! Ready to add a new product to your store? Fill in the details below to get started.</p>
        </div>
        <div class="header-actions">
            <div class="user-profile">
                <div class="user-avatar"><?php echo $shortName; ?></div>
                <div>
                    <div style="font-weight: 600; color: #1e293b;"><?php echo $username; ?></div>
                    <div style="font-size: 0.8rem; color: #64748b;">Administrator</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Form -->
    <form action="<?php echo base_url('Product/add'); ?>" method="POST" enctype="multipart/form-data">
        <div class="rounded gy-4">
            <div class="row g-4">

                <!-- General Information -->
                <div class="col-12 col-lg-8">
                    <div class="bg-white p-4 rounded shadow-sm" style="height:350px; border: 1px solid lightgrey;">
                        <h4 class="mb-4">General Information<span style="color:red;"><strong>*</strong></span></h4>

                        <!-- Phone Name -->
                        <div class="mb-3">
                            <label for="phone_name" class="form-label">Phone Name</label>
                            <input type="text" class="form-control" name="phone_name" id="phone_name" placeholder="e.g. Galaxy S24 Ultra" required>
                        </div>

                        <!-- Phone Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Phone Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4" placeholder="Short description about the phone..." required></textarea>
                        </div>
                    </div>
                </div>

                <!-- Product Media -->
                <div class="col-12 col-lg-4">
                    <div class="bg-white p-4 rounded shadow-sm" style="height:350px; border: 1px solid lightgrey;">
                        <h4 class="mb-4">Product Media<span style="color:red;"><strong>*</strong></span></h4>

                        <div class="d-flex flex-column align-items-center">
                            <!-- Input Image -->
                            <input type="file" class="form-control" id="phone_image" name="phone_image" accept="image/*" onchange="previewImage(event)" style="display:none;" required>

                            <!-- Preview Image -->
                            <div class="mt-3 d-flex flex-column align-items-center">
                                <img id="imagePreview" src="<?php echo base_url('assets/images/No_Image.png'); ?>" class="img-fluid rounded border" onclick="document.getElementById('phone_image').click()" style="max-height:180px;">
                                <input class="text-center" type="text" id="upImage" name="upImage" placeholder="Please Select Image" readonly style="border: none; background: transparent; box-shadow: none; width:100%;" required>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row g-4 mt-2">

                <!-- Pricing -->
                <div class="col-12 col-lg-8">
                    <div class="bg-white p-4 rounded shadow-sm" style="height:350px; border: 1px solid lightgrey;">
                        <h4 class="mb-4">Pricing And Inventory<span style="color:red;"><strong>*</strong></span></h4>

                        <!-- Pricing -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Base Price (RM)</label>
                            <input type="number" class="form-control" name="price" id="price" placeholder="0.00" step="0.01" min="0" required>

                            <label for="discount" class="form-label">Discount (%)</label>
                            <input type="number" class="form-control" name="discount" id="discount" placeholder="0.00" step="0.01" min="0" max="100" required>

                            <div class="my-3 border-top"></div>

                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" name="stock" id="stock" placeholder="0" step="1" min="0" required>
                        </div>
                    </div>
                </div>

                <!-- Brand -->
                <div class="col-12 col-lg-4">
                    <div class="bg-white p-4 rounded shadow-sm" style="height:350px; border: 1px solid lightgrey;">
                        <h4 class="mb-4">Product Media<span style="color:red;"><strong>*</strong></span></h4>

                        <div class="d-flex flex-column align-items-center">
                            <!-- Brand -->
                            <select class="form-select shadow-sm" id="brand" name="brand" size="8" required style="max-height:180px; overflow-y:auto; border-radius:0.5rem; border:1px solid #ccc;">
                                <option value="" disabled selected>Select Brand</option>
                                <?php foreach ($brand as $b) { ?>
                                    <option value="<?php echo $b->brand; ?>"><?php echo $b->brand; ?></option>
                                <?php } ?>
                            </select>
                            <input class="form-control mt-4" type="text" name="selected" id="selected" placeholder="Please Select Brand" readonly>
                            <small style="opacity: 0.6;">PS* if the brand did not available in list, add them first</small>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row g-4 mt-2">

                <!-- Inventory -->
                <div class="col-12 col-lg-8">
                    <div class="bg-white p-4 rounded shadow-sm" style="height:400px; border: 1px solid lightgrey;">
                        <h4 class="mb-4">Specification<span style="color:red;"><strong>*</strong></span></h4>

                        <!-- Pricing -->
                        <div class="mb-3">
                            <label for="storage" class="form-label">Storage Capacity (ROM)</label>
                            <input type="number" class="form-control" name="storage" id="storage" placeholder="e.g 128" step="1" min="0" required>

                            <label for="storage" class="form-label">Memory Capacity (RAM)</label>
                            <input type="number" class="form-control" name="ram" id="ram" placeholder="e.g 4" step="1" min="0" required>

                            <label for="storage" class="form-label">Battery Capacity (mAh)</label>
                            <input type="number" class="form-control" name="battery" id="battery" placeholder="e.g 10000" step="1" min="0" required>

                            <label for="storage" class="form-label">Operating System</label>
                            <input type="text" class="form-control" name="os" id="os" placeholder="Android 13" required>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="bg-white p-4 rounded shadow-sm d-flex flex-column justify-content-between" style="height:400px; border: 1px solid lightgrey;">
                        <h4 class="mb-4">Action Buttons</h4>

                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-plus-circle me-2"></i> Add Product
                            </button>

                            <a href="<?php echo base_url('Product/add'); ?>" class="btn btn-outline-secondary btn-lg w-100">
                                <i class="bi bi-arrow-clockwise me-2"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        const brandSelect = document.getElementById('brand');
        const selectedInput = document.getElementById('selected');

        brandSelect.addEventListener('change', function () {
            selectedInput.value = this.value;
        });

        const phoneImageInput = document.getElementById('phone_image');
        const imagePreview = document.getElementById('imagePreview');
        const upImageInput = document.getElementById('upImage');

        phoneImageInput.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                const file = this.files[0];

                // Set filename in the text input
                upImageInput.value = file.name;

                // Show image preview
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    upImageInput.style.display = "block";
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

</main>