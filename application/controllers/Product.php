<?php
class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        test();
        user_login('Admin');
        check_account();

        $this->load->model('Phone_m');
        $this->load->model('Brand_m');
        $this->load->library('pagination');
    }

    public function index()
    {
        $search = $this->input->get('search') ? "?search=" . $this->input->get('search') : '';

        $per_page = 10;
        $page = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

        $phone = $this->Phone_m->getPhoneDetails("All", $per_page, $page, $this->input->get('search'));
        $count = $this->Phone_m->get_total_phone();

        $config = array();
        $config['base_url'] = site_url('Product/index');
        $config['total_rows'] = $this->Phone_m->stress_argh($this->input->get('search'));
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        $config['suffix'] = $search;
        $config['first_url'] = $config['base_url'] . $config['suffix'];

        pagination_view($config);

        $this->pagination->initialize($config);

        $data = array(
            'phones' => $phone,
            'brands' => $this->Phone_m->get_brand(),
            'low' => $this->Phone_m->count_low(),
            'out' => $this->Phone_m->count_out(),
            'total_phone' => $count['total_phone']['total'],
            'total_active' => $count['total_active']['total'],
            'pagination' => $this->pagination->create_links(),
            'notiLowOut' => $this->Phone_m->lowOut(),
            'brand' => $this->Brand_m->get_all()
        );

        $this->load->view('component/sidebar_v');
        $this->load->view('Seller/product/product_v', $data);
    }

    public function product_listing()
    {
        echo 'test';
    }

    public function delete($id = "")
    {
        if (empty($id)) {
            $this->session->set_flashdata('message', 'Error Occured, Cannot Delete This Phone!');
            redirect('Product');
        }

        $this->Phone_m->delete($id) ?
            $this->session->set_flashdata('message', 'Error Occured, Cannot Delete This Phone!') :
            $this->session->set_flashdata('message', 'Phone ' . $id . ' Deleted Successfully!');

        redirect('Product');
    }

    public function update()
    {
        if (empty($this->input->post())) {
            $this->session->set_flashdata('message', 'Missing Input, Cannot Update This Phone!');
            redirect('Product');
        }

        $this->Phone_m->update_phone($this->input->post(), $_FILES['image_url']) ?
            $this->session->set_flashdata('message', 'Phone ' . $this->input->post('phone_name') . ' Updated Successfully!') :
            $this->session->set_flashdata('message', 'Error Occured, Cannot Update This Phone!');

        redirect('Product');
    }

    public function activate_deactivate($phone_id = "", $is_active = "")
    {
        if (empty($phone_id) && empty($is_active)) {
            $this->session->set_flashdata('message', 'Missing Required Information, Cannot Activate/Deactivate This Phone!');
            redirect('Product');
        }

        $this->Phone_m->activate_deactivate($phone_id, $this->username, $is_active == 1 ? 0 : 1);

        redirect('Product');
    }

    public function add()
    {
        if (!empty($this->input->post()) && !empty($_FILES['phone_image'])) {
            $status = $this->Phone_m->add($this->input->post(), $_FILES['phone_image']);

            if ($status['status'] === TRUE) {
                redirect('Product/index?search=' . $status['phone_name']);
            }
        }

        $this->load->view('component/sidebar_v', array('brand' => $this->Brand_m->get_all()));
        $this->load->view('Seller/product/add_product_v');
    }

    public function discount()
    {
        $search = $this->input->get('search') ? "?search=" . $this->input->get('search') : '';

        $per_page = 10;
        $page = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

        $config = array();
        $config['base_url'] = site_url('Product/discount');
        $config['total_rows'] = count($this->Phone_m->get_discount_phone(0, 0, $this->input->get('search')));
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        $config['suffix'] = $search;
        $config['first_url'] = $config['base_url'] . $config['suffix'];

        pagination_view($config);

        $this->pagination->initialize($config);

        $data['phones'] = $this->Phone_m->get_discount_phone($per_page, $page, $this->input->get('search'));
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('component/sidebar_v');
        $this->load->view('Seller/product/manage_discount_v', $data);
    }

    public function test()
    {
        echo base64_decode(urldecode('bGlicmFyeS9saWJyYXJ5X2xpc3RpbmcvYWxsL3NlYXJjaA%3D%3D'));
    }
}