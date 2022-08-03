<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Request Class
use App\Http\Requests\{UserRequest,EditUserRequest,loginValidation};

// Models
use App\Models\User;

// Facades
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('userList')->with('users',$users);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('createUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        
        $createUser = new User();
        $createUser->name = $request->name;
        $createUser->email = $request->email;
        $createUser->mobile = $request->mobile;
        $createUser->address = $request->address;
        $createUser->user_type = $request->user_type;
        $createUser->password = $request->password;
        $createUser->status = $request->status;
        $createUser->save();

        return redirect()->route('user.index')->with('message','User added successfully!');

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
    public function edit($id)
    {
        $editUser = User::find($id);
      
        return view('edit')->with('edituser',$editUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        
        $editUser = User::find($id);
        $editUser->name = $request->name;
        $editUser->email = $request->email;
        $editUser->mobile = $request->mobile;
        $editUser->address = $request->address;
        $editUser->user_type = $request->user_type;
        $editUser->status = $request->status;
        
        $editUser->save();
        return redirect()->route('user.index')->with('message','User updated successfully!');
       

        return view('edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function createAdmin(){
        return view('careateAdmin');
    }

    

    public function destroy($id)
    {
        
        $delete = User::find($id)->delete();
        return redirect()->route('user.index');

        // return view('userList');

        
        
    }
  

   //frontend side login
     
    public function home()
    { 
        //open fronted side login page

        return view('fronted.login');
        
    }
  

   public function check(loginValidation $request)
   {
        
        // User Authentication 
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials))
         {             
            return redirect('welcome')->with('userlogin','login successfully'); 
        } else {
            
            return redirect('userlogin')->with('loginwrong','Please check EmailId and Password');
        }
    }

    
    public function userLogout(Request $request) 
    {
        //logout user fronted side
        
        auth()->logout();
        return redirect('userlogin')->with('logout','You are logout');
        
  
    }
}


