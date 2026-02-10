<?php
class Cart_m extends CI_Model
{
	//adding item to cart
	public function add_item($data = array())
	{
		$this->db->trans_begin();

		// Check if the user already has a cart
		$sql = "SELECT `cart_id` FROM `cart` WHERE `user_id` = " . $this->db->escape($this->id) . " LIMIT 1";
		$cart = $this->db->query($sql)->row();

		if (!$cart) {
			// Insert new cart
			$sql_create_cart = "INSERT INTO `cart` (`user_id`, `created_at`, `updated_at`) VALUES (" . $this->db->escape($this->id) . ", NOW(), NOW())";
			$this->db->query($sql_create_cart);

			// Get the new cart_id immediately
			$cart_id = $this->db->insert_id();
		} else {
			// Cart exists
			$cart_id = $cart->cart_id;
		}

		// Get available stock for this phone
		$sql = "SELECT `stock` FROM `phone` WHERE `phone_id` = " . $this->db->escape($data['phone_id']) . " LIMIT 1";
		$query_stock = $this->db->query($sql);

		$available_stock = ($query_stock->num_rows() > 0) ? $query_stock->row()->stock : 0;

		// Check if this phone already exists in the user's cart
		$sql = "SELECT `ci`.`quantity` AS `current_quantity`, `ci`.`cart_item_id` FROM `cart_items` `ci` 
									JOIN `cart` `c` ON `c`.`cart_id` = `ci`.`cart_id` WHERE `c`.`user_id` = " . $this->db->escape($this->id) . " 
									AND `ci`.`phone_id` = " . $this->db->escape($data['phone_id']) . " 
									LIMIT 1";

		$existing_item = $this->db->query($sql)->row();


		// Add or update the item
		if ($existing_item) {
			// Item exists → update the quantity
			$new_quantity = $existing_item->current_quantity + (int) $data['quantity'];

			// Prevent exceeding stock
			if ($new_quantity > $available_stock) {
				$new_quantity = $available_stock;
			}

			// Update the quantity
			$sql = "UPDATE `cart_items` SET `quantity` = " . $new_quantity . ", `added_at` = NOW() WHERE `cart_item_id` = " . $existing_item->cart_item_id . "";
			$this->db->query($sql);

			$message = ($new_quantity == $available_stock) ? 'Item quantity updated (limited by available stock)' : 'Same Item Already Exist In Your Cart, Item Quantity Updated';

		} else {
			// Item does not exist → insert new record
			$final_quantity = ((int) $data['quantity'] > $available_stock) ? $available_stock : (int) $data['quantity'];

			// Insert new item
			$sql = "INSERT INTO `cart_items` (`cart_id`, `phone_id`, `quantity`, `added_at`) 
								VALUES (" . $cart_id . ", " . $this->db->escape($data['phone_id']) . ", " . $final_quantity . ", NOW())";
			$this->db->query($sql);

			$message = ($final_quantity < (int) $data['quantity']) ? "Only $available_stock item(s) added due to limited stock." : "Item added to your cart";
		}

		if ($this->db->trans_status() == false) {
			$this->db->trans_rollback();
			return array(
				'status' => false,
				'message' => 'Transaction Status Failed'
			);
		}

		$this->db->trans_commit();
		return array(
			'status' => TRUE,
			'message' => $message
		);
	}

