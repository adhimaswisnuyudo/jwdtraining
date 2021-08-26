<?php

class User extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        if($this->session->userdata('level') != "User"){
            redirect(base_url('logout'));
        }
    }

    function index(){
        echo "Tampilan User";
    }

}