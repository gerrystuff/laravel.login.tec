<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model{

    protected $table = 'usuarios';
    public $primaryKey= 'correo';

    public $timestamps = false;


    protected $fillable = [
        'correo','nip','tipo','nip_especial','nombre'
    ];

}



class CustomResponse {

    private $error;
    private $msg;
    private $payload;

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
