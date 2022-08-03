<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Request Class
use App\Http\Requests\{UserRequest,EditUserRequest,loginValidation};

// Models
use App\Models\User;

// Facades
use Illuminate\Support\Facades\Auth;


// Admin Side
class UserController extends Controller
{
<<<<<<< HEAD
    
=======
   

>>>>>>> c2ea4ea21a7d2cc3d3e322117abeecfd5460670f
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        // Open user list
        $users = User::all();
        return view('userList')->with('users',$users);
        
=======
        $users = User::all();
        return view('userList')->with('users',$users);
       
>>>>>>> c2ea4ea21a7d2cc3d3e322117abeecfd5460670f
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Open Create User Form

        return view('createUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // Insert Create User Data

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
        // Open User Edit Form 

        $editUser = User::find($id);
<<<<<<< HEAD
=======
      
>>>>>>> c2ea4ea21a7d2cc3d3e322117abeecfd5460670f
        return view('edit')->with('edituser',$editUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\EditUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        // Update User

        $editUser = User::find($id);
        $editUser->name = $request->name;
        $editUser->email = $request->email;
        $editUser->mobile = $request->mobile;
        $editUser->address = $request->address;
        $editUser->user_type = $request->user_type;
        $editUser->status = $request->status;
        
        $editUser->save();
        return redirect()->route('user.index')->with('message','User updated successfully!');
<<<<<<< HEAD
        
=======
       

        return view('edit');
>>>>>>> c2ea4ea21a7d2cc3d3e322117abeecfd5460670f
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 
    public function destroy($id)
    {
<<<<<<< HEAD
        // Delete User
=======
>>>>>>> c2ea4ea21a7d2cc3d3e322117abeecfd5460670f
        
        $delete = User::find($id)->delete();
        return redirect()->route('user.index');

<<<<<<< HEAD
        // return view('fronted.login');
=======
        // return view('userList');

        
        
    }
  

   //frontend side login
     
    public function home()
    { 
        //open fronted side login page

        return view('fronted.login');
>>>>>>> c2ea4ea21a7d2cc3d3e322117abeecfd5460670f
        
    }
  

<<<<<<< HEAD

    // Front_end Side
   public function check(loginValidation $request){

=======
   public function check(loginValidation $request)
   {
        
        // User Authentication 
>>>>>>> c2ea4ea21a7d2cc3d3e322117abeecfd5460670f
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


