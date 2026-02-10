<!-- ============================================================ PHONE DETAIL PAGE (Redesigned) ============================================================ -->
<div class="phone-detail-container pb-4" style="background: white;">
	<div class="container" style="margin-top: 80px;">
		<div class="row align-items-center g-5 rounded-4 p-4" style="background: white; border: 1px solid #e0e0e0;">

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
				<img src="<?php echo htmlspecialchars($finalImageUrl, ENT_QUOTES, 'UTF-8') ?>" alt="Phone Image" class="img-fluid rounded-4 border border-grey" style="max-height: 420px; object-fit: contain; z-index: 2; position: relative;">
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
				<div class="card shadow-sm mb-3 border border-grey">
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
			</div>
		</div>
	</div>
</div>
<style>
	.card:hover {
		box-shadow: none !important;
		transform: none !important;
	}
</style>

<div class="phone-detail-container pb-4 d-flex flex-column align-items-center" id="comment_list" data-id="<?php echo $phone->phone_id; ?>">
	<img src="<?php echo base_url('assets/images/loading.gif'); ?>" style="width:100px;">
</div>

<div class="phone-detail-container pb-4 d-flex flex-column align-items-center" id="popular_item">
	<img src="<?php echo base_url('assets/images/loading.gif'); ?>" style="width:100px;">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

	$(document).ready(function () {
		var phoneId = $('#comment_list').data('id');

		$.ajax({
			url: '<?php echo base_url('Review/index/') ?>',
			type: 'POST',
			data: { id: phoneId },
			dataType: 'json',

			success: function (response) {
				var $newContent = $(response.html);

				$('#comment_list').html(response.html);

				if (response.total_comment) {
					document.getElementById('cr_title').textContent = 'Comment And Reviews (' + response.total_comment + ')';
				}
			}
		});
	});

	$(document).ready(function () {
		var loaded = false;

		$(window).on('scroll', function () {
			var scrollTop = $(window).scrollTop();
			var windowHeight = $(window).height();
			var offsetTop = $('#popular_item').offset().top;

			if (!loaded && scrollTop + windowHeight >= offsetTop) {
				loaded = true;

				$.ajax({
					url: '<?php echo base_url('Homepage/explore_more') ?>',
					type: 'POST',
					success: function (response) {
						$('#popular_item').html(response);
					}
				});
			}
		});
	});

	document.addEventListener('click', function (e) {
		if (e.target.classList.contains('see-more')) {
			const p = e.target.closest('.comment-text');
			const shortText = p.querySelector('.short-text');
			const fullText = p.querySelector('.full-text');

			shortText.classList.toggle('d-none');
			fullText.classList.toggle('d-none');

			const t = e.target.textContent.trim().toLowerCase();
			e.target.textContent = (t === 'see less') ? 'see more' : 'see less';
		}
	});

</script>