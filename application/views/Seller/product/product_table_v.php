<!-- Product Table -->
<div class="card shadow-sm border border-primary-subtle shadow">
    <div class="table-responsive">
        <table id="productsTable" class="table align-middle table-hover mb-0 border border-primary-subtle">
            <thead class="table-primary">
                <tr>
                    <th>Product</th>
                    <th>Created At</th>
                    <th>Phone ID</th>
                    <th>Price (RM)</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Sales</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($phones)) { ?>
                    <?php foreach ($phones as $p) { ?>
                        <tr>
                            <td class="d-flex align-items-center gap-2">
                                <img src="<?php echo base_url() . $p->image_url; ?>" class="rounded border" style="width: 50; height:50; object-fit: fill;">
                                <div>
                                    <div class="fw-semibold"><?php echo $p->phone_name; ?></div>
                                    <small class="text-muted"><?php echo $p->brand; ?></small>
                                </div>
                            </td>
                            <td data-order="<?php echo strtotime($p->created_at); ?>">
                                <div class="fw-semibold">
                                    <?php echo date("d M Y", strtotime($p->created_at)); ?>
                                </div>
                            </td>
                            <td># <?php echo $p->phone_id; ?></td>
                            <td data-order="<?php echo $p->current_price; ?>" class="fw-bold">RM <?php echo number_format($p->current_price, 2); ?></td>
                            <td data-order="<?php echo $p->stock; ?>">
                                <?php if ($p->stock_status === 'Out of Stock') { ?>
                                    <span class="badge bg-danger">Out Of Stock</span>
                                <?php } elseif ($p->stock_status === 'Low Stock') { ?>
                                    <span class="badge bg-warning text-dark">Low Stock</span>
                                <?php } else { ?>
                                    <span class="badge bg-success">In Stock</span>
                                <?php } ?>
                            </td>

                            <?php if ($p->is_active == 1) {
                                $status = "Deactivate";
                                $icon = "bi-check-circle";
                                $badge = "bg-success";
                                $text = "Active";
                                $btn = "success";
                            } else {
                                $status = "Activate";
                                $icon = "bi-x-circle";
                                $badge = "bg-danger";
                                $text = "Inactive";
                                $btn = "danger";
                            } ?>

                            <td><span class="badge <?php echo $badge; ?>"><i class="bi <?php echo $icon; ?> me-1"></i><?php echo $text; ?></span></td>
                            <td data-order="<?php echo $p->total_sold; ?>"><?php echo $p->total_sold; ?> sold</td>

                            <td class="text-nowrap">
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPhone<?php echo $p->phone_id; ?>" title="Update">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <a href="<?php echo base_url('Product/activate_deactivate/' . $p->phone_id . '/' . $p->is_active); ?>">
                                    <button class="btn btn-outline-<?php echo $btn; ?> btn-sm" title="<?php echo $status; ?>">
                                        <i class="bi bi-power"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td class="d-flex align-items-center gap-2" colspan="8">Record Not Found</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div><?php echo $pagination; ?></div>
</div>