<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Requests
use App\Http\Requests\{StoreRequirement, Insertrequirement, EditValidation};

//Models
use App\Models\{Requirement, User, Category, Media, Favorite };

use Illuminate\Support\Facades\URL;


class GiveitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Show Giveit Requirement Data

        $data = Requirement:: with(['user','categories'])->where('type', 1 )->paginate(3);
        
        if ($request->ajax())
         {
    		$view = view('fronted.giveitdata',compact('data'))->render();
            return response()->json(['html'=>$view]);
         }

        return view('fronted.giveit', compact('data'));

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // Reuirement Id View Details
       $url = URL::current();
       $categoryId = Category::get();
        $mediaData = Media::get();
        $RequiredData = Requirement::find($id);
        $RequirementData = Requirement::all();
        $cat_id = $RequiredData->category_id;
        $Rre_id = $RequiredData->id;
        $favoriteData =Favorite::where('requirement_id',$Rre_id)->first();
        // dd($favoriteData);

        $relatedData = Requirement::with(['categories','media'])->where('category_id',$cat_id)->limit(3)->get();
        return view('fronted.giveitview',compact('RequiredData','categoryId','mediaData','relatedData','favoriteData','url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
