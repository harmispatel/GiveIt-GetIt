<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Request Class
use App\Http\Requests\{StoreRequirement, Insertrequirement, EditValidation};

// Models
use App\Models\{Requirement, User, Category, Media};

// Facades
use Illuminate\Support\Facades\File;

// Traits
use App\Traits\ImageTrait;

class RequirementController extends Controller
{
    //
     use ImageTrait;
    public function showinsert()
    {
        $categoryId = Category::get();

        return view('fronted.insertdatar',compact ('categoryId'));        
    }
    
    public function storeRequirement(Insertrequirement  $request)
    { 
        $cat_name = $request->Addcategory;
        $categoryname =Category::where('name',$cat_name)->exists();
        $user = auth()->User();
        $user_id = $user['id'];
        $user_type = $user['user_type'];
        $mediaAdd = new Media();
        
        if($request->hasfile('media')){
            $file= $request->file('media');
            $original_file_name =$request->media->getClientOriginalName();
            $image_mimetype = $request->media->getClientMimeType();
            $image_name   = time().'_'.$request->media->getClientOriginalName();
            $image_path = public_path(). Requirement::FILE_PATH;
            request()->media->move($image_path, $image_name);
        
            $mediaAdd->name = $image_name;
            $mediaAdd->path = Requirement::FILE_PATH . $image_name;
            $mediaAdd->original_name = $original_file_name;
            $mediaAdd->mime_type = $image_mimetype;
            
            $mediaAdd->save();
         }
    
            
        // if ($request->hasfile('media')) {
        //     $uploadedFile = $this->saveImage($request->media['path'], Requirement::FILE_PATH);  
        // }

        $requirement = new Requirement();
        if($request->category == 0)
        {
            $request->validate([
                'Addcategory' => 'required|unique:categories,name'
            ]);
            
            $categoryAdd = new  Category();
            $categoryAdd->name = isset($cat_name) ?  $cat_name : '';
            $categoryAdd->status = 1;
            $categoryAdd->save();
            
            $requirement->category_id  = $categoryAdd->id;    
        } else {
            $requirement->category_id = $request->category;
        }

        $requirement->requirements = $request->requirement;
        $requirement->quantity = $request->quantity;
        $requirement->user_id = $user_id;
        $requirement->media_id = $mediaAdd->id;
        $requirement->type = $user_type == 1 ? 1 : 2;
        $requirement->status	= 1;
        $requirement->save();
          
        return redirect('required')->with('message','Inserted RequiredData Successfully');
    }

    public function display()
    {
        $data = Requirement::with(['media'])->get();
    
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
     $mediaData = Media::get();
     $RequiredData = Requirement::find($id);
     return view('fronted.edit',compact('RequiredData','categoryId','mediaData'));
    }


    public function update(EditValidation $request, $id)
    {    
        // dd($request->toArray());
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
            $updateRequired->save();
        }
        else
        {
            $updateRequired = Requirement::find($id);    
                $updateRequired->category_id  = $request->category;
                $updateRequired->requirements = $request->requirement;
                $updateRequired->quantity = $request->quantity;
                $mediaAdd = new Media();
        
                if($request->hasfile('media')){
                    $file= $request->file('media');
                    $original_file_name =$request->media->getClientOriginalName();
                    $image_mimetype = $request->media->getClientMimeType();
                    $image_name   = time().'_'.$request->media->getClientOriginalName();
                    $image_path = public_path(). Requirement::FILE_PATH;
                    request()->media->move($image_path, $image_name);
                    
                    $mediaAdd->name = $image_name;
                    $mediaAdd->path = Requirement::FILE_PATH . $image_name;
                    $mediaAdd->original_name = $original_file_name;
                    $mediaAdd->mime_type = $image_mimetype;
                    
                    $mediaAdd->save();
                    $updateRequired->media_id = $mediaAdd->id;
                }
                $updateRequired->status	= $request->status;
                $updateRequired->save();
            }

           
    
        return redirect('required')->with('updatedata','Update RequiredData Successfully');
    
    }
}