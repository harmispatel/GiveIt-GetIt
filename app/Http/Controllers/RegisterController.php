<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Models
use App\Models\User;

//Requests
use App\Http\Requests\RegisterValidation;

class RegisterController extends Controller
{
     
    // Open Register page User 
    public function show()
    {
         return view('fronted.Register');
    }
   
        public function store(RegisterValidation $request)
        {
            // Insert Data user Fronted side
        
            $pass = bcrypt($request->password);
            $insertdata = new User();
            $insertdata->name =  $request->username;
            $insertdata->email =  $request->email;
            $insertdata->mobile =  $request->number;
            $insertdata->address =  $request->address;
             $insertdata->status = 1;
            $insertdata->user_type = 0;
            $insertdata->password = $pass;
            
            $insertdata->save();
            return redirect('userlogin')->with('msg','Register successfully');
        }
 }
