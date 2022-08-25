<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requirement extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ='requirements';
    
    public $timestamps = true;

    protected $guarded = [];

    const FILE_PATH = '/img/requirement/';


    public function categories()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function media()
    {
        return $this->hasOne(Media::class, 'id','media_id');
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');    
    }

    public function medias(){
        return $this->hasOne(Media::class, 'id','media_id');
    }

    
   }