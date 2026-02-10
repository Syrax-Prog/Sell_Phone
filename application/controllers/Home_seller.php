<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Home_seller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        test();
        check_account();

        $this->load->model('Order_m');
    }

    public function index()
    {
        user_login('Admin');
        $getData = $this->getData();

        //calculate percentage change revenue
        if ($getData['getPrevRev'] > 0) {
            $kira = (($getData['getRevenue'] - $getData['getPrevRev']) / $getData['getPrevRev']) * 100;
            $getRevenueChange = $kira > 9999 ? 9999.99 : $kira;
        } elseif ($getData['getPrevRev'] == 0 && $getData['getRevenue'] > 0) {
            $getRevenueChange = 100;
        } else {
            $getRevenueChange = 0;
        }


        //calculate percentage change total order
        $totalOrderChange = $getData['prevTotalOrder'] > 0
            ? ($getData['currentTotalOrder'] - $getData['prevTotalOrder']) / $getData['prevTotalOrder'] * 100
            : 100;

        //calculate percentage change total sold
        $soldChange = $getData['prevSold'] > 0
            ? ($getData['currSold'] - $getData['prevSold']) / $getData['prevSold'] * 100
            : 100;

        //calculate percentage change new customer
        $newCustRate = $getData['prevNewCust'] > 0
            ? ($getData['newCust'] - $getData['prevNewCust'] / $getData['prevNewCust']) * 100
            : 100;


        $data = array_merge($getData, array(
            'getRevenueChange' => $getRevenueChange,
            'totalOrderChange' => $totalOrderChange,
            'soldChange' => $soldChange,
            'newCustPercent' => $newCustRate
        )); // cannot data[] cause will be data[][] use array_merge instead

        $this->load->view('component/sidebar_v', $data);
        $this->load->view('Seller/seller_home_v', $data);
    }

    private function getData()
    {
        return array(
            'getRevenue' => $this->Order_m->getRevenue(),
            'getPrevRev' => $this->Order_m->getRevenueChange(),
            'currentTotalOrder' => $this->Order_m->get_total_order_all(),
            'prevTotalOrder' => $this->Order_m->get_total_order_prev(),
            'currSold' => $this->Order_m->get_curr_sold(),
            'prevSold' => $this->Order_m->get_prev_sold(),
            'newCust' => $this->Order_m->get_new_customer(),
            'prevNewCust' => $this->Order_m->get_prev_new_customer(),
            'lowStock' => $this->Order_m->get_low_stock()
        );
    }
}