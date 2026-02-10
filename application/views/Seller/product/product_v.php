<!-- Main Content -->
<main class="main-content">

    <div id="loadingOverlay">
        <div class="loader"></div>
    </div>

    <div class="header">
        <div>
            <h1>Products Management</h1>
            <p style="color: #64748b; margin-top: 0.3rem;">
                Here's an overview of your products today.
                Manage, update, and track your inventory with ease.
            </p>
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

    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('message'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Total Phone Includes Deactivated</div>
                    <div class="stat-value"><?php echo $total_phone; ?></div>
                </div>
                <div class="stat-icon blue"><i class="bi bi-phone"></i></div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Total Phone Active</div>
                    <div class="stat-value"><?php echo $total_active; ?></div>
                </div>
                <div class="stat-icon green"><i class="bi bi-check-circle"></i></div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Total Out Of Stock</div>
                    <div class="stat-value"><?php echo $out ?></div>
                </div>
                <div class="stat-icon red"><i class="bi bi-x-circle"></i></div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Total Low Stock</div>
                    <div class="stat-value"><?php echo $low ?></div>
                </div>
                <div class="stat-icon orange"><i class="bi bi-exclamation-circle"></i></div>
            </div>
        </div>
    </div>


    <!-- Toolbar -->
    <div class="bg-white rounded shadow-sm p-3 mb-3 d-flex justify-content-center">
        <div class="row g-2 align-items-center w-100 justify-content-center">
            <div class="col-auto d-flex align-items-center">

                <!-- Search Form -->
                <form method="GET" action="<?php echo site_url('Product/index') ?>" class="d-flex me-3" id="form1">
                    <input type="text" name="search" class="form-control" placeholder="Search phones..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>" style="width: 400px;">
                    <button class="btn btn-outline-secondary ms-2" type="submit">🔍</button>
                </form>

                <h1>|</h1>

                <!-- Notification Dropdown -->
                <div class="dropdown me-3">
                    <button type="button" class="btn position-relative border-0 bg-transparent" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="position-relative d-inline-block">
                            🔔
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo $low + $out ?>
                            </span>
                        </div>
                    </button>
                    <ul class="dropdown-menu">
                        <?php
                        $msg = '';
                        foreach ($notiLowOut as $p) {
                            if ($p->stock == 0) {
                                $msg = 'Out Of Stock';
                            } elseif ($p->stock <= 10) {
                                $msg = 'Low Stock';
                            } else
                                continue;
                            ?>
                            <a href="<?php echo site_url('Product/index?search=' . urlencode($p->phone_name)); ?>" style="text-decoration: none;">
                                <li class="dropdown-item d-flex">
                                    <span style="width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $p->phone_name ?></span>
                                    <span style="width: 100px; text-align: center;"><?php echo $msg ?></span>
                                    <span style="width: 50px; text-align: right;"><?php echo $p->stock ?></span>
                                </li>
                            </a>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="pl">awal</div>

    <!-- Product Table -->
    <div class="card shadow-sm border border-primary-subtle shadow">
        <div class="table-responsive">
            <table id="productsTable" class="table align-middle table-hover mb-0 border border-primary-subtle">
                <thead class="table-primary">
                    <tr>
                        <th>Product</th>
                        <th>Created At</th>
                        <th>Phone ID</th>
                        <th>Price (RM)</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Sales</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($phones as $p) { ?>
                        <tr>
                            <td class="d-flex align-items-center gap-2">
                                <img src="<?php echo base_url() . $p->image_url; ?>" class="rounded border" style="width: 50; height:50; object-fit: fill;">
                                <div>
                                    <div class="fw-semibold"><?php echo $p->phone_name; ?></div>
                                    <small class="text-muted"><?php echo $p->brand; ?></small>
                                </div>
                            </td>
                            <td data-order="<?php echo strtotime($p->created_at); ?>">
                                <div class="fw-semibold">
                                    <?php echo date("d M Y", strtotime($p->created_at)); ?>
                                </div>
                            </td>
                            <td># <?php echo $p->phone_id; ?></td>
                            <td data-order="<?php echo $p->current_price; ?>" class="fw-bold">RM <?php echo number_format($p->current_price, 2); ?></td>
                            <td data-order="<?php echo $p->stock; ?>">
                                <?php if ($p->stock_status === 'Out of Stock') { ?>
                                    <span class="badge bg-danger">Out Of Stock</span>
                                <?php } elseif ($p->stock_status === 'Low Stock') { ?>
                                    <span class="badge bg-warning text-dark">Low Stock</span>
                                <?php } else { ?>
                                    <span class="badge bg-success">In Stock</span>
                                <?php } ?>
                            </td>

                            <?php if ($p->is_active == 1) {
                                $status = "Deactivate";
                                $icon = "bi-check-circle";
                                $badge = "bg-success";
                                $text = "Active";
                                $btn = "success";
                            } else {
                                $status = "Activate";
                                $icon = "bi-x-circle";
                                $badge = "bg-danger";
                                $text = "Inactive";
                                $btn = "danger";
                            } ?>

                            <td><span class="badge <?php echo $badge; ?>"><i class="bi <?php echo $icon; ?> me-1"></i><?php echo $text; ?></span></td>
                            <td data-order="<?php echo $p->total_sold; ?>"><?php echo $p->total_sold; ?> sold</td>

                            <td class="text-nowrap">
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPhone<?php echo $p->phone_id; ?>" title="Update">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <a href="<?php echo base_url('Product/activate_deactivate/' . $p->phone_id . '/' . $p->is_active); ?>">
                                    <button class="btn btn-outline-<?php echo $btn; ?> btn-sm" title="<?php echo $status; ?>">
                                        <i class="bi bi-power"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div><?php echo $pagination; ?></div>
    </div>

    <?php foreach ($phones as $p) { ?>
        <!-- Modal edit phone -->
        <div class="modal fade" id="editPhone<?php echo $p->phone_id; ?>" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <form method="POST" action="<?php echo base_url('Product/update'); ?>" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="bi bi-pencil-square me-2"></i>Edit Phone
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="phone_id" value="<?php echo $p->phone_id; ?>">

                            <div class="mb-3">
                                <div style="display: flex; flex-direction:column;">
                                    <img src="<?php echo base_url() . $p->image_url; ?>" class="img-fluid rounded mb-4 shadow-sm" alt="Image" style="width: 300px; margin-left:250px; object-fit: contain;">

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold d-block">Phone Image</label>
                                        <input type="file" id="imageUpload1" name="image_url" accept="image/png, image/jpeg, image/jpg" class="form-control-file">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone_name_<?php echo $p->phone_id; ?>" class="form-label">
                                    Phone Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="phone_name_<?php echo $p->phone_id; ?>" name="phone_name" value="<?php echo $p->phone_name; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="price_<?php echo $p->phone_id; ?>" class="form-label">
                                    Price (RM) <span class="text-danger">*</span>
                                </label>
                                <input type="number" step="0.01" class="form-control" id="price_<?php echo $p->phone_id; ?>" name="current_price" value="<?php echo $p->current_price; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="price_<?php echo $p->phone_id; ?>" class="form-label">
                                    Current Stock <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control" id="stock_<?php echo $p->phone_id; ?>" name="stock" value="<?php echo $p->stock; ?>" required>
                            </div>

                            <div class="border rounded p-3 bg-light">
                                <h6 class="text-muted mb-3">Product Information (Read-Only)</h6>

                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <small class="text-muted d-block">Brand</small>
                                        <strong><?php echo $p->brand; ?></strong>
                                    </div>

                                    <div class="col-md-6">
                                        <small class="text-muted d-block">Phone ID</small>
                                        <strong># <?php echo $p->phone_id; ?></strong>
                                    </div>

                                    <div class="col-md-6">
                                        <small class="text-muted d-block">RAM</small>
                                        <strong><?php echo $p->ram; ?> GB</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <small class="text-muted d-block">Storage</small>
                                        <strong><?php echo $p->storage; ?> GB</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <small class="text-muted d-block">Total Sold</small>
                                        <strong><?php echo $p->total_sold; ?> sold</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-check-circle me-1"></i> Update Phone
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
        document.getElementById('brandSelect').addEventListener('change', function () {
            const otherInput = document.getElementById('otherBrand');

            if (this.value === 'Other') {
                otherInput.classList.remove('d-none');
                otherInput.required = true;
            } else {
                otherInput.classList.add('d-none');
                otherInput.required = false;
            }
        });

        $.ajax({
            url: 'Product/product_listing',
            type: 'POST',
            success: function (r) {
                $('#pl').html(r);
            }
        });
    });
</script>

</body>

</html>