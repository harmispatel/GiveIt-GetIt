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
        //
        return view('login');
        
    }

   public function check(LoginValidationRequest $request)
   {
        // Only Admin Login
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
<<<<<<< HEAD
            return view('welcome'); 
=======

            return redirect('common.layout'); 
>>>>>>> c2ea4ea21a7d2cc3d3e322117abeecfd5460670f
        } else {
          
            return redirect('loginform');
        }

    }

    public function logout(Request $request)
    {
        // Admin Logout
        Auth::logout();
        return redirect()->route('loginform');
    }

    public function log()
    {
        // Does not open Login Form 
        
        return redirect('home');
    }
   
}
