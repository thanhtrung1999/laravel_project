<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $table = "values";
    public $timestamps = false;

    public function attributes(){
        return $this->belongsTo('App\models\Attribute', 'attribute_id', 'id');
    }

    public function products(){
        return $this->belongsToMany('App\models\Product', 'product_value', 'value_id', 'product_id');
    }
}
