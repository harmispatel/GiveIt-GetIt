<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\{Requirement, User, Category, Media};

// Facades
use Illuminate\Support\Facades\Auth;


// Request Class
use App\Http\Requests\{ProfileValidation, ChangepasswordValidation};


class UserprofileController extends Controller
{

    /**
     * Display the User Profile
     *
     */
    public function edit()
    {
        // Get the Authenticated User and requirement details
        $user = Auth::user();
        $required = Requirement::with('user','categories')->where('user_id','=',Auth::user()->id)->paginate(10);
        
        return view('fronted.profile', compact('user','required'));
    }

    /**
     * Update the User Prfile
     *
     * @param \App\Http\Requests\ProfileValidation $request
     */
    public function update(ProfileValidation $request)
    {
        // Update the Authenticated User details
        $user = Auth::user();
        $request->validate([
            'email' =>  'unique:users,email,'.$user->id,
            // 'password'=>'required|min:6',
            // 'password_confirmation' =>'required_with:password|same:password|min:6'
        ]);
        
        
        
        $user->name = $request->username;
        $user->email = $request->email;
        $user->mobile = $request->number;
        $user->address = $request->address;
        
        $user->save();
        
        return redirect('editprofile');
    }

     public function show(){

        return view('fronted.password');
     }
   



    public function password(ChangepasswordValidation $request)
    { 
        $user = Auth::user();
      
 
        $pass = bcrypt($request->password);
        $user->password = $pass;
        $user->save();

    return redirect('editprofile')->with('updatepassword','Update password Successfully');
    }
     
}
