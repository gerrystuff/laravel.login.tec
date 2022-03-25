<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Usuario extends Model{

    protected $table = 'usuarios';
    public $primaryKey= 'correo';

    public $timestamps = false;


    protected $fillable = [
        'correo','nip','tipo','nip_especial','nombre'
    ];

    public function __construct(){
        
    }

    public function recovery($datosUsuario){
         
        $res = [
            'error' => false,
            'msg' => 'Usuario recuperado exitosamente.',
            'payload' => null
        ];
        
        //Validacion de usuario existente 
        $query = DB::select('call pa_getUser(?)',[$datosUsuario["correo"]]);

        $usuarioExiste = collect($query);

        if(count($usuarioExiste) == 0){
            $res["error"] = true;
            $res["msg"] = "El usuario no existe.";
            return $res;
        }

        //Validación de nip
        $contraseñaValida = Hash::check($datosUsuario["nip"], $usuarioExiste[0]->nip);

        if($contraseñaValida != 1){
            $res["error"] = true;
            $res["msg"] = "Nip incorrecto.";
            return $res;
        }


        $res["payload"] = $usuarioExiste[0];

        return $res;
    }

    public function login($datosUsuario){
         
        $res = [
            'error' => false,
            'msg' => 'Usuario autenticado exitosamente.',
            'payload' => null
        ];
        

        try {
        

        //Validacion de usuario existente 
        $query = DB::select('call pa_getUser(?)',[$datosUsuario["correo"]]);
        
        $usuarioExiste = collect($query);

        if(count($usuarioExiste) == 0){
            $res["error"] = true;
            $res["msg"] = "El usuario no existe.";
            return $res;
        }

        // //Validación de nip
        $contraseñaValida = Hash::check($datosUsuario["nip"], $usuarioExiste[0]->nip);

        if($contraseñaValida != 1){
            $res["error"] = true;
            $res["msg"] = "Nip incorrecto.";
            return $res;
        }


        if($datosUsuario["nip_especial"] != ""){
        
            $nip_especialValido = Hash::check($datosUsuario["nip_especial"],$usuarioExiste[0]->nip_especial);
        
            if($nip_especialValido != 1){
                $res["error"] = true;
                $res["msg"] = "Nip especial  incorrecto.";
                
                return $res;
            }   
        } 
        
        if($usuarioExiste[0]->estatus == 1){
            $res["error"] = true;
            $res["msg"] = "El usuario esta actualmente en sesión.";
            return $res;
        }
        $flag  = false;

        DB::select('call pa_logIn(?,?)',[$datosUsuario["correo"],$flag]);

        $res["msg"] = "Usuario auntenticado correctamente." ;
        return $res;

        } catch (\Throwable $th) {
            $res["error"] = true;
            $res["msg"] = $th;

            return $res;
        }
        
    }


    
    
    public function  usuarioExiste($correo){
       
        $usuarioExiste = $this->find($correo);
        
        if($usuarioExiste != null)
            return $usuarioExiste;

        return null;
    }  

    public function guardarUsuario($datosUsuario){

        $res = [
            'error' => false,
            'msg' => 'Usuario registrado correctamente. Inicie sesión',
            'payload' => null
        ];

        //Validamos que el usuario no exista en la base de datos 
        $usuarioExiste = $this->usuarioExiste($datosUsuario["correo"]);

        if($usuarioExiste != null){
            $res["error"] = true;
            $res["msg"] = "Este correo electrónico ya está en uso. Eliga otro.";
            return $res;
        }

        //Encriptamos nips
        $nip = Hash::make($datosUsuario['nip']);
        $nip_especial = '';
        if($datosUsuario["nip_especial"] != null){
            $nip_especial = Hash::make($datosUsuario['nip_especial']);
        }

        $this->correo = $datosUsuario["correo"];
        $this->nombre = $datosUsuario["nombre"];
        $this->nip = $nip;
        $this->tipo = $datosUsuario["tipo"];
        $this->nip_especial = $nip_especial;

        $save = $this->save();

        if($save != 1){
            $res["error"] = true;
            $res["msg"] = "No se guardo el usuario.";
            $res["payload"] = $save;
        }


        return $res;
    }


    

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
