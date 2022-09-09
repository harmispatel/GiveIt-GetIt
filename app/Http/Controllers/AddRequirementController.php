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
        // Insert New category
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
            // Insert Category Id
            $requirement->category_id = $request->category;
         }
         $requirement->requirements = $request->requirement;
         $requirement->quantity = $request->quantity;
         $requirement->user_id = $user_id;
         $requirement->price = $request->price;
         $requirement->media_id = $mediaAdd->id;
         $requirement->rent_date = $request->rentdate;
         $requirement->type = $request->Type;
         if($request->Type == 1)
         {
             $requirement->subtype = $request->givetype;
             
            }else{
                $requirement->subtype = $request->gettype;
            }
            if($request->givetype == 2){
                $requirement->price = isset($request->sellprice) ? $request->sellprice : NULL;
            }elseif($request->givetype == 3){
                $requirement->price = isset($request->rentprice) ? $request->rentprice : NULL;
            }else{

                $requirement->price = isset($request->price) ? $request->price : NULL;
            }
            

            $requirement->status	= 1;
 
            
               
            $requirement->save();
            
        return redirect('editprofile')->with('message','Inserted RequiredData Successfully');
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

        //Update Requirement Image 
       
        
         // Insert New Catagory
         $updateRequired = Requirement::find($id);
        if($request->category == 0)
        {
            $request->validate([
                'Addcategory' => 'required|unique:categories,name'
            ]);
            $categoryAdd = new  Category();
            $categoryAdd->name = isset( $cat_name) ?  $cat_name : '';
            $categoryAdd->status = 1;
            $categoryAdd->save();
            
            // Add New Category Id
            $updateRequired->category_id  = $categoryAdd->id;

            // Insert Image 
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
        }else{
            // Update Requirement Catgory 
            $updateRequired->category_id = $request->category;

            //Insert Image
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
            
            
        }
            $updateRequired->requirements = $request->requirement;
            $updateRequired->quantity = $request->quantity; 
            $updateRequired->type = $request->Type;

           // Update Type 
            if($request->Type == 1)
            {
                $updateRequired->subtype = $request->givetype;
            }else{
                $updateRequired->subtype = $request->gettype;
            }

            //Update SubType

                     if($request->givetype == 1){ 
                         $updateRequired->price = NULL;
                         $updateRequired->rent_date = NULL;
                         }elseif($request->givetype == 2){
                                    $updateRequired->price = $request->sellprice ;
                                    $updateRequired->rent_date = NULL;
                            }elseif($request->givetype == 3){
                                         $updateRequired->price = $request->rentprice;
                                         $updateRequired->rent_date = $request->rentdate;
                                 }elseif($request->gettype == 4){
                                            $updateRequired->price = NULL;
                                            $updateRequired->rent_date = NULL;
                                    }else{
                                            $updateRequired->price =$request->price;
                                            $updateRequired->rent_date = NULL;
                                          }
                              $updateRequired->status = $request->status;
                              $updateRequired->save();
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
        // Delete Requirement  
        
        $data = Requirement::find($id)->delete();  
        
        return back()->with('messagedelete','Deleted RequiredData Successfully');
    }
}
