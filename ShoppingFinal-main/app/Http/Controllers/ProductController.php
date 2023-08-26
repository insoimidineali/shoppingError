<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function saveproduct(Request $request){
        $this->validate($request, [
            'product_name'=>'required',
            'product_price' =>'required',
            'product_category'=>'required',
            'description_product'=>'required',
            'product_image'=>'image|nullable|max:1999'

        ]);


        //  getteing the origianal name of the file 
            // print($request->file('image')->getClientOriginalName());
            
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();

            // file name without ext
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Print($fileName);
       
            // geting extention
            $extention = $request->file('product_image')->getClientOriginalExtension();
            print($extention);

            // now we stor the filename only in the data base , not the images

            $fileNameToStor = $fileName."_".time().".".$extention;
            // print($fileNameToStor);

            // uploiding immage in the laravel file 

            $path = $request->file("product_image")->storeAs("public/product_images", $fileNameToStor);
            
            $product = new Product();
            $product->product_name = $request->input("product_name");
            $product->product_price = $request->input("product_price");
            $product->product_category = $request->input("product_category");
            $product->description_product = $request->input("description_product");
            $product->product_image = $fileNameToStor;

            $product->save();

            return back()->with("status", "votre Category a ete enregister avec success");
    }

    public function deleteproduct($id){
        $product = Product::find($id);
        Storage::delete("public/product_images/$product->product_image");

       $product->delete();
       return back()->with("status", "Deleting Successful");

        
    }

    public function editeproduct($id){
        $product = Product::find($id);
        $category = Category::where("category_name", "!=", $product->product_category)->get();
        return view("admin/editeproduct")->with("product", $product)->with("CTGR", $category);
    }
   
        public function updateproduct($id, Request $request){
            $product = Product::find($id);
            
            $product->product_name = $request->input("product_name");
            $product->product_price = $request->input("product_price");
            $product->product_category = $request->input("product_category");
            $product->description_product = $request->input("description_product");
            if($request->file("product_image")){
    
                $this->validate($request, [
                    "product_image" => "image|nullable|max:1999"
                ]);
                
                $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
               
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                
                $ext = $request->file('product_image')->getClientOriginalExtension();
                            // now we stor the filename only in the data base , not the images
                
                $fileNameToStor = $fileName."_".time().".".$ext;
                
                Storage::delete("public/product_images/$product->product_image");
    
                $path = $request->file("product_image")->storeAs("public/product_images", $fileNameToStor);
           
                $product->product_image = $fileNameToStor;
    
            }
    
            $product->update();
            return redirect("/admin/products")->with("status","Product updated successfull");
    
        
    

    }
    public function Desactivate($id){
        $slider =Product::find($id);
        $slider->status = 0;

        $slider->update();
        return back();
    }
    public function activate($id){
        $slider = Product::find($id);
        $slider->status = 1;
        $slider->update();
        return back();
    }

    

    
}
