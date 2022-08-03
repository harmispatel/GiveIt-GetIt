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

   public function check(LoginValidationRequest $request){

        // Only Admin Login
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            return redirect('common.layout'); 
        } else {
          
            return redirect('loginform');
        }


        // if (Auth::attempt($credentials)) {
            
        //     return view('welcome'); 
        // } else {
          
        //     return view('login');
        // }
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('loginform');
    }

    public function log(){
        return redirect('home');
    }

    
}
