<?php
namespace App\Models;

class CustomResponse {

    public bool $error;
    public String $msg;
    public String $internalError;
    public Usuario $usuario;

    public function __construct($error = false,$msg = "undefined",$internalError = "")
    {   
        $this->error=$error;
        $this->msg=$msg;
        $this->internalError = $internalError;
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
    public function setUsuario(Usuario $usuario){
        $this->usuario = $usuario;
    }


    /**
     * Get the value of internalError
     */ 
    public function getInternalError()
    {
        return $this->internalError;
    }

    /**
     * Set the value of internalError
     *
     * @return  self
     */ 
    public function setInternalError($internalError)
    {
        $this->internalError = $internalError;

        return $this;
    }
}

?>