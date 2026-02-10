<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        test();
        check_account();

        $this->load->model('User_m');
        $this->load->library('pagination');
    }

    public function index($page = 0)
    {
        $data['Cusers'] = $this->User_m->get_all($a = 0, $b = 0, $this->input->get('del'));

        $config['base_url'] = site_url('Customer/index');
        $config['total_rows'] = count($data['Cusers']);
        $config['per_page'] = 10;
        $config['use_page_numbers'] = TRUE;

        pagination_view($config);

        $this->pagination->initialize($config);
        $page = $page == 0 ? 1 : $page;
        $offset = ($page - 1) * $config['per_page'];

        $data['users'] = $this->User_m->get_all($config['per_page'], $offset, $this->input->get('del'));
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('component/sidebar_v');
        $this->load->view('Seller/user/customer_v', $data);
    }

    public function new_admin()
    {
        if (!empty($this->input->post('username'))) {

            $status = $this->User_m->add_admin($this->input->post());
            $_POST = array();

            if ($status) {
                $this->session->set_userdata('message', 'New Admin Added');
            } else {
                $this->sesion->set_userdata('message', 'failed To Add New Admin');
            }
        }

        $this->load->view('component/sidebar_v');
        $this->load->view('Seller/user/new_admin_v');
    }

    public function delete_user()
    {
        $user_id = $this->input->get();

        if (empty($user_id)) {
            $this->session->set_flashdata('message', 'user id missing');
        } else {
            if ($this->User_m->delete_user($user_id['user_id'])) {
                $this->session->set_flashdata('message', "Deleted User [ " . $user_id['name'] . " ]");
            } else {
                $this->session->set_flashdata('message', 'Failed !empty');
            }
        }

        redirect($this->input->get('url'));
    }

    public function reset_password($cust_id = '')
    {
        exit;
        if ($cust_id = '') {
            redirect('Customer');
        }

        $temp_pass = bin2hex(random_bytes(16));
        $this->User_m->temp_pass($temp_pass, $cust_id);

        $this->session->set_flashdata('message', 'Temporary Password Created');
        redirect('Customer');
    }

    public function admin_list($page = 0)
    {
        $filter = $this->session->userdata('filter');
        $filter = ($filter !== NULL && $filter != '') ? $filter : 'All';

        $data['Cusers'] = $this->User_m->get_admin(0, 0, 'All');

        $config['base_url'] = site_url('Customer/admin_list');
        $config['total_rows'] = count($this->User_m->get_admin(0, 0, $filter));

        $config['per_page'] = 10;
        $config['use_page_numbers'] = TRUE;

        pagination_view($config);

        $this->pagination->initialize($config);
        $page = $page == 0 ? 1 : $page;
        $offset = ($page - 1) * $config['per_page'];

        $data['admin'] = $this->User_m->get_admin($config['per_page'], $offset, $filter);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('component/sidebar_v');
        $this->load->view('Seller/user/admin_listing_v', $data);
    }

    public function set_session_filter()
    {
        $filter = $this->input->get('admin_type');
        $this->session->set_userdata('filter', $filter);

        redirect(base_url('Customer/admin_list'));
    }

    public function disable($user_id = '')
    {

        if ($user_id == '') {
            redirect('Customer');
        } else {

            $this->User_m->disable($user_id);
            redirect('Customer/index?del=true');
        }
    }

    public function update()
    {
        $this->session->set_flashdata('message', $this->User_m->update_customer($this->input->post()));
        redirect($this->input->post('url'));
    }
}