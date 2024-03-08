<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function footer(){
        $footerdetails = Footer::find(1);
        return view('admin.footer.footer',compact('footerdetails'));
    }

    public function updatefooter(Request $request){
        $footer = Footer::find(1);
        $footer->update($request->all());
        $notification = array(
            'message' => 'Footer updated successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
