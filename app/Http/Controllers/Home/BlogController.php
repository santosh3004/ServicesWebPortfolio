<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    public function allblog(){
        $blogs=Blog::latest()->get();
        return view('admin.blogs.blogs_all',compact('blogs'));
    }

    public function addblog(){
        $categories=BlogCategory::orderBy('blog_category','asc')->get();
        return view('admin.blogs.blogs_add',compact('categories'));
    }

    public function storeblog(Request $request){
        $request->validate([
            'blog_title'=>'required',
            'blog_category'=>'required',
            'blog_image'=>'required|mimes:jpg,jpeg,png',
            'blog_tags'=>'required',
            'blog_description'=>'required',
        ],
        [
            'blog_title.required'=>'Blog Title is Required',
            'blog_category.required'=>'Blog Category is Required',
            'blog_image.required'=>'Blog Image is Required',
            'blog_image.mimes'=>'This file type is not supported',
            'blog_tags.required'=>'Blog Tags is Required',
            'blog_description.required'=>'Blog Description is Required',
        ]);

        $blog_image=$request->file('blog_image');
        $name_gen=hexdec(uniqid()).'.'.$blog_image->getClientOriginalExtension();
        $blog_image->move(public_path('upload/blog_image/'),$name_gen);
        $save_url='upload/blog_image/'.$name_gen;

        Blog::insert([
            'blog_title'=>$request->blog_title,
            'blog_category_id'=>$request->blog_category,
            'blog_image'=>$save_url,
            'blog_tags'=>$request->blog_tags,
            'blog_description'=>$request->blog_description,
            'created_at'=>Carbon::now()
        ]);

        return redirect()->route('all.blog')->with('success','Blog Added Successfully');
    }

    public function editblog($id){
        $categories=BlogCategory::orderBy('blog_category','asc')->get();
        $blog=Blog::find($id);
        return view('admin.blogs.blogs_edit',compact('categories','blog'));
    }

    public function updateblog(Request $request){

        $id=$request->id;
        $request->validate([
            'blog_title'=>'required',
            'blog_category'=>'required',
            'blog_tags'=>'required',

            'blog_description'=>'required',
        ],
        [
            'blog_title.required'=>'Blog Title is Required',
            'blog_category.required'=>'Blog Category is Required',
            'blog_tags.required'=>'Blog Tags are Required',

            'blog_description.required'=>'Blog Description is Required',
        ]);
        $blog=Blog::findOrFail($id);

        if($request->file('blog_image')){
            $blog_image=$request->file('blog_image');
            unlink($blog->blog_image);
            $name_gen=hexdec(uniqid()).'.'.$blog_image->getClientOriginalExtension();
            $blog_image->move(public_path('upload/blog_image/'),$name_gen);
            $save_url='upload/blog_image/'.$name_gen;
            $blog->update([
                'blog_title'=>$request->blog_title,
                'blog_category_id'=>$request->blog_category,
                'blog_image'=>$save_url,
                'blog_tags'=>$request->blog_tags,
                'blog_description'=>$request->blog_description,
            ]);
        }else{
            $blog->update([
                'blog_title'=>$request->blog_title,
                'blog_category_id'=>$request->blog_category,
                'blog_tags'=>$request->blog_tags,
                'blog_description'=>$request->blog_description,
            ]);
        }
        $notification= array(
            'alert-type'=>'success',
            'message'=>'Blog Updated Successfully'
        );
        return redirect()->route('all.blog')->with($notification);
    }


    public function deleteblog($id){
        $blog=Blog::findOrFail($id);
        unlink($blog->blog_image);
        $blog->delete();
        $notification= array(
            'alert-type'=>'success',
            'message'=>'Blog Deleted Successfully'
        );
        return redirect()->route('all.blog')->with($notification);
    }

    public function blogdetails($id){
        $blogs=Blog::latest()->limit(5)->get();
        $blog=Blog::findOrFail($id);
        $categories=BlogCategory::orderBy('blog_category','asc')->limit(5)->get();
        return view('frontend.blog_details',compact('blog','blogs','categories'));
    }

    public function categoryblog($id){
        $recentblogs=Blog::where('blog_category_id',$id)->orderBy('id','desc')->get();
        $blogs=Blog::latest()->limit(5)->get();
        $categories=BlogCategory::orderBy('blog_category','asc')->get();
        return view('frontend.blog_by_category',compact('blogs','categories','recentblogs'));
    }

    public function homeblogs(){
        $blogs=Blog::latest()->get();
        $categories=BlogCategory::orderBy('blog_category','asc')->get();
        $recentblogs=Blog::latest()->limit(5)->get();
        return view('frontend.blogs',compact('blogs','categories','recentblogs'));
    }
}
