<?php

class Account extends CI_Controller{
    
    function login(){
        $this->load->view('accounts/login');
    }

    function dologin(){
        if(ispost()){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $checklogin = $this->Maccount->dologin($username,$password);
        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }

    function test(){
        echo passwordgenerator("123");
    }
    
}