<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\loginValidation;
use Auth;



class loginController extends Controller
{
    //

      public function loginshow()
      {
        return view('fronted.login');
      }
      public function checklogin(loginValidation $request)
      {
        // dd($request);
        $credentials = $request->only('email','password');
          //  dd($credentials);
        if (Auth::attempt($credentials)) {
              //  echo "hii";
                return view('fronted.requirements'); 
            } else{
                // echo'hello';
                return view('fronted.login');
      }
}
     public function logout(Request $request)
     {

     }

}
