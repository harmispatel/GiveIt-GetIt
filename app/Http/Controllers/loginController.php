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
       
        return view('login');       
    }

   public function check(LoginValidationRequest $request){

        // Only Admin Login
        $user = $request->only('email', 'password');
        $user['user_type'] = 1;
        $credentials = $user;
        if (Auth::attempt($credentials)) {

            $value = $request->session()->put('admin',Auth::user()->name);
            return redirect('home1');

        }else{
            return redirect('login');
        }

    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('loginform');
    }

    public function log(){
        return redirect('home');
    }

    
}
