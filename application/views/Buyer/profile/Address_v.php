<div class="profile-page">
    <?php $this->load->view('component/profile_side_v'); ?>
    <main style="margin-left: 20px; margin-top:20px;">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-5 fw-bold text-dark">Manage Addresses</h1>
                <p class="text-muted">Add, edit, or remove your saved addresses</p>
            </div>
            <div class="col-auto">
                <!-- Button to trigger Add Address modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                    <i class="fas fa-plus me-2"></i>Add New Address
                </button>
            </div>
        </div>

        <!-- Address Cards -->
        <div class="row g-2">
            <?php if (!empty($addresses)) { ?>
                <?php foreach ($addresses as $addr) { ?>
                    <div class="col-md-6 col-lg-6">
                        <div class="card h-100 shadow-sm <?php echo $addr->is_default ? 'border-primary' : ''; ?>">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>Address
                                    </h5>
                                    <?php if ($addr->is_default) { ?>
                                        <span class="badge bg-primary">Default</span>
                                    <?php } ?>
                                </div>
                                <p class="card-text text-muted small mb-0" style="white-space: pre-line;"><?php echo htmlspecialchars(trim($addr->address)); ?></p>
                            </div>
                            <div class="card-footer bg-white border-top">
                                <div class="d-flex gap-2">
                                    <!-- Edit Button triggers modal -->
                                    <button type="button" class="btn btn-outline-primary btn-sm flex-fill" data-bs-toggle="modal" data-bs-target="#editAddressModal<?php echo $addr->ua_id; ?>">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </button>

                                    <?php if (!$addr->is_default) { ?>
                                        <a href="<?php echo base_url() ?>Address/set_default?id=<?php echo $addr->ua_id; ?>" class="btn btn-outline-success btn-sm flex-fill" title="Set as default">
                                            <i class="fas fa-check me-1"></i>Default
                                        </a>
                                    <?php } ?>

                                    <form action="<?php echo base_url('Address/delete'); ?>" method="POST" class="d-inline">
                                        <input type="hidden" name="ua_id" value="<?php echo $addr->ua_id; ?>">
                                        <input type="hidden" name="redirect_to" value="<?php echo current_url(); ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-sm flex-fill">
                                            <i class="fas fa-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Address Modal -->
                    <div class="modal fade" id="editAddressModal<?php echo $addr->ua_id; ?>" tabindex="-1" aria-labelledby="editAddressModalLabel<?php echo $addr->ua_id; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="<?php echo base_url('Address/edit'); ?>" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editAddressModalLabel<?php echo $addr->ua_id; ?>">Edit Address</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ua_id" value="<?php echo $addr->ua_id; ?>">
                                        <div class="mb-3">
                                            <label for="address<?php echo $addr->ua_id; ?>" class="form-label">Address</label>
                                            <textarea class="form-control" id="address<?php echo $addr->ua_id; ?>" name="address" rows="3"><?php echo htmlspecialchars($addr->address); ?></textarea>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="is_default<?php echo $addr->ua_id; ?>" name="is_default" value="1" <?php echo $addr->is_default ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="is_default<?php echo $addr->ua_id; ?>">Set as default</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            <?php } else { ?>
                <!-- Empty State -->
                <div class="col-12 text-center py-5">
                    <i class="fas fa-map-marker-alt text-muted" style="font-size: 4rem;"></i>
                    <h3 class="mt-3 text-muted">No addresses yet</h3>
                    <p class="text-muted mb-4">Click "Add New Address" to get started</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                        <i class="fas fa-plus me-2"></i>Add Your First Address
                    </button>
                </div>
            <?php } ?>
        </div>
    </main>
</div>

<!-- Add Address Modal -->
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url('Address/add'); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAddressModalLabel">Add New Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_address" class="form-label">Address</label>
                        <textarea class="form-control" id="new_address" name="address" rows="3"></textarea>
                        <input type="hidden" name="redirect_to" value="<?php echo current_url(); ?>">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="new_is_default" name="is_default" value="1">
                        <label class="form-check-label" for="new_is_default">Set as default</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Address</button>
                </div>
            </form>
        </div>
    </div>
</div>