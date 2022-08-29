<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Requirement;
use App\Models\User;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    //
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            $countWishlist = Favorite::countWishlist($data['requirement_id']);


            $wishlist = new Favorite();
            if ($countWishlist != 1) {
                $wishlist->requirement_id = $data['requirement_id'];
                $wishlist->user_id = $data['user_id'];
                $wishlist->save();
                return response()->json(['action' => 'add', 'message' => 'Requirement added to Whishlist successfully!']);
            } else {
                Favorite::where(['user_id' => Auth::user()->id, 'requirement_id' => $data['requirement_id']])->delete();
                return response()->json(['action' => 'remove', 'message' => 'Requirement Remove  to Favorite successfully!']);
            }
        }
    }

     public function show()
     {
         $user = auth()->User();
         $data = Favorite::with('user', 'requirement')->where('user_id', '=', Auth::user()->id)->get();

         return view('fronted.favorite', compact('user', 'data'));
     }
     public function delete($id)
     {
         // Delete Requirement
         $data = Favorite::find($id)->delete();

         return back()->with('messagedelete', 'Deleted Whishlist Data Successfully');
     }
}
