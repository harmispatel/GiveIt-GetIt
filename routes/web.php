<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\loginController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get("/register", [RegisterController::class, 'show'])->name('register');
Route::post("/insert", [RegisterController::class, 'store'])->name('insert');

Route::get("/login",[loginController::class,'loginshow'])->name('login');
Route::post("/logindata",[loginController::class,'checklogin'])->name('logindata');

Route::get("/logout",[loginController::class,'logout'])->name('logout');
// Route::view("/login",'fronted.Login');

Route::get('userlogin',[LoginController::class,'index'])->name('loginform');
Route::post('userlogin',[LoginController::class,'check'])->name('login');

Route::view("/register",'fronted.Register');
