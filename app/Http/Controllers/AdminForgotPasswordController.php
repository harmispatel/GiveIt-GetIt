<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\models\User;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class AdminForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // Open Forgot Password Form
        return view('adminForgotPassword');
    }

   public function submitForm(Request $request){
        // dd('hello');
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(10);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

          Mail::send('AdminSendEmail', ['token' => $token],function($message) use($request)
          {
            $message->from('harmistest4@gmail.com');
              $message->to($request['email']);
              $message->subject('Reset Password');
          });

          return back()->with('message', 'We have e-mailed your password reset link!');
   }

   public function resetPasswordForm($token){
  
        return view('AdminForgetPasswordLink',['token' => $token]);
    
   }

   public function submitResetPasswordForm(Request $request){
   
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
                      
                              return redirect(route('loginform'))->with('message', 'Your password has been changed!');
   }
}
