<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Review extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        test();
        check_account();

        $this->load->model('Review_m');
    }



    public function index()
    {
        if (empty($this->input->post('id'))) {
            return false;
        }

        $more = 0;
        $load = 'Buyer/product/comment_list_v';
        if ($this->uri->segment(3) == 'append') {
            $more = $this->input->post('offset');
            $load = 'Buyer/product/comment_v';
        }

        $data['test'] = $this->input->post('offset');

        $limit = " LIMIT $more, 1";

        $data['review'] = $this->Review_m->getReview($this->input->post('id'), $limit);

        echo json_encode(array(
            'html' => $this->load->view($load, $data, true),
            'has_more' => count($this->Review_m->getReview($this->input->post('id'), " LIMIT " . ($more + 1) . ", 1")) > 0,
            'total_comment' => $this->Review_m->get_total_comment($this->input->post('id'))
        ));
    }

    public function add()
    {
        if (empty($this->input->post('rating'))) {
            $this->session->set_flashdata('message', 'Rating Cannot Be Null');
            redirect('Review');
        }

        $this->Review_m->create_review($this->input->post(), $_FILES);

        redirect('Orders');
    }

    public function test()
    {
        $sql = "SELECT * FROM reviews";

        $query = $this->db->query($sql)->row();
        echo "<pre>";
        print_r(json_decode($query->images));
        echo "</pre>";
    }
}