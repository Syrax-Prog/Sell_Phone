<?php

class Order_seller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        test();
        user_login('Admin');
        check_account();

        $this->load->model('Order_m');
    }

    public function recent_order()
    {
        $data['getRecentOrder'] = $this->Order_m->get_recent_order();

        $this->load->view('Seller/recent_order_v', $data);
    }

    public function index()
    {
        $data = $this->input->get('status');
        $search = $this->input->get('search');

        if (!in_array($data, array("Order Placed", "Shipped", "Completed", "Cancelled")) || empty($data)) {
            $data = "Order Placed";
        }

        $get_all_orders = $this->Order_m->get_all_orders($data, $search);
        $get_all_order_item = $this->Order_m->get_all_order_item();

        $status_counts = array(
            'Completed' => 0,
            'Order Placed' => 0,
            'Shipped' => 0
        );

        $rev = 0;
        foreach ($get_all_orders as $order) {
            if (isset($status_counts[$order->status])) {
                $status_counts[$order->status]++;
            }

            $rev += $order->status == 'Completed' ? $order->total_price : 0;
        }
        //grouped the array for easier retrieve and reduce load bla3
        $order_items = array();

        foreach ($get_all_order_item as $item) {
            $order_items[$item->order_id][] = $item;
        }

        $data = array(
            'all_orders' => $get_all_orders,
            'all_order_items' => $order_items
        );

        $this->load->view('component/sidebar_v', $data);
        $this->load->view('Seller/order/orders_v', $data);
    }

    public function update_status($order_id = "")
    {
        $new_status = $this->input->post('status');

        // Validate inputs
        if (empty($order_id) || empty($new_status)) {
            return $this->redirect_with_message('Something went wrong, please try again');
        }

        // Check if status change is allowed
        $checkStatus = $this->Order_m->get_status($order_id, $new_status);

        // Handle validation errors
        if (isset($checkStatus['error']) || $checkStatus['allowed'] === false) {
            $message = $checkStatus['error']
                ? $checkStatus['error']
                : $checkStatus['message'];

            return $this->redirect_with_message($message);
        }

        // Update status and handle result
        $result = $this->Order_m->update_status($order_id, $new_status);

        $messages = array(
            false => 'Update Failed',
            0 => 'Nothing Happened',
            'default' => 'Update Success'
        );

        $message = $messages[$result] ? $messages[$result] : $messages['default'];
        return $this->redirect_with_message($message);
    }

    private function redirect_with_message($message = "")
    {
        $this->session->set_flashdata('message', $message);
        redirect('Order_seller');
    }

    public function cancel($order_id = "")
    {
        if ($order_id == "") {
            $this->session->set_flashdata('message', 'Order ID not Found');
            redirect('Order_seller');
        }

        $cancel = $this->Order_m->cancel_order($order_id);

        if ($cancel === FALSE) {
            $this->session->set_flashdata('message', 'Cancel Failed');
            redirect('Order_seller');
        }

        $this->session->set_flashdata('message', 'Cancel Success');
        redirect('Order_seller');
    }
}