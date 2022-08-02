<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

// Models
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function index(){
        return view('registration');
    }

    public function store(Request $request){
        
        // $pass = bcrypt($request->password);
            $insertData = new User();
            $insertData->name =  $request->name;
            $insertData->email =  $request->email;
            $insertData->mobile =  $request->mobile;
            $insertData->address =  $request->address;
            $insertData->user_type =  $request->user_type; 
            $insertData->password = Hash::make($request->password);
            $insertData->status = $request->status;
            // dd($insertData->status);
            $insertData->save();

            return redirect('/login');
            //   dd( $insertData->password )
    }
}
