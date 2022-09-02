<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Request Class
use App\Http\Requests\{UserRequest,EditUserRequest,loginValidation};

// Models
use App\Models\User;
use Exception;
// Facades
use Illuminate\Support\Facades\Auth;


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
        try{

            $users = User::where('user_type','0')->paginate(10);
            
        }catch(Exception $e){
            return back()->with('mistake','An error occurred while you are trying to add new User.! Please try again.');
        }
        return view('userList')->with('users',$users);
        
        // $users = User::all();
        // return view('userList')->with('users',$users);
       
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
        try{
            
            $createUser = new User();
            $createUser->name = $request->name;
            $createUser->email = $request->email;
            $createUser->mobile = $request->mobile;
            $createUser->address = $request->address;
            $createUser->user_type = $request->user_type;
            $createUser->password = $request->password;
            $createUser->status = $request->status;
            $createUser->save();
        }catch(Exception $e){

            return back()->with('mistake','An error occurred while you are trying to add new User.! Please try again.');

        }
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
        try{

            $editUser = User::find($id);
            $editUser->name = $request->name;
            $editUser->email = $request->email;
            $editUser->mobile = $request->mobile;
            $editUser->address = $request->address;
            $editUser->user_type = $request->user_type;
            $editUser->status = $request->status;
            
            $editUser->save();
        }catch(Exception $e){
            
            return back()->with('mistake','An error occurred while you are trying to update new User.! Please try again.');
        }
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
        try {
            
            $delete = User::find($id)->delete();
        } catch (Exception $e) {

            return back()->with('mistake','An error occurred while you are trying to delete User.! Please try again.');
        } 
        return redirect()->route('user.index')->with('msg','User deleted successfully!'); 
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


