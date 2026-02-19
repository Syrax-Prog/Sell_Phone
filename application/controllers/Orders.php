<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
	public $s = array('Order Placed', 'Shipped', 'Completed', 'Cancelled');
	public function __construct()
	{
		parent::__construct();
		test();
		user_login('User');
		check_account();

		$this->load->model('Order_m');
		$this->load->model('Review_m');
	}

	public function index()
	{
		$status = $this->input->get('status');
		if (empty($status) || !in_array($status, $this->s)) {
			$status = 'Order Placed';
		}

		$data = $this->Order_m->get_all_orders($status, '', $this->id);
		$data = array_map(function ($data) {
			return $data->order_id;
		}, $data);

		$data['order'] = $this->Order_m->get_order_items($data);

		$data['review'] = $this->Review_m->get_review_status();

		
		$this->load->view('component/navbar_v');
		$this->load->view('Buyer/order/order_view_v', $data);
		$this->load->view('component/footer_v');
	}

	// Place order from checkout
	public function place_order()
	{
		// echo "<pre>";
		// $this->session->unset_userdata('selected_items');
		// print_r($this->input->post());
		// echo "</pre>";
		// exit;

		$this->Order_m->create_order($this->input->post());

		redirect('Orders');
	}

	public function remove($order_id = null)
	{
		$this->Order_m->cancel_order($order_id) ?
			$this->session->set_flashdata('success', 'Order Removed Successfully') :
			$this->session->set_flashdata('error', 'Error Ocurred, Failed to Cancel Order');

		redirect('Orders');
	}

	public function remove_items($phone_id = null, $order_item_id = null)
	{
		if ($phone_id == null || $order_item_id == null) {
			$this->session->set_flashdata('error', 'Error Occured Failed To Remove Items');
			redirect('Orders?status=Cancelled');
		}

		$this->Order_m->remove_items($phone_id, $order_item_id) ?
			$this->session->set_flashdata('success', 'Successfully Removed An Item') :
			$this->session->set_flashdata('error', 'Error While Removing An Item');

		redirect('Orders?status=Cancelled');
	}
}
