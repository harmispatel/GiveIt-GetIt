<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\{Requirement, User, Category, Media};

// Facades
use Illuminate\Support\Facades\Auth;

// Requests
use App\Http\Requests\ProfileValidation;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
        $user = Auth::user();
        
        return view('fronted.profile',compact ('user'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        
        
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProfileValidation  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileValidation $request)
    {
        // Update User Data Profile
        $updateuser = Auth::user(); 
        
        $updateuser->name = $request->username;
        $updateuser->email = $request->email;
        $updateuser->mobile = $request->number;
        $updateuser->address = $request->address;
       
        $updateuser->save();

        return view('fronted.profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
