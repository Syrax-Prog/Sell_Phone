<!-- ============================= Start Footer ============================= -->
<footer>
	<div class="container-fluid bg-primary text-white py-5">
		<div class="container">
			<div class="row text-center text-md-start g-4">

				<!-- ============================= Company Info ============================= -->
				<div class="col-md-4">
					<h5 class="fw-bold">PhoneStore</h5>
					<p>Your one-stop shop for the latest smartphones at unbeatable prices.</p>
					<p>
						123 Market Street,<br>
						Kuala Lumpur, Malaysia<br>
						Email: support@phonestore.com<br>
						Phone: +60 123 456 789
					</p>
				</div>
				<!-- ============================= End Company Info ============================= -->

				<!-- ============================= Quick Links ============================= -->
				<div class="col-md-4">
					<h5 class="fw-bold">Quick Links</h5>
					<ul class="list-unstyled">
						<li><a href="<?= site_url('Homepage'); ?>" class="text-white text-decoration-none">Home</a></li>
						<li><a href="#shop" class="text-white text-decoration-none">Shop</a></li>
					</ul>
				</div>
				<!-- ============================= End Quick Links ============================= -->

				<!-- ============================= Social Media ============================= -->
				<div class="col-md-4">
					<h5 class="fw-bold">Follow Us</h5>
					<p>Stay connected through our social channels:</p>
					<a href="#" class="text-white me-3 fs-4"><i class="bi bi-facebook"></i></a>
					<a href="#" class="text-white me-3 fs-4"><i class="bi bi-twitter"></i></a>
					<a href="#" class="text-white me-3 fs-4"><i class="bi bi-instagram"></i></a>
					<a href="#" class="text-white fs-4"><i class="bi bi-youtube"></i></a>
				</div>
				<!-- ============================= End Social Media ============================= -->

			</div>

			<hr class="bg-white my-4">

			<p class="text-center mb-0">&copy; <?= date('Y'); ?> PhoneStore. All rights reserved.</p>
		</div>
	</div>
</footer>
<!-- ============================= End Footer ============================= -->

<!-- ============================= Script ============================= -->
<style>
	.hover-bg-lightblue:hover {
		background-color: #e0f2ff;
		transition: 0.3s;
	}

	.hover-bg-lightpink:hover {
		background-color: #ffe0e6;
		transition: 0.3s;
	}

	.hover-bg-lightyellow:hover {
		background-color: #fff8e0;
		transition: 0.3s;
	}

	.hover-bg-lightgreen:hover {
		background-color: #e0ffe0;
		transition: 0.3s;
	}

	.hover-bg-lightgray:hover {
		background-color: #f0f0f0;
		transition: 0.3s;
	}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Homepage JS for pagination -->
<script src="assets/js/home_pagination.js"></script>

<!-- Checkout_v js -->
<script src="<?php echo base_url('assets/js/checkout.js'); ?>"></script>

<!-- Cart_v js -->
<script src="<?php echo base_url('assets/js/cart_v.js'); ?>"></script>

</body>

</html>