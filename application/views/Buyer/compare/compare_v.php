<?php
$phone_name = $this->db->query(
    "SELECT phone_name, phone_id FROM phone WHERE is_active = 1 ORDER BY phone_name ASC"
)->result();
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --card-radius: 14px;
        --border: 1px solid #e8e8e8;
        --text-muted: #888;
        --accent: #3b7bff;
        --surface: #f9f9f9;
        --bar-h: 5px;
    }

    .compare-wrap {
        font-family: 'DM Sans', sans-serif;
        padding: 3rem 1rem;
        max-width: 960px;
        margin: 0 auto;
    }

    .compare-heading {
        text-align: center;
        margin-bottom: 2rem;
    }

    .compare-heading h2 {
        font-size: 22px;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .compare-heading p {
        font-size: 14px;
        color: var(--text-muted);
    }

    .compare-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .compare-slot {
        border: var(--border);
        border-radius: var(--card-radius);
        overflow: hidden;
        background: #fff;
    }

    .slot-header {
        padding: 16px 18px 14px;
        border-bottom: var(--border);
        background: var(--surface);
    }

    .slot-label {
        font-size: 11px;
        font-weight: 500;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        color: var(--text-muted);
        margin-bottom: 10px;
    }

    .slot-select {
        width: 100%;
        font-size: 14px;
        font-family: inherit;
        padding: 9px 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fff;
        appearance: none;
        cursor: pointer;
        color: #111;
        transition: border-color 0.15s;
    }

    .slot-select:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(59, 123, 255, 0.12);
    }

    .slot-body {
        min-height: 320px;
        position: relative;
    }

    /* Empty state */
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 320px;
        gap: 10px;
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 2rem;
        opacity: 0.4;
    }

    .empty-state p {
        font-size: 13px;
    }

    /* Loading spinner */
    .loading-state {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 320px;
    }

    .spinner {
        width: 24px;
        height: 24px;
        border: 2px solid #eee;
        border-top-color: var(--accent);
        border-radius: 50%;
        animation: spin 0.7s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Phone card (rendered via AJAX) */
    .phone-card {
        padding: 18px;
        animation: fadeUp 0.25s ease;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .phone-card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 14px;
    }

    .phone-name {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 2px;
    }

    .phone-brand {
        font-size: 12px;
        color: var(--text-muted);
    }

    .price-tag {
        font-size: 13px;
        font-weight: 500;
        background: #eef3ff;
        color: var(--accent);
        padding: 4px 10px;
        border-radius: 20px;
        white-space: nowrap;
    }

    /* Spec bars */
    .spec-section-label {
        font-size: 10px;
        font-weight: 500;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        color: var(--text-muted);
        margin: 14px 0 8px;
    }

    .spec-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }

    .spec-name {
        font-size: 12px;
        color: var(--text-muted);
        width: 68px;
        flex-shrink: 0;
    }

    .spec-bar-bg {
        flex: 1;
        height: var(--bar-h);
        background: #f0f0f0;
        border-radius: 3px;
        overflow: hidden;
    }

    .spec-bar {
        height: 100%;
        border-radius: 3px;
        transition: width 0.5s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .spec-val {
        font-size: 12px;
        font-weight: 500;
        width: 56px;
        text-align: right;
        color: #333;
        flex-shrink: 0;
    }

    /* Feature tags */
    .tag-row {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin-top: 4px;
    }

    .tag {
        font-size: 11px;
        padding: 3px 9px;
        border-radius: 20px;
        background: var(--surface);
        border: 1px solid #e0e0e0;
        color: #555;
    }

    @media (max-width: 600px) {
        .compare-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="compare-wrap">
    <div class="compare-heading">
        <h2>Compare Phones</h2>
        <p>Select two devices to compare specifications side by side</p>
    </div>

    <div class="compare-grid">
        <?php foreach ([1, 2] as $slot): ?>
            <div class="compare-slot">
                <div class="slot-header">
                    <div class="slot-label"><?= $slot === 1 ? 'First device' : 'Second device' ?></div>
                    <select id="choose<?= $slot ?>" class="slot-select" data-target="#result<?= $slot ?>">
                        <option value="">— Choose a phone —</option>
                        <?php foreach ($phone_name as $row): ?>
                            <option value="<?= $row->phone_id ?>"><?= htmlspecialchars($row->phone_name) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="result<?= $slot ?>" class="slot-body">
                    <div class="empty-state">
                        <i class="bi bi-phone"></i>
                        <p>Select a phone to see specs</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(function () {

        const SPINNER = `<div class="loading-state"><div class="spinner"></div></div>`;
        const EMPTY = `<div class="empty-state"><i class="bi bi-phone"></i><p>Select a phone to see specs</p></div>`;

        function fetchPhone(phoneId, $target) {
            if (!phoneId) {
                $target.html(EMPTY);
                return;
            }

            $target.html(SPINNER);
            $target.data('loading', phoneId); // track which request is in flight

            $.ajax({
                url: "<?= base_url('compare/get_phone_compare') ?>",
                type: "POST",
                data: { id: phoneId },
                success(response) {
                    // Ignore stale responses if user switched dropdown fast
                    if ($target.data('loading') !== phoneId) return;
                    $target.html(response);
                },
                error() {
                    if ($target.data('loading') !== phoneId) return;
                    $target.html(`
                    <div class="empty-state">
                        <i class="bi bi-exclamation-circle"></i>
                        <p>Failed to load data. Please try again.</p>
                    </div>
                `);
                }
            });
        }

        $('[id^=choose]').on('change', function () {
            const $target = $($(this).data('target'));
            fetchPhone($(this).val(), $target);
        });
    });
</script>