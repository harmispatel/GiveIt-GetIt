<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidationRequest;
use App\Http\Requests\UserValidationRequest;
use Illuminate\Support\Facades\Auth;
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

    //LoginValidationRequest
    
   public function check(LoginValidationRequest $request){
       $credentials = $request->only('email', 'password');
    //    dd(Auth::attempt($credentials));

       if (Auth::attempt($credentials)) {
        //    dd('hello');
            return view('welcome'); 
        } else {
            // dd('hii');
            return view('login');
        }
    }

    public function logout(Request $request){
        auth()->logout();
        return redirect()->route('loginform');
    }
}
