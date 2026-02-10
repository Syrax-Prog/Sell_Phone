<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Analytics extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        test();
        user_login('Admin');
        check_account();

        $this->load->model('Order_m');
        $this->load->model('Phone_m');

        $this->brand = !empty($this->input->post('brandFilter')) ? $this->input->post('brandFilter') : '';
        $this->date = !empty($this->input->post('dateFilter')) ? $this->input->post('dateFilter') : '';
    }


    public function index()
    {
        $daily_sales = $this->Order_m->get_this_month_daily_sales($this->brand, $this->date);
        $top = $this->Order_m->get_this_month_top_product($this->brand, $this->date); //ok
        $getRevenue = $this->Order_m->getRevenue($this->brand, $this->date); //ok
        $stat = $this->Order_m->get_order_summary($this->brand, $this->date); //ok
        $b = $this->Order_m->get_this_month_top_brand($this->brand, $this->date);

        $data = array(
            'days' => json_encode($daily_sales['days']),
            'totals' => json_encode($daily_sales['totals']),
            'products' => json_encode($top['products']),
            'sold' => json_encode($top['sold']),
            'revenue' => $getRevenue,
            'status' => json_encode($stat['status']),
            'percentage' => json_encode($stat['percentage']),
            'count_status' => $stat['count_status'],
            'brands' => json_encode($b['brands']),
            'bsold' => json_encode($b['Bsold']),
            'allBrand' => $this->Phone_m->get_brand(),
            'currBrand' => $this->brand,
            'currDate' => $this->date
        );

        $this->load->view('component/sidebar_v');
        $this->load->view('Seller/analysis/analytics_v', $data);
    }
}