<?php if (!empty($this->session->flashdata('message'))) { ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: 'PhoneStore',
            text: "<?php echo $this->session->flashdata('message'); ?>",
            icon: 'info',
            confirmButtonText: 'OK'
        })
    </script>
<?php } ?>

<main class="main-content">
    <div class="header">
        <div>
            <h1>Customer Management</h1>
            <p style="color: #64748b; margin-top: 0.3rem;">
                View and manage all your registered customers in one place.
                Keep track of their activities, analyze engagement, and build stronger customer relationships. <br>
                <span><strong>Highlighted Row = Disabled/Deleted User</strong></span>
            </p>
        </div>

        <div class="header-actions">
            <div class="user-profile">
                <div class="user-avatar"><?php echo $shortName; ?></div>
                <div>
                    <div style="font-weight: 600; color: #1e293b;"><?php echo $username; ?></div>
                    <div style="font-size: 0.8rem; color: #64748b;">Administrator</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Customers</h6>
                            <h3 class="mb-0 fw-bold"><?php echo count($Cusers); ?></h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-people-fill text-warning fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Active Customers</h6>
                            <h3 class="mb-0 fw-bold"><?php echo count(array_filter($Cusers, function ($Cuser) {
                                return $Cuser['status'] == 'Active';
                            })); ?></h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-person-check-fill text-success fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Inactive Customers</h6>
                            <h3 class="mb-0 fw-bold"><?php echo count(array_filter($Cusers, function ($Cuser) {
                                return $Cuser['status'] == 'Inactive';
                            })); ?></h3>
                        </div>
                        <div class="bg-secondary bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-person-x-fill text-secondary fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Customer List</h5>

                <?php
                // Check if user clicked delete
                if (!empty($this->input->get('del')) && $this->input->get('del') == 'true') {
                    // Show Back button after deletion
                    echo '<a href="' . base_url('Customer/index') . '" class="btn btn-outline-primary" style="margin-left: 40px;">Back</a>';
                } else {
                    // Show Delete User button
                    echo '<a href="' . base_url('Customer/index?del=true') . '" class="btn btn-outline-danger" style="margin-left: 40px;">Disabled User</a>';
                }
                ?>

            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 px-4 fw-semibold">Customer ID</th>
                            <th class="py-3 px-4 fw-semibold">Username</th>
                            <th class="py-3 px-4 fw-semibold">Email</th>
                            <th class="py-3 px-4 fw-semibold text-center">Total Orders</th>
                            <th class="py-3 px-4 fw-semibold text-center">Joined At</th>
                            <th class="py-3 px-4 fw-semibold text-center">Status</th>
                            <th class="py-3 px-4 fw-semibold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr class="<?php echo $user['is_active'] == 0 ? 'inactive-row' : ''; ?>">
                                <td class="px-4">
                                    <span class="badge bg-light text-dark border">#<?php echo $user['user_id']; ?></span>
                                </td>
                                <td class="px-4">
                                    <?php echo $user['username']; ?>
                                </td>
                                <td class="px-4 text-muted"><?php echo $user['email']; ?></td>
                                <td class="px-4 text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                        <?php echo $user['total_order']; ?> orders
                                    </span>
                                </td>
                                <td class="px-4 text-center text-muted">
                                    <small><?php echo date('d M Y', strtotime($user['created_at'])); ?></small>
                                </td>
                                <td class="px-4 text-center">
                                    <?php if ($user['status'] == 'Active') { ?>
                                        <span class="badge bg-success rounded-pill px-3 py-2">
                                            <i class="bi bi-check-circle-fill me-1"></i>
                                            Active
                                        </span>
                                    <?php } else { ?>
                                        <span class="badge bg-secondary rounded-pill px-3 py-2">
                                            <i class="bi bi-x-circle-fill me-1"></i>
                                            Inactive
                                        </span>
                                    <?php } ?>
                                </td>
                                <td class="px-4 text-center">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit_user" data-id="<?php echo $user['user_id']; ?>" data-username="<?php echo $user['username']; ?>" data-email="<?php echo $user['email']; ?>">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>

                                        <a href="<?php echo base_url('Customer/disable/') . $user['user_id']; ?>" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip">
                                            <i class="bi bi-power"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="edit_user" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <form id="editUserForm" method="post" action="<?php echo base_url('Customer/update'); ?>">

                        <div class="modal-header">
                            <h5 class="modal-title">Edit Customer Account</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="user_id" id="edit_user_id">

                            <div class="mb-3">
                                <label>New Username</label>
                                <input type="text" class="form-control" name="username" id="edit_username">
                            </div>

                            <div class="mb-3">
                                <label>New Email</label>
                                <input type="email" class="form-control" name="email" id="edit_email">
                            </div>

                            <div class="mb-3">
                                <label>New Password</label>
                                <input type="text" class="form-control" name="password" id="edit_password">
                            </div>
                        </div>

                        <input type="text" value="Customer" name="url" hidden>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <div class="card-footer bg-white border-top py-3">
            <div class="d-flex justify-content-center">
                <?php echo $pagination; ?>
            </div>
        </div>
    </div>
    </div>
</main>

<script>
    document.getElementById('edit_user').addEventListener('show.bs.modal', function (event) {

        // Button that triggered the modal
        const button = event.relatedTarget;

        // Read data-* attributes
        const userId = button.getAttribute('data-id');
        const username = button.getAttribute('data-username');
        const email = button.getAttribute('data-email');

        // Inject into modal inputs
        document.getElementById('edit_user_id').value = userId;
        document.getElementById('edit_username').value = username;
        document.getElementById('edit_email').value = email;
    });
</script>