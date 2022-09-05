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
        try{

            $categoryData = Category::paginate(10);
        }catch(Exception $e){
            
            return back()->with('mistake','An error occurred while you are trying to show Category.! Please try again.');
        }
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
       
        try{
            $catName = count(Category::where('name',$request->categoryName)->get());

            if ($catName > 0) {
                return redirect()->route('category.index')->with('message','This category has already inserted so you can not inserte again.');
            }else{

                $categoryObj = new Category();
                $categoryObj->name = $request->categoryName;
                $categoryObj->status = 1;
                $categoryObj->save();
            }

        }catch(Exception $e){

            return back()->with('mistake','An error occurred while you are trying to Add new Category.! Please try again.');
        }
        
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
        try{

            $editCategoryData = Category::find($id);
            $category = Category::all();

        }catch(Exception $e){
            return back()->with('mistake','An error occurred while you are trying to open edit Category.! Please try again.');
        }
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
        try{

            $editCategory = Category::find($id);
            $editCategory->name = $request->categoryName;
            $editCategory->status = $request->status;
            $editCategory->save();

        }catch(Exception $e){
            return back()->with('mistake','An error occurred while you are trying to update Category.! Please try again.');
        }
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
        try{

            $RequirementData = Requirement::all();
            $data = count(Requirement::where('category_id',$id)->get());

            if($data > 0)
            {
                return redirect()->back()->with('msg','This id has exist in Requirement table so, You can not delete this Record!');
                
            }else{
    
                $delete = Category::find($id)->delete();
            }
            
        }catch(Exception $e){
            return back()->with('mistake','An error occurred while you are trying to delete Category.! Please try again.');
        }

        return redirect()->route('category.index')->with('message','Category deleted successfully!');
        
        
        // $query = Category::query()->find($id);
        // $category = $query->with('requirement',function($q){
        //     $q->where('category_id','id');
        // })->get();
        
        // $delete = Category::find($id)->delete();
        // return redirect()->route('category.index')->with('message','Category deleted successfully!');

    }
    
    public function multipleDelete(Request $request){
        
        try{

            $ids = $request->ids;
            $RequirementData = Requirement::all();
            $data = count(Requirement::where('category_id',$ids)->get());
            if($data > 0)
            {
                return redirect()->back()->with('msg','This id has exist in Requirement table so, You can not delete this Record!');
                
            }else{
    
                Category::whereIn('id',$ids)->delete();
                
            }
            
        }catch(Exception $e){

            return back()->with('mistake','An error occurred while you are trying to delete Category.! Please try again.');
        }

        return redirect()->route('category.index')->with('message','Category deleted successfully!');
        
    }
}
