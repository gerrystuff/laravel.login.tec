<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function index(){
    }


    public function show(){
        return view('auth');
        
    }

    public function store(Request $request){
        return view("welcome");
    }
    //
}
