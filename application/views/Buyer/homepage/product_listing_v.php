<!-- Section Header -->
<?php
$search_option = array(
    'phone_name' => 'Phone Name',
    'brand' => 'Brand',
    'os' => 'Operating System',
    // 'ram' => 'RAM (int)',
    // 'battery' => 'Battery',
    // 'chipset' => 'Chipset',
    // 'storage' => 'Storage (ROM)'
);
?>

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
                        <form class="d-flex gap-2" role="search" method="get"
                            action="<?php echo site_url('Homepage'); ?>">
                            <div class="input-group input-group-lg flex-grow-1">
                                <span class="input-group-text text-white border-0" style="background-color: #1E3A8A">
                                    <i class="bi bi-search"></i>
                                </span>
                                <?php
                                $searchValue = '';

                                if (isset($_GET['search_value'])) {
                                    // Get the search value from the URL, trim spaces, and escape special characters for safety
                                    $searchValue = trim($_GET['search_value']);
                                }
                                ?>
                                <input class="form-control border-start-0" type="search" name="search_value"
                                    placeholder="Search by brand, model, or features..." aria-label="Search phones"
                                    value="<?php echo $searchValue; ?>" maxlength="100">

                                <select name="search_type" class="form-select flex-grow-0"
                                    style="width: 200px; border-radius: 0;">
                                    <?php foreach ($search_option as $k => $v) {
                                        $selected = (isset($_GET['search_type']) && $_GET['search_type'] == $k) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $k; ?>" <?php echo $selected; ?>><?php echo $v; ?>
                                        </option>
                                    <?php } ?>
                                </select>
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

<?php
// Select the top 4 phones from the sorted list
$top_sales = array_slice($phone, 0, 4);
?>

<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">
                <i class="bi bi-fire text-danger me-2"></i>Best Sellers
            </h2>
            <div class="ms-auto">
                <span class="badge rounded-pill bg-white text-primary border border-primary px-3">Trending Now</span>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach ($top_sales as $top) {
                // Calculate Popularity Percentage
                $sold = intval($top->total_sold);
                $stock = intval($top->stock);
                $total_cap = $sold + $stock;
                $popularity = ($total_cap > 0) ? round(($sold / $total_cap) * 100) : 0;

                // Dynamic UI Colors based on popularity
                $bar_color = 'bg-success';
                $status_text = 'Stable';
                if ($popularity > 80) {
                    $bar_color = 'bg-danger';
                    $status_text = 'Selling Fast!';
                } elseif ($popularity > 50) {
                    $bar_color = 'bg-warning text-dark';
                    $status_text = 'High Demand';
                }
                ?>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm position-relative overflow-hidden h-100"
                        style="background: linear-gradient(145deg, #ffffff, #fcfcfc); border-radius: 15px;">

                        <div class="position-absolute top-0 start-0 bg-primary text-white px-3 py-1 fw-bold"
                            style="z-index: 10; border-bottom-right-radius: 15px; font-size: 0.75rem;">
                            #BEST SELLER
                        </div>

                        <div class="p-4 text-center">
                            <div class="mb-3 mt-2">
                                <img src="<?php echo !empty($top->image_url) ? $top->image_url : 'https://via.placeholder.com/150'; ?>"
                                    class="img-fluid" style="height: 140px; object-fit: contain;">
                            </div>

                            <h6 class="fw-bold text-dark text-truncate mb-1"><?php echo $top->phone_name; ?></h6>
                            <p class="text-primary fw-bold mb-3">RM <?php echo number_format($top->current_price, 2); ?></p>

                            <div class="px-1">
                                <div class="d-flex justify-content-between mb-1" style="font-size: 0.7rem;">
                                    <span class="text-muted"><?php echo $sold; ?> Sold</span>
                                    <span class="fw-bold <?php echo ($popularity > 80) ? 'text-danger' : 'text-dark'; ?>">
                                        <?php echo $status_text; ?>
                                    </span>
                                </div>
                                <div class="progress mb-2"
                                    style="height: 8px; border-radius: 10px; background-color: #eee;">
                                    <div class="progress-bar <?php echo $bar_color; ?> progress-bar-striped progress-bar-animated"
                                        role="progressbar" style="width: <?php echo $popularity; ?>%"
                                        aria-valuenow="<?php echo $popularity; ?>" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="text-start">
                                    <small class="text-muted" style="font-size: 0.65rem;">
                                        <i class="bi bi-box-seam me-1"></i><?php echo $stock; ?> units remaining
                                    </small>
                                </div>
                            </div>

                            <a href="<?php echo site_url('Homepage/viewDetails/' . intval($top->phone_id)); ?>"
                                class="btn btn-dark w-100 mt-3 rounded-pill py-2 shadow-sm" style="font-size: 0.85rem;">
                                View Selection
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<hr class="my-5 border-light">

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
                        <img src="<?php echo $imageUrl; ?>" class="card-img-top" alt="<?php echo $fon->phone_name; ?>"
                            style="height: 300px; object-fit: contain;" loading="lazy"
                            onerror="this.src='https://via.placeholder.com/400x300?text=Image+Not+Found'">

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
                            <a href="<?php echo site_url('Homepage/viewDetails/' . intval($fon->phone_id)); ?>"
                                class="btn btn-outline-secondary btn-sm flex-fill">
                                <i class="bi bi-eye me-2"></i>View Details
                            </a>
                            <a href="<?php echo site_url('Homepage/add_to_cart/' . intval($fon->phone_id)); ?>"
                                class="btn btn-sm flex-fill text-white" style="background-color: #1E3A8A">
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