<?php

class Getdata extends CI_Model{

    function getallmembers(){
        $q = "SELECT * FROM members ORDER BY name ASC";
        return $this->db->query($q);
    }
}