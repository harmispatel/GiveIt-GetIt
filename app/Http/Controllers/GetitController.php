<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Requests
use App\Http\Requests\{StoreRequirement, Insertrequirement, EditValidation};

//Models
use App\Models\{Requirement, User, Category, Media};


class GetitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Show Gitite Requirement Data
        $data = Requirement:: with(['user','categories'])->where('type', 2 )->paginate(3);
           if ($request->ajax()) 
           {
    		 $view = view('fronted.getitdata',compact('data'))->render();
            return response()->json(['html'=>$view]);
           }
         
        return view('fronted.getit',compact('data'));

        


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
        // Get It Requiment data Only View

        $categoryId = Category::get();
        $mediaData = Media::get();
        $RequiredData = Requirement::find($id);
        
        return view('fronted.getitview',compact('RequiredData','categoryId','mediaData'));
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
