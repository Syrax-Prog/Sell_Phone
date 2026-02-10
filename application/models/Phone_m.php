<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Phone_m extends CI_Model
{
	//low stock only != > 10
	public function lowOut()
	{
		$sql = "SELECT `phone_name`, `stock`,
						CASE 
							WHEN `stock` = 0 THEN 'Out of Stock'
							WHEN `stock` <= 10 THEN 'Low Stock'
							ELSE 'In Stock'
						END AS `stock_status`
					FROM `phone`
					WHERE `stock` >= 0 AND `stock` <= 10;
					";

		return $this->db->query($sql)->result();
	}

	public function stress_argh($search = '')
	{
		if ($search != '') {
			$search = $this->db->escape_like_str(trim($search));
			$search = " WHERE `phone_name` LIKE '%{$search}%' OR `phone_id` LIKE '%{$search}%' OR `brand` LIKE '%{$search}%'";
		}

		$sql = "SELECT COUNT(*) as count FROM phone " . $search . "";
		return $this->db->query($sql)->row()->count;
	}

	public function getPhoneDetails($allPhone = "", $limit = 10, $offset = 0, $search = '')
	{
		if ($search != '') {
			$search = $this->db->escape_like_str(trim($search));
			$search = " WHERE `p`.`phone_name` LIKE '%{$search}%' OR `p`.`phone_id` LIKE '%{$search}%' OR `p`.`brand` LIKE '%{$search}%'";
		}

		if (empty($allPhone)) {
			$sql = "SELECT * FROM `phone` WHERE `stock` > 0 AND `is_active` = 1";

			$query = $this->db->query($sql);

		} else {
			$sql = "SELECT 
							`p`.*, 
							COALESCE(SUM(
								CASE 
									WHEN `o`.`status` = 'Completed' AND `oi`.`is_cancelled` = 0 
									THEN `oi`.`quantity` 
									ELSE 0 
								END
							), 0) AS `total_sold`,
							
							CASE 
								WHEN `p`.`stock` = 0 THEN 'Out of Stock'
								WHEN `p`.`stock` <= 10 THEN 'Low Stock'
								ELSE 'In Stock'
							END AS `stock_status`
							
						FROM `phone` AS `p`
						LEFT JOIN `order_item` AS `oi` ON `oi`.`phone_id` = `p`.`phone_id`
						LEFT JOIN `orders` AS `o` ON `o`.`order_id` = `oi`.`order_id`
						" . $search . "
						GROUP BY `p`.`phone_id`
						ORDER BY `p`.`phone_id` DESC
					";

			$sql .= " LIMIT " . (int) $offset . ", " . (int) $limit . "";
			$query = $this->db->query($sql);
		}
		return $query->result();
	}

	public function get_brand()
	{
		$sql = "SELECT DISTINCT(`brand`) FROM `phone`";
		$query = $this->db->query($sql);

		return $query->result();
	}

	// public function getPhoneDetailsS()
	// {

	// 	$sql_get_all = "SELECT * FROM `phone`";
	// 	$query = $this->db->query($sql_get_all);

	// 	return $query->result();
	// }

	public function searchphones($query = "")
	{
		$sql_search = "SELECT * FROM `phone` WHERE `is_active` = 1 AND (`phone_name` LIKE '%{$query}%' OR `brand` LIKE '%{$query}%')";
		$query = $this->db->query($sql_search);

		return $query->result();
	}


	public function getPhoneById($id = "")
	{
		$sql_getByID = "SELECT * FROM phone WHERE phone_id = " . $this->db->escape($id) . "";
		$query = $this->db->query($sql_getByID);

		$row = $query->row();
		$row->total_row = $query->num_rows();

		return $row;
	}

	public function get_total_phone()
	{
		$sql = "SELECT COUNT(*) as `total` FROM `phone`";
		$query = $this->db->query($sql)->row_array();
		$data['total_phone'] = $query;

		$sql = "SELECT COUNT(*) as `total` FROM `phone` WHERE `is_active` = 1";
		$query = $this->db->query($sql)->row_array();
		$data['total_active'] = $query;

		$sql = "SELECT COUNT(*) as `total` FROM `phone` WHERE `stock` = 0";
		$query = $this->db->query($sql)->row_array();
		$data['out_stock'] = $query;

		return $data;
	}

	public function delete($id = '')
	{
		$sql_remove = "DELETE FROM `phone` WHERE `phone_id` = " . $this->db->escape($id) . "";
		$this->db->query($sql_remove);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	private function new_image($new_image = array(), $phone_name = "", $old_image = "")
	{
		// If new image uploaded
		if (!empty($new_image) && isset($new_image['error']) && $new_image['error'] === 0) {

			// Delete old image (if exists & not default)
			if (
				!empty($old_image) &&
				file_exists($old_image) &&
				strpos($old_image, 'no.png') === false
			) {
				unlink($old_image);
			}

			$ext = pathinfo($new_image['name'], PATHINFO_EXTENSION);
			$uploadPath = 'assets/images/';

			// sanitize filename
			$safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($phone_name));
			$fileName = time() . '_' . $safeName . '.' . $ext;
			$targetPath = $uploadPath . $fileName;

			if (move_uploaded_file($new_image['tmp_name'], $targetPath)) {
				return $targetPath;
			}

			// upload failed → keep old image
			return $old_image;
		}

		// No new image → return old image
		return $old_image;
	}

	public function update_phone($data = array(), $new_image = "")
	{
		if ($new_image != "") {
			$sql = "SELECT `image_url` FROM `phone` WHERE `phone_id` = " . $this->db->escape($data['phone_id']) . "";
			$image_url = $this->new_image($new_image, $data['phone_name'], $this->db->query($sql)->row()->image_url);
		}

		$this->db->trans_begin();

		//get price before update to compare if changes are made
		$sql = "SELECT `current_price` FROM `phone` WHERE `phone_id` = " . $this->db->escape($data['phone_id']) . "";
		$price_before = $this->db->query($sql)->row()->current_price;

		//check if image uploaded or not if not dont update image url
		$sql = ($image_url == "") ?
			"UPDATE `phone` SET `phone_name` = " . $this->db->escape($data['phone_name']) . ", `current_price` = " . $this->db->escape($data['current_price']) . ", `stock` = " . $this->db->escape($data['stock']) . ", `updated_by` = " . $this->db->escape($this->session->userdata('username')) . ", `updated_at` = NOW() WHERE `phone_id` = " . $this->db->escape($data['phone_id']) . "" :
			"UPDATE `phone` SET `phone_name` = " . $this->db->escape($data['phone_name']) . ", `current_price` = " . $this->db->escape($data['current_price']) . ", `stock` = " . $this->db->escape($data['stock']) . ", `updated_by` = " . $this->db->escape($this->session->userdata('username')) . ", `updated_at` = NOW(), `image_url` = " . $this->db->escape($image_url) . " WHERE `phone_id` = " . $this->db->escape($data['phone_id']) . "";

		$this->db->query($sql);

		//changes on price beign made or not... if not dont update price history
		if ((float) $price_before != (float) $data['current_price']) {
			$sql = "SELECT * FROM `phone_price_history` WHERE `phone_id` = " . $this->db->escape($data['phone_id']) . " AND `valid_to` IS NULL LIMIT 1";
			$query = $this->db->query($sql);

			if ($query->num_rows() > 0) {
				$sql = "UPDATE `phone_price_history` SET `valid_to` = NOW() WHERE `phone_id` = " . $this->db->escape($data['phone_id']) . " AND `valid_to` IS NULL";
				$this->db->query($sql);
			}

			//valid to should be null since its the latest
			$sql = "INSERT INTO `phone_price_history` (`phone_id`, `price`, `valid_from`, `valid_to`) VALUES (" . $this->db->escape($data['phone_id']) . ", " . $this->db->escape($data['current_price']) . ", NOW(), NULL)";
			$this->db->query($sql);
		}

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		}

		$this->db->trans_commit();
		return TRUE;
	}

	public function activate_deactivate($phone_id = "", $username = "", $is_active = "")
	{
		$this->db->trans_begin();

		$sql = "UPDATE `phone` SET `is_active` = " . $this->db->escape($is_active) . ", `updated_by` = " . $this->db->escape($username) . ", `updated_at` = NOW() WHERE `phone_id` = " . $this->db->escape($phone_id) . "";
		$this->db->query($sql);

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		}

		$this->db->trans_commit();
		return TRUE;
	}

	public function add($data = array(), $file = array(), $continue = FALSE)
	{
		// if ($continue === FALSE) {

		// 	$normalized = $this->normalize_phone_name($data['phone_name']);

		// 	$this->db->select('phone_name');
		// 	$this->db->like('phone_name', $normalized);
		// 	$query = $this->db->get('phone');

		// 	if ($query->num_rows() > 0) {
		// 		$this->session->set_flashdata('message', 'There are similar phone names already in the system.');
		// 		$this->session->set_flashdata('insert', $data);
		// 		redirect('Product/add');
		// 	}
		// }

		$insert_db = array(
			'phone_name' => $this->db->escape(trim($data['phone_name'])),
			'normalized_name' => $this->db->escape($this->normalize_phone_name($data['phone_name'])),
			'brand' => $this->db->escape(trim($data['brand'])),
			'description' => $this->db->escape(trim($data['description'])),
			'storage' => $this->db->escape(trim($data['storage'])),
			'ram' => $this->db->escape(trim($data['ram'])),
			'battery' => $this->db->escape(trim($data['battery'])),
			'os' => $this->db->escape(trim($data['os'])),
			'image_url' => $this->db->escape(trim($this->new_image($file, $this->username))),
			'is_active' => 1,
			'stock' => $this->db->escape(trim($data['stock'])),
			'current_price' => floatval($data['price']),
			'created_at' => $this->db->escape(date('Y-m-d H:i:s')),
			'created_by' => $this->db->escape($this->username),
			'updated_at' => $this->db->escape(date('Y-m-d H:i:s')),
			'updated_by' => $this->db->escape($this->username),
			'discount' => floatval($data['discount'])
		);

		$this->db->trans_begin();

		$sql = "INSERT INTO `phone` (" . implode(",", array_keys($insert_db)) . ") VALUES (" . implode(",", array_values($insert_db)) . ")";
		$this->db->query($sql);

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			return array(
				'status' => FALSE,
				'phone_name' => $data['phone_name']
			);
		}

		$this->db->trans_commit();
		return array(
			'status' => TRUE,
			'phone_name' => $data['phone_name']
		);
	}

	public function count_low()
	{
		$sql = "SELECT COUNT(*) AS `count_low` FROM `phone` WHERE `stock` > 0 AND `stock` <= 10";
		return $this->db->query($sql)->row()->count_low;
	}

	public function count_out()
	{
		$sql = "SELECT COUNT(*) AS `count_out` FROM `phone` WHERE `stock` <= 0";
		return $this->db->query($sql)->row()->count_out;
	}

	private function normalize_phone_name($word)
	{
		$word = strtolower($word);          // convert to lowercase
		$word = trim($word);                // remove leading/trailing spaces
		$word = preg_replace('/\s+/', '', $word);  // collapse multiple spaces
		$word = str_replace(['-', '_'], ' ', $word);
		return $word;
	}

	public function get_discount_phone($limit = 0, $offset = 0, $search = array())
	{
		// "All", $per_page, $page, $this->input->get('search')

		if ($limit == 0 && $offset == 0) {
			$limit = '';
		} else {
			$limit = " LIMIT $offset, $limit";
		}

		if (empty($search)) {
			$search = '';
		} else {
			$search = " AND (`phone_name` LIKE '%{$search}%' OR `phone_id` LIKE '%{$search}%' OR `brand` LIKE '%{$search}%')";
		}

		$sql = "SELECT * FROM `phone` WHERE `discount` != 0 $search $limit";

		return $this->db->query($sql)->result();
	}

	public function end($id = '')
	{
		$sql = "UPDATE `phone` SET `discount` = 0 WHERE `phone_id` = " . $this->db->escape($id);
		if ($this->db->query($sql) == TRUE) {
			return true;
		}

		return false;
	}

	public function edit($id = '', $new = 0)
	{
		$sql = "UPDATE `phone` SET `discount` = " . $this->db->escape($new) . " WHERE `phone_id` = " . $this->db->escape($id);
		return $this->db->query($sql);
	}
}
