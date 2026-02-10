<?php

class Cart extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		test();
		check_account();

		$this->load->model('Cart_m');
		$this->load->model('Address_m');

		$this->Cart_m->refresh_cart();
	}

	public function index()
	{
		$this->Cart_m->active_status(); //takut3 miss update is_active bila phone stock = 0.. (update kat database direct)
		$data['cart_item'] = $this->Cart_m->get_cart_items();

		//Load views
		$this->load->view('component/navbar_v');
		$this->load->view('Buyer/cart/cart_v', $data);
		$this->load->view('component/footer_v');
	}

	public function add()
	{
		user_login('User');
		$result = $this->Cart_m->add_item($this->input->post());

		if ($result['status']) {
			$this->session->set_flashdata('message', $result['message']);
		} else {
			$this->session->set_flashdata('message', $result['message']);
		}

		redirect('Cart');
	}

	public function update()
	{
		user_login('User');

		if (empty($this->input->post())) {
			$this->session->set_flashdata('message', 'No quantities submitted.');
			redirect('Cart');
		}

		$update = $this->Cart_m->update_cart_items($this->input->post());

		if (!empty($update['success'])) {
			$flash = "" . $update['success'] . "";

			if (!empty($update['failed'])) {
				$flash .= "<br><br>" . $update['failed'] . "";
			}
		} else {
			$flash = '';

			if (!empty($update['failed'])) {
				$flash = "" . $update['failed'] . "";
			}
		}

		$this->session->set_flashdata('message', $flash);
		redirect('Cart');
	}

	public function remove($cart_item_id = '')
	{
		user_login('User');

		if (empty($cart_item_id) || !is_numeric($cart_item_id)) {
			echo json_encode(['success' => false, 'message' => 'Invalid cart item ID.']);
			return;
		}

		$result = $this->Cart_m->remove_cart_item((int) $cart_item_id);
		echo json_encode($result);
	}

	public function checkout()
	{
		user_login('User');

		// if (empty($this->input->post()) && empty($this->session->userdata('selected_items'))) {
		// 	redirect('Cart');
		// }

		//Step 1: Get selected items (from POST or session)
		$selected_items = $this->input->post('selected_items');
		if (empty($selected_items)) {
			$selected_items = $this->session->userdata('selected_items');
		} else {
			$this->session->set_userdata('selected_items', $selected_items);
		}


		if (empty($selected_items)) {
			$this->session->set_flashdata('message', 'No items selected for checkout.');
			redirect('Cart');
			return;
		}

		//Step 3: Get checkout data using selected items
		$result = $this->Cart_m->get_checkout_data($selected_items);

		if (!$result['status']) {
			$this->session->set_flashdata('message', 'Checkout Failed');
			redirect('Cart');
			return;
		}

		//Step 4: Get user addresses
		$addresses = $this->Address_m->getAddress($this->id);

		//Step 5: Prepare data for the view
		$data = array(
			'checkout_items' => $result['cart_items'],
			'address' => $addresses,
			'total' => $result['total'],
			'user_details' => $result['user_details'],
			'username' => $this->username,
		);

		//Step 6: Load checkout page with all data intact
		$this->load->view('component/navbar_v', $data);
		$this->load->view('Buyer/order/checkout_v', $data);
		$this->load->view('component/footer_v');
	}
}
