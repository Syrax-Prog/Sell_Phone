<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dz extends CI_Controller
{
    public function index()
    {
        $this->load->view('sakai/index.php');
    }
}
