<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spinkit/1.2.5/spinkit.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://localhost/Sell_Phone/assets/css/admin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.x.x/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>PhoneStore</title>
</head>

<body>
    <?php
    $controller = $this->router->fetch_class();
    $method = $this->router->fetch_method();
    ?>

    <aside class="sidebar">
        <div class="logo">
            <h2>📱 PhoneStore</h2>
            <p>Admin Panel, <?php echo $this->username; ?></p>
        </div>

        <ul class="nav-menu">
            <a href="<?php echo base_url() . "Home_seller" ?>" style="text-decoration: none;">
                <li class="nav-item">
                    <span class="nav-icon"><i class="bi bi-house"></i></span>
                    <span>Dashboard</span>
                </li>
            </a>

            <li class="nav-item" data-bs-toggle="collapse" data-bs-target="#productsSubmenu" aria-expanded="false">
                <span class="nav-icon"><i class="bi bi-box"></i></span>
                <span>Products</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </li>
            <div class="collapse" id="productsSubmenu">
                <ul style="list-style: none; padding-left: 0; margin: 0; background: rgba(0,0,0,0.2);">
                    <li style="padding: 10px 20px 10px 50px;">
                        <a href="<?php echo base_url() . "Product" ?>" style="color: grey; text-decoration: none;">Product Listing</a>
                    </li>
                    <li style="padding: 10px 20px 10px 50px;">
                        <a href="<?php echo base_url() . "Product/add" ?>" style="color: grey; text-decoration: none;">Add Product</a>
                    </li>
                    <li style="padding: 10px 20px 10px 50px;">
                        <a href="<?php echo base_url() . "Product/discount" ?>" style="color: grey; text-decoration: none;">Manage Discounts</a>
                    </li>
                    <ul style="list-style: none; padding: 10px 20px 10px 50px;" id="brandSubmenu">
                        <a href="<?php echo base_url() . "Brand" ?>" style="color: grey; text-decoration: none;">Manage Brands</a>
                    </ul>
                </ul>
            </div>

            <li class="nav-item" data-bs-toggle="collapse" data-bs-target="#ordersSubmenu" aria-expanded="false">
                <span class="nav-icon"><i class="bi bi-receipt"></i></span>
                <span>Orders</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </li>
            <div class="collapse" id="ordersSubmenu">
                <ul style="list-style: none; padding-left: 0; margin: 0; background: rgba(0,0,0,0.2);">
                    <li style="padding: 10px 20px 10px 50px;">
                        <a href="<?php echo base_url() . "Order_seller?status=Order Placed" ?>" style="color: grey; text-decoration: none;">Order Placed</a>
                    </li>
                    <li style="padding: 10px 20px 10px 50px;">
                        <a href="<?php echo base_url() . "Order_seller?status=Shipped" ?>" style="color: grey; text-decoration: none;">Shipped</a>
                    </li>
                    <ul style="list-style: none; padding: 10px 20px 10px 50px;" id="brandSubmenu">
                        <a href="<?php echo base_url() . "Order_seller?status=Completed" ?>" style="color: grey; text-decoration: none;">Completed</a>
                    </ul>
                    <li style="padding: 10px 20px 10px 50px;">
                        <a href="<?php echo base_url() . "Order_seller?status=Cancelled" ?>" style="color: grey; text-decoration: none;">Cancelled</a>
                    </li>
                </ul>
            </div>

            <li class="nav-item" data-bs-toggle="collapse" data-bs-target="#customerSubmenu" aria-expanded="false">
                <span class="nav-icon"><i class="bi bi-people"></i></span>
                <span>Users</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </li>
            <div class="collapse" id="customerSubmenu">
                <ul style="list-style: none; padding-left: 0; margin: 0; background: rgba(0,0,0,0.2);">
                    <li style="padding: 10px 20px 10px 50px;">
                        <a href="<?php echo base_url() . "Customer" ?>" style="color: grey; text-decoration: none;">Manage Customer</a>
                    </li>
                    <?php if ($this->admin == 'super') { ?>
                        <li style="padding: 10px 20px 10px 50px;">
                            <a href="<?php echo base_url() . "Customer/new_admin" ?>" style="color: grey; text-decoration: none;">Add New Admin</a>
                        </li>
                        <li style="padding: 10px 20px 10px 50px;">
                            <a href="<?php echo base_url() . "Customer/admin_list" ?>" style="color: grey; text-decoration: none;">Admin Listing</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <a href="<?php echo base_url() . "Analytics" ?>" style="text-decoration: none;">
                <li class="nav-item">
                    <span class="nav-icon"><i class="bi bi-bar-chart"></i></span>
                    <span>Analytics</span>
                </li>
            </a>

            <a href="<?php echo base_url() . "Login_page/logout" ?>" style="text-decoration: none;">
                <li class="nav-item">
                    <span class="nav-icon"><i class="bi bi-power"></i></span>
                    <span>Logout</span>
                </li>
            </a>
        </ul>
    </aside>