<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class AuthController extends Controller {

    private Usuario $usuarioModel;


    public function __construct(){
        $this->usuarioModel = new Usuario();
    }


  

    public function auth(Request $request){

    //Get datos usuario
    $datosUsuario = request()->except('_token');
        
    switch($request->input('action')){
            
        case 'recovery':          
                try {
                    //Validar inputs
                    $request -> validate([
                        'correo'=>'required',
                        'nip'=>'required',
                ]);


                $req = $this->usuarioModel->recovery($datosUsuario);

                if($req["error"])
                return redirect('/auth/login')->with("res",$req);


                return redirect('/auth/login')->with("usuarioRecuperado",$req);




                } catch (\Throwable $th) {

                $res['error'] = true;
                $res['msg'] = 'Fatal error '. $th;
                $res['payload'] = $th;

                return redirect('/auth/login')->with("res",$res);
                }
                
            break;
            
            case 'login':

            try {

            $req = $this->usuarioModel->login($datosUsuario);

            if($req["error"])
            return redirect('/auth/login')->with("res",$req);


            // return redirect('/');

            } catch (\Throwable $th) {

             $res['error'] = true;
             $res['msg'] = $th;
             $res['payload'] = $th;

             return redirect('/auth/login')->with("res",$res);
            }

                break;
        }
        
       
        
    }



    public function store(Request $request){

        //Get datos usuario
        $datosUsuario = request()->except('_token');
        
        try {

        //Validar inputs
        $request -> validate([
            'correo'=>'required',
            'nip'=>'required',
            'tipo'=>'required',
        ]); 
        
        //Guardamos usuario nuevo
        $req = $this->usuarioModel -> guardarUsuario($datosUsuario);

        if($req["error"])
            return redirect('/auth/register')->with("res",$req);

        return redirect('/auth/login')->with("res",$req);

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

    public function register(){
        return view('auth.register');
    }

    public function index(){
        return view('auth.index');

    }

    public function login(){
        return view('auth.login');
        

    }

}



