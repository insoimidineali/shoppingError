<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //

    public function savecategory(Request $request){
        $category = new category();
                    //  data base                  champs de saisi
        $category->category_name = $request->input("name_category");
        $category->save();
        return back()->with("status","category registreration successfull");
    }

    public function deleteCategory($id){
        $category =  Category::find($id);
        $category->delete();

        return back()->with("status", "Deleting Successful");
    }

    public function editeCategory($id){
        $category = Category::find($id);
        return view('admin/editCategory')->with("CATGRY", $category);
    }

    public function updatecategory($id, Request $request){
        $category = Category::find($id);
        $category->category_name = $request->input("name_category");
        $category->update();
        return redirect("admin/categories")->with("status","category updated successfull");

    }

}
