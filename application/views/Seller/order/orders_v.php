<!-- Main Content -->
<main class="main-content">

    <div class="header">
        <div>
            <h1>Orders Management</h1>
            <p style="color: #64748b; margin-top: 0.3rem;">
                Monitor, manage, and update all customer orders efficiently in one place.
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

    <!-- Success/Error Messages -->
    <div class="alert alert-success alert-dismissible fade show d-none" role="alert" id="successAlert">
        <i class="bi bi-check-circle me-2"></i>
        <span id="successMessage"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-danger alert-dismissible fade show d-none" role="alert" id="errorAlert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <span id="errorMessage"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- Toolbar -->
    <div class="bg-white rounded shadow-sm p-3 mb-3">
        <div class="row g-2 align-items-center">
            <!-- Search -->
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <form method="GET" action="<?php echo base_url('Order_seller') ?>">
                        <!-- Preserve the current status dynamically -->
                        <input type="hidden" name="status" value="<?php echo $this->input->get('status') ?>">
                        <input class="form-control border-start-0 ps-0" id="searchInput" placeholder="Search by Order ID, Customer name..." name="search" value="<?php echo $this->input->get('search') ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-info text-center mt-3">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php } ?>

    <!-- Orders Table -->
    <div class="card shadow-sm border-0">
        <div class="table-responsive">

            <?php if (!empty($all_orders)) { ?>
                <table class="table align-middle table-hover mb-0" id="orderTable">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Order ID</th>
                            <th>Customer</th>
                            <th>Products</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_orders as $order) { ?>
                            <tr data-bs-toggle="modal" data-bs-target="#orderDetail<?php echo $order->order_id; ?>" style="cursor: pointer;">
                                <td class="ps-4">
                                    <span class="fw-bold text-primary"># <?php echo $order->order_id; ?></span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <span class="fw-bold text-primary"><?php echo strtoupper(substr($order->username, 0, 2)); ?></span>
                                        </div>
                                        <div>
                                            <div class="fw-semibold"><?php echo $order->username; ?></div>
                                            <small class="text-muted"><?php echo $order->email; ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-bag-check text-success fs-5 me-2"></i>

                                        <?php
                                        // Count cancelled items for this order
                                        $cancelled_count = 0;
                                        foreach ($all_order_items[$order->order_id] as $item) {
                                            if ($item->is_cancelled == 1) {
                                                $cancelled_count++;
                                            }
                                        }

                                        $total_items = count($all_order_items[$order->order_id]);
                                        ?>

                                        <div>
                                            <span class="fw-semibold"><?php echo $total_items; ?> Item</span>
                                            <?php if ($cancelled_count > 0) { ?>
                                                <small class="text-danger d-block">
                                                    <?php echo $cancelled_count; ?> Item Cancelled
                                                </small>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <span class="fw-bold text-success">RM <?php echo number_format($order->total_price, 2) ?></span>
                                </td>
                                <td>

                                    <!-- badge and icon for each status -->
                                    <?php
                                    $dis = 'Hidden';
                                    $status = $order->status; // e.g., "Completed"
                                    switch ($status) {
                                        case "Completed":
                                            $badge = "bg-success";
                                            $icon = "bi-check-circle";
                                            break;
                                        case "Order Placed":
                                            $badge = "bg-primary";
                                            $icon = "bi-cart-check";
                                            $dis = '';
                                            break;
                                        case "Shipped":
                                            $badge = "bg-info";
                                            $icon = "bi-truck";
                                            $dis = '';
                                            break;
                                        case "Cancelled":
                                            $badge = "bg-danger";
                                            $icon = "bi-x-circle";
                                            break;
                                        default:
                                            $badge = "bg-secondary";
                                            $icon = "bi-question-circle";
                                    }
                                    ?>

                                    <span class="badge <?php echo $badge; ?>">
                                        <i class="bi <?php echo $icon; ?> me-1"></i><?php echo $order->status; ?>
                                    </span>
                                </td>
                                <td>
                                    <div>
                                        <div class="fw-semibold"><?php echo date('d M Y', strtotime($order->order_date)); ?></div>
                                        <small class="text-muted"><?php echo date('h:i A', strtotime($order->order_date)); ?></small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#updateStatus<?php echo $order->order_id; ?>" title="Update Status" <?php echo $dis; ?>>
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelModal<?php echo $order->order_id; ?>" title="Cancel Order" <?php echo $dis; ?>>
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="text-center py-5">
                    <h5 class="text-muted">Whoa! The order list you requested is empty!</h5>
                    <p>Time to grab some coffee while we wait for orders to arrive.</p>
                </div>
            <?php } ?>

            <div id="pagination" class="d-flex justify-content-center mt-3"></div>
        </div>

        <?php foreach ($all_orders as $order) { ?>
            <!-- Cancel Confirmation Modal -->
            <div class="modal fade" id="cancelModal<?php echo $order->order_id; ?>" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="cancelModalLabel"><i class="bi bi-x-circle me-2"></i>Cancel Order</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to force cancel all item in this order <strong>#<?php echo $order->order_id; ?></strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <a href="Order_seller/cancel/<?php echo $order->order_id; ?>" class="btn btn-danger">Yes, Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php foreach ($all_orders as $order) { ?>
            <div class="modal fade" id="orderDetail<?php echo $order->order_id; ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content print-area">
                        <!-- Header -->
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
                                <i class="bi bi-receipt me-2"></i>Order Details: <strong># <?php echo $order->order_id; ?></strong>
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <!-- Order Status Timeline -->
                            <div class="card border-0 bg-light mb-3">
                                <!-- Customer Information -->
                                <div class="card border mb-3">
                                    <div class="card-body">
                                        <h6 class="text-primary mb-3"><i class="bi bi-person-circle me-2"></i>Customer Information</h6>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Username</small>
                                                <strong><?php echo $order->username; ?></strong>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Email Address</small>
                                                <strong><?php echo $order->email; ?></strong>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Customer ID</small>
                                                <strong># <?php echo $order->user_id; ?></strong>
                                            </div>
                                            <div class="col-12">
                                                <small class="text-muted d-block mb-1">Shipping Address</small>
                                                <strong><?php echo $order->address_at_order; ?></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Items -->
                                <div class="card border mb-3">
                                    <div class="card-body">
                                        <h6 class="text-primary mb-3"><i class="bi bi-cart me-2"></i>Order Items</h6>

                                        <?php $count = 0;
                                        foreach ($all_order_items[$order->order_id] as $i) {
                                            if ($i->is_cancelled == 1) {
                                                $count++;
                                            }
                                            ?>
                                            <div class="d-flex align-items-center p-3 bg-light rounded mb-2">
                                                <img src="<?php echo $i->image_url; ?>" class="rounded border me-3" width="60" height="60">
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold"><?php echo $i->phone_name; ?></div>
                                                    <small class="text-muted"><?php echo $i->storage_at_order . "GB, " . $i->brand; ?></small>
                                                    <div class="mt-1">
                                                        <?php
                                                        if ($i->is_cancelled == 1) { ?>
                                                            <span class="badge bg-danger">Cancelled</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <div class="text-muted small">Qty: <?php echo $i->quantity; ?></div>
                                                    <div class="fw-bold">RM <?php echo number_format($i->subtotal, 2); ?></div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <!-- Payment & Summary -->

                                <div class="card border">
                                    <div class="card-body">
                                        <h6 class="text-primary mb-3"><i class="bi bi-credit-card me-2"></i>Payment Summary</h6>
                                        <div class="row g-2 mb-2">
                                            <div class="col-6 text-muted">Subtotal (<?php echo count($all_order_items[$order->order_id]) - $count; ?> items):</div>
                                            <div class="col-6 text-end">RM <?php echo number_format($order->total_price, 2); ?></div>
                                        </div>
                                        <div class="row g-2 mb-2">
                                            <div class="col-6 text-muted">Shipping Fee:</div>
                                            <div class="col-6 text-end">RM 0.00</div>
                                        </div>
                                        <div class="row g-2 mb-2">
                                            <div class="col-6 text-success">Discount:</div>
                                            <div class="col-6 text-end text-success">RM 0.00</div>
                                        </div>
                                        <hr>
                                        <div class="row g-2">
                                            <div class="col-6 fw-bold fs-5">Total Amount:</div>
                                            <div class="col-6 text-end fw-bold text-success fs-5">RM <?php echo number_format($order->total_price, 2); ?></div>
                                        </div>
                                        <div class="mt-3">
                                            <small class="text-muted d-block">Payment Method: <strong>Online Banking | <?php echo $order->username; ?></strong></small>
                                            <small class="text-muted d-block">Payment Status: <span class="badge bg-success">Paid</span></small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-1"></i>Close
                                </button>
                                <?php $d = $order->status != 'Order Placed' && $order->status != 'Shipped' ? 'disabled' : ''; ?>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateStatus<?php echo $order->order_id; ?>" data-bs-dismiss="modal" <?php echo $d; ?>>
                                    <i class="bi bi-pencil me-1"></i>Update Status
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php foreach ($all_orders as $order) { ?>
            <div class="modal fade" id="updateStatus<?php echo $order->order_id; ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-dark">
                            <h5 class="modal-title">
                                <i class="bi bi-pencil-square me-2"></i>Update Order Status
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <form id="updateStatusForm" method="POST" action="Order_seller/update_status/<?php echo $order->order_id; ?>">
                                <div class="alert alert-info d-flex align-items-center">
                                    <i class="bi bi-info-circle me-2 fs-5"></i>
                                    <div>
                                        <small class="d-block"><strong>Order ID:</strong> # <?php echo $order->order_id; ?></small>
                                        <small class="d-block"><strong>Current Status:</strong> <span><?php echo $order->status; ?></span></small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-bookmark-check me-1"></i>New Order Status <span class="text-danger">*</span>
                                    </label>
                                    <?php $sel = ''; ?>

                                    <select class="form-select form-select-lg" name="status" required>
                                        <option value="Order Placed" <?php echo $order->status == "Order Placed" ? 'selected' : '';
                                        echo $order->status == "Shipped" ? 'disabled' : ''; ?>>Order Placed</option>
                                        <option value="Shipped" <?php echo $order->status == "Shipped" ? 'selected' : ''; ?>>Shipped</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i>Cancel
                            </button>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-check-circle me-1"></i>Update Status
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // ====== SETTINGS ======
        const rowsPerPage = 8;
        const table = document.getElementById('orderTable');
        const tableBody = table.querySelector('tbody');
        let rows = Array.from(tableBody.querySelectorAll('tr'));

        // Get filter elements
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const clearFiltersBtn = document.getElementById('clearFilters');

        // Pagination container
        const pagination = document.getElementById('pagination');
        let currentPage = 1;

        // ====== FILTER FUNCTION ======
        function applyFilters() {
            const searchValue = searchInput.value.trim().toLowerCase();
            const statusValue = statusFilter.value.trim().toLowerCase();

            rows.forEach(function (row) {
                const cells = row.cells;
                let showRow = true;

                // Search filter (Order ID + Customer)
                if (searchValue !== '') {
                    const orderId = cells[0].textContent.trim().toLowerCase();
                    const customerText = cells[1].textContent.trim().toLowerCase();
                    if (orderId.indexOf(searchValue) === -1 && customerText.indexOf(searchValue) === -1) {
                        showRow = false;
                    }
                }

                // Status filter (Status cell index 4)
                if (statusValue !== '' && showRow === true) {
                    const statusText = cells[4].textContent.trim().toLowerCase();
                    if (statusText.indexOf(statusValue) === -1) {
                        showRow = false;
                    }
                }

                // Mark row as filtered (don't show/hide yet, pagination will handle it)
                if (showRow === true) {
                    row.setAttribute('data-filtered', 'true');
                } else {
                    row.setAttribute('data-filtered', 'false');
                }
            });

            updatePagination();
        }

        // ====== CLEAR FILTERS ======
        function clearFilters() {
            searchInput.value = '';
            statusFilter.value = '';
            rows.forEach(function (row) {
                row.setAttribute('data-filtered', 'true');
            });
            updatePagination();
        }

        // ====== PAGINATION FUNCTIONS ======
        function showPage(pageNumber) {
            // Get only filtered (visible) rows
            const visibleRows = rows.filter(function (row) {
                return row.getAttribute('data-filtered') === 'true';
            });

            const startIndex = (pageNumber - 1) * rowsPerPage;
            const endIndex = startIndex + rowsPerPage;

            // Hide all rows first
            rows.forEach(function (row) {
                row.style.display = 'none';
            });

            // Show only the rows for current page
            visibleRows.forEach(function (row, index) {
                if (index >= startIndex && index < endIndex) {
                    row.style.display = '';
                }
            });

            currentPage = pageNumber;
            renderPagination(pageNumber);
        }

        function updatePagination() {
            currentPage = 1;
            showPage(currentPage);
        }

        function renderPagination(pageNumber) {
            const visibleRows = rows.filter(function (row) {
                return row.getAttribute('data-filtered') === 'true';
            });

            const totalPages = Math.ceil(visibleRows.length / rowsPerPage);
            pagination.innerHTML = '';

            // Don't show pagination if only 1 page or no results
            if (totalPages <= 1) {
                return;
            }

            // Previous button
            const prevBtn = document.createElement('button');
            prevBtn.textContent = 'Previous';
            prevBtn.className = 'btn btn-sm btn-outline-primary me-1';
            prevBtn.disabled = pageNumber === 1;
            prevBtn.onclick = function () {
                showPage(pageNumber - 1);
            };
            pagination.appendChild(prevBtn);

            // Page number buttons (show max 5 pages at a time)
            let startPage = Math.max(1, pageNumber - 2);
            let endPage = Math.min(totalPages, startPage + 4);

            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }

            // First page button if not in range
            if (startPage > 1) {
                const firstBtn = document.createElement('button');
                firstBtn.textContent = '1';
                firstBtn.className = 'btn btn-sm btn-outline-primary ms-1 me-1';
                firstBtn.onclick = function () {
                    showPage(1);
                };
                pagination.appendChild(firstBtn);

                if (startPage > 2) {
                    const dots = document.createElement('span');
                    dots.textContent = '...';
                    dots.className = 'mx-2';
                    pagination.appendChild(dots);
                }
            }

            // Page number buttons
            for (let i = startPage; i <= endPage; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.textContent = i;
                pageBtn.className = 'btn btn-sm ms-1 me-1';

                if (i === pageNumber) {
                    pageBtn.classList.add('btn-primary');
                } else {
                    pageBtn.classList.add('btn-outline-primary');
                }

                pageBtn.onclick = function () {
                    showPage(i);
                };
                pagination.appendChild(pageBtn);
            }

            // Last page button if not in range
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const dots = document.createElement('span');
                    dots.textContent = '...';
                    dots.className = 'mx-2';
                    pagination.appendChild(dots);
                }

                const lastBtn = document.createElement('button');
                lastBtn.textContent = totalPages;
                lastBtn.className = 'btn btn-sm btn-outline-primary ms-1 me-1';
                lastBtn.onclick = function () {
                    showPage(totalPages);
                };
                pagination.appendChild(lastBtn);
            }

            // Next button
            const nextBtn = document.createElement('button');
            nextBtn.textContent = 'Next';
            nextBtn.className = 'btn btn-sm btn-outline-primary ms-1';
            nextBtn.disabled = pageNumber === totalPages;
            nextBtn.onclick = function () {
                showPage(pageNumber + 1);
            };
            pagination.appendChild(nextBtn);
        }

        // ====== EVENT LISTENERS ======
        let searchTimeout;
        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(applyFilters, 300);
        });

        statusFilter.addEventListener('change', applyFilters);
        clearFiltersBtn.addEventListener('click', clearFilters);

        // ====== INITIAL LOAD ======
        // Initialize all rows as filtered (visible)
        rows.forEach(function (row) {
            row.setAttribute('data-filtered', 'true');
        });
        showPage(currentPage);
    });
</script>
</body>

</html>