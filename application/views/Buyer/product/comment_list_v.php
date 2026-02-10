<?php if (!empty($review)) { ?>
    <div class="container bg-white rounded py-4 mt-4 border border-grey" id="div1">
        <h2 class="fw-bold mb-4 mx-4" style="color: #1E3A8A;" id="cr_title">
            Comments and Reviews
        </h2>

        <!-- Review Card -->
        <div class="d-flex flex-column justify-content-center">
            <div class="card border-0 mb-3 no-hover ps-5" id="gabung">
                <?php foreach ($review as $v) { ?>
                    <div class="div2 card-body" style="border-bottom:1px solid lightgrey; padding-bottom: 50px;">
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
                                    <img src="<?php echo base_url($image); ?>" class="image-comment img-fluid rounded w-100 h-100 shadow-sm" alt="Review image <?php echo $x; ?>" style="cursor:pointer; object-fit: cover; border:1px solid black;" data-full="<?php echo base_url($image); ?>">

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

                        <div class="mt-2" id="image_preview" style="display: none;">
                            <img src="<?php echo base_url($image); ?>" style="max-width:300px; border: 1px solid black;" class="rounded shadow-sm">
                        </div>
                    </div>
                <?php } ?>
            </div>
            <button id="test" class="btn btn-primary mt-4 border border-dark glow-btn" style="width:100px; margin-left:50%; margin-right:50%;">See More</button>

            <p id="alll" class="text-center text-muted mt-3" style="display: none;">
                <i class="bi bi-check-circle me-2"></i>All Comments Loaded
            </p>
        </div>

    </div>
<?php } else { ?>
    <div class="container bg-white rounded py-5 mt-4 border d-flex flex-column align-items-center justify-content-center text-center">
        <i class="bi bi-chat-left-text fs-1 text-muted mb-3"></i>
        <h4 class="fw-bold text-secondary mb-1">
            No Reviews Yet
        </h4>
    </div>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var phoneId = <?php echo $review[0]['product_id']; ?>;
        var offset = $('#div1 .div2').length;

        $('#test').on('click', function () {
            $.ajax({
                url: '<?php echo base_url('Review/index/append') ?>',
                type: 'POST',
                data: {
                    id: phoneId,
                    offset: offset
                },
                dataType: 'json',

                success: function (response) {
                    var $newContent = $(response.html);
                    $('#gabung').append($newContent);

                    if (!response.has_more) {
                        $('#test').css('display', 'none');
                        $('#alll').css('display', '');
                    }

                    offset++;
                }
            });
        });

        $('.image-comment').on('click', function () {
            let imgSrc = $(this).data('full');

            $('#image_preview img').attr('src', imgSrc);
            $('.image-comment').removeClass('border-primary shadow-lg'); //remove highlighted for all image
            $(this).addClass('border-primary shadow-lg'); //reassign for selected one

            $('#image_preview').fadeIn();
        });

        $('#image_preview').on('click', function () {
            $(this).fadeOut();
        });

    });
</script>