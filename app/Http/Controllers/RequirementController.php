<?php

namespace App\Http\Controllers;

// Request Class
use App\Http\Requests\{RequirementRequest,EditRequirementRequest};

// Models
use App\Models\{Category, User, Requirement, Media};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        //
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
        
        $user = auth()->User();
        // echo"<pre>";print_r($user);exit;
        $user_id = $user['id'];
        $userData = User::get();

        // media
        if ($request->has('media')) {
            
            $file = $request->media;
            $originalName = $file->getClientOriginalName();
            $image_name = time().'_'.$originalName;
            $image_path = public_path(). Requirement::FILE_PATH;
            $request->media->move($image_path,$image_name);
            
        
        
            $modelObj = new Media();
            
        } 


        // Stored Id with Relationship
        $query = Requirement::query();
        $mediaId = $query->with('media', function($query) {
            $query->select('id');
        })
        ->get();

        $requirementObj = new Requirement();
        $requirementObj->media_id = $mediaId;
        // dd($requirementObj->media_id);
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
        $categoryId = Category::get();
        $editRequirementData = Requirement::find($id);
        // dd($editRequirementData);
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
        
        // dd($editRequirement  ->toArray());
        
        
        $editRequirement->update();
        
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
        
        $delete = Requirement::find($id)->delete();
        return redirect()->route('requirement.index');
        
    }
    

    // AJAX call
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

    // Serching
    public function searching(Request $request){
      
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
}