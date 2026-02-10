<main class="main-content">
    <div class="header">
        <div>
            <h1>Sales Analytics</h1>
            <p style="color: #64748b; margin-top: 0.3rem;">
                Gain valuable insights into your product performance today.
                Monitor trends, optimize inventory, and make data-driven decisions with ease.
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

    <form action="<?php echo base_url('Analytics') ?>" method="POST">
        <!-- Filters Section -->
        <div class="bg-white rounded shadow-sm p-3 mb-4">
            <div class="row g-3">
                <div class="col-12 col-md-4 col-lg-3">
                    <label for="brandFilter" class="form-label small text-muted mb-1">Brand</label>
                    <select class="form-select" id="brandFilter" name="brandFilter">
                        <option value="">All Brand</option>

                        <?php foreach ($allBrand as $brand) { ?>
                            <?php if ($currBrand == $brand->brand) { ?>
                                <option value="<?php echo $brand->brand; ?>" <?php echo "Selected"; ?>><?php echo $brand->brand; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $brand->brand; ?>"><?php echo $brand->brand; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>

                <?php if (isset($currDate)) { ?>
                    <div class="col-12 col-md-4 col-lg-3">
                        <label for="dateRange" class="form-label small text-muted mb-1">Date From</label>
                        <input type="date" class="form-control" name="dateFilter" value="<?php echo $currDate; ?>">
                    </div>
                <?php } else { ?>
                    <div class="col-12 col-md-4 col-lg-3">
                        <label for="dateRange" class="form-label small text-muted mb-1">Date From</label>
                        <input type="date" class="form-control" name="dateFilter">
                    </div>
                <?php } ?>

                <div class="col-12 col-md-12 col-lg-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel"></i> Apply Filters
                    </button>
                    <a href="<?php echo base_url('Analytics') ?>" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </a>
                </div>
            </div>
        </div>
    </form>

    <div class="container-fluid py-2">
        <div class="row g-4">
            <!-- Daily Sales Chart -->
            <div class="col-12 col-lg-8">
                <div class="bg-white rounded shadow-sm p-4 h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h2 class="h4 mb-1">
                                Daily Sales From -
                                <?php
                                if (!empty($currDate)) {
                                    echo date('d F Y', strtotime($currDate)); // shows filtered date
                                } else {
                                    echo date('F Y'); // shows current month + year
                                }
                                ?>
                            </h2>

                            <p class="text-muted small mb-0">Month vs Sales (RM)</p>
                        </div>
                        <span class="badge bg-primary">Updated</span>
                    </div>
                    <canvas id="dailySalesChart" height="165" data-labels='<?php echo $days; ?>' data-data='<?php echo $totals; ?>'></canvas>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-12 col-lg-4">
                <!-- Top Products -->
                <div class="bg-white rounded shadow-sm p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h2 class="h4 mb-1">Top 3 Products</h2>
                            <p class="text-muted small mb-0">Product vs Total Sold</p>
                        </div>
                    </div>
                    <canvas id="topProduct" height="100" data-labels='<?php echo $products; ?>' data-data='<?php echo $sold; ?>'>
                    </canvas>
                </div>

                <!-- Total Revenue Card -->
                <div class="rounded shadow-sm text-center p-4 d-flex flex-column align-items-center justify-content-center" style="background: linear-gradient(135deg, #4CAF50, #81C784); color: white; min-height: 150px;">
                    <div class="mb-2">
                        <i class="bi bi-currency-dollar fs-3"></i>
                    </div>
                    <h5 class="text-uppercase fw-bold small mb-3">Total Revenue</h5>
                    <h2 class="fw-bold mb-2 display-5">
                        RM <?php echo number_format($revenue, 2); ?>
                    </h2>
                    <small class="opacity-75">Current Month</small>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <!-- Order Summary -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="bg-white rounded shadow-sm p-4 h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h2 class="h4 mb-1">Order Summary (%)</h2>
                            <p class="text-muted small mb-0">Excluded Cancelled Orders</p>
                        </div>
                    </div>
                    <canvas id="summaryChart" height="80" data-labels='<?php echo $status; ?>' data-data='<?php echo $percentage; ?>'>
                    </canvas>
                </div>
            </div>

            <!-- Top Brands -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="bg-white rounded shadow-sm p-4 h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h2 class="h4 mb-1">Top 3 Brands</h2>
                            <p class="text-muted small mb-0">Brand vs Total Sold</p>
                        </div>
                    </div>
                    <canvas id="topBrand" height="165" data-labels='<?php echo $brands; ?>' data-data='<?php echo $bsold; ?>'>
                    </canvas>
                </div>
            </div>

            <!-- Order Status Cards -->
            <div class="col-12 col-lg-4">
                <div class="row g-3">
                    <!-- Completed Orders -->
                    <div class="col-12">
                        <div class="rounded shadow-sm text-center p-4 d-flex flex-column align-items-center justify-content-center" style="background: linear-gradient(135deg, #2ECC71, #27AE60); color: white; min-height: 140px;">
                            <div class="mb-2">
                                <i class="bi bi-check-circle fs-2"></i>
                            </div>
                            <h5 class="text-uppercase fw-bold small mb-3">
                                Total Completed Orders
                            </h5>
                            <h2 class="fw-bold mb-2 display-6">
                                <?php echo $count_status[2]; ?>
                            </h2>
                            <small class="opacity-75">Current Month</small>
                        </div>
                    </div>

                    <!-- Shipped Orders -->
                    <div class="col-12">
                        <div class="rounded shadow-sm text-center p-4 d-flex flex-column align-items-center justify-content-center" style="background: linear-gradient(135deg, #E67E22, #D35400); color: white; min-height: 140px;">
                            <div class="mb-2">
                                <i class="bi bi-truck fs-2"></i>
                            </div>
                            <h5 class="text-uppercase fw-bold small mb-3">
                                Total Shipped Orders
                            </h5>
                            <h2 class="fw-bold mb-2 display-6">
                                <?php echo $count_status[1]; ?>
                            </h2>
                            <small class="opacity-75">Current Month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/dailySale.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/topSold.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/order_summary.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/topBrand.js'); ?>"></script>
</main>