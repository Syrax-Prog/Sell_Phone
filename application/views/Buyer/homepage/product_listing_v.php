<!-- Section Header -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold text-dark mb-2">
            <i class="bi bi-phone text-primary me-2"></i>Featured Phones
        </h2>
        <p class="text-muted">Browse our collection of premium smartphones</p>

        <?php if (!empty($this->session->flashdata('message'))) { ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('message'); ?>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Filter and Search Controls -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="row g-3 align-items-center">
                    <!-- Search Form -->
                    <div class="col-lg-10 col-md-9 col-sm-6">
                        <form class="d-flex gap-2" role="search" method="get" action="<?php echo site_url('Homepage'); ?>">
                            <div class="input-group input-group-lg flex-grow-1">
                                <span class="input-group-text text-white border-0" style="background-color: #1E3A8A">
                                    <i class="bi bi-search"></i>
                                </span>
                                <?php
                                $searchValue = '';

                                if (isset($_GET['query'])) {
                                    // Get the search value from the URL, trim spaces, and escape special characters for safety
                                    $searchValue = trim($_GET['query']);
                                }
                                ?>
                                <input class="form-control border-start-0" type="search" name="query" placeholder="Search by brand, model, or features..." aria-label="Search phones" value="<?php echo $searchValue; ?>" maxlength="100">

                                <button class="btn text-white" type="submit" style="background-color: #1E3A8A">
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Active Search Indicator -->

                <?php if (isset($_GET['query']) && !empty(trim($_GET['query']))) { ?>
                    <div class="mt-3">
                        <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                            <i class="bi bi-funnel-fill me-2"></i>
                            Searching for:
                            <strong><?php echo $_GET['query']; ?></strong>
                            <a href="<?php echo site_url('Homepage'); ?>" class="btn btn-sm btn-outline-info ms-3">
                                Clear Search
                            </a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <?php foreach ($phone as $fon) { ?>
        <?php if (isset($fon->phone_id) && isset($fon->phone_name)) { ?>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12" id="data-container">
                <div class="card h-100 border-0 shadow-sm hover-lift">

                    <!-- Phone Image -->
                    <div class="position-relative">
                        <?php
                        if (isset($fon->image_url) && !empty($fon->image_url)) {
                            $imageUrl = $fon->image_url;
                        } else {
                            $imageUrl = 'https://via.placeholder.com/400x300?text=No+Image';
                        }
                        ?>
                        <img src="<?php echo $imageUrl; ?>" class="card-img-top" alt="<?php echo $fon->phone_name; ?>" style="height: 300px; object-fit: contain;" loading="lazy" onerror="this.src='https://via.placeholder.com/400x300?text=Image+Not+Found'">

                        <!-- NEW Badge - Shows if phone was added within last 30 days -->
                        <?php
                        if (isset($fon->created_at) && !empty($fon->created_at)) {
                            $createdDate = strtotime($fon->created_at);
                            $oneMonthAgo = strtotime('-30 days');

                            if ($createdDate > $oneMonthAgo) {
                                ?>
                                <span class="position-absolute top-0 start-0 badge bg-danger m-3">
                                    <i class="bi bi-star-fill me-1"></i>NEW
                                </span>
                                <?php
                            }
                        }
                        ?>

                        <!-- Stock Badge -->
                        <?php if (isset($fon->stock)) { ?>
                            <?php
                            $stock = intval($fon->stock);
                            if ($stock <= 10 && $stock > 0) {
                                $badgeClass = 'bg-warning text-dark';
                                $badgeText = 'Low Stock';
                            } elseif ($stock > 10) {
                                $badgeClass = 'bg-success';
                                $badgeText = 'In Stock';
                            } else {
                                $badgeClass = 'bg-secondary';
                                $badgeText = 'Out of Stock';
                            }
                            ?>
                            <span class="position-absolute top-0 end-0 badge <?php echo $badgeClass; ?> m-3">
                                <?php echo $badgeText; ?>
                            </span>
                        <?php } ?>
                    </div>

                    <!-- Phone Details -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark mb-3">
                            <span style="color: #1E3A8A;"><?php echo $fon->brand; ?></span> | <?php echo $fon->phone_name; ?>
                        </h5>


                        <!-- Price -->
                        <div class="mb-3">
                            <?php if (isset($fon->current_price)) {
                                if ($fon->discount != 0) {
                                    // Calculate discounted price
                                    $discounted_price = $fon->current_price - ($fon->current_price * $fon->discount / 100); ?>

                                    <h4 class="fw-bold mb-0" style="color: #1E3A8A">
                                        RM <?php echo number_format($discounted_price, 2); ?>
                                    </h4>

                                    <small class="text-muted text-decoration-line-through">
                                        RM <?php echo number_format($fon->current_price, 2); ?>
                                    </small>

                                <?php } else { ?>
                                    <h4 class="fw-bold mb-0" style="color: #1E3A8A">
                                        RM <?php echo number_format($fon->current_price, 2); ?>
                                    </h4>
                                <?php }
                            } else { ?>
                                <h4 class="text-muted mb-0">Price N/A</h4>
                            <?php } ?>
                        </div>

                        <!-- View Details Button -->
                        <div class="mt-auto d-flex gap-2">
                            <a href="<?php echo site_url('Homepage/viewDetails/' . intval($fon->phone_id)); ?>" class="btn btn-outline-secondary btn-sm flex-fill">
                                <i class="bi bi-eye me-2"></i>View Details
                            </a>
                            <a href="<?php echo site_url('Homepage/add_to_cart/' . intval($fon->phone_id)); ?>" class="btn btn-sm flex-fill text-white" style="background-color: #1E3A8A">
                                <i class="bi bi-cart me-2"></i>Add
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <!-- No Results Found -->
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-search text-muted" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="text-dark fw-bold mb-3">No Phones Found</h4>
                        <p class="text-muted mb-4">
                            We couldn't find any phones matching your search criteria.
                            Try adjusting your search or browse all available phones.
                        </p>
                        <a href="<?php echo site_url('Homepage'); ?>" class="btn btn-primary btn-lg">
                            <i class="bi bi-arrow-left me-2"></i>View All Phones
                        </a>
                    </div>
                </div>
            </div>
        <?php }
    } ?>
</div>

<div class="d-flex justify-content-center mt-3 pb-3">
    <button class="btn btn-outline-primary" id="load-more" onclick="load_more()">Load More</button><br><br>
</div>