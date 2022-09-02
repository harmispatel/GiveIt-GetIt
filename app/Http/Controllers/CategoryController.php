<?php

namespace App\Http\Controllers;

// Request Class
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

// Models
use App\Models\Category;
use App\Models\Requirement;

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

        $categoryData = Category::paginate(5);
        return view('categories')->with('categories',$categoryData);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Open new Category Form
        return view('addCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // Add new Category

        $categoryObj = new Category();
        $categoryObj->name = $request->categoryName;
        $categoryObj->status = $request->status;
        $categoryObj->save();
        
        return redirect()->route('category.index')->with('message','Category added successfully!');

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
    public function edit($id)
    {   
        // Open Edit Category Form

        $editCategoryData = Category::find($id);
        $category = Category::all();
        return view('editCategory',compact('editCategoryData','category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {   
        // Update Category

        $editCategory = Category::find($id);
        $editCategory->name = $request->categoryName;
        $editCategory->status = $request->status;
        $editCategory->save();
        return redirect()->route('category.index')->with('message','Category updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Category
        $RequirementData = Requirement::all();
        $data = count(Requirement::where('category_id',$id)->get());
        
        if($data > 0)
        {
            return redirect()->back()->with('msg','This id is already exist in Requirement table so, You can not delete this Record!');
            
        }else{

            $delete = Category::find($id)->delete();
            return redirect()->route('category.index')->with('message','Category deleted successfully!');
        }
        
        // $query = Category::query()->find($id);
        // $category = $query->with('requirement',function($q){
        //     $q->where('category_id','id');
        // })->get();
        
        // $delete = Category::find($id)->delete();
        // return redirect()->route('category.index')->with('message','Category deleted successfully!');

    }
    
    public function multipleDelete(Request $request){
        
        $ids = $request->ids;
        $RequirementData = Requirement::all();
        $data = count(Requirement::where('category_id',$ids)->get());
        if($data > 0)
        {
            return redirect()->back()->with('msg','This id is already exist in Requirement table so, You can not delete this Record!');
            
        }else{

            Category::whereIn('id',$ids)->delete();
            return redirect()->route('category.index')->with('message','Category deleted successfully!');

            // $delete = Category::find($id)->delete();
            // return redirect()->route('category.index')->with('message','Category deleted successfully!');
        }
        
    }
}
