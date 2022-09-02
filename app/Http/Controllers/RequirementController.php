<?php

namespace App\Http\Controllers;

// Request Class
use App\Http\Requests\{RequirementRequest,EditRequirementRequest, Insertrequirement, EditValidation};

// Models
use App\Models\{Category, User, Requirement, Media};
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mockery\Undefined;

// Admin Side

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show Requirement List
        try{

            $requirementsData = Requirement::all();
            $categoryName = Category::with(['category']);

        }catch(Exception $e){
            return back()->with('mistake','An error occurred while you are trying to show Requirements.! Please try again.');
        }
        return view('requirements',compact('requirementsData','categoryName'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Add new Requirement Form
        try{

            $categoryId = Category::get();
            $userId = User::get();

        }catch(Exception $e){

            return back()->with('mistake','An error occurred while you are trying to add new Requirements form.! Please try again.');
        }
        return view('addRequirement',compact('categoryId','userId'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // Validate Request
        try{

            $request->validate([
                'media' => 'required',
                'category_id' => 'required',
                'requirement' => 'required',
                'quantity' => 'required | numeric | min:1',
                'type' => 'required',
            ]);
    
            // Insert new Requirement 
            $cat_name = $request->Addcategory;
            $user = auth()->User();
            $user_id = $user['id'];
            $user_type = $user['user_type'];
            $userData = User::get();
    
            // Insert Image
            $mediaObj = new Media();
            if ($request->has('media')) {
                
                $file = $request->media;
                $originalName = $file->getClientOriginalName();
                $image_mimetype = $file->getClientMimeType();
                $image_name = time().'_'.$originalName;
                $image_path = public_path(). Requirement::FILE_PATH;
                $request->media->move($image_path,$image_name);
                
                $mediaObj->name = $image_name;
                $mediaObj->path = Requirement::FILE_PATH . $image_name;
                $mediaObj->original_name = $originalName;
                $mediaObj->mime_type = $image_mimetype;
                
                $mediaObj->save();
                    
            } 
           
            $requirementObj = new Requirement();
    
            // Add new Category and Stored in Categories table
            if ($request->category_id == 0) {
    
                $request->validate([
                    'Addcategory' => 'required|unique:categories,name'
                ]);
    
                //Add new category in categories table
                $categoryAdd = new  Category();
                $categoryAdd->name = isset($cat_name) ?  $cat_name : '';
                $categoryAdd->status = 1;
                $categoryAdd->save();
                
                // Add category_id if new category
                $requirementObj->category_id  = $categoryAdd->id;  
    
            }else {
                // Add category_id if already exist category
                $requirementObj->category_id = $request->category_id;
            }
    
    
            $requirementObj->requirements = $request->requirement;
            $requirementObj->quantity = $request->quantity;
            $requirementObj->user_id = $user_id;
            $requirementObj->media_id = $mediaObj->id;
            $requirementObj->status = 1;
            // $requirementObj->is_active = $request->is_active;
    
            // type: Giveit, Getit
            $requirementObj->type = $request->type;
          
            // subtype: giveItType, getItType
            if ($request->type = 1) {
    
                $requirementObj->subtype = $request->giveItType;
            }else{
                
                $requirementObj->subtype = $request->getItType;
            }
    
            // price:  
            if ($request->giveItType == 2) {
                $requirementObj->price = isset($request->addSellPrice) ? $request->addSellPrice : NULL;
                $requirementObj->rent_date =  NULL;
            }elseif ($request->giveItType == 3){
                $requirementObj->price = isset($request->addRentPrice) ? $request->addRentPrice : NULL;
                $requirementObj->rent_date = $request->addRentDate;
            }else{
                $requirementObj->price = isset($request->price) ? $request->price : NULL;
            }
    
            if ($request->getItType == 5) {
                $requirementObj->subtype = isset($request->getItType) ? $request->getItType : NULL;
            }
    
            $requirementObj->save();

        }catch(Exception $e){

            return back()->with('mistake','An error occurred while you are trying to add new Requirements.! Please try again.');

        }
        
        return redirect()->route('requirement.index')->with('message','Requirement added successfully!');
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Open Edit Requirement Form
            try{

                $categoryId = Category::get();
                $editRequirementData = Requirement::find($id);

            }catch(Exception $e){

                return back()->with('mistake','An error occurred while you are trying to edit Requirements.! Please try again.');
            }
            return view('editRequirement',compact('editRequirementData','categoryId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequirementRequest $request, $id)
    {
           
        try{

            $cat_name = $request->Addcategory;
            $categoryname =Category::where('name',$cat_name)->exists();
            $requirementObj = new Requirement();
            
            // Save Update Requirement
            $user = auth()->User();
            $user_id = $user['id'];
            $user_type = $user['user_type'];
            $category = $request->requirementCategory;  
            
            $editRequirement = Requirement::find($id);
            
            // Update Image
            $mediaObj = new Media();        
            if ($request->has('media')) {
                
                // Save Image If exist 
                $file = $request->media;
                $originalName = $file->getClientOriginalName();
                $image_mimetype = $file->getClientMimeType();
                $image_name = time().'_'.$originalName;
                $image_path = public_path(). Requirement::FILE_PATH;
                $request->media->move($image_path,$image_name);
                
                $mediaObj->name = $image_name;
                $mediaObj->path = Requirement::FILE_PATH . $image_name;
                $mediaObj->original_name = $originalName;
                $mediaObj->mime_type = $image_mimetype;
                
                $mediaObj->save();
                $editRequirement->media_id = $mediaObj->id;
            } else {
                 // Update Image
                $mediaObj = new Media();        
                if ($request->has('media')) {
                    
                    // Save Image If exist 
                    $file = $request->media;
                    $originalName = $file->getClientOriginalName();
                    $image_mimetype = $file->getClientMimeType();
                    $image_name = time().'_'.$originalName;
                    $image_path = public_path(). Requirement::FILE_PATH;
                    $request->media->move($image_path,$image_name);
                    
                    $mediaObj->name = $image_name;
                    $mediaObj->path = Requirement::FILE_PATH . $image_name;
                    $mediaObj->original_name = $originalName;
                    $mediaObj->mime_type = $image_mimetype;
                    
                    $mediaObj->save();
                    $editRequirement->media_id = $mediaObj->id;
                }
            }

            // Update new Category and Stored in Categories table
            if ($request->requirementCategory == 0) 
            {
                
                $request->validate([
                    'Addcategory' => 'required|unique:categories,name'
                ]);
    
                $categoryAdd = new Category();
                $categoryAdd->name = isset($cat_name) ?  $cat_name : '';
                $categoryAdd->status = 1;
                $categoryAdd->save();
                
                // Add category_id if new category
                $requirementObj->category_id  = $categoryAdd->id;  

            }else {
                // Add category_id if already exist category
                $requirementObj->category_id = $request->category_id;
            }

            $editRequirement->requirements = $request->requirement;
            $editRequirement->quantity = $request->quantity;
            $editRequirement->status = $request->status;
            
            // type: Giveit, Getit
            $editRequirement->type = $request->type;

            // subtype: giveItType, getItType
            if ($request->type = 1) {
                
                $editRequirement->subtype = $request->giveItType;
            }else{
                
                $editRequirement->subtype = $request->getItType;
            }

            // price:
            if($request->giveItType == 1){
                $editRequirement->price =  NULL;
                $editRequirement->rent_date =  NULL;
            }
            elseif($request->giveItType == 2) {
                $editRequirement->price = isset($request->addSellPrice) ? $request->addSellPrice : NULL;
                $editRequirement->rent_date =  NULL;
            }elseif ($request->giveItType == 3){
                $editRequirement->price = isset($request->addRentPrice) ? $request->addRentPrice : NULL;
                $editRequirement->rent_date = $request->addRentDate;
            }elseif($request->getItType == 5){
                $editRequirement->subtype = isset($request->getItType) ? $request->getItType : NULL;
            }else{
                $editRequirement->price = isset($request->price) ? $request->price : NULL;
            }


            $editRequirement->save();

        }catch(Exception $e){

            return back()->with('mistake','An error occurred while you are trying to update Requirements.! Please try again.');
        }

            return redirect()->route('requirement.index')->with('message','Requirement updated successfully!');
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
        try{

            $requirementData = Requirement::find($id);
            $deletemediaId = $requirementData->media_id;
            $delete = Requirement::find($id)->delete();
            
            // Find & Delete Id in Media Table
            $deleteId = Media::find($deletemediaId)->delete();

        }catch(Exception $e){

            return back()->with('mistake','An error occurred while you are trying to delete Requirements.! Please try again.');
        }
        return redirect()->route('requirement.index')->with('message','Requirement deleted successfully!');     
    }
    
    // AJAX : Filter
    public function changeStatus(Request $request)
    {
        // Ajax request for filter
        $requirementStatus = $request->filterStatus;
        $requirementSearch = $request->filterSearch;

        // Get Requirement Table
        $requirement = Requirement::query();
        
        // Relationship : Get data form category and medias
        $requirement->with(['category','medias']);
                        
        // Filter Status
        $requirement = $requirement->when(!empty($requirementStatus), function() use($requirement,$requirementStatus) {
            $requirement->where('status',$requirementStatus);
        });

        // Filter Search
        $requirement = $requirement->when(!empty($requirementSearch), function() use($requirement,$requirementSearch) {

            $requirement = $requirement->whereHas('category',function($query) use($requirementSearch) {
                $query->where('name', 'LIKE',"%".$requirementSearch."%");
                
            })->orWhere('quantity', 'LIKE',"%".$requirementSearch."%");
            
        })->get();
         
        // JSON Response
        return response()->json([
                    'requirements' => $requirement
                ]);
    
    }
}