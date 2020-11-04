<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\Value;

class Product extends Model
{
    protected $table = "products";

    public function categories(){
        return $this->belongsTo('App\models\Category', 'category_id', 'id');
    }

    public function values(){
        return $this->belongsToMany('App\models\Value', 'product_value', 'product_id', 'value_id');
    }

    public function variants(){
        return $this->hasMany('App\models\Variant', 'product_id', 'id');
    }

    //frontend
    public function getFeatured(){
        return Product::where('featured', 1)->take(4)->get();
    }

    public function getListNewProduct(){
        return Product::orderby('created_at', 'DESC')->take(8)->get();
    }

    public function getListProduct(){
        return Product::where('img', '<>', 'no-img.jpg')->paginate(12);
    }

    public function getListProductAfterFilter($request){
        if (isset($request['category'])){
            return Product::where('category_id', $request['category'])->paginate(12);
        }
        if (isset($request['price_start'])){
            return Product::whereBetween('price', [$request['price_start'], $request['price_end']])->paginate(12);
        }
        if(isset($request['attr_value'])){
            return Value::find($request['attr_value'])->products()->paginate(12);
        }
    }
}
