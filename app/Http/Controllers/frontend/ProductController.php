<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\{Product,Category,Attribute};

class ProductController extends Controller
{
    private $_productModel;
    private $_categoryModel;
    private $_attributeModel;

    public function __construct(Product $product_model, Category $category_model, Attribute $attribute_model)
    {
        $this->_productModel = $product_model;
        $this->_categoryModel = $category_model;
        $this->_attributeModel = $attribute_model;
    }

    public function index(Request $request){
        $data = [
            'products' => $this->_productModel->getListProduct(),
            'categories' => $this->_categoryModel->getAllCategories(),
            'attributes' => $this->_attributeModel->getAllAttributes(),
        ];
        $arr_request = [];
        if(isset($request->category) && !empty($request->category)){
            $arr_request['category'] = $request->category;
        }
        if(isset($request->start) && !empty($request->start)){
            $arr_request = [
                'price_start' => $request->start,
                'price_end' => $request->end,
            ];
        }
        if(isset($request->attr_value) && !empty($request->attr_value)){
            $arr_request['attr_value'] = $request->attr_value;
        }
        if(!empty($arr_request)){
            $data['products'] = $this->_productModel->getListProductAfterFilter($arr_request);
        }
        return view('frontend.store.products.shop', $data);
    }

    public function detail(){
        return view('frontend.store.products.detail');
    }

    public function complete(){
        return view('frontend.store.products.complete');
    }
}
