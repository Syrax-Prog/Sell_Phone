<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discount extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        test();
        check_account();
    }

    public function end_discount($id = '')
    {
        if ($id == '') {
            redirect('Product/discount');
        }

        $this->load->model('Phone_m');
        $this->Phone_m->end($id);
        redirect('Product/discount');
    }

    public function edit($id = '')
    {
        if ($id == '' || empty($this->input->post('discount_value'))) {
            redirect('Product/discount');
        }

        $this->load->model('Phone_m');
        $this->Phone_m->edit($id, $this->input->post('discount_value'));
        redirect('Product/discount');
    }
}