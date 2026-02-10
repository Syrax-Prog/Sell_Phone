<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_m extends CI_Model
{
	var $status = array('Order Placed', 'Shipped', 'Completed');

	//get all orders based on user
	public function get_user_orders($user_id = "")
	{
		// get order details using user id parsed by session, display in view->buyer->order_view
		$sql_getDetails = "
							SELECT *
							FROM `orders` 
							WHERE `user_id` = " . $this->db->escape($user_id) . "
							ORDER BY FIELD(`status`, '" . implode("','", $this->status) . "'), `order_date` DESC
						";

		$query = $this->db->query($sql_getDetails);
		return $query->result();
	}

	public function get_cancel_order($user_id = "")
	{
		$sql = "SELECT *
            FROM `orders` 
            LEFT JOIN `order_item` ON `orders`.`order_id` = `order_item`.`order_id`
            LEFT JOIN `phone` ON `phone`.`phone_id` = `order_item`.`phone_id`
            WHERE `orders`.`user_id` = " . $this->db->escape($user_id) . " 
            AND `order_item`.`is_cancelled` = 1
			ORDER BY `orders`.`order_date` DESC";

		return $this->db->query($sql)->result();
	}

	public function total_cancel($user_id = "")
	{
		$sql = "SELECT COUNT(*) AS `total_cancel` FROM `order_item`
		JOIN `orders` ON `orders`.`order_id` = `order_item`.`order_id`
		JOIN `user` ON `user`.`user_id` = `orders`.`user_id`
		WHERE `order_item`.`is_cancelled` = 1 AND `orders`.`user_id` = $user_id";

		return $this->db->query($sql)->row()->total_cancel;
	}

	public function get_order_items($order_ids = array())
	{
		if (empty($order_ids)) {
			return array();
		}

		$sql = "SELECT `order_item`.*, `phone`.*, `orders`.*
					FROM `order_item` 
					JOIN `phone` ON `order_item`.`phone_id` = `phone`.`phone_id`
					JOIN `orders` ON `orders`.`order_id` = `order_item`.`order_id`
					WHERE `order_item`.`order_id` IN (" . implode(",", $order_ids) . ")
					ORDER BY `order_item`.`order_id` DESC";

		return $this->db->query($sql)->result();
	}

	//change status to cancelled instead of permanently delete from databse
	public function cancel_order($order_id = "")
	{
		$this->db->trans_begin();

		$sql_cancel_order = "UPDATE `orders` SET `status` = 'Cancelled' WHERE `order_id` = " . $this->db->escape($order_id) . "";
		$this->db->query($sql_cancel_order);

		$sql_set_cancel = "UPDATE `order_item` SET `is_cancelled` = 1, `cancelled_by` = 'User' WHERE `order_id` = " . $this->db->escape($order_id) . "";
		$this->db->query($sql_set_cancel);

		$sql_update_stock = "UPDATE `phone` JOIN `order_item` ON `phone`.`phone_id` = `order_item`.`phone_id`
							SET `phone`.`stock` = `phone`.`stock` + `order_item`.`quantity`
							WHERE `order_item`.`order_id` = " . $this->db->escape($order_id) . "";
		$this->db->query($sql_update_stock);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		}

		$this->db->trans_commit();
		return true;
	}

	public function remove_items($phone_id = "", $order_item_id = "")
	{
		$this->db->trans_begin();

		// 1. Get order_id
		$sql = "SELECT `order_id` FROM `order_item` WHERE `order_item_id` = " . $this->db->escape($order_item_id) . "";
		$row = $this->db->query($sql)->row();

		if (!$row) {
			$this->db->trans_complete();
			return false;
		}

		// 2. Mark item as cancelled
		$sql = "UPDATE `order_item` 
            SET `is_cancelled` = 1, `cancelled_by` = 'User'
            WHERE `phone_id` = " . $this->db->escape($phone_id) . " 
            AND `order_item_id` = " . $this->db->escape($order_item_id) . "";
		$this->db->query($sql);

		// 3. Count active and cancelled items
		$sql = "SELECT 
                SUM(CASE WHEN `is_cancelled` = 0 THEN 1 ELSE 0 END) AS `active_items`,
                SUM(CASE WHEN `is_cancelled` = 1 THEN 1 ELSE 0 END) AS `cancelled_items`
            FROM `order_item`
            WHERE `order_id` = " . $this->db->escape($row->order_id) . "";
		$counts = $this->db->query($sql)->row();

		// 4. If all items are cancelled → update order status to "Cancelled"
		if ($counts->active_items == 0 && $counts->cancelled_items > 0) {
			$sql = "UPDATE `orders` 
                		SET `status` = 'Cancelled'
                		WHERE `order_id` = " . $this->db->escape($row->order_id) . "";
			$this->db->query($sql);
		} else {
			// Otherwise, recalc total only from active items
			$sql = "UPDATE `orders`
                	SET `total_price` = (
                    	SELECT COALESCE(SUM(`price_at_order` * `quantity`), 0)
                    	FROM `order_item`
                    	WHERE `order_id` = " . $this->db->escape($row->order_id) . " 
                    	AND `is_cancelled` = 0
                	)
                	WHERE `order_id` = " . $this->db->escape($row->order_id) . "";
			$this->db->query($sql);
		}

		$sql_return_stock = "UPDATE `phone` 
    							JOIN `order_item` ON `phone`.`phone_id` = `order_item`.`phone_id` 
    							SET `phone`.`stock` = `phone`.`stock` + `order_item`.`quantity` 
    							WHERE `order_item`.`phone_id` = " . $this->db->escape($phone_id) . " 
      							AND `order_item`.`order_item_id` = " . $this->db->escape($order_item_id) . "";

		$this->db->query($sql_return_stock);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}


	// get total order based on total item in order (not quantity)
	public function get_total_order($user_id = "")
	{
		$this->db->trans_start();

		$sql_totalOrders = "SELECT `order_item`.`order_id`, COUNT(`order_item`.`order_id`) AS `total_items`
								FROM `orders` JOIN `order_item` ON `orders`.`order_id` = `order_item`.`order_id`
								WHERE `orders`.`user_id` = " . $this->db->escape($user_id) . "
								GROUP BY `order_item`.`order_id`";

		$total_orders = $this->db->query($sql_totalOrders);

		if ($this->db->trans_status() == false) {
			$this->db->trans_rollback();
			return false;
		}

		$this->db->trans_commit();
		return true;
	}


	//proceed to order
	public function create_order($data = array())
	{
		//selected items are setted to session to prevent redirect back to cart
		//should stay on checkout if the user update anything in checkout

		$this->session->unset_userdata('selected_items');

		$grand_total = 0;
		foreach ($data['cart_ids'] as $cart_id) {
			$price = isset($data['prices'][$cart_id]) ? $data['prices'][$cart_id] : 0;
			$quantity = isset($data['quantities'][$cart_id]) ? $data['quantities'][$cart_id] : 1;
			$grand_total += $price * $quantity;
		}

		// Start database transaction (so if any query fails, everything rolls back)
		$this->db->trans_begin();

		// Insert into orders
		$sql_order = "INSERT INTO `orders` (`user_id`, `total_price`, `status`, `address_at_order`, `order_date`, `created_at`, `updated_at`)
                  VALUES (" . $this->db->escape($this->id) . ", " . (float) $grand_total . ", 'Order Placed', " . $this->db->escape($data['address_id']) . ", NOW(), NOW(), NOW())";
		$this->db->query($sql_order);
		$order_id = $this->db->insert_id();

		//Insert each order item
		foreach ($data['cart_ids'] as $i => $cart_id) {
			$phone_id = $data['phone_ids'][$i];
			$quantity = isset($data['quantities'][$cart_id]) ? $data['quantities'][$cart_id] : 1;
			$price = isset($data['prices'][$cart_id]) ? $data['prices'][$cart_id] : 0;
			$subtotal = $price * $quantity;

			// Get phone name (snapshot it at order time)
			$sql_phone = "SELECT `phone_name`, `storage`, `ram`, `battery`, `os` FROM `phone` WHERE `phone_id` = " . $this->db->escape($phone_id) . "";
			$query_phone = $this->db->query($sql_phone);

			if ($query_phone->num_rows() > 0) {
				$phone_name = $query_phone->row()->phone_name;
				$storage = $query_phone->row()->storage;
				$ram = $query_phone->row()->ram;
				$battery = $query_phone->row()->battery;
				$os = $query_phone->row()->os;

			} else {
				$phone_name = 'Unknown';
				$storage = 'Unknown';
				$ram = 'Unknown';
				$battery = 'Unknown';
				$os = 'Unknown';
			}

			$params = array(
				$this->db->escape($order_id),
				$this->db->escape($phone_id),
				$this->db->escape($phone_name),
				$this->db->escape($price),
				$this->db->escape($storage),
				$this->db->escape($ram),
				$this->db->escape($battery),
				$this->db->escape($os),
				$this->db->escape($quantity),
				$this->db->escape($subtotal)
			);


			$sql_item = "INSERT INTO `order_item` (`order_id`, `phone_id`, `phone_name_at_order`, `price_at_order`, `storage_at_order`, `ram_at_order`, `battery_at_order`, `os_at_order`, `quantity`, `subtotal`)
                     VALUES (" . implode(",", $params) . ")";
			$this->db->query($sql_item);

			$sql = "UPDATE `phone` SET `stock` = `stock` - " . $this->db->escape($quantity) . " WHERE `phone_id` = " . $this->db->escape($phone_id) . "";
			$this->db->query($sql);

			$sql = "DELETE FROM `cart_items` WHERE `cart_item_id` = " . $this->db->escape($cart_id) . "";
			$this->db->query($sql);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();

			return array(
				'status' => false,
				'message' => 'Failed to create order. Please try again.'
			);
		}

		$this->db->trans_commit();
		return array(
			'status' => true,
			'message' => 'Order created successfully!',
			'order_id' => $order_id
		);
	}

	//prevent repetition to get value
	private function get_single_value($sql = "", $isFloat = TRUE)
	{
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$row = $query->row();
			$value = reset($row);

			if (isset($value)) {
				if ($isFloat) {
					return (float) $value;
				} else {
					return (int) $value;
				}
			} else {
				if ($isFloat) {
					return 0.0;
				} else {
					return 0;
				}
			}
		} else {
			if ($isFloat) {
				return 0.0;
			} else {
				return 0;
			}
		}
	}

	// ---------------------------------------------------------
	// 📊 REVENUE
	// ---------------------------------------------------------

	public function getRevenue($brand = "", $date = null) //slug = filter data
	{
		//user filter by brand
		$plusSQL = "";
		if (!empty($brand)) {
			$brand = $this->db->escape($brand);
			$plusSQL = " AND `phone`.`brand` = $brand";
		}

		//user filter by date
		if (!empty($date)) {
			$date = $this->db->escape($date);
			$date = " AND DATE(`orders`.`order_date`) >= $date";

		} else {
			$date = " AND MONTH(`orders`.`order_date`) = MONTH(CURRENT_DATE())
		              AND YEAR(`orders`.`order_date`) = YEAR(CURRENT_DATE())";
		}

		$sql = "
			SELECT SUM(`order_item`.`price_at_order` * `order_item`.`quantity`) AS `total_revenue`
			FROM `orders`
			JOIN `order_item` ON `orders`.`order_id` = `order_item`.`order_id`
			JOIN `phone` ON `phone`.`phone_id` = `order_item`.`phone_id`
			WHERE `order_item`.`is_cancelled` = 0 AND `orders`.`status` = 'Completed'
			AND `orders`.`status` = 'Completed'
			$plusSQL $date ";

		// } else {
		// 	$sql = "
		// 	SELECT SUM(`order_item`.`price_at_order` * `order_item`.`quantity`) AS `total_revenue`
		// 	FROM `orders`
		// 	JOIN `order_item` ON `orders`.`order_id` = `order_item`.`order_id`
		// 	JOIN `phone` ON `phone`.`phone_id` = `order_item`.`phone_id`
		// 	WHERE MONTH(`orders`.`order_date`) = MONTH(CURRENT_DATE())
		// 	AND YEAR(`orders`.`order_date`) = YEAR(CURRENT_DATE())
		// 	AND `orders`.`status` = 'Completed'
		// 	$plusSQL
		// ";
		// }

		return $this->get_single_value($sql, TRUE);
	}

	//seller dashboard revenue change
	public function getRevenueChange($brand = "")
	{
		$plusSQL = "";
		if (!empty($brand)) {
			$brand = $this->db->escape($brand);
			$plusSQL = " AND `phone`.`brand` = $brand";
		}

		$sql = "
			SELECT SUM(`order_item`.`price_at_order` * `order_item`.`quantity`) AS `total_revenue`
			FROM `orders`
			JOIN `order_item` ON `orders`.`order_id` = `order_item`.`order_id`
			JOIN `phone` ON `phone`.`phone_id` = `order_item`.`phone_id`
			WHERE MONTH(`orders`.`order_date`) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
			AND YEAR(`orders`.`order_date`) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)
			AND `orders`.`status` = 'Completed'
			$plusSQL
		";

		return $this->get_single_value($sql, TRUE);
	}

	// ---------------------------------------------------------
	// 📦 TOTAL ORDERS
	// ---------------------------------------------------------

	public function get_total_order_all()
	{
		$sql = "
			SELECT COUNT(*) AS `total_order`
			FROM `orders`
			WHERE MONTH(`order_date`) = MONTH(CURRENT_DATE())
			AND YEAR(`order_date`) = YEAR(CURRENT_DATE())
			AND `status` = 'Completed'
		";

		return $this->get_single_value($sql, FALSE);
	}

	public function get_total_order_prev()
	{
		$sql = "
			SELECT COUNT(*) AS `total_order`
			FROM `orders`
			WHERE MONTH(`order_date`) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
			AND YEAR(`order_date`) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)
			AND `status` = 'Completed'
		";

		return $this->get_single_value($sql, FALSE);
	}

	// ---------------------------------------------------------
	// 📱 SOLD ITEMS
	// ---------------------------------------------------------

	public function get_curr_sold()
	{
		$sql = "
			SELECT SUM(`order_item`.`quantity`) AS `total_sold`
			FROM `orders`
			JOIN `order_item` ON `orders`.`order_id` = `order_item`.`order_id`
			WHERE MONTH(`orders`.`order_date`) = MONTH(CURRENT_DATE())
			AND YEAR(`orders`.`order_date`) = YEAR(CURRENT_DATE())
			AND `orders`.`status` = 'Completed'
		";

		return $this->get_single_value($sql, FALSE);
	}

	public function get_prev_sold()
	{
		$sql = "
			SELECT SUM(`order_item`.`quantity`) AS `total_sold`
			FROM `orders`
			JOIN `order_item` ON `orders`.`order_id` = `order_item`.`order_id`
			WHERE MONTH(`orders`.`order_date`) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
			AND YEAR(`orders`.`order_date`) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)
			AND `orders`.`status` = 'Completed'
		";

		return $this->get_single_value($sql, FALSE);
	}

	// ---------------------------------------------------------
	// 👥 NEW CUSTOMERS
	// ---------------------------------------------------------

	public function get_new_customer()
	{
		$sql = "
			SELECT COUNT(*) AS `total_new_customers`
			FROM (
				SELECT `user_id`, MIN(`order_date`) AS `first_order_date`
				FROM `orders`
				GROUP BY `user_id`
				HAVING 
					MONTH(`first_order_date`) = MONTH(CURRENT_DATE())
					AND YEAR(`first_order_date`) = YEAR(CURRENT_DATE())
			) AS `first_orders`
		";

		return $this->get_single_value($sql, FALSE);
	}

	public function get_prev_new_customer()
	{
		$sql = "
			SELECT COUNT(*) AS `total_new_customers`
			FROM (
				SELECT `user_id`, MIN(`order_date`) AS `first_order_date`
				FROM `orders`
				GROUP BY `user_id`
				HAVING 
					MONTH(`first_order_date`) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
					AND YEAR(`first_order_date`) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)
			) AS `first_orders`
		";

		return $this->get_single_value($sql, FALSE);
	}

	public function get_recent_order()
	{
		$sql = "SELECT `order_item`.*, `orders`.`status`, `user`.`username`, `phone`.`phone_name`
				FROM `orders` JOIN `order_item` ON `orders`.`order_id` = `order_item`.`order_id`
				JOIN `user` on `user`.`user_id` = `orders`.`user_id`
				JOIN `phone` ON `phone`.`phone_id` = `order_item`.`phone_id`
				WHERE `orders`.`status` != 'Cancelled' AND `orders`.`status` != 'Completed' AND `orders`.`status` != 'Shipped'
 				AND `order_item`.`is_cancelled` = 0
				ORDER BY FIELD(`status`, '" . implode("','", $this->status) . "'), `orders`.`order_date` DESC";
		$query = $this->db->query($sql);

		return $query->result();
	}

	//low stock are below 10
	public function get_low_stock()
	{
		$sql = "SELECT `phone_id`, `phone_name`, `stock` FROM `phone` WHERE `stock` <= 10";
		$query = $this->db->query($sql);

		return $query->result();
	}

	public function get_all_orders($status = 'Order Placed', $search = '', $id = '')
	{
		if ($id != '') {
			$id = " AND `orders`.`user_id` = $id";
		}
		// Escape and trim status
		$status = $this->db->escape(trim($status));

		// Base SQL
		$sql = "SELECT `orders`.*, `user`.*
            FROM `orders`
            LEFT JOIN `user` ON `user`.`user_id` = `orders`.`user_id`
            WHERE orders.status = $status $id";

		// Add search if provided
		if (!empty($search)) {
			$search = $this->db->escape_like_str(trim($search));
			$sql .= " AND (`user`.`username` LIKE '%$search%' OR `user`.`email` LIKE '%$search%')";
		}

		// Add ordering
		$sql .= " ORDER BY FIELD(`status`, '" . implode("','", $this->status) . "', 'Cancelled'), `order_date` DESC";

		$query = $this->db->query($sql);
		return $query->result();
	}


	public function get_all_order_item()
	{
		$sql = "SELECT `order_item`.*, `phone`.*, `orders`.`order_date` FROM `order_item`
					LEFT JOIN `phone` ON `order_item`.`phone_id` = `phone`.`phone_id`
					LEFT JOIN `orders` ON `orders`.`order_id` = `order_item`.`order_id`
					ORDER BY `orders`.`order_date` DESC";
		$query = $this->db->query($sql);

		return $query->result();
	}

	public function update_status($order_id = "", $status = "")
	{
		$sql = "UPDATE `orders` SET `status` = " . $this->db->escape($status) . " WHERE order_id = " . $this->db->escape($order_id) . "";
		$this->db->query($sql);

		//if just use num_rows() .... cannot detect if the update actually error or not
		//error()['code'] ..... 0 means no error
		if ($this->db->error()['code'] != 0) {
			return FALSE;
		}

		return "$order_id || $status"; // number of rows updated
	}

	public function get_status($order_id = "", $new_status = "")
	{
		// Get the current status from the database
		$sql = "SELECT `status` FROM `orders` WHERE `order_id` = " . $this->db->escape($order_id) . "";
		$query = $this->db->query($sql);

		if ($query->num_rows() == 0) {
			return array('error' => 'Order not found');
		}

		$current_status = $query->row()->status;

		// Define allowed progression order
		$order_sequence = array(
			'Order Placed' => 1,
			'Shipped' => 2,
			'Completed' => 3,
			'Cancelled' => 4
		);

		// check if both statuses exist in the sequence
		if (!isset($order_sequence[$current_status]) || !isset($order_sequence[$new_status])) {
			return array('error' => 'Invalid status');
		}

		// Compare status levels (NOT ALLOWED BACKWARDS)
		if ($order_sequence[$new_status] < $order_sequence[$current_status]) {
			// Reverse detected
			return array(
				'allowed' => false,
				'message' => "Cannot revert from '$current_status' to '$new_status'"
			);
		}

		// Allowed transition
		return array(
			'allowed' => true,
			'current' => $current_status,
			'new' => $new_status
		);
	}

	public function get_this_month_daily_sales($brand = "", $date = null)
	{

		if (!empty($brand)) {
			$brand = $this->db->escape($brand);
			$brand = " AND `phone`.`brand` = $brand";
		} else {
			$brand = "";
		}

		if (!empty($date)) {
			$date = $this->db->escape($date);
			$date = " AND DATE(`orders`.`order_date`) >= $date";
		} else {
			$date = "	AND YEAR(`orders`.`order_date`) = YEAR(CURDATE())
  						AND MONTH(`orders`.`order_date`) = MONTH(CURDATE())";
		}

		$sql = "SELECT DATE(`orders`.`order_date`) AS `day`, SUM(`orders`.`total_price`) AS `total_sales`
					FROM `orders`
					LEFT JOIN `order_item` ON `order_item`.`order_id` = `orders`.`order_id`
					LEFT JOIN `phone` ON `phone`.`phone_id` = `order_item`.`phone_id`
					WHERE `status` = 'Completed' AND `order_item`.`is_cancelled` = '0'
					$brand 
					$date
					GROUP BY `day`
					ORDER BY `day` ASC";

		// } else {
		// 	$sql = "SELECT DATE(`orders`.`order_date`) AS `day`, SUM(`orders`.`total_price`) AS `total_sales`
		// 			FROM `orders`
		// 			LEFT JOIN `order_item` ON `order_item`.`order_id` = `orders`.`order_id`
		// 			LEFT JOIN `phone` ON `phone`.`phone_id` = `order_item`.`phone_id`
		// 			WHERE `status` = 'Completed' 
		// 			$brand
		// 			AND YEAR(`order_date`) = YEAR(CURDATE())
		// 			AND MONTH(`order_date`) = MONTH(CURDATE())
		// 			GROUP BY `day`
		// 			ORDER BY `day` ASC";
		// }

		$result = $this->db->query($sql)->result();

		$days = array();
		$totals = array();

		if (!empty($result)) {
			foreach ($result as $row) {
				$days[] = $row->day; // e.g., '2025-11-10'
				$totals[] = (float) $row->total_sales;
			}
		}

		return array('days' => $days, 'totals' => $totals);
	}

	public function get_this_month_top_product($brand = "", $date = null)
	{

		if (!empty($brand)) {
			$brand = $this->db->escape($brand);
			$brand = " AND `phone`.`brand` = $brand";
		}

		if (!empty($date)) {
			$date = $this->db->escape($date);
			$date = " AND DATE(`orders`.`order_date`) >= $date";
		} else {
			$date = " 	AND YEAR(`orders`.`order_date`) = YEAR(CURDATE())
						AND MONTH(`orders`.`order_date`) = MONTH(CURDATE())";
		}

		$sql = "SELECT 
						`phone`.`phone_name` AS `product`,
						COALESCE(SUM(CASE WHEN `orders`.`status` = 'Completed' THEN `order_item`.`quantity` END), 0) AS `total_sold`
					FROM `phone`
					LEFT JOIN `order_item` ON `phone`.`phone_id` = `order_item`.`phone_id`
					LEFT JOIN `orders` 
						ON `orders`.`order_id` = `order_item`.`order_id`
						WHERE `order_item`.`is_cancelled` = 0
					$brand $date
					GROUP BY `phone`.`phone_name`
					ORDER BY `total_sold` DESC
					LIMIT 3";

		// } else {
		// 	$sql = "SELECT 
		// 				`phone`.`phone_name` AS `product`,
		// 				COALESCE(SUM(CASE WHEN `orders`.`status` = 'Completed' THEN `order_item`.`quantity` END), 0) AS `total_sold`
		// 			FROM `phone`
		// 			LEFT JOIN `order_item` ON `phone`.`phone_id` = `order_item`.`phone_id`
		// 			LEFT JOIN `orders` 
		// 				ON `orders`.`order_id` = `order_item`.`order_id`
		// 				AND YEAR(`orders`.`order_date`) = YEAR(CURDATE())
		// 				AND MONTH(`orders`.`order_date`) = MONTH(CURDATE())
		// 				AND `order_item`.`is_cancelled` = 0
		// 			$brand
		// 			GROUP BY `phone`.`phone_name`
		// 			ORDER BY `total_sold` DESC
		// 			LIMIT 3";
		// }

		$result = $this->db->query($sql)->result();
		$product = array();
		$total_sold = array();

		if (!empty($result)) {
			foreach ($result as $row) {
				$product[] = $row->product;
				$total_sold[] = (float) $row->total_sold;
			}
		}

		return array('products' => $product, 'sold' => $total_sold);
	}

	//test xbuat large query terus.. pakai if
	public function get_order_summary($brand = "", $date = null)
	{
		// 1. Simple query
		$sql = "SELECT orders.status, COUNT(*) AS count_status
				FROM orders
				JOIN order_item ON order_item.order_id = orders.order_id
				JOIN phone ON phone.phone_id = order_item.phone_id
				WHERE orders.status != 'Cancelled'
          		AND order_item.is_cancelled = 0";

		// brand filter
		$sql .= !empty($brand) ?
			" AND phone.brand = " . $this->db->escape($brand) . "" :
			"";

		// date filter
		$sql .= !empty($date) ?
			" AND orders.order_date >= " . $this->db->escape($date) . "" :
			" AND YEAR(orders.order_date) = YEAR(CURDATE()) AND MONTH(orders.order_date) = MONTH(CURDATE())";
		$sql .= " GROUP BY orders.status";

		// Run SQL
		$result = $this->db->query($sql)->result();

		// 3. Fill counts
		$counts = array_fill_keys($this->status, 0);
		foreach ($result as $row) {
			if (isset($counts[$row->status])) {
				$counts[$row->status] = $row->count_status;
			}
		}

		// 4. Percentages
		$total = array_sum($counts);
		$percentages = [];

		foreach ($counts as $value) {
			$percentages[] = $total > 0 ? round(($value / $total) * 100, 1) : 0;
		}

		return [
			'status' => $this->status,
			'percentage' => $percentages,
			'count_status' => array_values($counts)
		];
	}


	public function get_this_month_top_brand($brand = "", $date = null)
	{
		$sql = "SELECT `phone`.`brand`, 
						SUM(`order_item`.`quantity`) AS `total_sold`
					FROM `phone`
					JOIN `order_item` ON `phone`.`phone_id` = `order_item`.`phone_id`
					JOIN `orders` ON `orders`.`order_id` = `order_item`.`order_id`
					WHERE `orders`.`status` = 'Completed'
					AND `order_item`.`is_cancelled` = 0";

		if (!empty($brand)) {
			$brand = $this->db->escape($brand);
			$sql .= " AND `phone`.`brand` = $brand";
		}

		if (!empty($date)) {
			$date = $this->db->escape($date);
			$sql .= " AND `orders`.`order_date` >= $date";
			
		} else {
			$sql .= " 	AND YEAR(`orders`.`order_date`) = YEAR(CURDATE())
						AND MONTH(`orders`.`order_date`) = MONTH(CURDATE())";
		}

		$sql .= " 	GROUP BY `phone`.`brand`
					ORDER BY `total_sold` DESC
					LIMIT 3";

		// } else {
		// 	$sql = "SELECT `phone`.`brand`, 
		// 				SUM(`order_item`.`quantity`) AS `total_sold`
		// 			FROM `phone`
		// 			JOIN `order_item` ON `phone`.`phone_id` = `order_item`.`phone_id`
		// 			JOIN `orders` ON `orders`.`order_id` = `order_item`.`order_id`
		// 			WHERE `orders`.`status` = 'Completed'
		// 			AND `order_item`.`is_cancelled` = 0
		// 			$brand
		// 			AND YEAR(`orders`.`order_date`) = YEAR(CURDATE())
		// 			AND MONTH(`orders`.`order_date`) = MONTH(CURDATE())
		// 			GROUP BY `phone`.`brand`
		// 			ORDER BY `total_sold` DESC
		// 			LIMIT 3";
		// }

		$result = $this->db->query($sql)->result();
		$brand = array();
		$brand_sold = array();

		if (!empty($result)) {
			foreach ($result as $row) {
				$brand[] = $row->brand;
				$brand_sold[] = (float) $row->total_sold;
			}
		}

		return array('brands' => $brand, 'Bsold' => $brand_sold);
	}
}