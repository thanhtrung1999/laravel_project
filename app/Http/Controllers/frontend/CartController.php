<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Product;
use Cart;

class CartController extends Controller
{
    private $_productModel;

    public function __construct(Product $product_model)
    {
        $this->_productModel = $product_model;
    }

    public function index(){
//        dd(Cart::content());
        return view('frontend.store.cart.cart');
    }

    public function add(Request $request){
        $product = $this->_productModel->getProductById($request->id_product);
        Cart::add(
            $product->id,
            $product->name,
            getPriceByVariant($product, $request->attr),
            (int)$request->quantity,
            [
                'img' => $product->img,
                'attr' => $request->attr,
            ]
        );
//        dd(Cart::content());
        return redirect('store/cart');
    }
}
