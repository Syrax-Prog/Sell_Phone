<main class="main-content">
    <div class="header">
        <div>
            <h1>Add New Admin</h1>
            <p style="color: #64748b; margin-top: 0.3rem;">
                Add a new admin to help manage the kingdom. Choose wisely—admins hold great power, and with great power comes… a lot of notifications.
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

    <div class="bg-white rounded shadow-sm p-3 mb-4">
        <div class="container py-4">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <h3 class="mb-3">Add New Administrator</h3>

                    <?php if (!empty($this->session->userdata('message'))) { ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?php echo $this->session->userdata('message'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php }
                    $_POST = array();
                    $this->session->unset_userdata('message'); ?>

                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo base_url() ?>Customer/new_admin" method="POST">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                </div>

                                <button type="submit" name="Add" class="btn btn-primary">Add Administrator</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>