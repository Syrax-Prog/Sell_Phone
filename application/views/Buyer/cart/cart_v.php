<div class="container-fluid py-4" style="margin-top: 70px;">
	<div class="container">

		<!-- Page Header -->
		<div class="row mb-4">
			<div class="col-12">
				<div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
					<div>
						<h2 class="fw-bold text-dark mb-1">Shopping Cart</h2>
					</div>
					<a href="<?php echo base_url('Homepage#shop'); ?>" class="btn" style="border: 1px solid #1E3A8A">
						<i class="bi bi-arrow-left me-2"></i>Continue Shopping
					</a>
				</div>
			</div>
		</div>

		<!-- Flash Message -->
		<?php if ($this->session->flashdata('message')) { ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<i class="bi bi-check-circle-fill me-2"></i><?php echo $this->session->flashdata('message'); ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			</div>
		<?php } ?>

		<!-- Cart Content -->
		<form method="POST" action="<?php echo base_url('Cart/update'); ?>" id="cartForm">

			<?php if (!empty($cart_item)) { ?>
				<div class="row">
					<!-- Cart Items -->
					<div class="col-lg-8 mb-4">
						<div class="card border-0 shadow-sm">
							<div class="card-header bg-white border-bottom py-3">
								<div class="d-flex justify-content-between align-items-center">
									<h5 class="mb-0 fw-semibold">Cart Items (<?php echo count($cart_item); ?>)</h5>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="select-all" checked onchange="toggleAll(this)">
										<label class="form-check-label fw-semibold" for="select-all">Select All</label>
									</div>

								</div>
							</div>

							<div class="card-body p-0">

								<?php foreach ($cart_item as $item) {
									// Calculate discounted price ONCE per item at the start
									$discounted_price = $item->current_price;
									if (isset($item->discount) && $item->discount > 0) {
										$discounted_price = $item->current_price - ($item->current_price * $item->discount / 100);
									}
									?>
									<?php if ($item->is_active == 1) { ?>
										<div class="border-bottom p-3 cart-item-active">
											<div class="row g-3 align-items-center">
												<!-- Checkbox -->
												<div class="col-auto">
													<?php if ($item->stock <= 0) { ?>
														<input type="checkbox" class="form-check-input item-checkbox" value="<?php echo $item->cart_item_id; ?>" data-price="<?php echo $discounted_price; ?>" disabled>
													<?php } else { ?>
														<input type="checkbox" class="form-check-input item-checkbox" name="selected_items[]" value="<?php echo $item->cart_item_id; ?>" data-price="<?php echo $discounted_price; ?>" checked onchange="updateTotal()">
													<?php } ?>
												</div>

												<!-- Image -->
												<div class="col-auto">
													<?php
													if (!empty($item->image_url)) {
														$image_src = $item->image_url;
													} else {
														$image_src = 'https://via.placeholder.com/80x80?text=Product';
													}
													$alt_text = htmlspecialchars($item->phone_name);
													?>
													<img src="<?php echo $image_src; ?>" alt="<?php echo $alt_text; ?>" class="img-fluid rounded border" style="width: 80px; height: 80px; object-fit: cover;">
												</div>

												<!-- Product Info -->
												<div class="col">
													<h6 class="mb-1 fw-semibold"><?php echo $item->phone_name; ?></h6>
													<?php if ($item->stock <= 0) { ?>
														<small class="text-danger">Out Of Stock</small>
													<?php } ?>
													<div class="mt-2">
														<?php if (isset($item->discount) && $item->discount > 0) { ?>
															<span class="text-primary fw-semibold">
																RM <?php echo number_format($discounted_price, 2); ?>
															</span>
															<small class="text-muted text-decoration-line-through">
																RM <?php echo number_format($item->current_price, 2); ?>
															</small>
															<span class="badge bg-danger ms-1"><?php echo $item->discount; ?>% OFF</span>
														<?php } else { ?>
															<span class="text-primary fw-semibold">
																RM <?php echo number_format($discounted_price, 2); ?>
															</span>
														<?php } ?>
													</div>
												</div>

												<!-- Quantity Controls -->
												<div class="col-auto">
													<div class="d-flex align-items-center gap-2">
														<button type="button" class="btn btn-sm btn-outline-secondary" onclick="changeQty(<?php echo $item->cart_item_id; ?>, -1, <?php echo $item->stock; ?>)" <?php echo ($item->stock <= 0) ? 'disabled' : ''; ?>>
															<i class="bi bi-dash"></i>
														</button>

														<input type="number" name="quantities[<?php echo $item->cart_item_id; ?>]" id="qty-<?php echo $item->cart_item_id; ?>" value="<?php echo $item->quantity; ?>" min="1" max="<?php echo $item->stock; ?>" class="form-control form-control-sm text-center" style="width: 60px;" data-price="<?php echo $discounted_price; ?>" oninput="validateQty(this, <?php echo $item->stock; ?>)" <?php echo ($item->stock <= 0) ? 'disabled' : ''; ?>>

														<button type="button" class="btn btn-sm btn-outline-secondary" onclick="changeQty(<?php echo $item->cart_item_id; ?>, 1, <?php echo $item->stock; ?>)" <?php echo ($item->stock <= 0) ? 'disabled' : ''; ?>>
															<i class="bi bi-plus"></i>
														</button>
													</div>
												</div>

												<!-- Subtotal & Delete -->
												<div class="col-auto text-end" style="display: flex; gap:20px;">
													<div class="fw-bold text-dark mb-2" id="total-<?php echo $item->cart_item_id; ?>">
														RM <?php echo number_format($discounted_price * $item->quantity, 2); ?>
													</div>
													<button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteItem(<?php echo $item->cart_item_id; ?>, '<?php echo addslashes($item->phone_name); ?>')" title="Remove">
														<i class="bi bi-trash"></i>
													</button>
												</div>
											</div>
										</div>
									<?php } else { ?>
										<div class="border-bottom p-3 bg-light text-muted cart-item-inactive" style="opacity: 0.6;">
											<div class="row g-3 align-items-center">

												<!-- Image (No checkbox for inactive items) -->
												<div class="col-auto" style="margin-left:30px;">
													<?php
													if (!empty($item->image_url)) {
														$image_src = $item->image_url;
													} else {
														$image_src = 'https://via.placeholder.com/80x80?text=Product';
													}
													$alt_text = htmlspecialchars($item->phone_name);
													?>
													<img src="<?php echo $image_src; ?>" alt="<?php echo $alt_text; ?>" class="img-fluid rounded border" style="width: 80px; height: 80px; object-fit: cover;">
												</div>

												<!-- Product Info -->
												<div class="col">
													<h6 class="mb-1 fw-semibold"><?php echo $item->phone_name; ?> <span class="badge bg-danger text-light">No Longer Available</span></h6>
													<small class="text-danger">
														<i class="bi bi-x-circle-fill me-1"></i>Not Available
													</small>
													<div class="mt-2">
														<span class="text-muted text-decoration-line-through">RM
															<?php echo number_format($item->current_price, 2); ?></span>
													</div>
												</div>

												<!-- Quantity Controls (Disabled) -->
												<div class="col-auto">
													<div class="d-flex align-items-center gap-2">
														<button type="button" class="btn btn-sm btn-outline-secondary" disabled>
															<i class="bi bi-dash"></i>
														</button>

														<input type="number" class="form-control form-control-sm text-center" style="width: 60px;" value="<?php echo $item->quantity; ?>" disabled>

														<button type="button" class="btn btn-sm btn-outline-secondary" disabled>
															<i class="bi bi-plus"></i>
														</button>
													</div>
												</div>

												<!-- Subtotal & Delete -->
												<div class="col-auto text-end" style="display: flex; gap:20px;">
													<div class="fw-bold text-muted mb-2">
														RM 0.00
													</div>
													<button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteItem(<?php echo $item->cart_item_id; ?>, '<?php echo addslashes($item->phone_name); ?>')" title="Remove">
														<i class="bi bi-trash"></i>
													</button>
												</div>
											</div>
										</div>
									<?php }
								} ?>
							</div>
						</div>
					</div>

					<!-- Order Summary -->
					<div class="col-lg-4">
						<div class="card border-0 shadow-sm">
							<div class="card-body p-4">
								<h5 class="fw-semibold mb-3">Order Summary</h5>

								<div class="d-flex justify-content-between mb-2">
									<span class="text-muted">Selected Items:</span>
									<span class="fw-semibold" id="selected-count">0</span>
								</div>

								<hr>

								<div class="d-flex justify-content-between mb-3">
									<span class="fw-bold">Total:</span>
									<span class="fw-bold text-primary fs-5" id="grand-total">RM 0.00</span>
								</div>

								<div class="d-grid gap-2">
									<button type="button" class="btn btn-lg text-white" id="checkoutBtn" onclick="checkout()" style="background-color: #1E3A8A">
										<i class="bi bi-bag-check-fill me-2"></i>Proceed to Checkout
									</button>
									<button type="submit" name="update" class="btn btn-outline-secondary">
										<i class="bi bi-arrow-clockwise me-2"></i>Update Cart
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?php } else { ?>
				<div class="card border-0 shadow-sm">
					<div class="card-body text-center py-5">
						<i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
						<h4 class="mt-3 mb-2">Your cart is empty</h4>
						<p class="text-muted mb-4">Add some items to get started!</p>
						<a href="<?php echo base_url('Homepage#shop'); ?>" class="btn btn-primary">
							<i class="bi bi-shop me-2"></i>Start Shopping
						</a>
					</div>
				</div>
			<?php } ?>

		</form>
	</div>
</div>