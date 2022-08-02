<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    const FILE_PATH = '/img/requirement/';
    
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');    
    }

    public function media(){
        return $this->hasOne(Media::class,'id','media_id');
    }
}
