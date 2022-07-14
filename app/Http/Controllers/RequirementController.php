<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requirement;
use App\Http\Requests\StoreRequirement;
use App\Models\User;
use App\Models\Category;

class RequirementController extends Controller
{
    //
    public function showinsert()
    {
        //
        $categoryId = Category::get();
        // $User = User::get();
        // $user = auth()->User();
        // dd($user);print_r;

// dd($User); print_r;
        return view('fronted.insertdatar',compact ('categoryId'));
        
        
    }

    
    public function storeRequirement(Request  $request)
    {
    //    dd($user);print_r;


             $user = auth()->User();
             $user_id = $user['id'];
             $user_type = $user['user_type'];
            //    echo"<pre>"; print_r ($user_type); exit;
            $requirement = new Requirement();
            $requirement->category_id  =  $request->category;
            $requirement->requirements = $request->requirement;
            $requirement->quantity = $request->quantity;
            $requirement->user_id = $user_id;
            $requirement->type = $user_type;
            $requirement->status	= $request->status;
            $requirement->is_active = $request->inlineRadioOptions;

            // dd($requirement);print_r;
          
            $requirement->save();
            

            return view('fronted.requirements');
    }
}
