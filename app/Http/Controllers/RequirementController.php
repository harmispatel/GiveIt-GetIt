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
        // Show Category List

        $categoryName = Category::get();
        return view('requirements', compact('categoryName'));
    }

    public function fetchAll()
    {
        $datas = Requirement::with(['category','media'])->get();
        $output = '';
        if ($datas->count() > 0) {
            $output .='<table class="table table-striped table-sm text-center align-middle">
            <thead>
            <tr>
            <th>Image</th>
            <th>Category</th>
            <th>Person</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
            </thead>
            <tbody>';
            foreach ($datas as $data) {
                $url =asset(isset($data->media["path"]) ? $data->media["path"] : '/img/requirement/Noimage.jpg');
                $no_image=asset('/img/requirement/Noimage.jpg');
                $output .='<tr>
               
                <td><img src="'.$url.'" width="100" class="img-rounded"</td>

                                    <td>'.$data->category['name'].'</td>
                                    <td>'.$data->quantity.'</td>
                                    <td>'.(($data->type == 1) ? '<span class="badge bg-secondary">GiveIt</span>' : '<span class="badge bg-dark">GetIt</span>').'</td>
                                    <td>'.(($data->status == 1) ? '<span class="badge bg-success">Pending</span>' : '<span class="badge bg-danger">Completed</span>').'</td>

                                    <td>
                                        <a href="#" id="'.$data->id.'" class="text-success mx-1 editIcon"
                                        data-bs-toggle="modal" data-bs-target="#editRequirementModal"><i
                                        class="bi-pencil-square h4"></i></a>

                                        <a href="#" id="'.$data->id.'" class="text-danger mx-1 deleteIcon">
                                        <i class="bi-trash h4"></i></a>

                                    </td>
                                    </tr>';
            }

            $output .='</tbody></table>';
            echo $output;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Add new Requirement Form
        try {
            $categoryId = Category::get();
            $userId = User::get();
        } catch(Exception $e) {
            return back()->with('mistake', 'An error occurred while you are trying to add new Requirements form.! Please try again.');
        }
        return view('addRequirement', compact('categoryId', 'userId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RequirementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequirementRequest $request)
    {
        $addcategory = $request->Addcategory;
        $user = auth()->User();
        $userId = $user['id'];

        // Insert Image
        $Image = new Media();
        if ($request->has('media')) {
            $file = $request->media;
            $originalName = str_replace(' ', '_', $file->getClientOriginalName());
            $mimetype = $file->getClientMimeType();
            $imageName = time().'_'.$originalName;
            $imagePath = public_path(). Requirement::FILE_PATH;
            $request->media->move($imagePath, $imageName);

            $Image->name =  $imageName;
            $Image->path = Requirement::FILE_PATH . $imageName;
            $Image->original_name = $originalName;
            $Image->mime_type = $mimetype;
            $Image->save();
        }
        $requirement = new Requirement();
        if ($request->category == 0) {
            $request->validate([
                      'Addcategory' => 'required|unique:categories,name'
                      ]);
            $categoryAdd = new  Category();
            $categoryAdd->name = $addcategory;
            $categoryAdd->status = 1;
            $categoryAdd->save();
            $requirement->category_id  = $categoryAdd->id;
        } else {
            $requirement->category_id = $request->category;
        }

        $requirement->requirements = $request->requirement;
        $requirement->quantity = $request->quantity;
        $requirement->user_id = $userId;
        $requirement->media_id = $Image->id;
        $requirement->status = 1;
        $requirement->type = $request->type;

        if ($request->type == 1) {
            $requirement->subtype = $request->giveItType;
            if ($request->giveItType == 1) {
                $requirement->price =  null;
                $requirement->rent_date =  null;
            } elseif ($request->GiveItType == 2) {
                $requirement->price == isset($request->addsellPrice) ? $request->addSellPrice : null;
                $requirement->rent_date = null;
            } elseif ($request->GiveItType == 3) {
                $requirement->price = isset($request->addRentPrice) ? $request->addRentPrice : null;
                $requirement->rent_date = $request->addRentDate;
            }
        } else {
            $requirement->subtype = $request->getItType;

            if ($request->getItType == 4) {
                $requirement->price = null;
                $requirement->rent_date = null;
            } else {
                $requirement->price = isset($request->price) ? $request->price : null;
                $requirement->rent_date = null;
            }
        }
        $requirement->save();

        if (!empty($requirement)) {
            return response()->json([
                'status' => 1,
                'message' => 'Requirement created successfully.',
                'data' => []
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to craete the Requirement.',
                'darta' => []
            ]);
        }
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
    public function edit(Request $request)
    {
        // Open Edit Requirement Form
        $id = $request->id;
        $data = Requirement::find($id);
        $mediaId   = $data->media_id;
        $media = Media::find($mediaId);
        return response()->json([
            "success" => 1,
            'data' => $data,
            'media' => $media
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(EditRequirementRequest $request)
    {
        $addcategory = $request->Addcategory;
        $data = Requirement::find($request->Rid);
        $data->quantity = $request->quantity;
        $data->status = $request->status;
        $data->requirements = $request->requirement;
        $data->type = $request->type;

        //Insert Image
        $mediaAdd = new Media();
        if ($request->hasfile('media')) {
            $file= $request->file('media');
            $original_file_name =str_replace(' ', '_', $request->media->getClientOriginalName());
            $image_mimetype = $request->media->getClientMimeType();
            $image_name   = time().'_'.str_replace(' ', '_', $request->media->getClientOriginalName());
            $image_path = public_path(). Requirement::FILE_PATH;
            request()->media->move($image_path, $image_name);

            $mediaAdd->name = $image_name;
            $mediaAdd->path = Requirement::FILE_PATH . $image_name;
            $mediaAdd->original_name = $original_file_name;
            $mediaAdd->mime_type = $image_mimetype;

            $mediaAdd->save();
            $data->media_id = $mediaAdd->id;
        }


        if ($request->category == 0) {
            $request->validate([
                'Addcategory' => 'required|unique:categories,name'
            ]);
            // Add new category in categories table
            $categoryAdd = new  Category();
            $categoryAdd->name = $addcategory;
            $categoryAdd->status = 1;
            $categoryAdd->save();
            $data->category_id  = $categoryAdd->id;
        } else {
            $data->category_id = $request->category;
        }


        if ($request->type == 1) {
            $data->subtype = $request->giveItType;
            if ($request->giveItType == 1) {
                $data->price = null;
                $data->rent_date = null;
            } elseif ($request->giveItType == 2) {
                $data->price = isset($request->addsellPrice) ? $request->addsellPrice : null;
                $data->rent_date == null;
            } else {
                $data->price = isset($request->addRentPrice) ? $request->addRentPrice : null;
                $data->rent_date = isset($request->addRentDate) ? $request->addRentDate : null;
            }
        } else {
            $data->subtype = $request->getItType;
            if ($request->getItType == 4) {
                $data->price = null;
                $data->rent_date = null;
            } else {
                $data->price = isset($request->price) ? $request->price : null;
                $data->rent_date = null;
            }
        }




        $data->save();
        if (!empty($data)) {
            return response()->json([
                'status' => 1,
                'message' => 'Requirement created successfully.',
                'data' => []
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to craete the Requirement.',
                'darta' => []
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $data = Requirement::find($id);
        $deleteMediaId = $data->media_id;
        $delete = Requirement::find($id)->delete();

        if ($delete) {
            return response()->json([
                'status' => 1,
                'message' =>'Requirement deleted successfully',
                'data' => []
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' =>'Failed to delete the Requirement.',
                'data' => []
            ]);
        }
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
        $requirement = $requirement->when(!empty($requirementStatus), function () use ($requirement, $requirementStatus) {
            $requirement->where('status', $requirementStatus);
        });

        // Filter Search
        $requirement = $requirement->when(!empty($requirementSearch), function () use ($requirement, $requirementSearch) {
            $requirement = $requirement->whereHas('category', function ($query) use ($requirementSearch) {
                $query->where('name', 'LIKE', "%".$requirementSearch."%");
            })->orWhere('quantity', 'LIKE', "%".$requirementSearch."%");
        })->get();

        // JSON Response
        return response()->json([
                    'requirements' => $requirement
                ]);
    }
}
