<?php
class Profile_page extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('User_m');
		$this->load->model('Cart_m');
		test();
		check_account();
	}

	private function check_user()
	{
		$role = $this->session->userdata('role');
		$user_id = $this->session->userdata('user_id');

		if (empty($role) || empty($user_id)) {
			$this->session->set_flashdata('message', 'Something When Wrong, Please Login Again');
			$this->session->unset_userdata(array('user_id', 'username', 'role'));
			redirect('LoginPage');
		}

		if ($role != 'User') {
			$this->session->set_flashdata('message', 'Something When Wrong, Please Login Again');
			$this->session->unset_userdata(array('user_id', 'username', 'role'));
			redirect('LoginPage');
		}
	}

	public function index()
	{
		$this->check_user();

		$data['username'] = $this->session->userdata('username');
		$data['created_at'] = $this->session->userdata('created_at');
		$data['email'] = $this->session->userdata('email');

		$this->load->view('component/navbar_v', $data);
		$this->load->view('Buyer/profile/profile_v', $data);
		$this->load->view('component/footer_v');
	}

	public function update_username()
	{
		$this->check_user();

		$new_username = $this->input->post('username');
		$username = $this->session->userdata('username');

		// If available, update
		if ($this->User_m->update_username($username, $new_username)) {

			$this->session->set_userdata('username', $new_username);
			$this->session->set_flashdata('message', 'Username updated successfully.');
		} else {
			$this->session->set_flashdata('message', 'Failed to update username.');
		}

		redirect('Profile_page');
	}

	public function update_password()
	{
		$data = $this->input->post();

		if (empty($data)) {
			$this->session->set_flashdata('message', 'All Field Must Be Filled');
			redirect('Profile_page');
		}

		if ($data['new_password'] != $data['confirm_password']) {
			$this->session->set_flashdata('message', 'Password Mismatch Try Again');
			redirect('Profile_page');
		}

		if (!$this->User_m->compare_pass($data['current_password'])) {
			$this->session->set_flashdata('message', 'Current Password Doesnt Match Please Try Again');
			redirect('Profile_page');
		}

		if (!$this->User_m->update_password($data['new_password'])) {
			$this->session->set_flashdata('message', 'An Error Occured, Cannot Update Password');
			redirect('Profile_page');
		}

		$this->session->set_flashdata('message', 'Password Updated Successfully');
		redirect('Profile_page');
	}
}
