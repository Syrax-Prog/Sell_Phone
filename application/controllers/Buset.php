<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buset extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        test();
        anak_panah('43');
    }

    public function index(){
        echo $this->Test_m->username;
        echo "<br>";
        echo $this->Test_m->password;
    }
}