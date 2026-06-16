<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Compare extends CI_Controller{
    public function __construct()
	{
		parent::__construct();
		test();
		check_account();
	}

    public function index(){
        $this->load->view('component/navbar_v');
		$this->load->view('Buyer/compare/compare_v');
		$this->load->view('component/footer_v');
    }

    public function get_phone_compare(){
        $this->load->model('Phone_m');

        $data['phone'] = $this->Phone_m->getPhoneById($this->input->post('id'));
        $this->load->view('Buyer/compare/phone_compare_v', $data);
    }
}