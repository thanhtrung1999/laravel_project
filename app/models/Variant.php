<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $table = 'variants';
    public $timestamps = false;

    public function products(){
        return $this->belongsTo('products', 'product_id', 'id');
    }

    public function values(){
        return $this->belongsToMany('App\models\Value', 'variant_value', 'variant_id', 'value_id');
    }
}
