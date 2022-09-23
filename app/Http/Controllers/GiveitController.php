<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Requests
use App\Http\Requests\{StoreRequirement, Insertrequirement, EditValidation};

//Models
use App\Models\{Requirement, User, Category, Media, Favorite };

use Illuminate\Support\Facades\URL;
use DB;

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
        $totalRecords = Requirement::count();
        $data = Requirement::with(['user','categories'])->where('type', 1)->paginate(12);
        
        if ($request->ajax()) {
            $data = Requirement::with(['user','categories'])->where('type', 1)->paginate(12);
            
            $view = view('fronted.getitdata', compact('data'))->render();
            return response()->json(['html'=>$view]);
        }
        $ajaxId= isset($request->ajaxId) ? $request->ajaxId : 0;
        return view('fronted.giveit', compact('data', 'totalRecords'));
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
        $favoriteData =Favorite::where('requirement_id', $Rre_id)->first();
        $relatedData = Requirement::with(['categories','media'])->where('category_id', $cat_id)->limit(3)->get();
        return view('fronted.giveitview', compact('RequiredData', 'categoryId', 'mediaData', 'relatedData', 'favoriteData', 'url'));
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

    public function search(Request $request)
    {
        $page = $request->page;
        $filterSortby = $request->filterSortby == 1 ? 'asc' : 'desc';
        $filterSearch = $request->filterSearch;
        $total = 0;

        $requirement = Requirement::query();
        $requirement = $requirement->where('type', 1)->with(['media','user']);
        $requirement = $requirement->orderBy('created_at', $filterSortby);
        // $total += $requirement->orderBy('created_at', $filterSortby)->count();
        $requirement = $requirement->limit($request['limit'])
        ->offset($request['start'])
        ->get();

        $html = "";
        if (isset($requirement)) {
            foreach ($requirement as $key => $data) {
                $url =asset(isset($data->media["path"]) ? $data->media["path"] : '/img/requirement/Noimage.jpg');
                $no_image=asset('/img/requirement/Noimage.jpg');
                $route = route('giveviewdetail', $data['id']);
                $html .='<div class="col-md-4 data">';
                $html .='<div class="get_detalis_inr">';
                $html .='<div class="get_detalis_img">';
                $html .='<div class="get_img">';
                $html .='<a href='.$route.'>';
                if (isset($url)) {
                    $html .='<img src='.$url.'>';
                } else {
                    $html .='<img src='.$no_image.'>';
                }
                $html .= '</a>';
                $html .='</div>';
                $html .='<div class="get_detalis_info">';
                $html .=' <div style="height: 90px;
                overflow: hidden;">';
                $html .='<p>'. $data->requirements .'</p>';
                $html .='</div>';
                $html .='<div class="text-end">';
                $html .='<a href='.$route.'>Read more...</a>';
                $html .='</div>';
                $html .='</div>';
                $html .='</div>';
                $html .='</div>';
                $html .='</div>';
            }
            if ($request->ajax()) {
                return response()->json([
                    'html' => $html,
                    'records' => count($requirement),
                    'total' => $total

                ]);
            } else {
                echo "No Data";
                // return view()
            }
        }
    }
}

            
