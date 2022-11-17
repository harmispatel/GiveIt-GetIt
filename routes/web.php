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

    Route::get('/admin/login',[loginController::class,'index'])->name('loginform');
    Route::post('/admin/login',[loginController::class,'check'])->name('adminlogin');
    Route::get('/admin/registration',[RegistrationController::class,'index'])->name('registrationForm');
    Route::post('/admin/registration',[RegistrationController::class,'store'])->name('registration');
    

    //Forgot Password

    Route::get('/forgotPassword',[AdminForgotPasswordController::class,'index'])->name('forgotPassword');
    Route::post('/forgotPassword',[AdminForgotPasswordController::class,'submitForm'])->name('submitForm');
    Route::get('/resetPwd/{token}',[AdminForgotPasswordController::class,'resetPasswordForm'])->name('resetpassword');
    Route::post('/postResetPassword',[AdminForgotPasswordController::class,'submitResetPasswordForm'])->name('postResetPassword');


});

Route::group(['middleware' => ['auth']], function () {

    // Route::view('/admin/dashboard','welcome');
    
    Route::view('/admin/dashboard','welcome')->name('admin/dashboard');

    // Logout Route
    
    Route::post('/admin/logout', [loginController::class,'logout'])->name('logout');
    Route::get('/admin/logout', [loginController::class,'log']);
    
    // user Route
    Route::get('/admin/user', [UserController::class,'index'])->name('user.index');
    Route::post('/admin/user/store',[UserController::class,'store'])->name('user.store');
    Route::get('/admin/user/fetch-all',[UserController::class,'fetchAll'])->name('user.fetchAll');
    Route::get('/admin/user/edit',[UserController::class,'edit'])->name('user.edit');
    Route::post('/admin/user/update',[UserController::class,'update'])->name('user.update');
    Route::post('/admin/user/delete',[UserController::class,'delete'])->name('user.delete');  

    // Category Route
    Route::get('/admin/category', [CategoryController::class,'index'])->name('category.index');
    Route::post('/admin/category/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('/admin/category/fetch-all',[CategoryController::class,'fetchAll'])->name('category.fetchAll');
    Route::get('/admin/category/edit',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('/admin/category/update',[CategoryController::class,'update'])->name('category.update');
    Route::post('/admin/category/delete',[CategoryController::class,'delete'])->name('category.delete');

    // Requirement Route
    Route::get('/admin/requirement', [RequirementController::class,'index'])->name('requirement.index');
    Route::post('/admin/requirement/store', [RequirementController::class,'store'])->name('requirement.store');
    Route::get('/admin/requirement/fetch-all',[RequirementController::class,'fetchAll'])->name('requirement.fetchAll');
    Route::get('/admin/requirement/edit',[RequirementController::class,'edit'])->name('requirement.edit');
    Route::post('/admin/requirement/update',[RequirementController::class,'update'])->name('requirement.update');
    Route::post('/admin/requirement/delete',[RequirementController::class,'delete'])->name('requirement.delete');

    
    Route::delete('multipleCategoryDelete', [CategoryController::class,'multipleDelete']);
    // Filter Route
    Route::post('/filter',[RequirementController::class,'changeStatus']);

    
    // Profile Route
    Route::resource('/adminProfile', AdminProfileController::class);
});




// Front-end Route


    // Route::view("/welcome", 'fronted.index');
    Route::get('/', function () {
        // Update the user's profile...
    
        return redirect('/welcome');
    });
    Route::get("/welcome", [UserController::class,'main'])->name('welcome');

    Route::view("/aboutus", 'fronted.about');
    
    // login & Ragister user
    Route::get("/register",[RegisterController::class, 'show'])->name('register');
    Route::get("/login", [UserController::class,'home'])->name('login')->middleware('guest');
    Route::get('account/verify/{token}', [RegisterController::class, 'verifyAccount'])->name('user.verify');
    Route::post("/Register-insertdata", [RegisterController::class, 'store'])->name('Regitser.insertdata');
    Route::post("/userget", [UserController::class,'usercheck'])->name('useget')->middleware('guest');
    Route::post("/Model-login", [UserController::class,'login'])->name('modellogin')->middleware('guest');
    Route::post("/Giveit-search",[GiveitController::class,'search'])->name('giveit-search');
    Route::post("/Getit-search",[GetitController::class,'search'])->name('getit-search');
    
    // login with google
    Route::get('auth/google', [UserController::class, 'redirectToGoogle'])->name('google');
    Route::get('auth/google/callback', [UserController::class, 'handleGoogleCallback'])->name('google.callback');
   
    // login with facebook
    Route::get('auth/facebook', [UserController::class, 'redirectToFacebook'])->name('facebook');
    Route::get('auth/facebook/callback', [UserController::class, 'handleFacebookCallback'])->name('facebook.callback');

    // firebase witl login
    Route::post('auth/phone-otp/login', [UserController::class, 'firebase'])->name('login.otp');
   


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
