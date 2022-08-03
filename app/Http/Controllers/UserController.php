<?php

namespace App\Http\Controllers;

// Request Class
use App\Http\Requests\{UserRequest,EditUserRequest};
use Illuminate\Http\Request;

// Models
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\loginValidation;


// Admin Side
class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Open user list
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 
    public function destroy($id)
    {
        // Delete User
        
        $delete = User::find($id)->delete();
        return redirect()->route('user.index');

        // return view('fronted.login');
        
    }
  


    // Front_end Side
   public function check(loginValidation $request){

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            
            return redirect('home')->with('userlogin','login successfully'); 
        } else {
            
            return redirect('userlogin')->with('loginwrong','Please check EmailId and Password');
        }
    }
    public function userLogout(Request $request) 
    {
                
        auth()->logout();
        return redirect('userlogin')->with('logout','You are logout');
        
  
    }
}


