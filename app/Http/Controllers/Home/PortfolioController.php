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
}
