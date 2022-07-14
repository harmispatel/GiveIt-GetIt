<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
   



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('fronted.login');
        
    }

   public function check(Request $request){

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            
            return redirect('require'); 
        } else {
            
            return redirect('userlogin');
        }
    }
    public function userLogout(Request $request) 
    {
        
        auth()->logout();
        return view('fronted.login');
        // dd($request);
  
    }
}


