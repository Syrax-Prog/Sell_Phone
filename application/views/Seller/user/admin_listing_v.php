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
            <h1>Admin Management</h1>
            <p style="color: #64748b; margin-top: 0.3rem;">
                Manage all administrator accounts from a single dashboard.
                Monitor access levels, assign roles, and ensure secure and efficient system control.
            </p>
        </div>

        <div class="header-actions">
            <div class="user-profile">
                <div class="user-avatar"><?php echo $shortName; ?></div>
                <div>
                    <div style="font-weight: 600; color: #1e293b;"><?php echo $username; ?></div>
                    <div style="font-size: 0.8rem; color: #64748b;">System Administrator</div>
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
                            <h6 class="text-muted mb-2">Total Admins</h6>
                            <h3 class="mb-0 fw-bold"><?php echo count($Cusers); ?></h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-people-fill text-primary fs-3"></i>
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
                            <h6 class="text-muted mb-2">Super Admins</h6>
                            <h3 class="mb-0 fw-bold"><?php echo count(array_filter($Cusers, function ($a) {
                                return $a['admin_type'] == 'Super';
                            })); ?></h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-shield-fill-check text-success fs-3"></i>
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
                            <h6 class="text-muted mb-2">Normal Admins</h6>
                            <h3 class="mb-0 fw-bold"><?php echo count(array_filter($Cusers, function ($a) {
                                return $a['admin_type'] == 'Normal';
                            })); ?></h3>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-person-badge-fill text-info fs-3"></i>
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
                <h5 class="mb-0 fw-semibold">Administrator List</h5>
                <div class="admin-filter" style="margin: 20px 0 20px 30px; display: flex; align-items: center; gap: 10px;">

                    <a class="btn btn-success border-black" href="<?php echo site_url('Customer/set_session_filter?admin_type=super'); ?>">
                        Super Admin
                    </a>

                    <a class="btn btn-info border-black" href="<?php echo site_url('Customer/set_session_filter?admin_type=normal'); ?>">
                        Normal Admin
                    </a>

                    <a class="btn btn-secondary border-black" href="<?php echo site_url('Customer/set_session_filter?admin_type=All'); ?>">
                        Reset
                    </a>
                </div>

            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="myTable" class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 px-4 fw-semibold">Admin ID</th>
                            <th class="py-3 px-4 fw-semibold">Username</th>
                            <th class="py-3 px-4 fw-semibold">Email</th>
                            <th class="py-3 px-4 fw-semibold text-center">Admin Type</th>
                            <th class="py-3 px-4 fw-semibold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admin as $user) { ?>
                            <tr>
                                <td class="px-4">
                                    <span class="badge bg-light text-dark border">#<?php echo $user['user_id']; ?></span>
                                </td>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; font-size: 0.85rem; font-weight: 600;">
                                            <?php echo strtoupper(substr($user['username'], 0, 2)); ?>
                                        </div>
                                        <span class="fw-medium"><?php echo $user['username']; ?></span>
                                    </div>
                                </td>
                                <td class="px-4 text-muted"><?php echo $user['email']; ?></td>
                                <td class="px-4 text-center">
                                    <?php if ($user['admin_type'] == 'Super') { ?>
                                        <span class="badge bg-success rounded-pill px-3 py-2">
                                            <i class="bi bi-star-fill me-1"></i>
                                            Super Admin
                                        </span>
                                    <?php } else { ?>
                                        <span class="badge bg-info rounded-pill px-3 py-2">
                                            <i class="bi bi-person-badge me-1"></i>
                                            Normal Admin
                                        </span>
                                    <?php } ?>
                                </td>
                                <td class="px-4 text-center">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit_user" data-id="<?php echo $user['user_id']; ?>" data-username="<?php echo $user['username']; ?>" data-email="<?php echo $user['email']; ?>">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>

                                        <a href="<?php echo base_url(); ?>Customer/delete_user?user_id=<?php echo $user['user_id']; ?>&name=<?php echo $user['username']; ?>&url=Customer/admin_list" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Delete Admin">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <div class="card-footer bg-white border-top py-3">
                    <div class="d-flex justify-content-center">
                        <?php echo $pagination; ?>
                    </div>
                </div>
            </div>
        </div>
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
                            <label for="edit_admin_type">Admin Type</label>
                            <select class="form-control" name="admin_type" id="edit_admin_type">
                                <option value="super">Super</option>
                                <option value="normal">Normal</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>New Password</label>
                            <input type="text" class="form-control" name="password" id="edit_password">
                        </div>
                    </div>

                    <input type="text" value="Customer/admin_list" name="url" hidden>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

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