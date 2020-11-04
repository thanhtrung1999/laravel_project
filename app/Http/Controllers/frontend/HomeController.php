<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $_productModel;

    public function __construct(Product $product_model)
    {
        $this->_productModel = $product_model;
    }

    public function index(){
        $data = [
            'products_featured' => $this->_productModel->getFeatured(),
            'products_new' => $this->_productModel->getListNewProduct(8),
        ];
        return view('frontend.index', $data);
    }

    public function contact(){
        return view('frontend.contact');
    }

    public function about(){
        return view('frontend.about');
    }
}
