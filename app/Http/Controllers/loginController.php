<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\loginValidation;


class loginController extends Controller
{
    //

      public function loginshow()
      {
        return view('fronted.login');
      }
      public function checklogin(loginValidation $request)
      {
        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
               dd('hello');
                // return view('welcome'); 
            } else {
                dd('hii');
                // return view('login');
      }
}
}
