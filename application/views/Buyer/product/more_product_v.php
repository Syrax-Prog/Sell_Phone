<div class="container bg-white rounded py-4 mt-4 border border-grey">
    <h2 class="fw-bold mb-4 mx-4" style="color: #1E3A8A;">
        View Other Products
    </h2>

    <div class="d-flex flex-column justify-content-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 mx-4">
            <?php
            $i = 0;
            foreach ($phone as $p) {
                $i++;
                // Determine final price after discount
                if ($p->discount != 0) {
                    $final_price = $p->current_price - ($p->current_price * $p->discount / 100);
                } else {
                    $final_price = $p->current_price;
                }

                // Determine image URL
                $imageUrl = (strpos($p->image_url, 'http') === 0) ? $p->image_url : base_url($p->image_url);
                ?>
                <div class="col">
                    <div class="card border border-primary h-100">
                        <img src="<?php echo htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top img-fluid" alt="<?php echo htmlspecialchars($p->phone_name, ENT_QUOTES, 'UTF-8'); ?>" style="height:200px; object-fit:cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($p->phone_name, ENT_QUOTES, 'UTF-8'); ?></h5>
                            <p class="card-text">
                                RM <?php echo number_format($final_price, 2); ?>
                                <?php if ($p->discount != 0) { ?>
                                    <small class="text-muted text-decoration-line-through">
                                        RM <?php echo number_format($p->current_price, 2); ?>
                                    </small>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                if ($i % 4 == 0) {
                    break;
                }
            } ?>

        </div>
        <a class="btn btn-primary mt-4 border border-dark glow-btn" style="width:100px; margin-left: 50%; margin-right: 50%;" href="<?php echo base_url('Homepage#shop') ?>">See More</a>
    </div>

</div>