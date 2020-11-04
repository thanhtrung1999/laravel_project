<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//frontend
Route::get('','frontend\HomeController@index');
Route::get('contact','frontend\HomeController@contact');
Route::get('about-us','frontend\HomeController@about');
Route::group(['prefix' => 'store'], function (){
    Route::group(['prefix' => 'products'], function (){
        Route::get('','frontend\ProductController@index');
        Route::get('detail/{id}', 'frontend\ProductController@detail');
        Route::get('complete', 'frontend\ProductController@complete');
    });
    Route::group(['prefix' => 'cart'], function (){
        Route::get('', 'frontend\CartController@index');
    });
    Route::group(['prefix' => 'checkout'], function (){
        Route::get('', 'frontend\CheckoutController@index');
    });
});

//backend
Route::get('login', 'backend\LoginController@getLogin')->middleware('checkLogout');
Route::post('login', 'backend\LoginController@postLogin');
Route::group(['prefix' => 'admin', 'middleware' => 'checkLogin'], function (){
    Route::get('', 'backend\LoginController@getIndex');
    Route::get('logout', 'backend\LoginController@Logout');
    //category
    Route::group(['prefix' => 'category'], function (){
        Route::get('', 'backend\CategoryController@getCategory');
        Route::post('', 'backend\CategoryController@postCategory');
        Route::get('edit/{id}', 'backend\CategoryController@editCategory');
        Route::post('edit/{id}', 'backend\CategoryController@postEditCategory');
        Route::get('delete/{id}', 'backend\CategoryController@deleteCategory');
    });
    //product
    Route::group(['prefix' => 'product'], function (){
        Route::get('', 'backend\ProductController@listProduct');
        Route::get('add', 'backend\ProductController@addProduct');
        Route::post('add', 'backend\ProductController@postAddProduct');
        Route::get('edit/{id}', 'backend\ProductController@editProduct');
        Route::post('edit/{id}', 'backend\ProductController@postEditProduct');
        Route::get('delete/{id}', 'backend\ProductController@deleteProduct');

        Route::post('add-attr', 'backend\ProductController@AddAttrProduct');
        Route::get('detail-attr', 'backend\ProductController@DetailAttrProduct');
        Route::get('edit-attr/{id}', 'backend\ProductController@EditAttrProduct');
        Route::post('edit-attr/{id}', 'backend\ProductController@postEditAttrProduct');
        Route::get('delete-attr/{id}', 'backend\ProductController@DeleteAttrProduct');

        Route::post('add-value', 'backend\ProductController@AddValue');
        Route::get('edit-value', 'backend\ProductController@EditValue');

        Route::get('add-variant/{id}', 'backend\ProductController@AddVariant');
        Route::post('add-variant/{id}', 'backend\ProductController@postAddVariant');
        Route::get('edit-variant/{id}', 'backend\ProductController@EditVariant');
        Route::post('edit-variant/{id}', 'backend\ProductController@postEditVariant');
        Route::get('delete-variant/{id}', 'backend\ProductController@DeleteVariant');
        Route::get('cancel', function (){
            return redirect('admin/product');
        });
    });
    //order
    Route::group(['prefix' => 'order'], function (){
        Route::get('', 'backend\OrderController@listOrder');
        Route::get('detail', 'backend\OrderController@detailOrder');
        Route::get('processed', 'backend\OrderController@processedOrder');
    });
});
Route::get('danh-muc-de-quy', function (){
    return view('backend.danh-muc-de-quy');
});
