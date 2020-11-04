<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = false;

    public function products(){
        return $this->hasMany('App\models\Product','category_id', 'id');
    }

    public function getAllCategories(){
        return Category::all();
    }
}
