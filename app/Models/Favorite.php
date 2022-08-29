<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Favorite extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public static function countWishlist($requirement_id){
        $countWishlist = Favorite::where(['requirement_id' => $requirement_id, 'user_id' => Auth::user()->id])->exists();
        return $countWishlist;
    }

    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
}
