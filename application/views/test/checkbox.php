<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <form action="<?php echo base_url() ?>Test/testCheck" method="post">
        <p>Choose options:</p>
        <input type="checkbox" name="option[]" value="1"> Option 1<br>
        <input type="checkbox" name="option[]" value="2"> Option 2<br>
        <input type="checkbox" name="option[]" value="3"> Option 3<br>
        <input type="checkbox" name="option[]" value="4"> Option 4<br>
        <input type="checkbox" name="option[]" value="5"> Option 5<br>
        <input type="checkbox" name="option[]" value="6"> Option 6<br>
        <input type="checkbox" name="option[]" value="7"> Option 7<br>
        <button type="submit">Submit</button>
    </form> -->

    <form action="<?php echo base_url('Test/testCheck'); ?>" method="post">
        <h3>Your Cart</h3>

        <?php
        // Example cart items array (normally from DB)
        $cart_items = [
            ['cart_item_id' => 101, 'phone_name' => 'iPhone 15', 'price' => 4500, 'quantity' => 1],
            ['cart_item_id' => 102, 'phone_name' => 'Samsung S23', 'price' => 3800, 'quantity' => 2],
            ['cart_item_id' => 103, 'phone_name' => 'Xiaomi 14', 'price' => 2500, 'quantity' => 1],
        ];
        ?>

        <table cellpadding="5" cellspacing="0">
            <tr>
                <th>Select</th>
                <th>Phone</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>

            <?php foreach ($cart_items as $item) { ?>
                <tr>
                    <td>
                        <input type="checkbox" name="selected_items[]" value="<?php echo $item['cart_item_id']; ?>">
                    </td>
                    <td>
                        <input type="text" name="phone_name[<?php echo $item['cart_item_id']; ?>]" value="<?php echo $item['phone_name']; ?>"></td>
                        
                    <td>RM <?php echo number_format($item['price'], 2); ?></td>
                    <td>
                        <input type="number" name="quantities[<?php echo $item['cart_item_id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1">
                    </td>
                </tr>
            <?php } ?>
        </table>

        <br>
        <button type="submit">Checkout Selected Items</button>
    </form>

</body>

</html>