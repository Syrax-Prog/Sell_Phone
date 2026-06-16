<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/homepage.css'); ?>">
	<title>PhoneStore</title>

</head>

<body>
	<?php $style = 'border-bottom border-primary border-2'; ?>

	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow sticky-top py-3">
		<div class="container">

			<!-- Logo with Icon -->
			<a class="navbar-brand d-flex align-items-center fw-bold fs-4 text-primary"
				href="<?php echo site_url('Homepage'); ?>">
				<i class="bi bi-phone-fill me-2 fs-3"></i>
				<span>PhoneStore</span>
			</a>

			<!-- Mobile Toggle Button -->
			<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
				aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- Navigation Links -->
			<div class="collapse navbar-collapse" id="navbarNav">

				<!-- Center Navigation -->
				<ul class="navbar-nav mx-auto mb-2 mb-lg-0">

					<!-- Home -->
					<li class="nav-item">
						<a class="nav-link fw-semibold px-3" href="<?php echo site_url('Homepage'); ?>">
							<i class="bi bi-house-door me-1"></i>
							Home
						</a>
					</li>

					<!-- Shop -->
					<li class="nav-item dropdown" id="#shop">
						<a class="nav-link fw-semibold dropdown-toggle px-3"
							href="<?php echo site_url('Homepage#shop'); ?>" role="button" data-bs-toggle="dropdown"
							aria-expanded="false">
							<i class="bi bi-grid me-1"></i>
							Shop
						</a>
						<ul class="dropdown-menu shadow border" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="#">Apple</a></li>
							<li><a class="dropdown-item" href="#">Samsung</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="#">All Phones</a></li>
						</ul>
					</li>

					<!-- compare -->
					<li class="nav-item" id="#shop">
						<a class="nav-link fw-semibold px-3" href="<?php echo site_url('Compare'); ?>">
							<i class="bi bi-shuffle me-1"></i>
							Compare Phone
						</a>
					</li>

					<!--  quick search -->
					<li class="nav-item px-3">
						<form action="<?php echo site_url('Homepage'); ?>" method="GET" class="d-flex">
							<div class="input-group">
								<span class="input-group-text bg-white border-end-0">
									<i class="bi bi-search text-muted"></i>
								</span>
								<input type="text" name="search_value" class="form-control border-start-0 ps-0"
									placeholder="Search phones..." aria-label="Search">
								<input type="hidden" name="search_type" value="phone_name">
							</div>
						</form>
					</li>
				</ul>

				<!-- Right Side Navigation -->
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">

					<!-- Cart with Badge -->
					<li class="nav-item me-3 position-relative">
						<a class="nav-link text-dark p-0 <?php echo ($this->uri->segment(1) == 'Cart') ? $style : ''; ?>"
							href="<?php echo site_url('Cart'); ?>">
							<i class="bi bi-cart3 fs-5"></i>
							<span
								class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
								style="font-size: 0.65rem;" id="cart_count">
								<?php
								if (!empty($username)) {
									echo empty(count_cart()) ? '0' : count_cart();
								}else{
									echo '0';
								}
								?>
							</span>
						</a>
					</li>

					<!-- User Dropdown or Login -->
					<li class="nav-item dropdown">
						<?php if (!empty($username)) { ?>
							<a class="nav-link dropdown-toggle btn px-4 py-2 rounded-pill fw-semibold" href="#"
								role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-person-circle me-1"></i>
								<?php echo $username; ?>
							</a>
							<ul class="dropdown-menu shadow border-0">
								<li><a class="dropdown-item" href="<?php echo site_url('Profile_page'); ?>">My Profile</a>
								</li>
								<li><a class="dropdown-item" href="<?php echo site_url('Orders'); ?>">My Orders</a></li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li><a class="dropdown-item text-danger"
										href="<?php echo site_url('Login_page/logout'); ?>">Logout</a></li>
							</ul>
						<?php } else { ?>
							<a class="btn btn-primary px-4 py-2 rounded-pill fw-semibold"
								href="<?php echo site_url('Login_page'); ?>">
								<i class="bi bi-person-circle me-1"></i> Login
							</a>
						<?php } ?>
					</li>

				</ul>

			</div>

		</div>
	</nav>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>