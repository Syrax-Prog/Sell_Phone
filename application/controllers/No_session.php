<?php
defined('BASEPATH') or exit('No direct script access allowed');

class No_session extends CI_Controller
{
	public function index()
	{
		// Optional: set a flash message for the user
		$data['message'] = "You must be logged in to access this page.";

		// Load the no_session view
		$this->load->view("component/navbar_v", $data);
		$this->load->view('Buyer/no_session_v', $data);
		$this->load->view('component/footer_v');
	}
}
