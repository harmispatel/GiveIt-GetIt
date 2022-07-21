<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\ForgotPasswordController;


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

Route::get('/forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::group(['middleware' => ['auth']], function () {
    
    Route::get("/logout",[loginController::class,'logout'])->name('logout');
    
    Route::post("/userlogout",[UserController::class,'userLogout'])->name('userlogout'); 

    
    
    Route::get("/insertform",[RequirementController::class,'showinsert'])->name('insertform');
    Route::post("/insertdata",[RequirementController::class,'storeRequirement'])->name('insertdata'); 
    Route::get("/required",[RequirementController::class,'display'])->name('required');
    Route::post("/update/{id}",[RequirementController::class,'update'])->name('update');
    Route::get("/edit/{id}",[RequirementController::class,'edit'])->name('edit');

    Route::delete("/delete/{id}",[RequirementController::class,'delete'])->name('delete');
    // Route::get("/filter",[RegisterController::class,'filterRequired'])->name('filter'); 

    // forgot password

   

});