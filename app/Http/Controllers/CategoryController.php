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

        $categoryData = Category::all();
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
        // dd($id);
       
        // $cat_id = Category::with('requirements')->find($id)->get();
        // dd($cat_id);
        $delete = Category::find($id)->delete();
        return redirect()->route('category.index')->with('message','Category deleted successfully!');

    }
    
    public function multipleDelete(Request $request){
        // dd($request);
        $ids = $request->ids;
        DB::table("categories")->whereIn('id',explode(",",$ids))->delete();

        return redirect()->route('category.index')->with('message','Category deleted successfully!');
    }
}
