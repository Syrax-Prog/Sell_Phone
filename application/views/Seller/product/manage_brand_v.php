<main class="main-content">
    <div class="header">
        <div>
            <h1>Manage Brands</h1>
            <p style="color: #64748b; margin-top: 0.3rem;">Add new brands and manage existing ones for your product catalog.</p>
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

    <!-- Add Brand Form -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Add New Brand</h5>
        </div>
        <div class="card-body">
            <form action="<?php echo base_url('Brand/add'); ?>" method="POST" enctype="multipart/form-data">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Brand Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="brand_name" placeholder="e.g., Apple, Samsung" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Brand Logo <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="brand_image" accept="image/*" required>
                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check-circle me-2"></i>Add Brand
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Brands List -->
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="bi bi-list-ul me-2"></i>All Brands</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 15%;">Logo</th>
                            <th style="width: 30%;">Brand Name</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($brands)) { ?>
                            <?php $no = 1;
                            foreach ($brands as $brand) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>
                                        <img src="<?php echo base_url() . $brand->brand_img; ?>" alt="<?php echo $brand->brand; ?>" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: contain;">
                                    </td>
                                    <td><strong><?php echo $brand->brand; ?></strong></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editBrandModal<?php echo $brand->id; ?>">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteBrand(<?php echo $brand->id; ?>)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editBrandModal<?php echo $brand->id; ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Brand</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="<?php echo base_url('Brand/brand_update'); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <input type="hidden" name="brand_id" value="<?php echo $brand->id; ?>">

                                                    <div class="mb-3">
                                                        <label class="form-label">Brand Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="brand_name" value="<?php echo $brand->brand; ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Current Logo</label>
                                                        <div>
                                                            <img src="<?php echo base_url() . $brand->brand_img; ?>" alt="<?php echo $brand->brand; ?>" class="img-thumbnail mb-2" style="width: 100px; height: 100px; object-fit: contain;">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">New Logo (Optional)</label>
                                                        <input type="file" class="form-control" name="brand_image" accept="image/*">
                                                        <small class="text-muted">Leave empty to keep current logo</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update Brand</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="bi bi-inbox display-1 text-muted"></i>
                                    <p class="text-muted mt-3">No brands found. Add your first brand above!</p>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>

<script>
    function deleteBrand(brandId) {
        if (confirm('Are you sure you want to delete this brand? This action cannot be undone.')) {
            window.location.href = '<?php echo base_url('Product/brand_delete/'); ?>' + brandId;
        }
    }
</script>