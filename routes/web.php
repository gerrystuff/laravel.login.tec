<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::redirect('/','/auth/ingreso');



//Views
Route::get('/auth/ingreso',[AuthController::class,'ingreso']);
Route::get('/auth/registro',[AuthController::class,'registro']);


//Events
Route::post('/auth/login',[AuthController::class,'login']);
Route::post('/auth/recuperar',[AuthController::class,'recuperar']);
Route::post('/auth/registro',[AuthController::class,'store']);

