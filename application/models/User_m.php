<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @param string $email
 * @return bool
 * @param array $userdata
 */

class User_m extends CI_Model
{
	public function login($userdata = array())
	{
		$sql = "SELECT * FROM `user` WHERE `email` = " . $this->db->escape(trim($userdata['email'])) . "";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$sql = "SELECT * FROM `user` WHERE `email` = " . $this->db->escape(trim($userdata['email'])) . " AND `password` = " . $this->db->escape(md5(trim($userdata['password'])));
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return array(
					'data' => $query->row(),
					'status' => true
				);
			} else {
				return array(
					'status' => false,
					'false_loc' => 'pass'
				);
			}
		} else {
			return array(
				'status' => false,
				'false_loc' => 'email'
			);
		}
	}

	public function register($userdata = array())
	{

		$sql = "INSERT INTO `user` (`username`, `password`, `email`, `role`, `is_active`, `created_at`, `updated_at`) 
				VALUES (
			 	" . $this->db->escape(trim($userdata['username'])) . ", 
				" . $this->db->escape(md5(trim($userdata['password']))) . ", 
				" . $this->db->escape(trim($userdata['email'])) . ", 
				'User', 1, NOW(), NOW()
				)";

		return $this->db->query($sql);
	}

	//check for any duplicate entry
	public function user_exists($email = "")
	{
		$sql = "SELECT * FROM `user` WHERE `email` = " . $this->db->escape($email) . " LIMIT 1";
		return $this->db->query($sql)->num_rows() > 0;
	}

	public function update_username($username = "", $new_username = "")
	{
		$sql = "UPDATE `user` SET `username` = " . $this->db->escape(trim($new_username)) . " WHERE username = " . $this->db->escape(trim($username)) . "";
		return $this->db->query($sql);
	}

	public function get_all($limit = 0, $offset = 0, $del = false, $user = 'User')
	{
		if ($limit == 0 && $offset == 0) {
			$pagi = "";
		} else {
			$pagi = " LIMIT $offset, $limit";
		}

		if ($del) {
			$del = " AND `user`.`is_active` = 0 ";
		} else {
			$del = " AND `user`.`is_active` = 1 ";
		}

		$sql = "SELECT 
					`user`.*, 
					COUNT(`orders`.`order_id`) AS `total_order`,
					COALESCE(
						DATE_FORMAT(MAX(`orders`.`order_date`), '%Y-%m-%d'), 
						'No Purchase Made'
					) AS `last_order_date`,
					CASE 
						WHEN MAX(`orders`.`order_date`) < DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
							OR MAX(`orders`.`order_date`) IS NULL
						THEN 'Inactive'
						ELSE 'Active'
					END AS `status`
				FROM `user`
				LEFT JOIN `orders` 
					ON `orders`.`user_id` = `user`.`user_id` 
					AND `orders`.`status` = 'Completed'
				LEFT JOIN `order_item` 
					ON `order_item`.`order_id` = `orders`.`order_id` 
					AND `order_item`.`is_cancelled` = 0
				WHERE `user`.`role` = 'User' $del
				GROUP BY `user`.`user_id`
				$pagi";
		return $this->db->query($sql)->result_array();
	}

	public function compare_pass($curr_pass = '')
	{
		if (!$curr_pass) {
			return FALSE;
		}

		$sql = "SELECT * FROM `user` WHERE `user_id` = " . $this->id . " AND `password` = " . $this->db->escape(md5(trim($curr_pass))) . "";
		$query = $this->db->query($sql);

		return $query->num_rows() > 0 ? TRUE : FALSE;
	}

	public function update_password($new_pass = '')
	{
		if (!$new_pass) {
			return FALSE;
		}

		$sql = "UPDATE `user` SET `password` = " . $this->db->escape(md5(trim($new_pass))) . " WHERE `user_id` = " . $this->id . "";
		$query = $this->db->query($sql);

		return $query;
	}

	public function add_admin($data = array())
	{
		$sql = "INSERT INTO user (username, password, email, role, admin_type) VALUES (" . $this->db->escape(trim($data['username'])) . ", " . $this->db->escape(md5(trim($data['password']))) . ", " . $this->db->escape(trim($data['email'])) . ", 'Admin', 'normal')";

		return $this->db->query($sql);
	}

	public function delete_user($user_id = '')
	{
		$sql = "DELETE FROM user WHERE user_id = " . $this->db->escape(trim($user_id)) . "";

		return $this->db->query($sql);
	}


	public function get_admin($limit = 0, $offset = 0, $filter = 'All')
	{
		$pagi = ($limit == 0 && $offset == 0) ? $pagi = "" : " LIMIT $offset, $limit";

		$filter = ($filter === 'All') ? '' : " AND `admin_type` = " . $this->db->escape($filter) . "";

		if ($this->admin == 'super') {
			$sql = "SELECT *, CASE `admin_type` WHEN 'super' THEN 'Super' ELSE 'Normal' END AS `admin_type` FROM `user` WHERE `role` = 'admin' $filter $pagi";
			return $this->db->query($sql)->result_array();
		}

		return FALSE;
	}

	public function disable($user_id)
	{
		$sql = "UPDATE user SET is_active = NOT is_active WHERE user_id = " . $this->db->escape(trim($user_id));
		$this->db->query($sql);
	}

	public function update_customer($data = array())
	{
		$password = (!empty($data['password'])) ? ", `password` = " . $this->db->escape(md5(trim($data['password']))) . " " : '';
		$admin_type = (!empty($data['admin_type'])) ? ", `admin_type` = " . $this->db->escape(trim($data['admin_type'])) . " " : '';

		$sql = "UPDATE `user` SET `username` = " . $this->db->escape(trim($data['username'])) . ", `email` = " . $this->db->escape(trim($data['email'])) . "$password $admin_type WHERE `user_id` = " . $data['user_id'] . "";

		if ($this->db->query($sql)) {
			$m = 'Update Success Eventhough Nothing Actually Happen';
			if ($this->db->affected_rows() > 0) {
				$m = 'Congrats You Actually Update 1 User Data';
			}
		} else {
			$m = 'Weird, Something went wrong, I couldnt Update The Data';
		}

		return $m;
	}

	public function check_user_exist()
	{
		$sql = "SELECT * FROM user WHERE user_id = $this->id";
		$query = $this->db->query($sql);

		return $query->num_rows();
	}
}
