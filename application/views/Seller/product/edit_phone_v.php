<div class="epc-card-container">
    <div class="epc-card epc-card-small">
        <div class="epc-card-image">
            <label class="image-checkbox">
                <input type="checkbox" name="phone_select[]" value="1" hidden>
                <img src="<?= (strpos($phone->link_gambar, 'http') === 0)
                    ? $phone->link_gambar
                    : base_url($phone->link_gambar); ?>" alt="Phone Image">
            </label>
        </div>
        <div class="epc-card-details">

            <h3>Edit Phone Details</h3>

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success" style="color: green; font-weight: bold;">
                    <?= $this->session->flashdata('success'); ?>
                </div>
            <?php elseif ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger" style="color: red; font-weight: bold;">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form class="epc-card-form" action="<?= base_url('editPhone/update_detail') ?>" method="POST"
                enctype="multipart/form-data">

                <input type="text" class="epc-input" name="phone_id" value="<?= $phone_id; ?>" hidden>
                <div class="epc-form-row">
                    <div class="epc-form-col">
                        <label class="epc-label">Phone Name</label>
                        <input type="text" class="epc-input" name="name" value="<?= $phone->phone_name; ?>">
                    </div>
                    <div class="epc-form-col">
                        <label class="epc-label">Brand</label>
                        <input type="text" class="epc-input" name="brand" value="<?= $phone->brand; ?>">
                    </div>
                </div>

                <div class="epc-form-row">
                    <div class="epc-form-col">
                        <label class="epc-label">Price</label>
                        <input type="number" class="epc-input" name="price" value="<?= $phone->price; ?>">
                    </div>
                    <div class="epc-form-col">
                        <label class="epc-label">Stock</label>
                        <input type="number" class="epc-input" name="stock" value="<?= $phone->stock; ?>">
                    </div>
                </div>

                <div class="epc-form-row">
                    <div class="epc-form-col">
                        <label class="epc-label">Storage</label>
                        <input type="text" class="epc-input" name="storage" value="<?= $phone->storage; ?>">
                    </div>
                    <div class="epc-form-col">
                        <label class="epc-label">RAM</label>
                        <input type="text" class="epc-input" name="ram" value="<?= $phone->ram; ?>">
                    </div>
                </div>

                <div class="epc-form-row">
                    <div class="epc-form-col">
                        <label class="epc-label">Battery</label>
                        <input type="text" class="epc-input" name="battery" value="<?= $phone->battery; ?>">
                    </div>
                    <div class="epc-form-col">
                        <label class="epc-label">OS</label>
                        <input type="text" class="epc-input" name="os" value="<?= $phone->os; ?>">
                    </div>
                </div>

                <div class="epc-form-row">
                    <div class="epc-form-col-full">
                        <label class="epc-label">Change Image</label>
                        <input type="file" name="link_gambar" class="epc-input">
                    </div>
                </div>

                <div class="epc-form-row">
                    <div class="epc-form-col-full">
                        <label class="epc-label">Description</label>
                        <input type="textarea" class="epc-input" name="descP" value="<?= $phone->descP; ?>">
                    </div>
                </div>

                <button type="submit" class="epc-btn">Update</button>
            </form>
        </div>
    </div>
</div>