<?php

class CustomResponse {

    private bool $error;
    private String $msg;
    private String $usuario;

    public function __construct($error = false,$msg = "undefined",$usuario = null)
    {   
        $this->error=$error;
        $this->msg=$msg;
        $this->usuario=$usuario;
    }

        
    
    public function toString(){
        return ['error'=>$this->error,'msg'=>$this->msg,'usuario'=>$this->usuario];
    }

    public function getError(){
        return $this->error;
    }

    public function getMsg(){
        return $this->msg;
    }

    public function getusuario(){
        return $this->usuario;
    }

    public function setError($error){
        $this->error = $error;
    }

    public function setMsg($msg){
        $this->msg = $msg;
    }
    public function setusuario($usuario){
        $this->usuario = $usuario;
    }

}

?>