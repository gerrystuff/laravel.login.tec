<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function index(){
        return view('auth.index');

    }

    public function login(){
        return view('auth.login');

    }

    public function register(){
        return view('auth.register');

    }


    public function show(){
        
    }

    public function store(Request $request){
        $datosUsuario = request()->except('_token');


        //TODOS
        //Validar inputs
        $request -> validate([
            'correo'=>'required',
            'nip'=>'required',
            'tipo'=>'required',
            'nip_especial'=>'required',
        ]);

        //Validar usuario repetido

        





        //Almacenar usuario


        return redirect('/auth/register')->with("usuario",$datosUsuario);


    }


    public function create(Request $request){

        return view('auth.create');

    }
    //
}
