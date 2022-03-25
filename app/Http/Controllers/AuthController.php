<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index(){
        return view('auth.index');

    }

    public function login(){
        return view('auth.login');
        

    }

    public function auth(Request $request){
        $res = [
            'error' => false,
            'msg' => '',
            'payload' => null
        ];
        //TODOS
        
        //Get datos usuario
        $datosUsuario = request()->except('_token');

        //Validar inputs
        $request -> validate([
            'correo'=>'required',
            'nip'=>'required',
        ]);


        //Validar si existe ese usuario
        //Validar contraseñas
        //Validar si esta en sesion
        //Validar si es usuario especial
        //
        //retornar objeto 




        $res['error'] = false;
        $res['msg'] = 'Credenciales autenticadas correctamente';
        $res['payload'] = $datosUsuario;


        return redirect('/auth/login')->with("res",$res);


        try {
            //code...
        } catch (\Throwable $th) {
            
         $res['error'] = true;
         $res['msg'] = 'Fatal error';
         $res['payload'] = $th;

         return redirect('/auth/login')->with("res",$res);
        }
        
    }

    public function register(){
        return view('auth.register');

    }


    public function show(){
    }

    public function store(Request $request){

        $res = [
            'error' => false,
            'msg' => '',
            'payload' => null
        ];
        //TODOS

        try {

        //Get datos usuario
        $datosUsuario = request()->except('_token');

        //Validar inputs
        $request -> validate([
            'correo'=>'required',
            'nip'=>'required',
            'tipo'=>'required',
        ]);

        //Validar usuario repetido /
        $usuarioExiste  = Usuario::find($datosUsuario["correo"]);

        if($usuarioExiste != null){
            $res['error'] = true;
            $res['msg'] = 'Este correo electrónico ya está en uso. Eliga otro.';
            return redirect('/auth/register')->with("res",$res);
        }

        //Encriptar contraseñas
        $nip = Hash::make($datosUsuario['nip']);
        $nip_especial = '';
        if($datosUsuario["nip_especial"] != null){
            $nip_especial = Hash::make($datosUsuario['nip_especial']);
        }

        //Crear usuario 
        $usuario = new Usuario([
            'correo' => $datosUsuario['correo'],
            'nip' => $nip,
            'nip_especial' => $nip_especial,
            'tipo' => $datosUsuario['tipo']
        ]);

        //Almacenar usuario
        $usuario->registrarUsuario();
        


        $res['error'] = false;
        $res['msg'] = 'Usuario registrado correctamente';
        $res['payload'] = $usuario;

        return redirect('/auth/login')->with("res",$res);

        } catch (\Throwable $th) {
            $res['error'] = true;
            $res['msg'] = $th;
            $res['payload'] = $th;

        return redirect('/auth/register')->with("res",$res);

        }
        
    }


    public function create(Request $request){

        return view('auth.create');

    }
    //
}
