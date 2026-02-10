<div class="bg-light py-5 mt-5">
	<div class="d-flex align-items-center justify-content-center min-vh-100">
		<div class="col-md-6 col-lg-4">
			<div class="card shadow-lg border-0 rounded-4">
				<div class="card-body p-5">

					<!-- Header -->
					<div class="text-center mb-4">
						<div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px; font-size: 28px; font-weight: bold;">
							📱
						</div>
						<h3 class="mt-3 fw-bold text-dark">Create Your Account</h3>
						<p class="text-muted">Join PhoneStore today</p>
					</div>

					<!-- Display error/success messages -->
					<?php if (!empty($error)) { ?>
						<div class="alert alert-danger"><?php echo $error; ?></div>
					<?php } ?>

					<!-- Registration form -->
					<form method="post" action="<?php echo site_url('Login_page/register_submit'); ?>">

						<!-- Username -->
						<div class="mb-3">
							<label for="email" class="form-label fw-semibold">Email</label>
							<input type="email" name="email" class="form-control form-control-lg rounded-3" placeholder="Enter Email" required>
						</div>

						<!-- Email -->
						<div class="mb-3">
							<label for="username" class="form-label fw-semibold">Username</label>
							<input type="username" name="username" class="form-control form-control-lg rounded-3" placeholder="Enter Username" required>
						</div>

						<!-- Password -->
						<div class="mb-3">
							<label for="password" class="form-label fw-semibold">Password</label>
							<input type="password" name="password" class="form-control form-control-lg rounded-3" placeholder="Enter password" required>
						</div>

						<!-- Role (optional: shown only to admins, or defaulted to Customer) -->
						<input type="hidden" name="role" value="Customer">

						<!-- Submit -->
						<button type="submit" class="btn btn-primary w-100 py-2 rounded-3 shadow-sm fw-semibold">
							Register
						</button>
					</form>

					<!-- Footer link -->
					<div class="text-center mt-4">
						<p class="text-muted mb-1">
							Already have an account?
							<a href="<?php echo site_url('Login_page'); ?>" class="fw-semibold text-primary text-decoration-none">Login</a>
						</p>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>