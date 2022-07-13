<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {

    Route::view('/welcome','welcome');
    Route::get('/logout',[LoginController::class,'logout'])->name('logout');
    Route::resource('/user',UserController::class);

});

Route::get('/login',[LoginController::class,'index'])->name('loginform');
Route::post('/login',[LoginController::class,'check'])->name('login');


// Route::get('/userlist',[UserController::class,'index']);

//front-end
Route::view("/register",'fronted.Register');