	//remove cart (for order)
	public function remove_cart($cart_id = "")
	{
		// Start transaction
		$this->db->trans_start();

		// Get the phone_id and quantity before deleting
		$sql = "SELECT * FROM `cart` WHERE `cart_id` = " . $this->db->escape($cart_id) . "";
		$cart_item = $this->db->query($sql)->row();

		if ($cart_item) {
			//remove item from cart since user proceed order
			$sql = "DELETE FROM `cart` WHERE `cart_id` = " . $this->db->escape($cart_id) . "";
			$this->db->query($sql);
		}

		// Complete transaction
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	//return items from cart
	public function get_cart_items()
	{
		$sql = "
        SELECT
            `ci`.`cart_item_id`,
            `ci`.`phone_id`,
            `ci`.`quantity`,
            `ci`.`added_at`,
			`p`.`discount`,
            `p`.`phone_name`,
            `p`.`current_price`,
            `p`.`image_url`,
            `p`.`stock`,
			`p`.`is_active`,
            (`ci`.`quantity` * `p`.`current_price`) AS `subtotal`
        FROM `cart_items` `ci`
        JOIN `cart` `c` ON `c`.`cart_id` = `ci`.`cart_id`
        JOIN `phone` `p` ON `p`.`phone_id` = `ci`.`phone_id`
        WHERE `c`.`user_id` = " . $this->db->escape($this->id) . "
        ORDER BY `p`.`is_active` DESC, `ci`.`added_at` DESC";

		return $this->db->query($sql)->result();
	}

	//remove item from cart -- user click remove
	public function remove_cart_item($cart_item_id = "")
	{
		$sql = "SELECT `ci`.`cart_item_id` 
				FROM `cart_items` `ci` 
				JOIN `cart` `c` ON `c`.`cart_id` = `ci`.`cart_id` 
				WHERE `ci`.`cart_item_id` = " . $this->db->escape($cart_item_id) . " 
				AND `c`.`user_id` = " . $this->db->escape($this->id) . " 
				LIMIT 1";

		$item = $this->db->query($sql)->row();

		if (!$item) {
			return array('success' => false, 'message' => 'Item not found or does not belong to your cart.');
		}

		$this->db->trans_begin();

		$sql = "DELETE FROM `cart_items` WHERE `cart_item_id` = " . $this->db->escape($cart_item_id) . "";
		$this->db->query($sql);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return array('success' => false, 'message' => 'Failed to remove item from cart.');
		}

		$this->db->trans_commit();
		return array(
			'success' => true,
			'message' => 'Item removed successfully.'
		);
	}

	//update item from cart (quantity)
	public function update_cart_items($upd = array())
	{
		if (empty($upd)) {
			redirect('Cart');
		}

		$fail = array();
		$succ = array();

		$this->db->trans_begin();

		//get cart item id from the selected item in cart... only selected will be updated..
		//if user add quantity but did not select them when click update
		//the item will not be updated

		foreach ($upd['selected_items'] as $ci_id) {
			$sql = "SELECT `stock`, `phone_name` FROM `phone` WHERE `phone_id` IN 
					( SELECT `phone_id` FROM `cart_items` WHERE `cart_item_id` = " . $this->db->escape($ci_id) . ")";
			$query = $this->db->query($sql)->row();
			$curStock = $query->stock;
			$name = $query->phone_name;

			//skip item that are bigger than current stock (will be auto updated to current stock)
			//already put auto update in constructor

			if ($upd['quantities'][$ci_id] > $curStock) {
				$fail[] = $name;
				continue;
			}

			$sql = "UPDATE `cart_items` SET `quantity` = " . $this->db->escape($upd['quantities'][$ci_id]) . " WHERE `cart_item_id` = " . $this->db->escape($ci_id) . "";
			$this->db->query($sql);
			if ($this->db->affected_rows() > 0) {
				$succ[] = $name;
			}
		}

		if ($this->db->trans_status() == false) {
			$this->db->trans_rollback();

			return array(
				'failed' => 'Transaction Status Failed All Items Failed To Update, Try Again',
				'success' => ''
			);
		}

		$this->db->trans_commit();
		return array(
			'failed' => !empty($fail) ? "This Item [ " . implode(", ", $fail) . " ] New Quantity Surpass Current Available Stock" : '',
			'success' => !empty($succ) ? "This Item [ " . implode(", ", $succ) . " ] New Quantity Updated Successfully" : ''
		);
	}

