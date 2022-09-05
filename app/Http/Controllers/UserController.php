<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Request Class
use App\Http\Requests\{UserRequest,EditUserRequest,loginValidation};

// Models
use App\Models\User;

// Facades
use Illuminate\Support\Facades\Auth;

// Mail
use Mail;

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

        $users = User::where('user_type', '0')->paginate(10);
        return view('userList')->with('users', $users);
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

        return redirect()->route('user.index')->with('message', 'User added successfully!');
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
        return view('edit')->with('edituser', $editUser);
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
        return redirect()->route('user.index')->with('message', 'User updated successfully!');
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
        return redirect()->route('user.index')->with('msg', 'User deleted successfully!');
    }

   /**
     * Display a listing of frontend side login.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        // Open fronted side login page
        return view('fronted.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\loginValidation  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function usercheck(loginValidation $request)
    {
        $credentials = $request->only('email', 'password');
        $verify = User::Where('email', $request->email)
        ->WhereNotNull('email_verified_at')
        ->first();
        
        if (!empty($verify)) {
            if(Auth::attempt($credentials)){
                return redirect('welcome')->with('userlogin', 'login successfully');
            } else{
                return redirect('welcome')->with('userlogin', 'login successfully');
            }
            }else {
                return redirect('login')->with('mistake', 'Please Not Verify Email');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userLogout(Request $request)
    {
        //logout user fronted side
        auth()->logout();
        return redirect('login')->with('logout', 'You are logout');
    }
}
