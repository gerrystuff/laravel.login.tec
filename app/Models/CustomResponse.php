<?php

class CustomResponse {

    private bool $error;
    private String $msg;
    private String $payload;

    public function __construct($error = false,$msg = "undefined",$payload = null)
    {   
        $this->error=$error;
        $this->msg=$msg;
        $this->payload=$payload;
    }

        
    
    public function toString(){
        return ['error'=>$this->error,'msg'=>$this->msg,'payload'=>$this->payload];
    }

    public function getError(){
        return $this->error;
    }

    public function getMsg(){
        return $this->msg;
    }

    public function getPayload(){
        return $this->payload;
    }

    public function setError($error){
        $this->error = $error;
    }

    public function setMsg($msg){
        $this->msg = $msg;
    }
    public function setPayload($payload){
        $this->payload = $payload;
    }

}

?>