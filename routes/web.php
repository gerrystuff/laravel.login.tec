<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/',function(){
    return view('welcome');
});

// Route::resource('/auth',AuthController::class);
// Route::resource('auth', AuthController::class);
Route::get('/auth',[AuthController::class,'index']);
Route::get('/auth/login',[AuthController::class,'login']);
Route::get('/auth/register',[AuthController::class,'register']);
Route::post('/auth/register',[AuthController::class,'store']);



// Route::post('/auth/register',[AuthController::class,'register']);




// Route::get('/auth', function (){

//     return view('auth.index');
// });


