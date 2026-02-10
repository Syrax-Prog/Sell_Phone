<aside class="p-3 vh-100">
    <ul class="nav flex-column">

        <!-- My Account -->
        <li class="nav-item mb-2">
            <a class="nav-link text-dark fw-semibold" href="<?php echo base_url('Profile_page'); ?>">
                <i class="bi bi-person-circle me-2"></i> My Account
            </a>
        </li>

        <!-- My Purchase with Submenu -->
        <li class="nav-item mb-2">
            <a class="nav-link text-dark fw-semibold d-flex justify-content-between align-items-center">
                <span><i class="bi bi-bag-fill me-2"></i> My Purchase</span>
            </a>
            <ul class="nav flex-column ms-3">
                <li class="nav-item">
                    <a class="nav-link text-dark fw-normal" href="<?php echo base_url('Orders?status=Order Placed'); ?>">Order Placed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-normal" href="<?php echo base_url('Orders?status=Shipped'); ?>">Shipped</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-normal" href="<?php echo base_url('Orders?status=Completed'); ?>">Completed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-normal" href="<?php echo base_url('Orders?status=Cancelled'); ?>">Cancelled</a>
                </li>
            </ul>
        </li>
        <!-- My Address -->
        <li class="nav-item mb-2">
            <a class="nav-link text-dark fw-semibold" href="<?php echo base_url('Address'); ?>">
                <i class="bi bi-geo-alt-fill me-2"></i> My Address
            </a>
        </li>

    </ul>
</aside>