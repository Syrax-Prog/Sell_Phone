<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Address extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        test();
        check_account();

        $this->load->model('Cart_m');
        $this->load->model('Address_m');
    }

    public function add()
    {
        if (empty($this->input->post())) {

            //post will always send the url to the rquesting page
            redirect(str_replace(base_url(), '', $this->input->post('redirect_to')));
        }

        //model will return message regradless the process success or failed
        $add_new = $this->Address_m->add_address($this->input->post());

        $this->session->set_flashdata('message', $add_new ? 'Successfully Added New Address' : 'Something Went Wrong, Failed To Add Address');
        redirect(str_replace(base_url(), '', $this->input->post('redirect_to')));
    }

    public function edit()
    {
        $data = $this->input->post();
        if (empty($data['ua_id'])) {
            $this->session->set_flashdata('message', 'Missing Address Id');
            redirect('Cart/checkout');
        }

        $this->Address_m->edit_address($data);
        redirect('Cart/checkout');
    }

    public function delete()
    {
        if (!empty($this->input->post('ua_id'))) {
            $delete = $this->Address_m->delete_address($this->input->post('ua_id'));
            $this->session->set_flashdata('message', $delete['message']);

        } else {
            $this->session->set_flashdata('message', 'Missing User Address, Please Try Again');

        }

        redirect(str_replace(base_url(), '', $this->input->post('redirect_to')));
    }

    public function index()
    {
        $address = $this->Address_m->getAddress();

        $data = array('addresses' => $address);

        $this->load->view('component/navbar_v');
        $this->load->view('Buyer/profile/Address_v', $data);
    }

    public function set_default()
    {
        if (!empty($this->input->get())) {
            $status = $this->Address_m->set_default($this->input->get());

            if ($status == TRUE) {
                $this->session->set_flashdata('message', 'New Default Address Set Successfully');
                redirect('Address');
            }
        }

        $this->session->set_flashdata('message', 'Error Occured, Cannot Set Default Address');
        redirect('Address');
    }
}