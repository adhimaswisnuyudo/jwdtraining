<?php

class Maccount extends CI_Model{

    function dologin($username,$password){
        $querycheck = "SELECT userid,username,fullname,
            password,level FROM users WHERE username='$username' LIMIT 1";
        $check = $this->db->query($querycheck);
        if($check->num_rows() > 0){
            $storedpassword = $check->row()->password;
            $checkpassword = password_verify($password,$storedpassword);
            if($checkpassword){
                // return true;
                $this->createloginsession($username);
                $level = $check->row()->level;
                if($level=="Admin"){
                    redirectresponse(base_url('adm'));
                }
                else if($level=="User"){
                    redirectresponse(base_url('usr'));
                }
                else{
                    failedresponse("Hak akses error");
                }
            }
            else{
                failedresponse("Password tidak sesuai !");
            }
        }
        else{
            failedresponse("Username tidak ditemukan");
        }
    }

    function createloginsession($username){
        $q = "SELECT userid,username,fullname,level
            FROM users where username='$username'";
        $user = $this->db->query($q)->row();
        $session = array(
            'userid'=>$user->userid,
            'username'=>$user->username,
            'fullname'=>$user->fullname,
            'level'=>$user->level
        );
        $this->session->set_userdata($session);
    }

}