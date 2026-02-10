<!-- Main Content -->
<main class="main-content">
    <!-- Header -->
    <div class="header">
        <div>
            <h1>Dashboard Overview</h1>
            <p style="color: #64748b; margin-top: 0.3rem;">Welcome back, <?php echo $username; ?>! Here's what's
                happening today.</p>
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

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <?php
                    if ($getRevenueChange >= 0) {
                        $colorTag = "positive";
                    } else {
                        $colorTag = 'negative';
                    } ?>
                    <div class="stat-title">Total Revenue (RM)</div>
                    <div class="stat-value"><?php echo number_format($getRevenue, 2); ?></div>
                    <div class="stat-change <?php echo $colorTag; ?>">
                        <?php
                        if ($getRevenueChange >= 0 && $getRevenueChange < 9999) {
                            echo "↑ " . number_format($getRevenueChange, 2) . "% from last month";
                        } elseif ($getRevenueChange >= 9999) {
                            echo "↑ " . number_format($getRevenueChange, 2) . "%.. growing so much in a month.. sus";
                        } else {
                            echo "↓ " . number_format($getRevenueChange, 2) . "% from last month";
                        }
                        ?>
                    </div>
                </div>
                <div class="stat-icon blue">💵</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <?php
                    if ($totalOrderChange >= 0) {
                        $colorTag = "positive";
                    } else {
                        $colorTag = 'negative';
                    } ?>
                    <div class="stat-title">Total Orders</div>
                    <div class="stat-value"><?php echo $currentTotalOrder; ?></div>
                    <div class="stat-change <?php echo $colorTag; ?>">
                        <?php
                        if ($totalOrderChange >= 0) {
                            echo "↑ " . number_format($totalOrderChange, 2) . "% from last month";
                        } else {
                            echo "↓ " . number_format($totalOrderChange, 2) . "% from last month";
                        }
                        ?>
                    </div>
                </div>
                <div class="stat-icon green">📦</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <?php
                    if ($soldChange >= 0) {
                        $colorTag = "positive";
                    } else {
                        $colorTag = 'negative';
                    } ?>
                    <div class="stat-title">Products Sold</div>
                    <div class="stat-value"><?php echo $currSold; ?></div>
                    <div class="stat-change <?php echo $colorTag; ?>">
                        <?php
                        if ($soldChange >= 0) {
                            echo "↑ " . number_format($soldChange, 2) . "% from last month";
                        } else {
                            echo "↓ " . number_format($soldChange, 2) . "% from last month";
                        }
                        ?>
                    </div>
                </div>
                <div class="stat-icon purple">📱</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <?php
                    if ($newCustPercent >= 0) {
                        $colorTag = "positive";
                    } else {
                        $colorTag = 'negative';
                    } ?>
                    <div class="stat-title">New Customers</div>
                    <div class="stat-value"><?php echo $newCust; ?></div>
                    <div class="stat-change <?php echo $colorTag; ?>">
                        <?php
                        if ($newCustPercent >= 0) {
                            echo "↑ " . number_format($newCustPercent, 2) . "% from last month";
                        } else {
                            echo "↓ " . number_format($newCustPercent, 2) . "% from last month";
                        }
                        ?>
                    </div>
                </div>
                <div class="stat-icon orange">👥</div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Orders</h3>
                <a href="Order_Seller" class="card-action">View All →</a>
            </div>

            <div id="recent_order" class="d-flex justify-content-center align-items-center">
                <img src="<?php echo base_url('assets/images/loading.gif'); ?>" style="width:100px;">
            </div>
        </div>

        <!-- Low Stock Alerts & Quick Actions -->
        <div>
            <div class="card" style="margin-bottom: 1.5rem;">
                <div class="card-header">
                    <h3 class="card-title">Low Stock Alerts</h3>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#stockModal" class="card-action">View All →</a>
                </div>
                <?php
                $i = 0;
                foreach ($lowStock as $low) {
                    if ($i >= 2) {
                        break;
                    }
                    ?>
                    <div class="alert-item">
                        <span class="alert-icon">⚠️</span>
                        <div class="alert-content">
                            <h4><?php echo $low->phone_name; ?></h4>
                            <p>Only <?php echo $low->stock; ?> units left in stock</p>
                        </div>
                    </div>
                    <?php $i++;
                }
                if (empty($lowStock)) { ?>
                    <div class="text-center py-2">
                        <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_jbrw3hcz.json" background="transparent" speed="1" style="width: 100px; height: 100px; margin:auto;" loop autoplay>
                        </lottie-player>
                        <h6 class="mt-3 text-success fw-semibold">All items are well stocked!</h6>
                        <p class="text-muted small">No low-stock alerts for now.</p>
                    </div>
                <?php } ?>

                <!-- Add Product Modal -->
                <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg">
                            <form id="addProductForm" method="POST" action="<?php echo base_url() . "Product/add" ?>" enctype="multipart/form-data">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="addProductLabel">
                                        <i class="bi bi-plus-circle me-2"></i>Add Product
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body row g-3 px-4 py-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Phone Name</label>
                                        <input type="text" class="form-control" name="phone_name" placeholder="e.g. iPhone 15 Pro" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Brand</label>
                                        <select class="form-select" name="brand" id="brandSelect" required>
                                            <option value="">Choose Brand</option>
                                            <option value="Apple">Apple</option>
                                            <option value="Samsung">Samsung</option>
                                            <option value="Google">Google</option>
                                            <option value="Xiaomi">Xiaomi</option>
                                            <option value="Oppo">Oppo</option>
                                            <option value="Other">Other</option>
                                        </select>

                                        <!-- Show when "Other" is selected -->
                                        <input type="text" class="form-control mt-2 d-none" id="otherBrand" name="other_brand" placeholder="Enter new brand name">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Description</label>
                                        <textarea class="form-control" name="description" rows="3" placeholder="Enter product description..." required></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Price (RM)</label>
                                        <input type="number" step="0.01" class="form-control" name="price" placeholder="e.g. 4999.00" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Storage (GB)</label>
                                        <input type="number" class="form-control" name="storage" placeholder="e.g. 256" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">RAM (GB)</label>
                                        <input type="text" class="form-control" name="ram" placeholder="e.g. 8" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Battery (mAh)</label>
                                        <input type="text" class="form-control" name="battery" placeholder="e.g. 5000" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Operating System</label>
                                        <input type="text" class="form-control" name="os" placeholder="e.g. Android 14 / iOS 17" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Stock Quantity</label>
                                        <input type="number" class="form-control" name="stock" placeholder="e.g. 10" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold d-block">Phone Image</label>
                                        <input type="file" id="imageUpload1" name="image" accept="image/png, image/jpeg, image/jpg" class="d-none" required>
                                        <label for="imageUpload1" class="btn btn-outline-danger">
                                            <i class="bi bi-upload me-1"></i> Upload Image
                                        </label>
                                        <small class="text-muted ms-2">(PNG, JPG, JPEG)</small>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle me-1"></i>Cancel
                                    </button>
                                    <button class="btn btn-danger" type="submit">
                                        <i class="bi bi-check-circle me-1"></i>Add Product
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Modal -->
                <div class="modal fade" id="stockModal" tabindex="-1" aria-labelledby="stockModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 shadow-lg">

                            <!-- Header -->
                            <div class="modal-header bg-warning bg-gradient text-dark border-0">
                                <h5 class="modal-title fw-bold d-flex align-items-center" id="stockModalLabel">
                                    <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i> Low Stock Alert
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- Body -->
                            <div class="modal-body bg-light">
                                <?php if (!empty($lowStock) && is_array($lowStock)) { ?>
                                    <div class="row g-3">
                                        <?php foreach ($lowStock as $item) { ?>
                                            <div class="col-md-6">
                                                <div class="card border-0 shadow-sm h-100">
                                                    <div class="card-body d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <h6 class="fw-bold mb-1 text-dark">
                                                                <?php echo htmlspecialchars($item->phone_name); ?>
                                                            </h6>
                                                            <p class="mb-1 text-muted small">Current stock:
                                                                <span class="fw-semibold text-danger"><?php echo (int) $item->stock; ?>
                                                                    units</span>
                                                            </p>

                                                            <?php if ($item->stock == 0) { ?>
                                                                <span class="badge bg-danger">Out of Stock</span>
                                                            <?php } elseif ($item->stock < 5) { ?>
                                                                <span class="badge bg-warning text-dark">Critical</span>
                                                            <?php } else { ?>
                                                                <span class="badge bg-info text-dark">Low</span>
                                                            <?php } ?>
                                                        </div>
                                                        <i class="bi bi-phone-fill text-secondary fs-3 opacity-50"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="text-center py-5">
                                        <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_totrpclr.json" background="transparent" speed="1" style="width: 100px; height: 100px; margin:auto;" loop autoplay>
                                        </lottie-player>
                                        <h6 class="mt-3 text-success fw-semibold">All items are well stocked!</h6>
                                        <p class="text-muted small">No low-stock alerts for now.</p>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Footer -->
                            <div class="modal-footer bg-white border-0">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-1"></i> Close
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Actions</h3>
                </div>
                <div class="quick-actions">
                    <button class="action-btn" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <span>➕</span>
                        Add Product
                </div>
            </div>
        </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajax({
            url: 'Order_seller/recent_order',
            type: 'POST',

            success: function (response) {
                $('#recent_order').html(response);
            }
        })
    });
</script>

</body>

</html>