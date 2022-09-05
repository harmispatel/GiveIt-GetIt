<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Models
use App\Models\{User,UserVerify};

//Requests
use App\Http\Requests\RegisterValidation;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use DB;

// use Illuminate\Database\QueryException;

class RegisterController extends Controller
{
    // Open Register page User

    public function show()
    {
        return view('fronted.Register');
    }

        public function store(Request $request)
        {
            // Insert Data user Fronted side
            try {
                $token = Str::random(10);
                $pass = bcrypt($request->password);
                $insertdata = new User();
                $insertdata->user_type = 0;
                $insertdata->status = 1;
                $insertdata->password = $pass;
                $insertdata->name =  $request->username;
                $insertdata->email   =  $request->email;
                $insertdata->mobile =  $request->number;
                $insertdata->address =  $request->address;
                $insertdata->email_token = $token;


                Mail::send(
                    'fronted.emailVerificationEmail',
                    ['token' => $token],
                    function ($message) use ($request) {
                        $message->from('harmistest@gmail.com');
                        $message->to($request['email']);
                        $message->subject('Email Verification');
                    }
                );
                $insertdata->save();
            } catch(Exception  $e) {
                return back()->with('mistake', 'Data has been Insert fail!');
            }
            return redirect('login')->with('msg', 'Email successfully');
        }
        public function verifyAccount($token)
        {
            $verifyEmail = DB::table('users')
        ->where([
          'email_token' => $token
          ])->first();
            if ($verifyEmail->email_token != "") {
                DB::table('Users')->where('email_token', $token)
                 ->update(['email_verified_at' => Carbon::now(),
                             'email_token' => null
        ]);
            }
            return redirect()->route('login')->with('msg', 'Email verifiy successfully');
        }
}
