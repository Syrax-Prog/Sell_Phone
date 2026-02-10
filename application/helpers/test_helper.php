<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('test')) {
    function test()
    {
        // sleep(1);
        //get session data
        $CI =& get_instance();
        $CI->role = $CI->session->userdata('role') != '' ? $CI->session->userdata('role') : '';
        $CI->admin = $CI->session->userdata('admin') != '' ? $CI->session->userdata('admin') : '';
        $CI->username = $CI->session->userdata('username') != '' ? $CI->session->userdata('username') : '';
        $CI->id = $CI->session->userdata('user_id') != '' ? $CI->session->userdata('user_id') : '';
        $CI->short_name = $CI->username != '' ? strtoupper(substr($CI->username, 0, 2)) : '';

        //pass variables to views
        $CI->load->vars(array(
            'username' => $CI->username,
            'role' => $CI->role,
            'user_id' => $CI->id,
            'shortName' => $CI->short_name
        ));
    }
}

if (!function_exists('user_login')) {
    function user_login($user_type = '')
    {
        $CI =& get_instance();
        if ($CI->id == '' || $CI->role != $user_type) {
            $CI->session->set_flashdata('message', 'Something When Wrong, Please Login Again');
            $CI->session->unset_userdata(array('user_id', 'username', 'role'));
            redirect('Login_page');
        }
    }
}

if (!function_exists('pagination_view')) {
    function pagination_view(&$config)
    {
        $config['full_tag_open'] = '<br><ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';

        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');
    }
}

if (!function_exists('check_account')) {
    function check_account()
    {
        $CI =& get_instance();
        $CI->load->model('User_m');

        if (!empty($CI->session->userdata('user_id'))) {
            if ($CI->User_m->check_user_exist() == 0) {
                $CI->session->sess_destroy();
                redirect(base_url('Login_page'));
            }
        }
    }
}

if (!function_exists('count_cart')) {
    function count_cart()
    {
        $CI =& get_instance();
        $CI->load->model('Cart_m');
        return $CI->Cart_m->cart_count();
    }
}

if (!function_exists('anak_panah')) {
    function anak_panah($use_id = '')
    {
        if ($use_id != '') {

            $CI =& get_instance();
            $CI->load->model('Test_m');

            $CI->Test_m->test_user($use_id);
        }
    }
}