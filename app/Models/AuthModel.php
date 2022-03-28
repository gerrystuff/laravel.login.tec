<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthModel {

    public function recuperar($datosUsuario){
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


        if($usuarioExiste[0]->tipo == 1){
        
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


    public function registrar($datosUsuario){


        $res = [
            'error' => false,
            'msg' => 'Usuario registrado correctamente. Inicie sesión',
            'payload' => null,
            "internal_error" => null,
        ];

        try {
       
        //Validacion de usuario existente 
        $query = DB::select('call pa_getUser(?)',[$datosUsuario["correo"]]);
        
        $usuarioExiste = collect($query);
        
        // echo json_decode($usuarioExiste);kv
        
        if(count($usuarioExiste) != 0){
            $res["error"] = true;
            $res["msg"] = "Este correo electrónico ya está en uso. Eliga otro.";
            $res["internal_error"] = $usuarioExiste;
            return $res;
        }


        // //Encriptamos nips
        $nip = Hash::make($datosUsuario['nip']);
        $nip_especial = '';

        if($datosUsuario["tipo"] == 1){
            $nip_especial = Hash::make($datosUsuario['nip_especial']);
        }
            $usuarioNuevo = new Usuario([
                "correo" => $datosUsuario["correo"],
                "nombre" => $datosUsuario["nombre"],
                "nip" => $nip,
                "tipo" => $datosUsuario["tipo"],
                "nip_especial" => $nip_especial,
            ]);
    
            $usuarioNuevo->save();

            return $res;

        } catch (\Throwable $th) {
            $res["error"] = true;
            $res["msg"] = "No se guardo el usuario.";
            $res["payload"] = $usuarioNuevo;
            $res["internal_error"] = $th;
            return $res;
            // var_dump($th);
        }
    }
}
