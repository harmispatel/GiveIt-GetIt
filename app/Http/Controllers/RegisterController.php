<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterValidation;

class RegisterController extends Controller
{
    //

    public function show()
    {
         return view('fronted.Register');
    }
   
        public function store(RegisterValidation $request)
        {
            // $input = $request->all(); 
        
            $pass = bcrypt($request->password);
            $insertdata = new User();
            $insertdata->name =  $request->username;
            $insertdata->email =  $request->email;
            $insertdata->mobile =  $request->number;
            $insertdata->address =  $request->address;
             $insertdata->status = 1;
            $insertdata->user_type = $request->user_type;
        
            $insertdata->password = $pass;
            //   dd( $insertdata->password )
        
            $insertdata->save();
             

            return redirect('userlogin')->with('msg','Register successfully');
        }
            
 }
