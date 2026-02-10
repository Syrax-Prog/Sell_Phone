<?php if (isset($getRecentOrder)) { ?>
    <table class="orders-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Phone Name</th>
                <th>Total price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($getRecentOrder as $order) {
                if ($i >= 7) {
                    break;
                }
                ?>
                <tr>
                    <td># <?php echo $order->order_id; ?></td>
                    <td><?php echo $order->username; ?></td>
                    <td><?php echo $order->phone_name_at_order; ?></td>
                    <td>RM <?php echo number_format(($order->price_at_order * $order->quantity), 2); ?></td>
                    <td><span class="status-badge completed"><?php echo $order->status; ?></span></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } else { ?>
    <div class="card border-0 shadow-sm my-4">
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
            <h5 class="mt-3 text-muted mb-0">No items to display</h5>
        </div>
    </div>
<?php } ?>