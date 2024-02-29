<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function aboutpage(){
        $aboutdata=About::find(1);
        return view('admin.about_page.about_page_all',compact('aboutdata'));

    }

    public function updateabout(Request $request){
        $aboutid=$request->id;
        if($request->file('about_image')){
            $image=$request->file('about_image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //Image::make($image)->resize(636,852)->save('upload/home_slider/',$name_gen);
            $image->move(public_path('upload/about_image/'),$name_gen);

        $save_url='upload/about_image/'.$name_gen;

        About::findOrFail($aboutid)->update([
            'title'=>$request->title,
            'short_title'=>$request->short_title,
            'about_image'=>$save_url,
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,

        ]);

        $notification= array(
            'alert-type'=>'success',
            'message'=>'About Section Updated Successfully'
        );

        return redirect()->back()->with($notification);}
        else{
            About::findOrFail($aboutid)->update([
                'title'=>$request->title,
            'short_title'=>$request->short_title,

            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,
            ]);

            $notification= array(
                'alert-type'=>'success',
                'message'=>'About section data Updated Successfully'
            );

            return redirect()->back()->with($notification);
        }

    }

    public function homeabout(){
        $aboutdata=About::find(1);
        return view('frontend.about_page',compact('aboutdata'));
    }


    public function aboutmultiimage(){
        return view('admin.about_page.multiimage');
    }

    public function storemultiimage(Request $request){
        $images=$request->file('multi_image');
        foreach($images as $image){
        $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        $image->move(public_path('upload/multi_image/'),$name_gen);

    $save_url='upload/multi_image/'.$name_gen;

    MultiImage::insert([
'multi_image'=>$save_url,
'created_at'=>Carbon::now()
    ]);

        }
    $notification= array(
        'alert-type'=>'success',
        'message'=>'Multiple Images Uploaded Successfully'
    );

    return redirect()->route('about.all.multiimage')->with($notification);
    }


    public function aboutallmultiimage(){
        $images=MultiImage::all();
        return view('admin.about_page.all_multiimage',compact('images'));
    }

    public function abouteditmultiimage($id){
        $images=MultiImage::findOrFail($id);
        return view('admin.about_page.edit_multiimage',compact('images'));

    }

    public function updatemultiimage(Request $request){
        $image=MultiImage::findOrFail($request->id);
        if($request->file('multi_image')){
            unlink(public_path($image->multi_image));
            $image=$request->file('multi_image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload/multi_image/'),$name_gen);
            $save_url='upload/multi_image/'.$name_gen;

            MultiImage::findOrFail($request->id)->update([
            'multi_image'=>$save_url,
             ]);

        $notification= array(
            'alert-type'=>'success',
            'message'=>'Image Updated Successfully'
        );

        return redirect()->route('about.all.multiimage')->with($notification);}
    }
    public function aboutdeletemultiimage($id){
        $image=MultiImage::findOrFail($id);
        unlink(public_path($image->multi_image));
        $image->delete();
        $notification= array(
            'alert-type'=>'success',
            'message'=>'Image Deleted Successfully'
        );

        return redirect()->back()->with($notification);
    }
}
