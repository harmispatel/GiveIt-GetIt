<?php

namespace App\Http\Controllers;

// Request Class
use App\Http\Requests\{RequirementRequest,EditRequirementRequest, Insertrequirement, EditValidation};

// Models
use App\Models\{Category, User, Requirement, Media};

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


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
        
        $requirementsData = Requirement::all();
        $categoryName = Category::with(['category']);
        return view('requirements',compact('requirementsData','categoryName'));
        // return view('requirements')->with('requirements',$requirementsData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Add new Requirement Form
        $categoryId = Category::get();
        $userId = User::get();
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
        // dd($request->addRentDate);
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
        // $requirementObj->type = $request->type;
        $requirementObj->status = $request->status;
        $requirementObj->is_active = $request->is_active;

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

        // Rent

        $requirementObj->save();
        
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
        
            $categoryId = Category::get();
            $editRequirementData = Requirement::find($id);
        
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
           
            $cat_name = $request->Addcategory;
            $categoryname =Category::where('name',$cat_name)->exists();
            $requirementObj = new Requirement();
            
        // Save Update Requirement
            $user = auth()->User();
            $user_id = $user['id'];
            $user_type = $user['user_type'];
            $category = $request->requirementCategory;  
            
            if ($request->requirementCategory == 0) 
            {
                
                $request->validate([
                    'Addcategory' => 'required|unique:categories,name'
                ]);
    
                $categoryAdd = new Category();
                $categoryAdd->name = isset($cat_name) ?  $cat_name : '';
                
                $categoryAdd->status = 1;
                $categoryAdd->save();
                
                $editRequirement = Requirement::find($id);
                $editRequirement->category_id = $categoryAdd->id;
                $editRequirement->requirements = $request->requirement;
                $editRequirement->quantity = $request->quantity;
                $editRequirement->type = $request->quantity;
                $editRequirement->status = $request->status;
                $editRequirement->is_active = $request->is_active;
                $editRequirement->save();


                // $editRequirement->user_id = $user_id;
                // $editRequirement->type = $request->type;
                // $editRequirement->is_active = $request->is_active;

                // $requirementObj->category_id  = $categoryAdd->id;   
            }else {
                    // $requirementObj->category_id = $request->category;
                    
                    $editRequirement = Requirement::find($id);
                    $editRequirement->category_id  = $category;
                    $editRequirement->requirements = $request->requirement;
                    $editRequirement->quantity = $request->quantity;
                    

                 
                    
                    // Update media
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
                    $editRequirement->type = $request->type;
                    $editRequirement->status = $request->status;
                    $editRequirement->is_active = $request->is_active;
                    
                    $editRequirement->save();
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
        $requirementData = Requirement::find($id);
        $deletemediaId = $requirementData->media_id;
        
        $delete = Requirement::find($id)->delete();
        $deleteId = Media::find($deletemediaId)->delete();
        return redirect()->route('requirement.index');     
    }
    

    // AJAX call for Status
        public function changeStatus(Request $request)
        {
           
            $query = Requirement::query();
            
            if ($request->ajax()) {
                if ($request->filterStatus == "" ){

                    $requirements = Requirement::query();

                    $requirements = $query->with('category', function($query) {
                                    $query->select('id', 'name');
                                })
                                ->get();
                    

                        return response()->json([
                        'requirements' => $requirements
                        ]);
                }else{

                    // $requirement = Requirement::query();
                        if ($request->filterIsActive != "" ) {
                            
                            $requirement = $query->with('category', function($query) {
                                                $query->select('id', 'name');
                                            })
                                            ->where('status', $request->filterStatus)
                                            ->where('is_active',$request->filterIsActive)
                                            ->get();
                        
                        }else{

                            $requirement = $query->with('category', function($query) {
                                            $query->select('id', 'name');
                                        })
                                        ->where('status', $request->filterStatus)
                                        // ->where('is_active',$request->filterIsActive)
                                        ->get();

                            
                        }

                        
                        // $requirement->where(!empty($request->filterIsActive), function($query) use($request) {
                        //             $query->where('is_active',$request->filterIsActive);
                        //                 // ->orWhere('field', 'LIKE' , '%' . $request->searchString . "%");
                        //         });
                        
                        // $requirements = $requirement->get();
                        
                        return response()->json([
                        'requirements' => $requirement
                        ]);
                    }
                
            }
            else{
                return response()->json(['errors' => $request->errors()]);
                // return view('requirements',compact('category','requirements'));
            }
        }
    
    // AJAX call for IsActive
        public function changeIsActive(Request $request)
        {

            $isActiveQuery = Requirement::query();

            if($request->ajax()){

                if ($request->filterIsActive == "") {

                    $datas = Requirement::query();

                    $datas = $isActiveQuery->with('category', function($isActiveQuery){
                        $isActiveQuery->select('id','name');
                    })
                    ->get();

                    return response()->json([
                        'datas' => $datas
                    ]); 
                }else{
                
                    if ($request->filterStatus != "" ) {
                        
                        $data = $isActiveQuery->with('category', function($isActiveQuery){
                                            $isActiveQuery->select('id','name');
                                        })
                                        ->where('is_active', $request->filterIsActive)
                                        ->where('status',$request->filterStatus)
                                        ->get();
                    }else{

                        $data = $isActiveQuery->with('category', function($isActiveQuery){
                                            $isActiveQuery->select('id','name');
                                        })
                                        ->where('is_active', $request->filterIsActive)
                                        // ->where('status',$request->filterStatus)
                                        ->get();
                    }
                }



                        // $data->where(!empty($request->filterStatus), function($query) use($request) {
                        //     $query->where('status',$request->filterStatus);
                        //         // ->orWhere('field', 'LIKE' , '%' . $request->searchString . "%");
                        //     });
                
                // $datas = $data->get();

                // dd($datas->toArray());

                return response()->json([
                    'datas' => $data
                ]);  
            }
            else{

                return view('requirements',compact('is_active','data'));

            }
        }

    // AJAX call for Searching...
        public function searching(Request $request)
        {
        
            if($request->ajax()){

                $search = Requirement::query()->with('category', function($query){
                            $query->select('id','name');
                    
                });

                // Searching using relation
                if (!empty($request->searchString)) {
                    $search->whereHas('category',function($query) use($request) {
                            $query->where('name', 'LIKE','%'.$request->searchString."%");
                                                    
                    }); 
                }
                // ->where('status',$request->filterStatus)
                // ->orWhere('is_active',$request->filterIsActive);
        
                if (!empty($request->filterStatus)) {
                    
                    $search->where('status',function ($query) use($request) {
                            $query->where('status', $request->filterStatus);
                    });
                }

                if (!empty($request->filterIsActive)) {      
                    $search->where('is_active',function ($query) use($request) {
                        $query->where('is-active', $request->filterIsActive);
                    });
                }    
                $datas = $search->get();
        
                $output="";
                if($datas)
                {

                    foreach ($datas as $key => $product) {
                        $output.='<tr>'.
                                    '<td>'.$product->category->name.'</td>'.
                                    // '<td>'.$product->requirements.'</td>'.
                                    '<td>'.$product->quantity.'</td>'.
                                    '<td>'.($product->type == '0' ? 'Getit' : 'Giveit').'</td>'.
                                    '<td><span class="'.($product->status == '0' ? 'badge badge-danger' : 'badge badge-success').'">'
                                            .($product->status == '0' ? 'Pending' : 'Completed').
                                        '<span>
                                    </td>'.
                                    '<td><span class="'.($product->is_active == '0' ? 'badge badge-danger' : 'badge badge-success').'">'
                                        .($product->is_active == '0' ? 'In Active' : 'Active') .
                                    '</td>'.
                                    '<td><a href=""><i class="fas fa-edit"></i></a> <a href=""><i class="fas fa-trash"></i><a></td>'.
                                '</tr>';
                    }
                        
                    return Response()->json([
                        'output' => $output,
                    ]);
                                
                }
            }
        }




    //frontend
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


    // public function edit($id)
    // {
    
    //  $categoryId = Category::get();
    //  $mediaData = Media::get();
    //  $RequiredData = Requirement::find($id);
    //  return view('fronted.edit',compact('RequiredData','categoryId','mediaData'));
    // }


    // public function update(EditValidation $request, $id)
    // {    
    //     // dd($request->toArray());
    //     $cat_name = $request->Addcategory;
    //     $categoryname =Category::where('name',$cat_name)->exists();
    //     $user = auth()->User();
    //     $user_id = $user['id'];
    //     $user_type = $user['user_type'];
    //     if($request->category == 0)
    //     {
    //         $request->validate([
    //             'Addcategory' => 'required|unique:categories,name'
    //         ]);
    //         $categoryAdd = new  Category();
    //         $categoryAdd->name = isset( $cat_name) ?  $cat_name : '';
    //         $categoryAdd->status = 1;
    //         $categoryAdd->save();
            
            
    //         $updateRequired = Requirement::find($id);
    //         $updateRequired->category_id  = $categoryAdd->id;
    //         $updateRequired->requirements = $request->requirement;
    //         $updateRequired->quantity = $request->quantity;
    //         $updateRequired->status	= $request->status;
    //         $updateRequired->save();
    //     }
    //     else
    //     {
    //         $updateRequired = Requirement::find($id);    
    //             $updateRequired->category_id  = $request->category;
    //             $updateRequired->requirements = $request->requirement;
    //             $updateRequired->quantity = $request->quantity;
    //             $mediaAdd = new Media();
        
    //             if($request->hasfile('media')){
    //                 $file= $request->file('media');
    //                 $original_file_name =$request->media->getClientOriginalName();
    //                 $image_mimetype = $request->media->getClientMimeType();
    //                 $image_name   = time().'_'.$request->media->getClientOriginalName();
    //                 $image_path = public_path(). Requirement::FILE_PATH;
    //                 request()->media->move($image_path, $image_name);
                    
    //                 $mediaAdd->name = $image_name;
    //                 $mediaAdd->path = Requirement::FILE_PATH . $image_name;
    //                 $mediaAdd->original_name = $original_file_name;
    //                 $mediaAdd->mime_type = $image_mimetype;
                    
    //                 $mediaAdd->save();
    //                 $updateRequired->media_id = $mediaAdd->id;
    //             }
    //             $updateRequired->status	= $request->status;
    //             $updateRequired->save();
    //         }

           
    
    //     return redirect('required')->with('updatedata','Update RequiredData Successfully');
    
    // }
}