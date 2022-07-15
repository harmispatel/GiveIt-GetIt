<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RequirementController;


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


Route::get("/userlogin",[UserController::class,'index'])->name('userlogin')->middleware('guest');
Route::post("/userget",[UserController::class,'check'])->name('useget');

Route::group(['middleware' => ['auth']], function () {
    
    Route::get("/logout",[loginController::class,'logout'])->name('logout');
    
    Route::get("/userlogout",[UserController::class,'userLogout'])->name('userlogout'); 

    
    
    Route::get("/insertform",[RequirementController::class,'showinsert'])->name('insertform');
    Route::post("/insertdata",[RequirementController::class,'storeRequirement'])->name('insertdata'); 
    Route::get("/require",[RequirementController::class,'display'])->name('require');
    Route::post("/update/{id}",[RequirementController::class,'update'])->name('update');
    Route::get("/edit/{id}",[RequirementController::class,'edit'])->name('edit');

    Route::get("/delete/{id}",[RequirementController::class,'delete'])->name('delete');

});