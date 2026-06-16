<div class="p-3 m-2h-100">
    <div class="text-center p-3 bg-light">
        <img src="<?= base_url($phone->image_url); ?>" alt="<?= $phone->phone_name; ?>" class="img-fluid"
            style="max-height: 200px; object-fit: contain;">
    </div>

    <div class="card-body">
        <h5 class="card-title mb-1 text-primary"><?= $phone->phone_name; ?></h5>
        <p class="text-muted small mb-3"><?= $phone->brand; ?></p>

        <div class="mb-3">
            <span class="h4 text-dark">RM <?= number_format($phone->current_price, 2); ?></span>
            <?php if ($phone->discount > 0): ?>
                <span class="badge bg-danger ms-2">-<?= $phone->discount; ?>%</span>
            <?php endif; ?>
        </div>

        <table class="table table-sm border-top">
            <tbody>
                <tr>
                    <td class="text-muted w-25">RAM</td>
                    <td class="fw-bold"><?= $phone->ram; ?> GB</td>
                </tr>
                <tr>
                    <td class="text-muted">Storage</td>
                    <td class="fw-bold"><?= $phone->storage; ?> GB</td>
                </tr>
                <tr>
                    <td class="text-muted">Battery</td>
                    <td class="fw-bold"><?= $phone->battery; ?> mAh</td>
                </tr>
                <tr>
                    <td class="text-muted">OS</td>
                    <td class="fw-bold small"><?= $phone->os; ?></td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">Stock: <span
                    class="<?= $phone->stock > 5 ? 'text-success' : 'text-danger'; ?>"><?= $phone->stock; ?>
                    unit</span></small>
            <span class="badge <?= $phone->is_active ? 'bg-success' : 'bg-secondary'; ?>">
                <?= $phone->is_active ? 'Available' : 'Unavailable'; ?>
            </span>
        </div>
    </div>
</div>