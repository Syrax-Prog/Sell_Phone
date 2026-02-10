<!-- Bootstrap Checkout Page -->
<div class="container-fluid py-4" style="margin-top: 70px;">
	<div class="container">

		<!-- Page Header -->
		<div class="row mb-4">
			<div class="col-12">
				<h2 class="fw-bold text-dark mb-1">Checkout</h2>
				<p class="text-muted mb-0 small">Review and confirm your order</p>
			</div>
		</div>

		<?php if (!empty($checkout_items)) { ?>
			<form action="<?php echo site_url('Orders/place_order') ?>" method="post" id="checkoutForm">
				<div class="row">

					<!-- Left Column -->
					<div class="col-lg-8 mb-4">

						<!-- Shipping Address Section -->
						<div class="card border-0 shadow-sm mb-4">
							<div class="card-header bg-white border-bottom py-3">
								<div class="d-flex justify-content-between align-items-center">
									<h5 class="mb-0 fw-semibold">
										<i class="bi bi-geo-alt-fill text-primary me-2"></i>Shipping Address
									</h5>
									<div class="btn-group">
										<button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#addAddressModal">
											<i class="bi bi-plus-circle me-1"></i>Add
										</button>

										<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editAddressModal">
											<i class="bi bi-pencil me-1"></i>Edit
										</button>

										<button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#removeAddressModal">
											<i class="bi bi-trash me-1"></i>Delete
										</button>
									</div>
								</div>
							</div>

							<div class="card-body p-4">
								<select class="form-select" name="address_id" id="address" required>
									<option value="">-- Select Delivery Address --</option>

									<?php foreach ($address as $ad) {
										// Check if this address is set as default
										if ($ad->is_default == 1) {
											$selected = 'selected';
										} else {
											$selected = '';
										}
										?>

										<option value="<?php echo $ad->address; ?>" <?php echo $selected; ?>>
											<?php
											echo htmlspecialchars($ad->address);
											if ($ad->is_default == 1)
												echo ' ⭐';
											?>
										</option>
									<?php } ?>
								</select>
								<?php if (empty($address)) { ?>
									<div class="alert alert-warning mt-3 mb-0">
										<i class="bi bi-exclamation-triangle me-2"></i>Please add a delivery address first
									</div>
								<?php } ?>
							</div>
						</div>


						<!-- Order Items Section -->
						<div class="card border-0 shadow-sm">
							<div class="card-header bg-white border-bottom py-3">
								<div class="d-flex justify-content-between align-items-center">
									<h5 class="mb-0 fw-semibold">Products Ordered</h5>

									<?php
									// Count how many items are in the checkout list
									$item_count = count($checkout_items);

									// Prepare the label text
									$item_label = 'item';
									if ($item_count > 1) {
										$item_label = 'items'; // plural if more than one
									}
									?>

									<span class="badge text-white" style="background-color: #1E3A8A;">
										<?php echo $item_count . ' ' . $item_label; ?>
									</span>
								</div>

							</div>


							<div class="card-body p-0">
								<?php
								$grand_total = 0;
								$total_savings = 0;
								?>
								<?php foreach ($checkout_items as $item) { ?>
									<?php
									// Calculate discounted price for this item
									$discounted_price = $item->current_price;
									$has_discount = false;

									if (isset($item->discount) && $item->discount > 0) {
										$discounted_price = $item->current_price - ($item->current_price * $item->discount / 100);
										$has_discount = true;
									}

									$item_total = $discounted_price * $item->quantity;
									$grand_total += $item_total;

									// Calculate savings for this item
									if ($has_discount) {
										$item_savings = ($item->current_price - $discounted_price) * $item->quantity;
										$total_savings += $item_savings;
									}

									// check image url start with http or not
									if (strpos($item->image_url, 'http') === 0) {
										$imageSrc = $item->image_url;
									} else {
										$imageSrc = base_url($item->image_url);
									}
									?>
									<div class="p-3 
									<?php
									$last_item = end($checkout_items);

									if ($item !== $last_item) {
										echo ' border-bottom';
									}
									?>">

										<div class="row g-3 align-items-center">
											<!-- Image -->
											<div class="col-auto">
												<img src="<?php echo $imageSrc; ?>" alt="<?php echo htmlspecialchars($item->phone_name); ?>" class="img-fluid rounded" style="width: 70px; height: 70px; object-fit: cover;">
											</div>

											<!-- Product Info -->
											<div class="col">
												<h6 class="mb-1 fw-semibold"><?php echo htmlspecialchars($item->phone_name) ?>
												</h6>
												<div class="d-flex align-items-center gap-2 flex-wrap">
													<?php if ($has_discount) { ?>
														<span class="text-primary fw-semibold">RM
															<?php echo number_format($discounted_price, 2) ?></span>
														<span class="text-muted text-decoration-line-through small">RM
															<?php echo number_format($item->current_price, 2) ?></span>
														<span class="badge bg-danger"><?php echo $item->discount; ?>% OFF</span>
													<?php } else { ?>
														<span class="text-primary fw-semibold">RM
															<?php echo number_format($discounted_price, 2) ?></span>
													<?php } ?>
													<span class="text-muted">×</span>
													<span class="text-muted"><?php echo $item->quantity ?></span>
													<small class="badge bg-success-subtle text-success">
														<i class="bi bi-check-circle-fill me-1"></i>In Stock
													</small>
												</div>

												<input type="hidden" name="quantities[<?php echo $item->cart_item_id ?>]" value="<?php echo $item->quantity ?>">
												<input type="hidden" name="cart_ids[]" value="<?php echo $item->cart_item_id ?>">
												<input type="hidden" name="phone_ids[]" value="<?php echo $item->phone_id ?>">
												<input type="hidden" name="prices[<?php echo $item->cart_item_id ?>]" value="<?php echo $discounted_price ?>">
											</div>

											<!-- Subtotal -->
											<div class="col-auto text-end">
												<div class="fw-bold text-dark">RM <?php echo number_format($item_total, 2) ?></div>
												<?php if ($has_discount) { ?>
													<small class="text-success">
														Saved RM <?php echo number_format(($item->current_price - $discounted_price) * $item->quantity, 2); ?>
													</small>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>

					<!-- Right Column - Order Summary -->
					<div class="col-lg-4">
						<div class="card border-0 shadow-sm sticky-top" style="top: 90px;">
							<div class="card-body p-4">
								<h5 class="fw-semibold mb-4">Order Summary</h5>

								<div class="mb-3">

									<div class="d-flex justify-content-between mb-2">
										<?php
										// Count how many items are in the checkout
										$item_count = count($checkout_items);

										// Determine the correct word for item/items
										$item_label = 'item';
										if ($item_count > 1) {
											$item_label = 'items';
										}

										// Format the subtotal amount
										$formatted_total = number_format($grand_total, 2);
										?>

										<span class="text-muted">
											Subtotal (<?php echo $item_count . ' ' . $item_label; ?>)
										</span>
										<span class="fw-semibold">
											RM <?php echo $formatted_total; ?>
										</span>
									</div>

									<?php if ($total_savings > 0) { ?>
										<div class="d-flex justify-content-between mb-2">
											<span class="text-success">
												<i class="bi bi-tag-fill me-1"></i>Total Savings
											</span>
											<span class="text-success fw-semibold">
												- RM <?php echo number_format($total_savings, 2); ?>
											</span>
										</div>
									<?php } ?>

									<div class="d-flex justify-content-between mb-2">
										<span class="text-muted">Shipping Fee</span>
										<span class="text-success fw-semibold">FREE</span>
									</div>
								</div>

								<div class="border-top pt-3 mb-4">
									<div class="d-flex justify-content-between align-items-center">
										<span class="fw-bold fs-5">Total</span>
										<span class="fw-bold fs-4" style="color: #1E3A8A;">RM
											<?php echo number_format($grand_total, 2) ?></span>
									</div>
									<?php if ($total_savings > 0) { ?>
										<div class="text-end mt-2">
											<small class="text-success">
												<i class="bi bi-check-circle-fill me-1"></i>
												You're saving RM <?php echo number_format($total_savings, 2); ?> on this order!
											</small>
										</div>
									<?php } ?>
								</div>


								<div class="d-grid gap-2">
									<?php
									// Check if there are any addresses saved
									$button_disabled = '';
									if (empty($address)) {
										// If no address is found, disable the "Place Order" button
										$button_disabled = 'disabled';
									}

									// Get the URL for returning to the Cart page
									$cart_url = site_url('Cart');
									?>

									<!-- Place Order Button -->
									<button type="submit" class="btn text-white btn-lg" <?php echo $button_disabled; ?> style="background-color: #1E3A8A;">
										<i class="bi bi-check-circle-fill me-2"></i>Place Order
									</button>

									<!-- Back to Cart Button -->
									<a href="<?php echo $cart_url; ?>" class="btn btn-outline-secondary">
										<i class="bi bi-arrow-left me-2"></i>Back to Cart
									</a>
								</div>


								<div class="mt-4 p-3 bg-light rounded">
									<small class="text-muted">
										<i class="bi bi-shield-check text-success me-2"></i>
										<strong>Secure Checkout</strong><br>
										Your payment information is protected
									</small>
								</div>
							</div>
						</div>
					</div>

				</div>
			</form>
		<?php } else { ?>
			<!-- Empty State -->
			<div class="card border-0 shadow-sm">
				<div class="card-body text-center py-5">
					<i class="bi bi-cart-x text-muted mb-3" style="font-size: 4rem;"></i>
					<h4 class="fw-bold mb-2">No Items to Checkout</h4>
					<p class="text-muted mb-4">Your cart is empty. Add some items to proceed with checkout.</p>
					<a href="<?php echo site_url('Cart') ?>" class="btn btn-primary btn-lg">
						<i class="bi bi-arrow-left me-2"></i>Go to Cart
					</a>
				</div>
			</div>
		<?php } ?>

	</div>
</div>

<!-- Add Address Modal -->
<div class="modal fade" id="addAddressModal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-success text-white">
				<h5 class="modal-title fw-bold">
					<i class="bi bi-plus-circle-fill me-2"></i>Add New Address
				</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<form method="POST" action="<?php echo site_url('Address/add') ?>">
					<div class="mb-3">
						<label class="form-label fw-semibold">Complete Address <span class="text-danger">*</span></label>
						<textarea name="address" class="form-control" rows="4" required placeholder="Street, Building, City, State, Postal Code"></textarea>
						<small class="text-muted">Please provide your complete address including postal code</small>
					</div>
					<div class="form-check mb-3">
						<input class="form-check-input" type="checkbox" name="is_default" id="setDefault" value="1">
						<label class="form-check-label" for="setDefault">
							<i class="bi bi-star me-1"></i>Set as default address
						</label>
					</div>
					<div class="d-grid gap-2">
						<button type="submit" class="btn btn-success">
							<i class="bi bi-plus-circle me-2"></i>Add Address
						</button>
						<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
							Cancel
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Edit Address Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title fw-bold">
					<i class="bi bi-pencil-fill me-2"></i>Edit Address
				</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<form method="POST" action="<?php echo site_url('Address/edit') ?>">
					<div class="mb-3">
						<label class="form-label fw-semibold">Select Address <span class="text-danger">*</span></label>
						<select name="ua_id" id="edit_address_select" class="form-select" required>
							<option value="">-- Choose an Address to Edit --</option>
							<?php foreach ($address as $ad) { ?>
								<option value="<?php echo $ad->ua_id; ?>" data-address="<?php echo htmlspecialchars($ad->address); ?>">
									<?php
									echo htmlspecialchars($ad->address);
									if ($ad->is_default == 1)
										echo ' ⭐';
									?>
								</option>
							<?php } ?>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label fw-semibold">New Address <span class="text-danger">*</span></label>
						<textarea name="new_address" id="new_address_text" class="form-control" rows="4" required placeholder="Enter updated address"></textarea>
						<small class="text-muted">Modify the address details as needed</small>
					</div>
					<div class="form-check mb-3">
						<input class="form-check-input" type="checkbox" name="is_default" id="setDefaultEdit" value="1">
						<label class="form-check-label" for="setDefaultEdit">
							<i class="bi bi-star me-1"></i>Set as default address
						</label>
					</div>
					<div class="d-grid gap-2">
						<button type="submit" class="btn btn-primary">
							<i class="bi bi-save me-2"></i>Update Address
						</button>
						<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
							Cancel
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Remove Address Modal -->
<div class="modal fade" id="removeAddressModal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h5 class="modal-title fw-bold">
					<i class="bi bi-trash-fill me-2"></i>Remove Address
				</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<?php if (!empty($address)) { ?>
					<p class="text-muted mb-3">
						<i class="bi bi-info-circle me-2"></i>Select an address to delete. This action cannot be undone.
					</p>

					<div class="list-group">
						<?php foreach ($address as $ad) { ?>
							<div class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
								<div class="flex-grow-1 me-3">
									<div class="fw-semibold mb-1">
										<?php echo htmlspecialchars($ad->address); ?>
										<?php if ($ad->is_default == 1) { ?>
											<span class="badge bg-warning text-dark ms-2">
												<i class="bi bi-star-fill"></i> Default
											</span>
										<?php } ?>
									</div>
								</div>
								<button type="button" class="btn btn-sm btn-outline-danger delete-address-btn" data-address-id="<?php echo $ad->ua_id; ?>" data-address-text="<?php echo htmlspecialchars($ad->address); ?>" data-delete-url="<?php echo site_url('Address/delete'); ?>">
									<i class="bi bi-trash"></i> Delete
								</button>
							</div>
						<?php } ?>
					</div>
				<?php } else { ?>
					<div class="alert alert-info mb-0">
						<i class="bi bi-info-circle me-2"></i>No addresses available to remove.
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>