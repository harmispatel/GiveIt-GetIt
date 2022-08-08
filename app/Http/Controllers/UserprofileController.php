<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\{Requirement, User, Category, Media};

// Facades
use Illuminate\Support\Facades\Auth;


// Request Class
use App\Http\Requests\ProfileValidation;

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
        $required = Requirement::with('user','categories')->where('user_id','=',Auth::user()->id)->get();
        
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
            'email' =>  'unique:users,email,'.$user->id
        ]);
        
        $user->name = $request->username;
        $user->email = $request->email;
        $user->mobile = $request->number;
        $user->address = $request->address;
        $user->save();

        return redirect('editprofile');
    }
     
}
