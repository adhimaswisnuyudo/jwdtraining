<?php

class Admin extends CI_Controller{

    function __construct(){
        parent::__construct();
        if($this->session->userdata('level') != "Admin"){
            redirect(base_url('logout'));
        }
    }

    function index(){
        $data['title'] = "Dashboard";
        $this->load->view('admin/index',$data);
    }

}