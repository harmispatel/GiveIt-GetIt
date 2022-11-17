<?php

namespace App\Http\Controllers;

// Request Class
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

// Models
use App\Models\Category;
use App\Models\Requirement;
use Exception;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show Category List
        return view('categories');
    }

    // handle fetch all employees ajax request
    public function fetchAll()
    {
        $datas = Category::all();
        $output = '';
        if ($datas->count() > 0) {
            $output .='<table id="dtable" class="table table-striped table-sm text-center align-middle">
            <thead>
            <tr>
            <th>name</th>
            <th>status</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>';
            foreach ($datas as $data) {
                $output .='<tr>
                <td>'.$data->name.'</td>
                
                <td>'.(($data->status == 0) ? '<span class="badge bg-danger">InActive</span>' : '<span class="badge bg-success">Active</span>').'</td>
            
                <td>
                <a href="#" id="'.$data->id.'" class="text-success mx-1 editIcon"
                data-bs-toggle="modal" data-bs-target="#editCategoryModal"><i
                class="bi-pencil-square h4"></i></a>

                                        <a href="#" id="'.$data->id.'" class="text-danger mx-1 deleteIcon">
                                        <i class="bi-trash h4"></i></a>

                                    </td>
                                    </tr>';
            }

            $output .='</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // Add new Category
        $input = $request->all();

        $category = Category::create($input);
        // Set the Response
        if (!empty($category)) {
            return response()->json([
                'status'  => 1,
                'message' => 'Category created successfully.',
                'data'    => []
            ]);
        } else {
            return response()->json([
                'status'  => 0,
                'message' => 'Failed to craete the Categroy.',
                'data'    => []
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        // Open Edit Category Form
        $id = $request->id;
        $data = Category::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request)
    {
        // Update Category
        $input = $request->except(['_token', 'Cid']);
        $data = Category::where('id', $request->Cid)->update($input);
        $datas = Category::where('id', $request->Cid)->first();
        if ($datas) {
            return response()->json([
                'status' => 1,
                'message' => 'Category updated successfully.',
              'data' => $datas

            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to update the Category.',
                'data' => []
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
        // Delete Category
        $id =   $request->id;
        $RequirementData = Requirement::all();
        $data = count(Requirement::where('category_id',$id)->get());
        if($data > 0)
            {
                return response()->json([
                    'status' => 0,
                    'message' => 'Failed to delete the Category.',
                    'data' =>  []
                ]);

                    
            }else{
                $data = Category::find($id)->delete($id);
                return response()->json([
                    'status' => 1,
                    'message' => 'Category deleted successfully',
                    'data' => []
                ]);
            }
    }

    public function multipleDelete(Request $request)
    {
        try {
            $ids = $request->ids;
            $RequirementData = Requirement::all();
            $data = count(Requirement::where('category_id', $ids)->get());
            if ($data > 0) {
                return redirect()->back()->with('msg', 'This id has exist in Requirement table so, You can not delete this Record!');
            } else {
                Category::whereIn('id', $ids)->delete();
            }
        } catch(Exception $e) {
            return back()->with('mistake', 'An error occurred while you are trying to delete Category.! Please try again.');
        }
        return redirect()->route('category.index')->with('message', 'Category deleted successfully!');
    }
}
