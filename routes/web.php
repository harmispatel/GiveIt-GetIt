<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\AddRequirementController;
use App\Http\Controllers\AdminForgotPasswordController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\GiveitController;
use App\Http\Controllers\GetitController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\FavoriteController;
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



// Admin Route

Route::group(['middleware' => ['guest']], function () {
    Route::get('/loginform',[loginController::class,'index'])->name('loginform');
    Route::post('/login', [loginController::class,'check'])->name('login');
    Route::get('/registration', [RegistrationController::class,'index'])->name('registrationForm');
    Route::post('/registration', [RegistrationController::class,'store'])->name('registration');
    
    //Forgot Password
    Route::get('/forgotPassword',[AdminForgotPasswordController::class,'index'])->name('forgotPassword');
    Route::post('/forgotPassword',[AdminForgotPasswordController::class,'submitForm'])->name('submitForm');
    Route::get('/resetPwd/{token}',[AdminForgotPasswordController::class,'resetPasswordForm'])->name('resetpassword');
    Route::post('/postResetPassword',[AdminForgotPasswordController::class,'submitResetPasswordForm'])->name('postResetPassword');

});

Route::group(['middleware' => ['auth']], function () {
    
    // Logout Route
    Route::post("/logout", [loginController::class,'logout'])->name('logout')->middleware('auth');
    Route::get('/logout', [loginController::class,'log']);

    // Resource Route of User,Category,Requirement
    Route::resource('/user', UserController::class);
    Route::resource('/category', CategoryController::class);
    Route::delete('multipleCategoryDelete', [CategoryController::class,'multipleDelete']);
    Route::resource('/requirement', RequirementController::class);
    
    // Filter Route
    Route::post('/filterStatus', [RequirementController::class,'changeStatus']);
    Route::post('/filterIsActive', [RequirementController::class,'changeIsActive']);
    Route::post('/search', [RequirementController::class,'searching']);
    
    // Profile Route
    Route::resource('/adminProfile', AdminProfileController::class);
});





// Front-end Route


    Route::view("/welcome", 'fronted.index');
    Route::view("/aboutus", 'fronted.about');
    
    // login & Rqgister user
    Route::get("/register",[RegisterController::class, 'show'])->name('register');
    Route::get("/login", [UserController::class,'home'])->name('login')->middleware('guest');
    Route::get('account/verify/{token}', [RegisterController::class, 'verifyAccount'])->name('user.verify');
    Route::post("/Register-insertdata", [RegisterController::class, 'store'])->name('Regitser.insertdata');
    Route::post("/userget", [UserController::class,'usercheck'])->name('useget')->middleware('guest');
    
    
    // Forgot password
    Route::get('/forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    
    // Giveit & Getit page
    Route::get('/giveit', [GiveitController::class,'index'])->name('giveit');
    Route::get('/getit', [GetitController::class,'index'])->name('getit');
    Route::get("/giveview-detail/{id}", [GiveitController::class,'show'])->name('giveviewdetail');
    Route::get("/getview-detail/{id}", [GetitController::class,'show'])->name('getitview');
    
  
    Route::group(['middleware' => ['auth']], function () {
        
    // Logout User
    Route::post("/logout", [UserController::class,'userLogout'])->name('userlogout');
    
    // Requirement 
    Route::get("/insertform", [RequirementController::class,'showinsert'])->name('insertform');
    Route::get("/required-data", [RequirementController::class,'display'])->name('required');
    Route::get("/Required-form", [AddRequirementController::class,'index'])->name('addform');
    Route::post("/Required/insert-data", [AddRequirementController::class,'storeRequirement'])->name('insertdata');
    Route::get("/Required/edit/{id}", [AddRequirementController::class,'edit'])->name('edit');
    Route::delete("/delete-Requirement/{id}", [AddRequirementController::class,'destroy'])->name('deleteRequirement');
    Route::post("/Required/update/{id}", [AddRequirementController::class,'update'])->name('update');
    Route::post('/add-to-favorite', [FavoriteController::class,'store'])->name('add-to-favorite');
    Route::get('/display-favorites', [FavoriteController::class,'show'])->name('displayfavorites');
    Route::delete("/delete/{id}", [FavoriteController::class,'delete'])->name('delete');
    Route::get("/editprofile", [UserProfileController::class,'edit'])->name('editprofile');
    Route::post("/User/update-profile", [UserProfileController::class,'update'])->name('userupdateprofile');
    Route::post("/User/update-password", [UserProfileController::class,'password'])->name('updatepassword');
});



    