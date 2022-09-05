<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if (Auth::user()) {
            return redirect()->back();
       }else{
           return view('login');       
       }
    }

   public function check(LoginValidationRequest $request){

        // Only Admin Login
        $user = $request->only('email', 'password');
        $user['user_type'] = 1;
        $credentials = $user;
        
        if (Auth::attempt($credentials)) {

            $value = $request->session()->put('admin',Auth::user()->name);
            // $userCount = count(User::where('user_type','0')->get());
            // return view('welcome',compact('userCount'));
            // return redirect('/admin/dashboard');
            return view('welcome');

        }else{
            // return redirect('login');
            return redirect()->route('loginform');
        }

    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('loginform');
    }

    public function log(){
        return redirect()->route('loginform');
    }

}
