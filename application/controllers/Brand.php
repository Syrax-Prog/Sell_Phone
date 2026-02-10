<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        test();
        check_account();

        $this->load->model('Brand_m');
    }

    public function index()
    {
        $data['brands'] = $this->Brand_m->get_all();

        $this->load->view('component/sidebar_v');
        $this->load->view('Seller/product/manage_brand_v', $data);
    }

    public function add()
    {
        if (!empty($this->input->post()) && !empty($_FILES)) {
            if ($this->Brand_m->create_brand($this->input->post(), $_FILES)) {
                $this->session->set_flashdata('message', 'Success');
                redirect('Brand');
            }
        }

        $this->session->set_flashdata('message', 'Fail');
        redirect('Brand');
    }

    public function brand_update()
    {
        $data = array_merge($this->input->post(), $_FILES);
        
        if ($this->Brand_m->update_brand($data)) {
            redirect('Brand');
        }
    }
}