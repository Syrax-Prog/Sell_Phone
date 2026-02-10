<?php foreach ($review as $v) { ?>
    <div class="card-body" style="border-bottom:1px solid lightgrey; padding-bottom: 50px;">
        <!-- User Info Row -->
        <div class="d-flex align-items-start gap-3 mb-3">
            <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:50px;height:50px">
                <?php echo strtoupper(substr($v['username'], 0, 2)); ?>
            </div>
            <div class="flex-grow-1">
                <h6 class="mb-1 fw-semibold"><?php echo $v['username']; ?></h6>

                <div class="d-flex align-items-center gap-2">
                    <div class="text-warning">
                        <?php
                        $rating = (int) $v['rating'];
                        echo str_repeat('<i class="bi bi-star-fill"></i>', $rating);
                        echo str_repeat('<i class="bi bi-star"></i>', 5 - $rating);
                        ?>
                    </div>
                    <small class="text-muted"><?php echo $rating; ?></small>
                </div>

            </div>
        </div>

        <!-- Metadata -->
        <div class="text-muted small mb-3">
            <span class="me-2"><?php echo $v['created_at']; ?></span>
            <span class="text-secondary"> | </span>
            <span class="ms-2"><?php echo $v['phone_name_at_order']; ?></span>
        </div>

        <!-- Review Text -->
        <p class="mb-3 lh-base comment-text text-muted" style="font-size:14px;">
            <span class="short-text">
                <?php echo substr($v['comment'], 0, 200); ?>
                <?php if (strlen($v['comment']) > 200)
                    echo '...'; ?>
            </span>

            <span class="full-text d-none">
                <?php echo $v['comment']; ?>
            </span>

            <?php if (strlen($v['comment']) > 200) { ?>
                <a href="javascript:void(0)" class="see-more text-primary ms-1">see more</a>
            <?php } ?>
        </p>



        <!-- Images Gallery -->
        <div class="d-flex gap-2 flex-wrap">
            <?php
            $x = 0;
            $user_uploaded = json_decode($v['images'], true);
            $total = count($user_uploaded);
            foreach ($user_uploaded as $image) { ?>
                <div class="position-relative" style="width:70px;height:70px">
                    <img src="<?php echo base_url($image); ?>" class="img-fluid rounded w-100 h-100 shadow-sm" alt="Review image <?php echo $x; ?>" style="cursor:pointer; object-fit: cover; border:1px solid black;">

                </div>
                <?php if ($x == 1 && $total > 3) { ?>
                    <div class="position-relative" style="width:70px;height:70px">
                        <div class="bg-dark bg-opacity-75 rounded d-flex align-items-center justify-content-center w-100 h-100" style="cursor:pointer">
                            <span class="text-white fw-bold">+<?php echo $total - $x - 1; ?><br> more</span>
                        </div>
                    </div>
                    <?php break;
                }
                $x++;
            }
            ?>
        </div>
    </div>
<?php } ?>