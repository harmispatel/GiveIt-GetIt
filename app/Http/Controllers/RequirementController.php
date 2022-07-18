<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requirement;
use App\Http\Requests\StoreRequirement;
use App\Http\Requests\Insertrequirement;
use App\Http\Requests\EditValidation;
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

    
    public function storeRequirement(Insertrequirement  $request)
    {
          $user = auth()->User();
        if($request->category == 0){

            $categoryAdd = new  Category();
            $categoryAdd->name = isset($request->Addcategory) ? $request->Addcategory : ''    ;
            $categoryAdd->status = 1;
            $categoryAdd->save();
        }
            $user_id = $user['id'];
            $user_type = $user['user_type'];
            
            $requirement = new Requirement();
            if($request->category == 0){
                $requirement->category_id  = $categoryAdd->id;
            }else{
            $requirement->category_id  = $request->category;
            }
            $requirement->requirements = $request->requirement;
            $requirement->quantity = $request->quantity;
            $requirement->user_id = $user_id;
            $requirement->type = $user_type == '2' ? 1 : 2;
            $requirement->status	= $request->status;
            $requirement->is_active = $request->inlineRadioOptions;
            $requirement->save();
          
            return redirect('require')->with('message','Inserted Data Successfully');
    }
    public function display()
    {
        $data = Requirement::get();
         
        return view('fronted.requirements', compact('data'));
        
    }

    public function delete($id)
    {
        $data = Requirement::find($id)->delete();  
        
        return redirect('require')->with('messagedelete','Deleted Data Successfully');
    }
    public function edit($id)
    {
     // echo "hello";
     $categoryId = Category::get();
     $RequiredData = Requirement::find($id);
     return view('fronted.edit',compact('RequiredData','categoryId'));
 }
 public function update(EditValidation $request, $id)
 {
     $updateRequired = Requirement::find($id);
     $updateRequired->category_id  =  $request->category;
     $updateRequired->requirements = $request->requirement;
     $updateRequired->quantity = $request->quantity;
     $updateRequired->status	= $request->status;
     $updateRequired->is_active = $request->inlineRadioOptions;
   
     $updateRequired->save();
     return redirect('require')->with('updatedata','Update Data Successfully');
 
 }

}
    



