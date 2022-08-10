<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Request
use App\Http\Requests\ProfileValidation;
// Model
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AdminProfile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('AdminChangePassword');
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
       
    }

    /**
     * Update the specified resource in storage.    
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if ($request->has('password')) {
            
            if ($request->password === $request->confirmPassword) {
                $changePassword = User::Find($id);
                $changePassword->password = Hash::make($request->password);
                $changePassword->save();
    
                return view('welcome')->with('message','Change Password successfully!');
            }else{
                return view('AdminChangePassword')->with('msg',"Password and Confirm Password are not Same");
            }
        }else{
            
            // if ($request->has('username')) {
                
                $userModel = User::find($id);
                $userModel->name = $request->username;
                $userModel->email = $request->email;
                $userModel->mobile = $request->number;
                $userModel->address = $request->address;
                $userModel->save();
        
                return view('welcome')->with('message','Profile Updated successfully!');
            // }
        }

        
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
