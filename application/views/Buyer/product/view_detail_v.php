<!-- ============================================================ PHONE DETAIL PAGE (Redesigned) ============================================================ -->
<div class="phone-detail-container pb-4" style="background: white;">
	<div class="container" style="margin-top: 80px;">
		<div class="row align-items-center g-5 shadow-lg rounded-4 p-4" style="background: white; border: 1px solid #e0e0e0;">

			<!-- ============================================================ PHONE IMAGE ============================================================ -->
			<div class="col-md-6 text-center position-relative">
				<div class="rgb-glow position-absolute top-50 start-50 translate-middle"></div>

				<?php
				$imageUrl = $phone->image_url;
				if (strpos($imageUrl, 'http') === 0) {
					$finalImageUrl = $imageUrl;
				} else {
					$finalImageUrl = base_url($imageUrl);
				}
				?>
				<img src="<?php echo htmlspecialchars($finalImageUrl, ENT_QUOTES, 'UTF-8') ?>" alt="Phone Image" class="img-fluid rounded-4 shadow-lg" style="max-height: 420px; object-fit: contain; z-index: 2; position: relative;">
			</div>
			<!-- ============================================================ END PHONE IMAGE ============================================================ -->

			<!-- ============================================================ PHONE INFO ============================================================ -->
			<div class="col-md-6 text-dark">
				<h2 class="fw-bold mb-2" style="color: #1E3A8A"><?php echo $phone->brand . " | " . $phone->phone_name; ?></h2>
				<h4 class="fw-bold mb-3" style="color: #1E3A8A">
					<?php if (isset($phone->current_price)) {
						if ($phone->discount != 0) {
							$discounted_price = $phone->current_price - ($phone->current_price * $phone->discount / 100); ?>

							RM <?php echo number_format($discounted_price, 2); ?>
							<small class="text-muted text-decoration-line-through" style="font-size: 0.7em;">
								RM <?php echo number_format($phone->current_price, 2); ?>
							</small>

						<?php } else { ?>
							RM <?php echo number_format($phone->current_price, 2); ?>
						<?php }
					} else { ?>
						Price N/A
					<?php } ?>
				</h4>

				<!-- ============================================================ SPECS LIST ============================================================ -->
				<div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><strong>Storage:</strong> <?php echo $phone->storage; ?> GB</li>
						<li class="list-group-item"><strong>RAM:</strong> <?php echo $phone->ram; ?> GB</li>
						<li class="list-group-item"><strong>Battery:</strong> <?php echo $phone->battery; ?> mAh</li>
						<li class="list-group-item"><strong>OS:</strong> <?php echo $phone->os; ?></li>
						<li class="list-group-item"><strong>Description:</strong> <?php echo $phone->description; ?>
						</li>
					</ul>

					<ul class="small text-muted mt-3">
						<li>✔ 1-Year Warranty</li>
						<li>✔ 7-Day Returns</li>
						<li>✔ Fast Delivery</li>
					</ul>

				</div>
				<!-- ============================================================ END SPECS LIST ============================================================ -->

				<!-- ============================================================ BUY FORM ============================================================ -->
				<form action="<?php echo site_url('Cart/add'); ?>" method="post" class="mt-4">
					<!-- hidden value -->
					<input type="hidden" name="phone_id" value="<?php echo $phone->phone_id; ?>">
					<input type="hidden" name="phone_name" value="<?php echo $phone->phone_name; ?>">
					<input type="hidden" name="price" value="<?php echo $phone->current_price; ?>">
					<input type="hidden" name="storage" value="<?php echo $phone->storage; ?>">
					<input type="hidden" name="ram" value="<?php echo $phone->ram; ?>">
					<input type="hidden" name="battery" value="<?php echo $phone->battery; ?>">
					<input type="hidden" name="os" value="<?php echo $phone->os; ?>">
					<input type="hidden" name="image" value="<?php echo $phone->image_url; ?>">

					<div class="d-flex align-items-center mb-4">
						<label for="quantity" class="form-label fw-semibold me-3 mb-0">Quantity:</label>
						<input type="number" name="quantity" id="quantity" value="1" min="1" max="<?php echo $phone->stock; ?>" class="form-control text-center" style="width: 90px; border-radius: 10px;">
					</div>

					<div class="d-flex gap-3">
						<button type="submit" name="submit" value="submit" class="btn btn-lg px-4 glow-btn text-white" style="background-color: #1E3A8A;">
							Add To Cart
						</button>
						<a href="<?php echo site_url('Homepage'); ?>" class="btn btn-lg btn-outline-dark px-4">
							← Back
						</a>
					</div>
				</form>
				<!-- ============================================================ END BUY FORM ============================================================ -->
			</div>
			<!-- ============================================================ END PHONE INFO ============================================================ -->
		</div>
	</div>
</div>