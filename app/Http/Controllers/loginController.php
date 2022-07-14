<?php

namespace App\Http\Controllers;
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

   public function checklogin(Request $request){

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            return redirect('welcome'); 
        } else {
          
            return redirect('loginform');
        }
    }
    public function logout(Request $request) {
    Auth::logout();
    return redirect('/login');
}
}