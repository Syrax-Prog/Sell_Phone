<?php $this->load->view('Buyer/homepage/carousel_v'); ?>

<div class="container my-5">
	<!-- Categories Header -->


	<?php if (!empty($this->session->userdata('message1'))) { ?>
		<div class="alert alert-info alert-dismissible fade show" role="alert">
			<i class="bi bi-info-circle me-2"></i>
			<?php echo $this->session->userdata('message1'); ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<?php $this->session->unset_userdata('message1'); ?>
	<?php } ?>


	<div class="row mb-4">
		<div class="col">
			<h2 class="text-uppercase text-secondary fw-bold">POPULAR BRANDS</h2>
		</div>
	</div>

	<div class="row g-3 mb-3">
		<?php foreach ($brand as $v) { ?>
			<div class="col-6 col-md-4 col-lg-2">
				<a href="<?php echo base_url() . "Homepage?query=" . $v->brand . "#shop" ?>" style="text-decoration:none;">
					<div class="card shadow-sm h-100 text-center p-3 hover-bg-lightblue" style="border: 3px solid #1E3A8A">
						<div class="card-body">
							<span>
								<img src="<?php echo base_url() . $v->brand_img ?>" class="img-fluid" style="height: 60px; object-fit: contain;">
							</span>
							<br><br>
							<h6 class="card-title fw-bold">
								<?php echo $v->brand ?>
							</h6>
						</div>
					</div>
				</a>
			</div>
		<?php } ?>
	</div>
</div>

<div class="container my-5 py-4" id="shop">

	<?php $this->load->view('Buyer/homepage/product_listing_v', array('phone' => $phone)); ?>

	<?php $this->load->view('Buyer/homepage/company_detail_v'); ?>