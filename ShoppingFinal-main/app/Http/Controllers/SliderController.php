<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Print_;

use function Symfony\Component\String\b;

class SliderController extends Controller
{
    //
    public function saveslider(Request  $request){
       
            $this->validate($request, [
                'description2'=>'required',
                'description1' =>'required',
                'image'=>'image|nullable|max:1999'
            ]);
            //getteing the origianal name of the file 
            // print($request->file('image')->getClientOriginalName());
            
            $fileNameWithExt = $request->file('image')->getClientOriginalName();

            // file name without ext
          $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Print($fileName);
       
            // geting extention
            $ext = $request->file('image')->getClientOriginalExtension();
            // print($ext);

            // now we stor the filename only in the data base , not the images

            $fileNameToStor = $fileName."_".time().".".$ext;
            // print($fileNameToStor);

            // uploiding immage in the laravel file 

            $path = $request->file("image")->storeAs("public/slide_images", $fileNameToStor);
            
            $slider = new Slider();
            $slider->description_1 = $request->input("description1");
            $slider->description_2 = $request->input("description2");
            $slider->image = $fileNameToStor;

            $slider->save();

            return back()->with("status", "votre slider a ete enregister avec success");

        

        }  
    public function deleteslider($id){
        $slider =  Slider::find($id);
       
        Storage::delete("public/slide_images/$slider->images");
       
        $slider->delete();
        return back()->with("status", "Deleting Successful");

    }  
    public function editeSlider($id){
        $slider = Slider::find($id);
        return view("admin/editeSlider")->with("SLDRS", $slider);
    }

    public function updateSlider($id, Request $request){
        $slider = Slider::find($id);
        $slider->description_1 = $request->input("description1");
        $slider->description_2 = $request->input("description2");

        if($request->file("image")){

            $this->validate($request, [
                "image" => "image|nullable|max:1999"
            ]);
            
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
           
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            
            $ext = $request->file('image')->getClientOriginalExtension();
                        // now we stor the filename only in the data base , not the images
            
            $fileNameToStor = $fileName."_".time().".".$ext;
            
            Storage::delete("public/slide_images/$slider->images");

            $path = $request->file("image")->storeAs("public/slide_images", $fileNameToStor);
       
            $slider->images = $fileNameToStor;

        }

        $slider->update();
        return redirect("/admin/slider")->with("status","Slider updated successfull");

    }

    public function DesactivateSlider($id){
        $slider =Slider::find($id);
        $slider->status = 0;
        $slider->update();
        return back();
    }
    public function activateSlider($id){
        $slider = Slider::find($id);
        $slider->status = 1;
        $slider->update();
        return back();
    }


}
