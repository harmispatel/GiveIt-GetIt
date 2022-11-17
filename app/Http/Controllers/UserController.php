<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Socialite
use Laravel\Socialite\Facades\Socialite;

// Exception;
use Exception;

// Request Class
use App\Http\Requests\{UserRequest,EditUserRequest,loginValidation};

// Models
use App\Models\User;

// Facades
use Illuminate\Support\Facades\Auth;

// Mail
use Mail;

// URL
use Illuminate\Support\Facades\URL;

// Validator
use Validator;

// Carbon
use Carbon\Carbon;

// Admin Side
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function main()
    {
        $user = Auth::user();
        return view('fronted.index', compact('user'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('userList');
    }


    //handle fetch all user ajax request
    public function fetchAll()
    {
        $emps = User::where('user_type', '0')->get();
        $output = '';
        if ($emps->count() > 0) {
            $output .='<table class="table table-striped table-sm text-center align-middle">
            <thead>
            <tr>
            <th>name</th>
            <th>E-mail</th>
            <th>Phone</th>
            <th>Address</th>
            <th>User_type</th>
            <th>status</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .='<tr>
                <td>'.$emp->name.'</td>
                <td>'.$emp->email.'</td>
                <td>'.$emp->mobile.'</td>
                <td>'.$emp->address.'</td>
                <td>'.(($emp->user_type == 0) ? 'User' : 'admin').'</td>
                
                <td>'.(($emp->status == 0) ? '<span class="badge bg-danger">InActive</span>' : '<span class="badge bg-success">Active</span>').'</td>
            
                <td>
                <a href="#" id="'.$emp->id.'" class="text-success mx-1 editIcon"
                data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i
                class="bi-pencil-square h4"></i></a>

                                        <a href="#" id="'.$emp->id.'" class="text-danger mx-1 deleteIcon">
                                        <i class="bi-trash h4"></i></a>

                                    </td>
                                    </tr>';
            }

            $output .='</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
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
    // handle insert user ajax  request
    public function store(UserRequest $request)
    {
            $input = $request->all();
            $input['email_verified_at'] = Carbon::now();
            $input['password'] = bcrypt($request->password);

           $user =  User::create($input);

           // Set the Response
           if (!empty($user)) {

            return response()->json([
                'status'  => 1,
                'message' => 'User created successfully.',
                'data'    => []
            ]);
           }else{

            return response()->json([
                'status'  => 0,
                'message' => 'Failed to craete the user.',
                'data'    => []
            ]);

           }
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
    // handle edit user ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = User::find($id);
        return response()->json($emp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\EditUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Handle Update User ajax request
    public function update(EditUserRequest $request)
    {
        // Update the User
        $input = $request->except(['_token', 'emp_id']);
        $emp = User::where('id', $request->emp_id)->update($input);
        
        // Set the Response
        if ($emp) {
            return response()->json([
                'status'  => 1,
                'message' => 'User updated successfully.',
                'data'    => []
            ]);
        } else {
            return response()->json([
                'status'  => 0,
                'message' => 'Failed to update the user.',
                'data'    => []
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = User::find($id)->delete($id);

        if($emp){
            return response()->json([
                'status' => 1,
                'message' => 'User deleted successfully',
                'data' => []
            ]);
        }else{
            return response()->json([
                'status' => 0,
                'message' => 'User deleted successfully',
                'data' => []
            ]);
        }
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
            if (Auth::attempt($credentials)) {
                return redirect('welcome')->with('userlogin', 'login successfully');
            } else {
                return redirect('login')->with('mistake', 'Please check Email and Password');
            }
        } else {
            return redirect('login')->with('mistake', 'Please Not Verify Email');
        }
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\loginValidation  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function login(loginValidation $request)
    {
        $credentials = $request->only('email', 'password');
        $verify = User::Where('email', $request->email)
        ->WhereNotNull('email_verified_at')
        ->first();
        if (!empty($verify)) {
            if (Auth::attempt($credentials)) {
                return redirect()->back()->with('userlogin', 'login successfully');
            } else {
                return redirect()->back()->with('mistake', 'Please check Email and Password');
            }
        } else {
            return redirect()->back()->with('mistake', 'Please Not Verify Email');
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
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function redirectToGoogle()
        {
            return Socialite::driver('google')->redirect();
        }

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function handleGoogleCallback()
        {
            try {
                $user = Socialite::driver('google')->user();
                
                $finduser = User::where('google_id', $user->id)->first();
        
                if($finduser){
        
                    Auth::login($finduser);
        
                    return redirect()->intended('welcome')->with('userlogin', 'login successfully');
        
                }else{
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                        'user_type' => 0,
                        'status' => 1,
                    ]);
        
                    Auth::login($newUser);
        
                    return redirect()->intended('welcome')->with('userlogin', 'login successfully');
                }
        
            } catch (Exception $e) {
                dd($e->getMessage());
            }
    }

      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
        
            $user = Socialite::driver('facebook')->user();
         
            $finduser = User::where('facebook_id', $user->id)->first();
        
            if($finduser){
         
                Auth::login($finduser);
        
                return redirect()->intended('welcome')->with('userlogin', 'login successfully');
         
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'user_type' => 0,
                    'status' => 1,
                ]);
        
                Auth::login($newUser);
        
                return redirect()->intended('welcome')->with('userlogin', 'login successfully');
            }
        
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function firebase(Request $request)
    {
        $credentials = $request->all();
        $finduser = User::where('mobile', $request->number)->first();
        // dd($finduser > 1);
        
       
        if($finduser){
            Auth::login($finduser);
            return response()->json([
                'status'  => 1,
                'message' => 'User login successfully.',
                'data'    => [$finduser]
            ]);
        }else{
            $newUser = User::create([
                    'mobile' => $request->number,
                    'user_type' => 0,
                    'status' => 1,
            ]);
            Auth::login($newUser);    
       
            return response()->json([
                'status'  => 1,
                'message' => 'User regiter successfully.',
                'data'    => [$newUser]
            ]);
        }  
        
    }
   



}
