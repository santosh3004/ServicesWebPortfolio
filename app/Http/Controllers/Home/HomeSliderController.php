<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use Image;

class HomeSliderController extends Controller
{
    public function homeslider(){
        $homeslide=HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all',compact('homeslide'));

    }


    public function updateslider(Request $request){

        $slide_id=$request->id;
        if($request->file('home_slider')){
            $image=$request->file('home_slider');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //Image::read($image)->resize(636,852)->save('upload/home_slider/',$name_gen);
            $image->move(public_path('upload/home_slider/'),$name_gen);

        $save_url='upload/home_slider/'.$name_gen;

        HomeSlide::findOrFail($slide_id)->update([
            'title'=>$request->title,
            'short_title'=>$request->title,
            'home_slide'=>$save_url,
            'video_url'=>$request->video_url,
        ]);

        $notification= array(
            'alert-type'=>'success',
            'message'=>'Home Slider Updated Successfully'
        );

        return redirect()->back()->with($notification);}
        else{
            HomeSlide::findOrFail($slide_id)->update([
                'title'=>$request->title,
                'short_title'=>$request->title,
                'video_url'=>$request->video_url,
            ]);

            $notification= array(
                'alert-type'=>'success',
                'message'=>'Home Slider Updated Successfully'
            );

            return redirect()->back()->with($notification);
        }

    }
}
