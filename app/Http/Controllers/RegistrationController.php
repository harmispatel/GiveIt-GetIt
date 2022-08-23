<?php

namespace App\Http\Controllers;

// Request
use Illuminate\Http\Request;

// Models
use App\Models\{User, Registration};

// Facades
use Illuminate\Support\Facades\Hash;


// Admin Side

class RegistrationController extends Controller
{
    public function index()
    {   
        //  Open Registration Form

        return view('registration');
    }
    public function store(Request $request)
    {
        // Save User Registration 
        
            $insertData = new User();
            $insertData->name =  $request->name;
            $insertData->email =  $request->email;
            $insertData->mobile =  $request->mobile;
            $insertData->address =  $request->address;
            $insertData->user_type =  0 ; 
            $insertData->password = Hash::make($request->password);
            $insertData->status = $request->status;
            
            $insertData->save();
            return redirect('/login');     
    }
}
