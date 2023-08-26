<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Command;
class AdminController extends Controller
{
    //
    public function home(){
        return view('admin.home');
    }
    public function addcategory(){
        return view('admin.addcategory');
    }
    public function categories(){
        // Display the categories
        $categries = Category::get();
        return view('admin.categories')->with("CTGR",$categries);
    }

     public function addslider(){
        return view('admin.addslider');
    
    }  
    public function slider(){
        $slider = Slider::get();
        return view('admin.slider')->with("SLDR",$slider);
        return view("admin.slider");
        
    } 
    public function products(){
        $product = Product::get();
        return view("admin.products")->with("PRDCT", $product);
    }
    public function addproduct(){
        $categories = Category::get();
        return view("admin.addproduct")->with("categoriess", $categories);

    }
    public function orders(){
        $commands  = Command::all();
        $commands->transform(function($command, $key){
           
            $command->cart = unserialize($command->cart);
            return $command;
        });

        return view('admin.orders')->with("commands", $commands);
    }

}
