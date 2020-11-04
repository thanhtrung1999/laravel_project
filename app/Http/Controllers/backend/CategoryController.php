<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use Illuminate\Http\Request;
use App\models\Category;

class CategoryController extends Controller
{
    public function getCategory(){
        $data['categories'] = Category::all();
        return view('backend.category.category', $data);
    }

    public function postCategory(AddCategoryRequest $request){
        $category_model = new Category();
        $category_model->name = $request->name;
        $category_model->parent = $request->categories_parent;
        $category_model->save();
        return redirect()->back()->with('alert', 'Thêm danh mục thành công');
    }

    public function editCategory($id){
        $data = [
            'category' => Category::find($id),
            'categories' => Category::all()
        ];
        return view('backend.category.editcategory', $data);
    }

    public function postEditCategory(EditCategoryRequest $request, $id){
        $category = Category::find($id);
        $category->name = $request->name;
        $category->parent = $request->categories_parent;
        $category->save();
        return redirect()->back()->with('alert', 'Sửa danh mục thành công');
    }

    public function deleteCategory($id){
        $category = Category::find($id);
        Category::destroy($id);
        Category::where('parent', $id)->delete();
        return redirect()->back()->with('alert', 'Xóa danh mục '.$category->name.' thành công');
    }
}
