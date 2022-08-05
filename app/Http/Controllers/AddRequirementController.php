<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Requests
use App\Http\Requests\{StoreRequirement, Insertrequirement, EditValidation};

//Models
use App\Models\{Requirement, User, Category, Media};

//Facades
use Illuminate\Support\Facades\File;

class AddRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show Insert Requirement Form
        $categoryId = Category::get();

        return view('fronted.addrequiment',compact ('categoryId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Insertrequirement  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRequirement(Insertrequirement $request)
    {
        //Insert Requirement Data

        $cat_name = $request->Addcategory;
        $categoryname =Category::where('name',$cat_name)->exists();
        $user = auth()->User();
        $user_id = $user['id'];
        $user_type = $user['user_type'];
        
      //Image Insert Media Models 

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

         $requirement->price = $request->price;
         $requirement->media_id = $mediaAdd->id;
         $requirement->type = $user_type == 1 ? 1 : 2;
         $requirement->status	= 1;
         $requirement->save();
          
        return redirect('welcome')->with('message','Inserted RequiredData Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $data = Requirement::with('media','categories',)->get();
    
        return view('fronted.display', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Show EditRequirement Form

        $categoryId = Category::get();
        $mediaData = Media::get();
        $RequiredData = Requirement::find($id);
        return view('fronted.edit',compact('RequiredData','categoryId','mediaData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\EditValidation  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditValidation $request, $id)
    {
        //Update Requirement Data

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

           
    
        return redirect('editprofile')->with('updatedata','Update RequiredData Successfully');
    
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Requirement  

        $data = Requirement::find($id)->delete();  
        
        return redirect('editprofile')->with('messagedelete','Deleted RequiredData Successfully');
    }
}
