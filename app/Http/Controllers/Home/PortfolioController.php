<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Carbon;


class PortfolioController extends Controller
{
    public function allportfolio(){
        $portfolios=Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all',compact('portfolios'));
    }

    public function addportfolio(){
        return view('admin.portfolio.portfolio_add');
    }

    public function storeportfolio(Request $request){
        $request->validate([
            'portfolio_name'=>'required',
            'portfolio_title'=>'required',
            'portfolio_description'=>'required',
            'portfolio_image'=>'required',
        ],[
            'portfolio_name.required'=>'Portfolio Name is Required',
            'portfolio_title.required'=>'Portfolio Title is Required',
            'portfolio_description.required'=>'Portfolio Description is Required',
            'portfolio_image.required'=>'Portfolio Image is Required',]);

            $image=$request->file('portfolio_image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload/portfolio_image/'),$name_gen);

        $save_url='upload/portfolio_image/'.$name_gen;

        $portfolio=new Portfolio();
        $portfolio->portfolio_name=$request->portfolio_name;
        $portfolio->portfolio_title=$request->portfolio_title;
        $portfolio->portfolio_description=$request->portfolio_description;
        $portfolio->portfolio_image=$save_url;
        $portfolio->save();

        $notification= array(
            'alert-type'=>'success',
            'message'=>'Portfolio Added Successfully'
        );

        return redirect()->route('all.portfolio')->with($notification);
    }

    public function editportfolio($id){
        $portfolio=Portfolio::findOrFail($id);
        return view('admin.portfolio.portfolio_edit',compact('portfolio'));
    }

    public function updateportfolio(Request $request){
        $request->validate([
            'portfolio_name'=>'required',
            'portfolio_title'=>'required',
            'portfolio_description'=>'required',

        ],[
            'portfolio_name.required'=>'Portfolio Name is Required',
            'portfolio_title.required'=>'Portfolio Title is Required',
            'portfolio_description.required'=>'Portfolio Description is Required',
        ]);
        $portfolio=Portfolio::findOrFail($request->id);
            if($request->file('portfolio_image')){

                unlink(public_path($portfolio->portfolio_image));
                $image=$request->file('multi_image');
                $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('upload/multi_image/'),$name_gen);
                $save_url='upload/multi_image/'.$name_gen;
                $portfolio->portfolio_image=$save_url;
            }
        $portfolio->portfolio_name=$request->portfolio_name;
        $portfolio->portfolio_title=$request->portfolio_title;
        $portfolio->portfolio_description=$request->portfolio_description;
        $portfolio->update();

        $notification= array(
            'alert-type'=>'success',
            'message'=>'Portfolio Updated Successfully'
        );

        return redirect()->route('all.portfolio')->with($notification);
    }

    public function deleteportfolio($id){
        $portfolio=Portfolio::findOrFail($id);
        unlink(public_path($portfolio->portfolio_image));
        $portfolio->delete();

        $notification= array(
            'alert-type'=>'success',
            'message'=>'Portfolio Deleted Successfully'
        );

        return redirect()->route('all.portfolio')->with($notification);
    }

    public function portfoliodetails($id){
        $portfolio=Portfolio::findOrFail($id);
        return view('frontend.portfolio_details',compact('portfolio'));
    }

    public function homeallportfolio(){
        $portfolios=Portfolio::latest()->get();
        return view('frontend.portfolio.portfolio',compact('portfolios'));
    }
}
