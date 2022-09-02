<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Models
use App\Models\User;

//Requests
use App\Http\Requests\RegisterValidation;
use Exception;
// use Illuminate\Database\QueryException;

class RegisterController extends Controller
{
     
    // Open Register page User 
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function show()
    {
         return view('fronted.Register');
    }
   
        public function store(Request $request)
        {
            // Insert Data user Fronted side
        
            try{
                $pass = bcrypt($request->password);
                $insertdata = new User();
                $insertdata->name =  $request->username;
                $insertdata->email   =  $request->email;
                $insertdata->mobile =  $request->number;
                $insertdata->address =  $request->address;
                $insertdata->status = 1;
                $insertdata->user_type = 0;
                $insertdata->password = $pass;
                
              $insertdata->save();
            }catch(Exception  $e)
            {
                return back()->with('mistake','Data has been Insert fail!');
            }
            return redirect('userlogin')->with('msg','Register successfully');
            
        }
    }