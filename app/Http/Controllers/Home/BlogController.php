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
}
