<!-- ============================================================ Profile Section ============================================================ -->
<div class="profile-page">
	<?php $this->load->view('component/profile_side_v'); ?>
	<main>
		<div class="container-fluid min-vh-100">
			<div class="container">
				<div class="row justify-content-center align-items-center min-vh-100 py-4">
					<div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">

						<!-- Profile Card -->
						<div class="card shadow-lg border-0 rounded-4">
							<div class="card-body p-4 p-md-5">

								<!-- ============================================================ Profile Header ============================================================ -->
								<div class="text-center mb-4">
									<div class="bg-primary bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow" style="width: 100px; height: 100px; font-size: 3rem;">
										<i class="bi bi-person-circle"></i>
									</div>
									<h2 class="fw-bold text-dark mb-2">My Profile</h2>
									<p class="text-muted mb-0">Manage your account information</p>
								</div>

								<?php if (!empty($this->session->flashdata('message'))) { ?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										<i class="bi bi-check-circle-fill me-2"></i>
										<strong><?php echo $this->session->flashdata('message'); ?></strong>
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
								<?php } ?>

								<?php if (!empty($this->session->flashdata('error'))) { ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<i class="bi bi-exclamation-circle-fill me-2"></i>
										<strong><?php echo $this->session->flashdata('error'); ?></strong>
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
								<?php } ?>

								<div class="card border-0 bg-light mb-4">
									<div class="card-body p-0">
										<ul class="list-group list-group-flush">

											<!-- Username Section -->
											<li class="list-group-item bg-transparent border-0 py-3">
												<div class="row align-items-center">
													<div class="col-12 mb-3">
														<label class="form-label fw-semibold text-dark mb-0">
															<i class="bi bi-person-fill text-primary me-2"></i>Username
														</label>
													</div>
													<div class="col-12">
														<form action="<?php echo site_url('Profile_page/update_username'); ?>" method="post" class="needs-validation" novalidate id="usernameForm">
															<div class="input-group">
																<span class="input-group-text bg-primary text-white border-0">
																	<i class="bi bi-pencil"></i>
																</span>
																<input type="text" name="username" value="<?php
																if (isset($username)) {
																	echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
																} else {
																	echo '';
																}
																?>" class="form-control" placeholder="Enter username" required minlength="3" maxlength="50" pattern="[a-zA-Z0-9_]+" title="Username can only contain letters, numbers, and underscores">
																<button type="submit" class="btn btn-primary">
																	<i class="bi bi-check-lg me-1"></i>Save
																</button>
															</div>
														</form>
													</div>
												</div>
											</li>

											<!-- Email Section -->
											<li class="list-group-item bg-transparent border-0 py-3">
												<div class="row">
													<div class="col-12 mb-2">
														<label class="form-label fw-semibold text-dark mb-0">
															<i class="bi bi-envelope-fill text-primary me-2"></i>Email Address
														</label>
													</div>
													<div class="col-12">
														<div class="d-flex align-items-center">
															<span class="text-muted">
																<?php echo isset($email) ? htmlspecialchars($email, ENT_QUOTES, 'UTF-8') : 'No email provided'; ?>
															</span>
															<?php if (isset($email) && !empty($email)) { ?>
																<span class="badge bg-success ms-2">
																	<i class="bi bi-check-circle"></i> Verified
																</span>
															<?php } ?>
														</div>
													</div>
												</div>
											</li>

											<!-- Account Created Date (Optional) -->
											<?php if (isset($created_at) && !empty($created_at)) { ?>
												<li class="list-group-item bg-transparent border-0 py-3">
													<div class="row">
														<div class="col-12 mb-2">
															<label class="form-label fw-semibold text-dark mb-0">
																<i class="bi bi-calendar-check-fill text-primary me-2"></i>Member
																Since
															</label>
														</div>
														<div class="col-12">
															<span class="text-muted">
																<?php echo htmlspecialchars(date('F j, Y', strtotime($created_at)), ENT_QUOTES, 'UTF-8'); ?>
															</span>
														</div>
													</div>
												</li>
											<?php } ?>

											<!-- Account Status (Optional) -->
											<li class="list-group-item bg-transparent border-0 py-3">
												<div class="row">
													<div class="col-12 mb-2">
														<label class="form-label fw-semibold text-dark mb-0">
															<i class="bi bi-shield-check-fill text-primary me-2"></i>Account
															Status
														</label>
													</div>
													<div class="col-12">
														<?php
														$accountStatus = isset($status) ? $status : 'active';
														if ($accountStatus === 'active') {
															echo '<span class="badge bg-success">Active</span>';
														} elseif ($accountStatus === 'pending') {
															echo '<span class="badge bg-warning text-dark">Pending Verification</span>';
														} elseif ($accountStatus === 'suspended') {
															echo '<span class="badge bg-danger">Suspended</span>';
														} else {
															echo '<span class="badge bg-secondary">Unknown</span>';
														}
														?>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
								<!-- ============================================================ End Profile Details ============================================================ -->

								<!-- ============================================================ Additional Actions ============================================================ -->
								<div class="row g-3">

									<!-- Change Password Button -->
									<div class="col-12">
										<button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
											<i class="bi bi-key-fill me-2"></i>Change Password
										</button>
									</div>
									<!-- Back to Dashboard -->
									<div class="col-12">
										<a href="<?php echo site_url('Homepage'); ?>" class="btn btn-secondary w-100">
											<i class="bi bi-arrow-left me-2"></i>Back to Homepage
										</a>
									</div>
								</div>
								<!-- ============================================================ End Additional Actions ============================================================ -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ============================================================ End Profile Section ============================================================ -->

		<!-- ============================================================ Change Password Modal ============================================================ -->
		<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0 shadow-lg">
					<div class="modal-header bg-primary text-white border-0">
						<h5 class="modal-title fw-bold" id="changePasswordModalLabel">
							<i class="bi bi-key-fill me-2"></i>Change Password
						</h5>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="<?php echo site_url('Profile_page/update_password'); ?>" method="post">
						<div class="modal-body p-4">

							<!-- Current Password -->
							<div class="mb-3">
								<label for="currentPassword" class="form-label fw-semibold">
									<i class="bi bi-lock-fill text-primary me-2"></i>Current Password
								</label>
								<input type="password" class="form-control" id="currentPassword" name="current_password" placeholder="Enter current password" required>
							</div>

							<!-- New Password -->
							<div class="mb-3">
								<label for="newPassword" class="form-label fw-semibold">
									<i class="bi bi-key-fill text-primary me-2"></i>New Password
								</label>
								<input type="password" class="form-control" id="newPassword" name="new_password" placeholder="Enter new password" required>
								<div class="form-text">
									<small>Minimum 8 characters recommended</small>
								</div>
							</div>

							<!-- Confirm New Password -->
							<div class="mb-3">
								<label for="confirmPassword" class="form-label fw-semibold">
									<i class="bi bi-check-circle-fill text-primary me-2"></i>Confirm New Password
								</label>
								<input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Confirm new password" required>
							</div>

						</div>
						<div class="modal-footer border-0">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
								<i class="bi bi-x-lg me-1"></i>Cancel
							</button>
							<button type="submit" class="btn btn-primary">
								<i class="bi bi-check-lg me-1"></i>Update Password
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- ============================================================ Delete Account Modal ============================================================ -->
		<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0 shadow-lg">
					<div class="modal-header bg-danger text-white border-0">
						<h5 class="modal-title fw-bold" id="deleteAccountModalLabel">
							<i class="bi bi-exclamation-triangle-fill me-2"></i>Delete Account
						</h5>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body p-4">
						<p class="mb-3">Are you sure you want to delete your account? This action cannot be undone.</p>
						<div class="alert alert-warning mb-0" role="alert">
							<i class="bi bi-info-circle-fill me-2"></i>
							<strong>Warning:</strong> All your data will be permanently deleted.
						</div>
					</div>
					<div class="modal-footer border-0">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
							<i class="bi bi-x-lg me-1"></i>Cancel
						</button>
						<form action="<?php echo site_url('Profile_page/delete_account'); ?>" method="post" class="d-inline">
							<button type="submit" class="btn btn-danger">
								<i class="bi bi-trash-fill me-1"></i>Delete Permanently
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>