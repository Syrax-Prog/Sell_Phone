<div class="bg-light" style="padding-top: 30px;">
	<div class="d-flex align-items-center justify-content-center min-vh-100">
		<div class="col-md-5 col-lg-4">
			<div class="card shadow-lg border-0 rounded-4">
				<div class="card-body p-5">

					<!-- Header -->
					<div class="text-center mb-4">
						<div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px; font-size: 28px; font-weight: bold;">
							🔑
						</div>

						<h3 class="mt-3 fw-bold text-dark">Welcome To PhoneStore</h3>
						<p class="text-muted">Login to continue</p>
					</div>

					<?php if (!empty($this->session->userdata('message'))) { ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?php echo $this->session->userdata('message'); ?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php
						$this->session->sess_destroy();
					}
					?>

					<!-- Login Form -->
					<form method="post" action="<?php echo site_url('Login_page/login'); ?>">
						<div class="mb-3">
							<label for="email" class="form-label fw-semibold">Email</label>
							<input type="email" name="email" class="form-control form-control-lg rounded-3" value="<?php echo get_cookie('remembered_email'); ?>" placeholder="Enter your email" required>
						</div>
						<div class="mb-3">
							<label for="password" class="form-label fw-semibold">Password</label>
							<input type="password" name="password" class="form-control form-control-lg rounded-3" placeholder="Enter your password" required>
						</div>
						<div class="mb-3 form-check">
							<input type="checkbox" name="remember_me" class="form-check-input" id="rememberMe" <?php echo get_cookie('remembered_email') ? 'checked' : ''; ?>>
							<label class="form-check-label" for="rememberMe">
								Remember my email
							</label>
						</div>
						<button type="submit" class="btn btn-primary w-100 py-2 rounded-3 shadow-sm fw-semibold">
							Login
						</button>
					</form>

					<!-- Register link -->
					<div class="text-center mt-4">
						<p class="text-muted mb-1">
							Don’t have an account?
							<a href="<?= site_url('Login_page/Registration'); ?>" class="fw-semibold text-primary text-decoration-none">Register</a>
						</p>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>