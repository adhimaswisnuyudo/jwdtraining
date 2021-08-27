<?php

function jsonoutput($statusheader,$response){
    $ci =& get_instance();
    $ci->output->set_content_type('application/json');
    $ci->output->set_status_header($statusheader);
    $ci->output->set_output(json_encode($response));
}

function successresponse($message){
    jsonoutput(200,array('status'=>'success','message'=>$message));
}

function failedresponse($message){
    jsonoutput(200,array('status'=>'failed','message'=>$message));
}

function dataresponse($objectname,$objectdata){
    jsonoutput(200,array(
        'status'=>'success',
        'message'=>'Query OK',
        "$objectname"=>$objectdata));
}

function redirectresponse($targeturl){
    jsonoutput(200,array(
        'status'=>'success',
        'message'=>'Redirect...',
        'url'=>$targeturl));
}

function passwordgenerator($password){
    return password_hash($password,PASSWORD_BCRYPT);      
}

function ispost(){
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=="POST"){
        return true;
    }
    else{
        jsonoutput(405,array('status'=>'failed','message'=>'method tidak diperkenankan'));
    }
}
