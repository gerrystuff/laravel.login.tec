<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthModel {

    public function recuperar($correo,$nip){

      
        try {

        $res = new CustomResponse(false,"Usuario recuperado exitosamente");      
          
        $usuario = $this->_recuperarUsuario($res,$correo);
        
        // echo json_encode($usuario);

        if($usuario == null)
            return $res;

        //Validación de nip
        $contraseñaValida = Hash::check($nip, $usuario->getNip());

        if($contraseñaValida != 1){
            $res->setError(true);
            $res->setMsg("Nip incorrecto.");
            return $res;
        }

        $res->setUsuario($usuario);

        return $res;
         
    } catch (\Throwable $th) {
            $res->setError(true);
            $res->setMsg("Fallo al recuperar usuario.");
            $res->setInternalError($th);
            var_dump($th);
            return $res;
    }
    }




    public function login($datosUsuario){


        $res = new CustomResponse(false,"Usuario autenticado exitosamente");

        try {
        
        $usuario = $this->_recuperarUsuario($res,$datosUsuario["correo"]);
        
        // echo json_encode($usuario);

        if($usuario == null)
            return $res;

        //Validación de nip
        $contraseñaValida = Hash::check($datosUsuario["nip"], $usuario->getNip());
        
        if($contraseñaValida != 1){
            $res->setError(true);
            $res->setMsg("Nip incorrecto.");
            return $res;
        }

        //Validacion de nip especial
        if($usuario->getTipo() == 1){
           
            $nip_especialValido = Hash::check($datosUsuario["nip_especial"],$usuario->getNip_especial());
        
            if($nip_especialValido != 1){
                $res->setError(true);
                $res->setMsg("Nip especial incorrecto.");
                return $res;
            }   
        } 
    
         $correo = $datosUsuario["correo"];
    
        DB::select("call pa_logIn('$correo',@flag);");
        
        $statusRow = DB::select("select @flag as status;");
        
        $status = json_encode($statusRow[0]->status);

        if($status == 1){
            $res->setError(true);
            $res->setMsg("El usuario esta actualmente en sesión.");
            return $res;
        }

        return $res;

        } catch (\Throwable $th) {
            $res->setError(true);
            $res->setMsg("Fatal error");
            $res->setInternalError($th);
            echo $th;
            return $res;
        }
    }


    public function registrar(Usuario $usuario){
        try {

        $res = new CustomResponse();
        
        
        $usuarioExiste = $this->_recuperarUsuario($res,$usuario->getCorreo());
        
        
        if($usuarioExiste != null){
            $res->setError(true);
            $res->setMsg("Este correo electrónico ya está en uso. Eliga otro.");   
            return $res;
        }

        //Encriptamos nips
        $nip = Hash::make($usuario->getNip());
        $nip_especial = '';

        if($usuario->getTipo() == 1){
            $nip_especial = Hash::make($usuario->getNip_especial());
        }

        //Guardar usuario
        DB::select('insert into usuarios(correo,nombre,nip,tipo,nip_especial) values (?,?,?,?,?)',[
            $usuario->getCorreo(),
            $usuario->getNombre(),
            $nip,
            $usuario->getTipo(),
            $nip_especial
        ]);

        $res->setError(false);
        $res->setMsg("Usuario registrado correctamente.");

        return $res;

        } catch (\Throwable $th) {
            $res->setError(true);
            $res->setMsg("No se guardo el usuario, verifique los campos.");
            $res->setUsuario($usuario);
            $res->setInternalError($th);
            var_dump($th);
            return $res;
        }
    }


    private function _recuperarUsuario(CustomResponse $res , $correo){

        //Validacion de usuario existente 
        $query = DB::select('call pa_getUser(?)',[ $correo] );

        $usuarioExiste = collect($query);

        if(count($usuarioExiste) == 0){
            $res->setError(true);
            $res->setMsg("El usuario no existe");
            return null;
        }

        return new Usuario(
        $usuarioExiste[0]->correo,
        $usuarioExiste[0]->nip,
        $usuarioExiste[0]->tipo,
        $usuarioExiste[0]->nip_especial,
        $usuarioExiste[0]->nombre,

    );
    
}
}
