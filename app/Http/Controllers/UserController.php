<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\loginValidation;

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

   public function check(loginValidation $request){

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            
            return redirect('require')->with('userlogin','login successfully'); 
        } else {
            
            return redirect('userlogin')->with('loginwrong','login unsuccessfully');
        }
    }
    public function userLogout(Request $request) 
    {
        
        auth()->logout();
        return redirect('userlogin')->with('logout','You are logout');
        // dd($request);
  
    }
}


