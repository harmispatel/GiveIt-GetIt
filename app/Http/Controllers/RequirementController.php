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
        // dd($requirementsData);
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
    public function store(RequirementRequest $request)
    {   
        // dd($request->media);
        // Save new Requirement

            $user = auth()->User();
            $user_id = $user['id'];
            $userData = User::get();

        // media
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
       

        // Stored Id with Relationship
        $query = Requirement::query();
       
        $requirementObj = new Requirement();
        $requirementObj->media_id = $mediaObj->id;
        $requirementObj->category_id = $request->category_id;
        $requirementObj->requirements = $request->requirement;
        $requirementObj->quantity = $request->quantity;
        $requirementObj->user_id = $user_id;
        $requirementObj->type = $request->type;
        
        $requirementObj->status = $request->status;
        $requirementObj->is_active = $request->is_active;
        
        $requirementObj->save();
        
        return redirect()->route('requirement.index')->with('message','Requirement added successfully!');
        // return view('requirements');
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
        // Save Update Requirement

            $user = auth()->User();
            $user_id = $user['id'];
            $category = $request->requirementCategory;  
            $user_type = $user['user_type'];
            
            $editRequirement = Requirement::find($id);
            $editRequirement->category_id = $category;
            $editRequirement->requirements = $request->requirement;
            $editRequirement->quantity = $request->quantity;
            $editRequirement->user_id = $user_id;
            $editRequirement->type = $request->type;
            $editRequirement->status = $request->status;
            $editRequirement->is_active = $request->is_active;
        
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

            $delete = Requirement::find($id)->delete();
            return redirect()->route('requirement.index');     
    }
    

    // AJAX call for Status
        public function changeStatus(Request $request)
        {
            // dd($request->toArray());
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
        public function changeIsActive(Request $request){

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