<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requirement extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ='requirements';
    protected $guarded = [];

    public function categories()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')->select('name');
    }

}