<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequirement;
use App\Http\Requests\Insertrequirement;
use App\Http\Requests\EditValidation;
use App\Models\Requirement;
use App\Models\User;
use App\Models\Category;

class RequirementController extends Controller
{
    //
    public function showinsert()
    {
        $categoryId = Category::get();

        return view('fronted.insertdatar',compact ('categoryId'));        
    }

    public function filterRequired(){

     
    }

    
    public function storeRequirement(Insertrequirement  $request)
    {
        $cat_name = $request->Addcategory;
        $categoryname =Category::where('name',$cat_name)->exists();
        $user = auth()->User();
        $user_id = $user['id'];
        $user_type = $user['user_type'];

        if($request->category == 0)
        {
            $request->validate([
                'Addcategory' => 'required|unique:categories,name'
            ]);

            $categoryAdd = new  Category();
            $categoryAdd->name =isset( $cat_name) ?  $cat_name : '';
            $categoryAdd->status = 1;
            $categoryAdd->save();
            
            $requirement = new Requirement();
            $requirement->category_id  = $categoryAdd->id;
            $requirement->requirements = $request->requirement;
            $requirement->quantity = $request->quantity;
            $requirement->user_id = $user_id;
            $requirement->type = $user_type == '2' ? 1 : 2;
            $requirement->status	= 1;
            // $requirement->is_active = $request->inlineRadioOptions;
            $requirement->save();
            
        
        }
        else
        {
            $requirement = new Requirement();
            $requirement->category_id  = $request->category;
            $requirement->requirements = $request->requirement;
            $requirement->quantity = $request->quantity;
            $requirement->user_id = $user_id;
            $requirement->type = $user_type == '2' ? 1 : 2;
            $requirement->status	= 1;
            // $requirement->is_active = $request->inlineRadioOptions;
            $requirement->save();
        }
          
        return redirect('required')->with('message','Inserted RequiredData Successfully');
    }

    public function display()
    {
        $data = Requirement::get();
         
        return view('fronted.requirements', compact('data'));
        
    }

    public function delete($id)
    {
        $data = Requirement::find($id)->delete();  
        
        return redirect('required')->with('messagedelete','Deleted RequiredData Successfully');
    }


    public function edit($id)
    {
    
     $categoryId = Category::get();
     $RequiredData = Requirement::find($id);
     return view('fronted.edit',compact('RequiredData','categoryId'));
    }


    public function update(EditValidation $request, $id)
    {    
        $cat_name = $request->Addcategory;
        $categoryname =Category::where('name',$cat_name)->exists();
        $user = auth()->User();
        $user_id = $user['id'];
        $user_type = $user['user_type'];

        if($request->category == 0)
        {
            $request->validate([
                'Addcategory' => 'required|unique:categories,name'
            ]);
        
       

            $categoryAdd = new  Category();
            $categoryAdd->name = isset( $cat_name) ?  $cat_name : '';
            $categoryAdd->status = 1;
            $categoryAdd->save();
            
            
            $updateRequired = Requirement::find($id);
            
            $updateRequired->category_id  = $categoryAdd->id;
            $updateRequired->requirements = $request->requirement;
            $updateRequired->quantity = $request->quantity;
            $updateRequired->status	= $request->status;
            // $updateRequired->is_active = $request->inlineRadioOptions;
            $updateRequired->save();
        }
            else
            {
                $updateRequired = Requirement::find($id);
                
                $updateRequired->category_id  = $request->category;
                $updateRequired->requirements = $request->requirement;
                $updateRequired->quantity = $request->quantity;
                $updateRequired->status	= $request->status;
                // $updateRequired->is_active = $request->inlineRadioOptions;
                $updateRequired->save();
            }
           
    
        return redirect('required')->with('updatedata','Update RequiredData Successfully');
    
    }
}