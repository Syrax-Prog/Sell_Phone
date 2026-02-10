<!-- Main Content -->
<main class="main-content">
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

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('message')) { ?>
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?php echo $this->session->flashdata('message'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Search Toolbar -->
    <div class="bg-white rounded shadow-sm p-3 mb-3 d-flex justify-content-center">
        <div class="row g-2 align-items-center w-100 justify-content-center">
            <div class="col-auto d-flex align-items-center">

                <!-- Search Form -->
                <form method="GET" action="<?php echo site_url('Product/discount') ?>" class="d-flex me-3" id="form1">
                    <input type="text" name="search" class="form-control" placeholder="Search phones..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>" style="width: 400px;">
                    <button class="btn btn-outline-secondary ms-2" type="submit">🔍</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Product Table -->
    <div class="row">
        <div class="col-12">
            <div class="shadow-sm rounded" style="border:1px solid lightgrey;">
                <div class="card-header bg-white p-4 rounded">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold">
                            List Product With Active Discount
                        </h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="productsTable" class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3 px-4 fw-semibold text-secondary border-0">Product</th>
                                <th class="py-3 px-4 fw-semibold text-secondary border-0">Phone ID</th>
                                <th class="py-3 px-4 fw-semibold text-secondary border-0">Price (RM)</th>
                                <th class="py-3 px-4 fw-semibold text-secondary border-0">Discount (%)</th>
                                <th class="py-3 px-4 fw-semibold text-secondary border-0">Final Price (RM)</th>
                                <th class="py-3 px-4 fw-semibold text-secondary border-0 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($phones as $p) { ?>
                                <tr class="border-bottom">
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-light rounded-3 p-2 border" style="width: 60px; height: 60px; overflow: hidden;">
                                                <img src="<?php echo base_url() . $p->image_url; ?>" class="w-100 h-100" style="object-fit: cover;">
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-dark mb-1"><?php echo $p->phone_name; ?></div>
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary border"><?php echo $p->brand; ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-info bg-opacity-10 text-info border border-info fs-6 px-3 py-2">
                                            #<?php echo $p->phone_id; ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="fw-semibold text-dark">RM <?php echo number_format($p->current_price, 2); ?></span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <?php if ($p->discount > 0) { ?>
                                            <span class="badge bg-danger fs-6 px-3 py-2"><?php echo $p->discount; ?>% OFF</span>
                                        <?php } else { ?>
                                            <span class="text-muted">-</span>
                                        <?php } ?>
                                    </td>
                                    <td class="px-4 py-3">
                                        <?php
                                        $discountedPrice = $p->current_price - (($p->discount / 100) * $p->current_price);
                                        $finalPrice = max($discountedPrice, 0);
                                        ?>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-success fs-5">RM <?php echo number_format($finalPrice, 2); ?></span>
                                            <?php if ($p->discount > 0) { ?>
                                                <small class="text-muted text-decoration-line-through">RM <?php echo number_format($p->current_price, 2); ?></small>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="btn-group" role="group">
                                            <button class="end_discount btn btn-outline-danger btn-sm" data-id="<?php echo $p->phone_id; ?>">
                                                End Discount
                                            </button>
                                            <button class="edit btn btn-outline-primary btn-sm" data-id="<?php echo $p->phone_id; ?>" data-current="<?php echo $p->discount; ?>">
                                                Edit Discount
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white border-0 p-4">
                    <div class="d-flex justify-content-center">
                        <?php echo $pagination; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            display: none;
        }

        .content-popup {
            background-color: white;
            width: 400px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
    </style>

    <div id="end_popup" class="popup" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:9999;">
        <div class="content-popup" style="background:white; padding:20px; border-radius:8px; text-align:center;">
            <h3 id="title"></h3>
            <p id="text"></p>

            <!-- Form for editing -->
            <form id="popupForm" method="post" action="">
                <input type="number" name="discount_value" id="discount_value" placeholder="Enter discount" style="margin-bottom:10px;">
                <br>
                <button type="submit" class="btn btn-danger border border-dark" id="confirm">Confirm</button>
                <button type="button" id="closePopup" class="btn btn-info border border-dark">Close</button>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.end_discount', function () {
                var id = $(this).data('id');
                var popup = $('#end_popup');

                popup.css('display', 'flex');

                $('#title').text('Confirm End');
                $('#text').text('Are you sure you want to end discount #' + id + '?');
                $('#popupForm').attr('action', '<?php echo base_url("Discount/end_discount/"); ?>' + id);
                $('#discount_value').hide();
            });

            $(document).on('click', '.edit', function () {
                var id = $(this).data('id');
                var popup = $('#end_popup');
                var curr = $(this).data('current');

                popup.css('display', 'flex');

                $('#title').text('Edit Discount');
                $('#text').text('Edit Discount Value #' + id + '?');

                $('#discount_value').show();

                $('#discount_value').attr('placeholder', curr);
                $('#popupForm').attr('action', '<?php echo base_url("Discount/edit/"); ?>' + id);
            });

            $('#closePopup').on('click', function () {
                $('#end_popup').hide();
            });

            $('#end_popup').on('click', function (e) {
                if (e.target === this) $(this).hide();
            });
        });

    </script>

</main>