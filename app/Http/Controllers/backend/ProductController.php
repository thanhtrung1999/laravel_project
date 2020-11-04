<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\{AddProductRequest,EditProductRequest,AddAttributeRequest,EditAttrRequest,AddValueRequest};
use Illuminate\Http\Request;
use App\models\{Product,Attribute,Value,Category,Variant};

class ProductController extends Controller
{
    public function listProduct(){
//        dd(attr_values(Product::find(3)->values()->get()));
        $data['products'] = Product::paginate(5);
        return view('backend.product.listproduct', $data);
    }

    public function addProduct(){
        $data = [
            'attributes' => Attribute::all(),
            'categories' => Category::all(),
        ];
        return view('backend.product.addproduct', $data);
    }

    public function postAddProduct(AddProductRequest $request){
//        dd($request->all());
        $product_model = new Product();
        $product_model->product_code = $request->product_code;
        $product_model->name = $request->product_name;
        $product_model->price = $request->product_price;
        $product_model->featured = $request->featured;
        $product_model->state = $request->product_state;
        $product_model->info = $request->info;
        $product_model->describe = $request->description;
        if($request->has('product_img')){
            $file = $request->product_img;
            $file_name = time() . '-product-' . $_FILES['product_img']['name'];
            $file->move('backend/img/', $file_name);
            $product_model->img = $file_name;
        } else {
            $product_model->img = 'no-img.jpg';
        }
        $product_model->category_id = $request->category;
        $product_model->save();

        $data = [];
        foreach ($request->attr as $value){
            foreach ($value as $item){
                $data[] = $item;
            }
        }
        $product_model->values()->Attach($data);

        $arr_variants = get_combinations($request->attr);

        foreach ($arr_variants as $arr_variant_values){
            $variant_model = new Variant();
            $variant_model->product_id = $product_model->id;
            $variant_model->save();
            $variant_model->values()->Attach($arr_variant_values);
        }

        return redirect("admin/product/add-variant/$product_model->id");
    }

    public function editProduct($id){
        $data = [
            'product' => Product::find($id),
            'categories' => Category::all(),
            'attributes' => Attribute::all(),
        ];
        return view('backend.product.editproduct', $data);
    }

    public function postEditProduct(EditProductRequest $request, $id){
//        dd($request->all());
        $product = Product::find($id);
        $product->product_code = $request->product_code;
        $product->name = $request->product_name;
        $product->price = $request->product_price;
        $product->featured = $request->featured;
        $product->state = $request->product_state;
        $product->info = $request->info;
        $product->describe = $request->description;
        if($request->has('product_img')){
            if($product->img != 'no-img.jpg'){
                unlink('backend/img/'.$product->img);
            }
            $file = $request->product_img;
            $file_name = time() . '-product-' . $_FILES['product_img']['name'];
            $file->move('backend/img/', $file_name);
            $product->img = $file_name;
        }
        $product->category_id = $request->category;
        $product->save();

        $data = [];
        foreach ($request->attr as $value){
            foreach ($value as $item){
                $data[] = $item;
            }
        }
        $product->values()->Sync($data);

        $arr_variants = get_combinations($request->attr);
        foreach ($arr_variants as $arr_variant_values){
            if(checkVariant($product, $arr_variant_values)){
                $variant_model = new Variant();
                $variant_model->product_id = $product->id;
                $variant_model->save();
                $variant_model->values()->Attach($arr_variant_values);
            }
        }

        return redirect()->back()->with('alert', 'Sửa sản phẩm thành công');
    }

    public function deleteProduct($id){
        Product::destroy($id);
        return redirect()->back()->with('alert', 'Xóa sản phẩm thành công');
    }

    public function AddAttrProduct(AddAttributeRequest $request){
        $attr_model = new Attribute();
        $attr_model->name = $request->attr_name;
        $attr_model->save();
        return redirect()->back()->with('alert', 'Thêm thuộc tính thành công');
    }

    public function DetailAttrProduct(){
        $data['attributes'] = Attribute::all();
        return view('backend.attr.attr', $data);
    }

    public function EditAttrProduct($id){
        $data['attr'] = Attribute::find($id);
        return view('backend.attr.editattr', $data);
    }

    public function postEditAttrProduct(EditAttrRequest $request, $id){
        $attr = Attribute::find($id);
        $attr->name = $request->attr_name;
        $attr->save();
        return redirect('admin/product/detail-attr')->with('alert', 'Sửa thuộc tính thành công');
    }

    public function DeleteAttrProduct($id){
        Attribute::destroy($id);
        return redirect()->back()->with('alert', 'Xóa thuộc tính thành công');
    }

    public function AddValue(AddValueRequest $request){
        $value_model = new Value();
        $value_model->value = $request->attr_value;
        $value_model->attribute_id = $request->attr_id;
        $value_model->save();
        return redirect()->back()->with('alert', 'Thêm giá trị thuộc tính thành công');
    }

    public function EditValue(){
        return view('backend.attr.editvalue');
    }

    public function AddVariant($id){
        return view('backend.variant.addvariant', [
            'product' => Product::find($id),
        ]);
    }

    public function postAddVariant(Request $request, $id){
//        dd($request->all());
        foreach ($request->variant as $key => $value){
            $variant = Variant::find($key);
            $variant->price = $value;
            $variant->save();
        }
        return redirect('admin/product')->with('alert', 'Thêm sản phẩm thành công!');
    }

    public function EditVariant($id){
        $data = [
            'product' => Product::find($id),
        ];
        return view('backend.variant.editvariant', $data);
    }

    public function postEditVariant(Request $request, $id){
        foreach ($request->variant as $key => $value){
            $variant = Variant::find($key);
            $variant->price = $value;
            $variant->save();
        }
        return redirect('admin/product/edit/'.$id)->with('alert', 'Đã sửa thành công!');
    }

    public function DeleteVariant($id){
        Variant::destroy($id);
        return redirect()->back()->with('alert', 'Xóa biến thể thành công');
    }

}