	//retrieve items selecetd from cart to be display in checkout page
	public function get_checkout_data($selected_items = array())
	{
		if (empty($selected_items)) {
			return array(
				'status' => false,
				'message' => 'No items selected'
			);
		}

		$this->db->trans_begin();

		// Get cart items - FIXED: Added link_gambar field
		$sql = "SELECT
                `ci`.`cart_item_id`,
                `ci`.`phone_id`,
                `ci`.`quantity`,
                `ci`.`added_at`,
                `p`.`phone_name`,
				`p`.`discount`,
                `p`.`current_price`,  -- Changed from current_price
                `p`.`stock`,
                `p`.`image_url`,
                (`ci`.`quantity` * `p`.`current_price`) AS `subtotal`
            FROM `cart_items` `ci`
            JOIN `cart` `c` ON `c`.`cart_id` = `ci`.`cart_id`
            JOIN `phone` `p` ON `ci`.`phone_id` = `p`.`phone_id`
            WHERE `c`.`user_id` = " . $this->db->escape($this->id) . "
            AND `ci`.`cart_item_id` IN (" . implode(',', array_map('intval', $selected_items)) . ")
            AND `p`.`stock` >= `ci`.`quantity`
            ORDER BY `ci`.`added_at` DESC";

		$cart_items = $this->db->query($sql)->result();

		if (empty($cart_items)) {
			return array(
				'status' => false,
				'message' => 'No valid items found for checkout'
			);
		}

		// Calculate totals
		$total = 0;
		foreach ($cart_items as $item) {
			$total += $item->subtotal;
		}

		// Get user details
		$sql_user = "
                SELECT
                    `u`.`user_id`,
                    `u`.`username`,
                    `u`.`email`,
                    `a`.`address`
                FROM `user` `u`
                LEFT JOIN `user_address` `a`
                    ON `u`.`user_id` = `a`.`user_id`
                    AND `a`.`is_default` = 1
                WHERE `u`.`user_id` = " . $this->db->escape($this->id) . "
                LIMIT 1
            ";

		if ($this->db->trans_status() == false) {
			$this->db->trans_rollback();

			return array(
				'status' => false,
				'message' => 'Transaction status failed'
			);
		}

		$this->db->trans_commit();
		return array(
			'status' => true,
			'cart_items' => $cart_items,
			'user_details' => $this->db->query($sql_user)->row(),
			'total' => $total,
		);
	}

	//make sure that cart always up to date before continue to proceed to order
	//prevent wrong quantity or quantity > stock level
	public function refresh_cart()
	{
		if (!isset($this->id)) {
			return 0;
		}

		$updated = FALSE;

		$sql = "SELECT `cart_id` FROM `cart` WHERE `user_id` = " . $this->db->escape($this->id) . "";
		$cart_id = $this->db->query($sql)->row()->cart_id;

		$sql = "SELECT `phone_id`, `quantity` FROM `cart_items` WHERE `cart_id` = " . $this->db->escape($cart_id) . "";
		$phone_data = $this->db->query($sql)->result_array();

		foreach ($phone_data as $pd) {
			$sql = "SELECT `stock` FROM `phone` WHERE `phone_id` = '" . $pd['phone_id'] . "'";
			$stock = $this->db->query($sql)->row()->stock;

			if ($stock < $pd['quantity']) {
				$sql = "UPDATE `cart_items` SET `quantity` = " . $stock . " WHERE `cart_id` = '" . $cart_id . "' AND `phone_id` = '" . $pd['phone_id'] . "'";
				$this->db->query($sql);

				if ($this->db->affected_rows() > 0) {
					$updated = TRUE;
				}
			}
		}

		if ($updated) {
			$this->session->set_flashdata('message', 'Some Of The Item In Cart Have Been Updated');
		}
	}

	//number of items in the user's cart
	function cart_count()
	{
		$sql = "SELECT SUM(cart_items.quantity) as cart_count FROM cart_items JOIN cart on cart.cart_id = cart_items.cart_id WHERE cart.user_id = " . $this->db->escape($this->id) . "";
		return $this->db->query($sql)->row()->cart_count;
	}


	//set phone status to 0 when the items already out of stock
	// is_active = 0, means that phone will not be displayed to consumer
	function active_status()
	{
		if (empty($this->id)) {
			return false;
		}

		$this->db->trans_begin();

		$sql = "SELECT `phone`.`is_active`, `phone`.`stock`, `phone`.`phone_id` FROM `cart_items`
					JOIN `cart` ON `cart`.`cart_id` = `cart_items`.`cart_id`
					JOIN `phone` ON `phone`.`phone_id` = `cart_items`.`phone_id`
					WHERE `cart`.`user_id` = $this->id";

		$result = $this->db->query($sql)->result();

		foreach ($result as $item) {
			if ($item->stock == 0 && $item->is_active == 1) {
				$sql = "UPDATE `phone` SET `is_active` = 0 WHERE `phone_id` = $item->phone_id";
				$this->db->query($sql);
			}
		}

		if ($this->db->trans_status() == false) {
			$this->db->trans_rollback();
			return false;
		}

		$this->db->trans_commit();
		return true;
	}
}