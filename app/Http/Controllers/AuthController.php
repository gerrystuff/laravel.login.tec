<?php
namespace App\Http\Controllers;

use App\Models\AuthModel;
use App\Models\Usuario;

class AuthController extends Controller {

    private AuthModel $authModel;

    public function __construct(){
        $this->authModel = new AuthModel();
    }

    public function login(){
        header('Content-Type:application/json; charset=utf-8');
            
         $datosUsuario = request()->except('_token');
         
         $req = $this->authModel->login($datosUsuario);

        return json_encode($req);
            
    }


    public function recuperar() {
        header('Content-Type:application/json; charset=utf-8');
        
         $datosUsuario = request()->except('_token');

         $req = $this->authModel->recuperar($datosUsuario["correo"],$datosUsuario["nip"]);

         return json_encode($req);
      
    }


    public function store(){
        header('Content-Type:application/json; charset=utf-8');

            $datosUsuario = request()->except('_token');

            $usuario = new Usuario($datosUsuario["correo"],$datosUsuario["nip"],$datosUsuario["tipo"],$datosUsuario["nip_especial"],$datosUsuario["nombre"]);
            
            $req = $this->authModel->registrar($usuario);

            return json_encode($req);
        
    }

    public function registro(){
        return view('auth.registro');
    }

    public function index(){
        return view('welcome');
    }

    public function ingreso(){
        return view('auth.ingreso');
        
    }

    public function home(){
        return view('auth.home');
    }

}



