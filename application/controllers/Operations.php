<?php

class Operations extends CI_Controller{

    function addorupdatemember(){
        if(ispost()){
            $mode = $this->input->post('mode');
            $name = $this->input->post('name');
            $memberid = $this->input->post('memberid');
            $identitynumber = $this->input->post('identitynumber');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');

            if($mode=="add"){
                $datatoinsert = array(
                    'name'=>$name,
                    'identitynumber'=>$identitynumber,
                    'phone'=>$phone,
                    'address'=>$address
                );
                $this->db->insert('members',$datatoinsert);
                successresponse("$name Berhasil disimpan");
            }
            else if($mode=="edit"){
                $datatoedit = array(
                    'name'=>$name,
                    'identitynumber'=>$identitynumber,
                    'phone'=>$phone,
                    'address'=>$address
                );
                $this->db->update('members',$datatoedit,array('memberid'=>$memberid));
                successresponse("$name Berhasil diperbaharui");
            }
        }
    }

    function deletemember(){
        if(ispost()){
            $memberid = $this->input->post('memberid');
            $this->db->delete('members',array('memberid'=>$memberid));
            successresponse("Data berhasil dihapus");
        }
    }
}