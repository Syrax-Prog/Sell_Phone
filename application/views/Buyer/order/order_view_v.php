<!-- Orders List Page -->
<div class="profile-page d-flex">
	<?php $this->load->view('component/profile_side_v'); ?>

	<main class="flex-grow-1 p-4">
		<div class="d-flex flex-column gap-4">
			<?php if (empty($order)) { ?>
				<!-- Empty State -->
				<div class="card shadow-sm">
					<div class="card-body text-center py-5">
						<i class="bi bi-cart-x fs-1 text-muted"></i>
						<p class="mt-3 text-muted">No orders found, Try again, Maybe dont alter the link! Thanks</p>
					</div>
				</div>
			<?php } else { ?>
				<?php
				// Group items by order_id for proper display
				$grouped_orders = [];
				foreach ($order as $item) {
					$grouped_orders[$item->order_id][] = $item;
				}
				?>

				<?php foreach ($grouped_orders as $order_id => $items) {
					$orderTotal = 0;
					$firstItem = $items[0];

					// Calculate actual order status based on is_cancelled flags
					$total_items = count($items);
					$cancelled_items = 0;

					foreach ($items as $item) {
						if ($item->is_cancelled == 1) {
							$cancelled_items++;
						}
					}

					// Determine the actual status for this specific order
					if ($cancelled_items == $total_items) {
						// All items cancelled = order is cancelled
						$statusLabel = 'Cancelled';
						$statusClass = 'bg-danger';
					} elseif ($cancelled_items > 0) {
						// Some items cancelled = partially cancelled
						$statusLabel = 'Partially Cancelled';
						$statusClass = 'bg-warning text-dark';
					} else {
						// No items cancelled = use the database status or GET parameter
						$statusLabel = empty($this->input->get('status')) || !in_array($this->input->get('status'), $this->s)
							? 'Order Placed'
							: $this->input->get('status');

						// Map status to appropriate badge color
						switch (strtolower($statusLabel)) {
							case 'pending':
							case 'order placed':
								$statusClass = 'bg-warning text-dark';
								break;
							case 'processing':
								$statusClass = 'bg-info text-dark';
								break;
							case 'completed':
								$statusClass = 'bg-success';
								break;
							case 'cancelled':
								$statusClass = 'bg-danger';
								break;
							default:
								$statusClass = 'bg-secondary';
						}
					}
					?>
					<article class="card shadow-sm p-3" style="border: 1px solid grey;">
						<!-- Header: Order ID & Status -->
						<div class="card-header d-flex justify-content-between align-items-center bg-white border-bottom">
							<h5 class="mb-0 fw-semibold" style="color: #1E3A8A;">
								Order #<?php echo $order_id; ?>
							</h5>
							<div class="d-flex justify-content-between align-items-center gap-3">
								<span class="badge rounded-pill px-3 py-2 <?php echo $statusClass; ?>">
									<?php echo $statusLabel; ?>
								</span>
							</div>
						</div>

						<!-- Body: All Items in This Order -->
						<div class="card-body">
							<?php foreach ($items as $index => $item) {
								// Only add to total if item is not cancelled
								if ($item->is_cancelled == 0) {
									$orderTotal += (float) $item->subtotal;
								}
								?>
								<?php if ($index > 0) { ?>
									<hr class="my-3">
								<?php } ?>

								<div class="row g-3 align-items-center">
									<!-- Product Image -->
									<div class="col-auto">
										<?php
										// Use image_url (current) instead of image_at_order
										$imagePath = !empty($item->image_url)
											? base_url($item->image_url)
											: base_url('assets/images/No_Image_Available.jpg');
										?>
										<img src="<?php echo $imagePath; ?>" alt="<?php echo $item->phone_name_at_order; ?>" class="img-fluid rounded border <?php echo $item->is_cancelled == 1 ? 'opacity-50' : ''; ?>" style="width: 100px; height: 100px; object-fit: cover;" onerror="this.src='<?php echo base_url('assets/images/No_Image_Available.jpg'); ?>'">
									</div>

									<!-- Product Details -->
									<div class="col">
										<div class="d-flex flex-column">
											<div class="d-flex justify-content-between align-items-start mb-2">
												<div>
													<h6 class="mb-1 fw-semibold <?php echo $item->is_cancelled == 1 ? 'text-decoration-line-through text-muted' : ''; ?>" style="<?php echo $item->is_cancelled == 0 ? 'color: #1E3A8A;' : ''; ?>">
														<?php echo $item->phone_name_at_order; ?>
													</h6>
													<small class="text-muted">
														<?php echo $item->brand; ?>
													</small>
												</div>
												<span class="badge bg-light text-dark border">
													Qty: <?php echo (int) $item->quantity; ?>
												</span>
											</div>

											<?php if (!empty($item->description)) { ?>
												<p class="small mb-2 text-muted">
													<?php echo $item->description; ?>
												</p>
											<?php } ?>

											<!-- Specifications at time of order -->
											<div class="d-flex gap-3 flex-wrap small text-muted">
												<span><i class="bi bi-hdd"></i> <?php echo (int) $item->storage_at_order; ?>GB</span>
												<span><i class="bi bi-memory"></i> <?php echo (int) $item->ram_at_order; ?>GB RAM</span>
												<span><i class="bi bi-battery-charging"></i> <?php echo (int) $item->battery_at_order; ?>mAh</span>
												<span><i class="bi bi-phone"></i> <?php echo $item->os_at_order; ?></span>
											</div>
										</div>
									</div>



									<!-- Pricing & Actions -->
									<div class="col-auto text-end">
										<?php if ($item->is_cancelled == 1) { ?>
											<!-- Cancelled Item Display -->
											<div class="text-danger">
												<i class="bi bi-x-circle-fill fs-4"></i>
												<p class="mb-0 small fw-semibold">Item Cancelled</p>
											</div>
										<?php } else { ?>
											<!-- Active Item Display -->
											<small class="text-muted d-block">Unit Price</small>
											<p class="mb-1 fw-semibold" style="color: #1E3A8A;">
												RM <?php echo number_format((float) $item->price_at_order, 2); ?>
											</p>
											<?php if ((int) $item->quantity > 1) { ?>
												<small class="text-muted d-block">× <?php echo (int) $item->quantity; ?></small>
												<p class="mb-2 fw-bold" style="color: #1E3A8A;">
													RM <?php echo number_format((float) $item->subtotal, 2); ?>
												</p>
											<?php } ?>

											<!-- Cancel Button - Only show for Order Placed status -->
											<?php if (strtolower($statusLabel) == 'order placed' || strtolower($statusLabel) == 'pending') { ?>
												<a class="btn btn-outline-danger btn-sm mt-2" href="<?php echo base_url("Orders/remove_items/$item->phone_id/$item->order_item_id"); ?>" onclick="return confirm('Are you sure you want to cancel this item?');">
													<i class="bi bi-x-circle me-1"></i> Cancel Item
												</a>
											<?php } ?>
										<?php } ?>

										<?php
										if ($item->status == 'Completed' && !isset($review[$item->order_id][$item->phone_id]) && $item->is_cancelled == 0) { ?>
											<button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#review_modal" data-orderitemid="<?php echo $item->order_item_id; ?>" data-orderid="<?php echo $item->order_id; ?>" data-phoneid="<?php echo $item->phone_id; ?>" data-phonename="<?php echo $item->phone_name_at_order; ?>" data-des="<?php echo $item->description; ?>" data-brand="<?php echo $item->brand; ?>">
												<i class="bi bi-pencil"></i> <span>Write Review</span>
											</button>
										<?php } else if ($item->status == 'Completed' && isset($review[$item->order_id][$item->phone_id]) && $item->is_cancelled == 0) { ?>
												<button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-semibold" disabled>
													<i class="bi bi-pencil"></i> <span>Review Submitted</span>
												</button>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>

						<!-- Footer: Order Total & Summary -->
						<div class="card-footer bg-light border-top">
							<div class="d-flex justify-content-between align-items-center">
								<div class="small text-muted">
									<i class="bi bi-box-seam"></i>
									<?php
									$active_items = $total_items - $cancelled_items;
									if ($cancelled_items > 0) {
										echo "$active_items active item(s)";
										if ($cancelled_items > 0) {
											echo " <span class='text-danger'>($cancelled_items cancelled)</span>";
										}
									} else {
										echo "$total_items item(s)";
									}
									?>
								</div>
								<div class="text-end">
									<small class="text-muted d-block">Order Total</small>
									<h5 class="mb-0 fw-bold" style="color: #1E3A8A;">
										RM <?php echo number_format($orderTotal, 2); ?>
									</h5>
									<?php if ($cancelled_items > 0 && $cancelled_items < $total_items) { ?>
										<small class="text-muted fst-italic">(Excluding cancelled items)</small>
									<?php } ?>
								</div>
							</div>
						</div>
					</article>
				<?php } ?>
			<?php } ?>
		</div>
	</main>

	<!-- Modal -->
	<div class="modal fade" id="review_modal" tabindex="-1" aria-labelledby="review_modal_label" aria-hidden="true" data-bs-backdrop="false" style="position: fixed;">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content rounded-4 shadow">

				<!-- Modal Header -->
				<div class="modal-header text-white" style="background-color: #1E3A8A;">
					<h5 class="modal-title" id="review_modal_label">Write A Review</h5>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<!-- Modal Body -->
				<div class="modal-body">
					<form id="review_form" class="d-flex flex-column gap-3" method="post" action="<?php echo base_url('Review/add'); ?>" enctype="multipart/form-data">

						<input type="hidden" value="<?php echo $this->id; ?>" name="user_id">
						<input type="hidden" id="phoneID" name="product_id">
						<input type="hidden" id="orderID" name="order_id">

						<!-- Product Info -->
						<div class="d-flex gap-3 border p-3 rounded align-items-center">
							<img src="<?php echo base_url('assets/images/40/40_78_693fd63c1acba.png'); ?>" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">

							<div class="flex-grow-1">
								<label class="form-control mb-2 border-0 bg-transparent p-0" id="phoneName">Phone Name Here</label>
								<label class="form-control mb-2 border-0 bg-transparent p-0" id="desc">Description Here</label>
								<label class="form-control border-0 bg-transparent p-0" id="brand">Brand Here</label>
							</div>
						</div>

						<!-- Product Rating -->
						<div class="d-flex flex-column">
							<label for="rating" class="mb-1">Product Rating</label>
							<select id="rating" name="rating" class="form-select">
								<option value="1">⭐</option>
								<option value="2">⭐⭐</option>
								<option value="3">⭐⭐⭐</option>
								<option value="4">⭐⭐⭐⭐</option>
								<option value="5">⭐⭐⭐⭐⭐</option>
							</select>
						</div>

						<textarea name="comment" id="comment" class="form-control" placeholder="Write your review..." style="height: 100px;"></textarea>
						<input type="file" class="form-control" name="images[]" accept="image/*" multiple>
						<input type="hidden" id="orderItemID" name="order_item_id">
				</div>

				<!-- Modal Footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger rounded-pill px-4" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary rounded-pill px-4 ">Submit Review</button>
				</div>

				</form>
			</div>
		</div>
	</div>
</div>

<script>
	document.getElementById('review_modal').addEventListener('show.bs.modal', function (event) {
		const btn = event.relatedTarget;

		document.getElementById('orderID').value = btn.dataset.orderid;
		document.getElementById('orderItemID').value = btn.dataset.orderitemid;
		document.getElementById('phoneName').textContent = btn.dataset.phonename;
		document.getElementById('phoneID').value = btn.dataset.phoneid;
		document.getElementById('desc').textContent = btn.dataset.des;
		document.getElementById('brand').textContent = btn.dataset.brand;
	});
</script>