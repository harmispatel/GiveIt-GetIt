<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Requirement, User, Category, Media};
use Illuminate\Support\Facades\Auth;
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
    public function create()
    {
        //
    }

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
        // $user = auth()->User();
      
  
        // return view('fronted.profile',compact ('user'));

     
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileValidation $request)
    {
        //
        $updateuser = Auth::user(); 
        
        $updateuser->name = $request->username;
        $updateuser->email = $request->email;
        $updateuser->mobile = $request->number;
        $updateuser->address = $request->address;
        // echo "<pre>";
        // print_r($updateuser->id);
        // exit;
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
