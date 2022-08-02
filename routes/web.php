<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RequirementController;
use PharIo\Manifest\RequirementCollection;
// use App\Http\Controllers\{LoginController, RegisterController, UserController, RequirementController, ForgotPasswordController, GiveitController, GetitController, AddRequirementController, UserProfileController};
// use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;





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

Route::get('/home', function () {
    return view('fronted.index');
});

Route::group(['middleware' => ['guest']], function () {

    Route::get('/login',[LoginController::class,'index'])->name('loginform');
    Route::post('/login',[LoginController::class,'check'])->name('login');
    Route::get('/registration',[RegistrationController::class,'index'])->name('registrationForm');
    Route::post('/registration',[RegistrationController::class,'store'])->name('registration');


});

Route::group(['middleware' => ['auth']], function () {

    Route::post("/logout",[loginController::class,'logout'])->name('logout')->middleware('auth');
    Route::get('/logout',[LoginController::class,'log']);
    Route::resource('/user',UserController::class);
    Route::resource('/category',CategoryController::class);
    Route::resource('/requirement',RequirementController::class);
    Route::view('/home','welcome');
    // Route::get('/filterStatus',[RequirementController::class,'filterStatus'])->name('filterStatus');
    Route::post('/filterStatus',[RequirementController::class,'changeStatus']);
    Route::post('/filterIsActive',[RequirementController::class,'changeIsActive']);
    Route::post('/search',[RequirementController::class,'searching']);
    // Route::get('/search',[RequirementController::class,'searchCategory']);
    
});


    
    // Route::get("/register", [RegisterController::class, 'show'])->name('register');
    // Route::post("/insert", [RegisterController::class, 'store'])->name('insert');

    // Route::get("/login",[loginController::class,'loginshow'])->name('login');
    // Route::post("/logindata",[loginController::class,'checklogin'])->name('logindata');
    // Route::get('/addUer',[UserController::class,'createAdmin'])->name('createAdmin');
    // Route::post('/addUer',[UserController::class,'store'])->name('storeAdmin');


// Route::view("/login",'fronted.Login');
 
// Route::get('/logout',[LoginController::class,'logout'])->name('logout');




// Route::get('/userlist',[UserController::class,'index']);

//front-end
// Route::view("/register",'fronted.Register');


Route::get("/register",[RegisterController::class, 'show'])->name('register');
Route::post("/insert", [RegisterController::class, 'store'])->name('insert');

Route::get("/userlogin",[UserController::class,'index'])->name('userlogin')->middleware('guest');
Route::post("/userget",[UserController::class,'check'])->name('useget');

Route::get('/forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/giveit',[GiveitController::class,'index'])->name('giveit');
Route::get('/getit',[GetitController::class,'index'])->name('getit');
Route::view('/donate','fronted.donate');



Route::group(['middleware' => ['auth']], function () {
    
    Route::post("/userlogout",[UserController::class,'userLogout'])->name('userlogout'); 
    
    Route::get("/insertform",[RequirementController::class,'showinsert'])->name('insertform');
    // Route::post("/insertdata",[RequirementController::class,'storeRequirement'])->name('insertdata'); 
    Route::get("/required",[RequirementController::class,'display'])->name('required');
    
    
    
    Route::get("/insertrequired",[AddRequirementController::class,'index'])->name('addform');
    Route::post("/insertdata",[AddRequirementController::class,'storeRequirement'])->name('insertdata');
    Route::get("/edit/{id}",[AddRequirementController::class,'edit'])->name('edit');
    // Route::get("/view/{id}",[AddRequirementController::class,'show'])->name('view');
    Route::delete("/delete/{id}",[AddRequirementController::class,'destroy'])->name('delete');
    Route::post("/update/{id}",[AddRequirementController::class,'update'])->name('update');
    Route::get("/editprofile",[UserProfileController::class,'edit'])->name('editprofile');
    Route::get("/userupdateprofile",[UserProfileController::class,'update'])->name('userupdateprofile');
    // Route::get("/userrequireddata",[UserProfileController::class,'display'])->name('userrequireddata');

       


});
