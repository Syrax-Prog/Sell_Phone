<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Homepage extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		test();
		check_account();

		$this->load->model('Phone_m');
		$this->load->model('Brand_m');
		$this->load->model('Cart_m');
		$this->load->model('Review_m');
	}

	public function index()
	{
		$query = $this->input->get('query');

		$data['phone'] = $query ? $this->Phone_m->searchPhones($query) : $this->Phone_m->getPhoneDetails();
		$data['brand'] = $this->get_brand();

		$this->load->view('component/navbar_v');
		$this->load->view('Buyer/homepage/home_v', $data);
		$this->load->view('component/footer_v');
	}

	public function viewDetails($id = '')
	{
		if (empty($id)) {
			$this->session->set_flashdata('message', 'Phone ID missing, Please Try Again');
			redirect('Homepage');

		} else {
			$data['phone'] = $this->Phone_m->getPhoneById($id);

			if ($data['phone']->total_row == 0 || $data['phone']->is_active == 0) {
				$this->session->set_flashdata('message', 'Invalid Request, Try Again Later');
				redirect('Homepage');
			}

			// Load views
			$this->load->view('component/navbar_v');
			$this->load->view('Buyer/product/view_detail_v2', $data);
			$this->load->view('component/footer_v');
		}
	}

	public function viewDetailsTest($id = '')
	{
		if (empty($id)) {
			$this->session->set_flashdata('message', 'Phone ID missing, Please Try Again');
			redirect('Homepage');

		} else {
			$data['phone'] = $this->Phone_m->getPhoneById($id);

			// Load views
			$this->load->view('component/navbar_v');
			$this->load->view('Buyer/product/view_detail_v2', $data);
			$this->load->view('component/footer_v');
		}
	}

	public function get_brand()
	{
		return $this->Brand_m->get_brand();
	}

	public function add_to_cart($phone_id = '')
	{
		$data = array(
			'phone_id' => $phone_id,
			'quantity' => 1,
		);

		$status = $this->Cart_m->add_item($data);

		$this->session->set_userdata('message1', $status['message']);
		redirect('Homepage');
	}

	public function explore_more()
	{
		$this->load->view('Buyer/product/more_product_v', array('phone' => $this->Phone_m->getPhoneDetails()));
	}
}
