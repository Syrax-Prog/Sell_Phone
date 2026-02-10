<?php

class Login_page extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		test();
		check_account();

		$this->load->model('User_m');
	}

	public function index()
	{
		$this->load->view('component/navbar_v');
		$this->load->view('Buyer/login/login_v');
		$this->load->view('component/footer_v');
	}

	public function set_cookie($data)
	{
		if ($data['remember_me']) {
			$this->input->set_cookie(array(
				'name' => 'remembered_email',
				'value' => $data['email'],
				'expire' => 86400 * 30, // 30 days
				'secure' => FALSE, // Set to TRUE if using HTTPS
				'httponly' => TRUE
			));
		} else {
			// Delete the cookie if unchecked
			delete_cookie('remembered_email');
		}
	}

	//receive login details, verify, redirect
	public function login()
	{
		// Validate user
		$user = $this->User_m->login($this->input->post());

		if ($user['status']) {
			$user = $user['data'];
			// Set session data (for logged-in user)
			$this->session->set_userdata(array(
				'user_id' => $user->user_id,
				'username' => $user->username,
				'email' => $user->email,
				'role' => $user->role,
				'logged_in' => TRUE,
				'admin' => $user->admin_type
			));

			if ($user->is_active == 0) {
				$this->session->set_userdata('message', 'Account Has Being Disabled. Contact Admin For Mor Info');
				$this->session->unset_userdata(array('user_id', 'username', 'email', 'role', 'logged_in', 'admin'));
				redirect('Login_page');
			}

			$this->set_cookie($this->input->post());

			$home = array(
				'Admin' => 'Home_seller',
				'User' => 'Homepage'
			);
			redirect($home[$user->role]);

			// if ($user->role === 'Admin') {
			// 	redirect('Home_seller');
			// } else {
			// 	redirect('Homepage');
			// }
		} else {
			if ($user['false_loc'] == 'pass') {
				$this->session->set_userdata('message', 'Invalid password');
			} else {
				$this->session->set_userdata('message', 'Invalid Email Address');
			}
			redirect('Login_page');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Login_page');
	}

	public function Registration()
	{
		$this->load->view('component/navbar_v');
		$this->load->view('Buyer/login/register_v');
		$this->load->view('component/footer_v');
	}

	public function register_submit()
	{
		//check if user already exist
		$userExist = $this->User_m->user_exists(trim($this->input->post('email')));

		if ($userExist) {
			$data['error'] = "Email Already Taken, Choose Another Email";
		} else {
			$isRegistered = $this->User_m->register($this->input->post());

			if ($isRegistered) {
				$data['success'] = "Registration Successful! Please Login";
			} else {
				$data['error'] = "Something Went Wrong. Try Again";
			}
		}

		$this->load->view('component/navbar_v');
		$this->load->view('Buyer/login/register_v', $data);
		$this->load->view('component/footer_v');
	}
}
