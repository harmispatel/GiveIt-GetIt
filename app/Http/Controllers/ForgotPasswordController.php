<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\models\User;
use Hash;
use DB;

class ForgotPasswordController extends Controller
{
    //
     /**
       * Write code on show Forgetpassword Form
       *
       * @return response()
       */
      public function showForgetPasswordForm(Request $request)
      {
         return view('fronted.forgetPassword');

      }
  
      /**
       * Write code on check User Email Authenticated 
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);
  
          $token = Str::random(10);

          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);


          
          Mail::send('fronted.email', ['token' => $token], 
          
          function($message) use($request)
          {
            $message->from('harmistest4@gmail.com');
              $message->to($request['email']);
              $message->subject('Reset Password');
          });
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Send User Email Forget Password Link 
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
         return view('fronted.forgetPasswordLink', ['token' => $token]);
      }
  
      /**
       * Write code on User Reset Password 
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
            
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword)
          {
              return back()->withInput()->with('error', 'Invalid token!');
          }

               // User Update Password
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/userlogin')->with('message', 'Your password has been changed!');
}
}
