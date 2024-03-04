<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    public function allblogcategory(){
        $blogcategories=BlogCategory::latest()->get();
        return view('admin.blog_category.blog_category_all',compact('blogcategories'));
    }

    public function addblogcategory(){
        return view('admin.blog_category.blog_category_add');
    }

    public function storeblogcategory(Request $request){
        $request->validate([
            'blog_category'=>'required',
        ],[
            'blog_category.required'=>'Blog Category Name is Required',
        ]);

        $blogcategory=new BlogCategory();
        $blogcategory->blog_category=$request->blog_category;
        $blogcategory->save();

        $notification= array(
            'alert-type'=>'success',
            'message'=>'Blog Category Added Successfully'
        );

        return redirect()->route('all.blog.category')->with($notification);
    }

    public function editblogcategory($id){
        $blogcategory=BlogCategory::findOrFail($id);
        return view('admin.blog_category.blog_category_edit',compact('blogcategory'));
    }

    public function updateblogcategory(Request $request){
        $request->validate([
            'blog_category'=>'required',
        ],[
            'blog_category.required'=>'Blog Category Name is Required',
        ]);

        $blogcategory=BlogCategory::findOrFail($request->id);
        $blogcategory->blog_category=$request->blog_category;
        $blogcategory->save();

        $notification= array(
            'alert-type'=>'success',
            'message'=>'Blog Category Updated Successfully'
        );

        return redirect()->route('all.blog.category')->with($notification);
    }

    public function deleteblogcategory($id){
        $blogcategory=BlogCategory::findOrFail($id);
        $blogcategory->delete();

        $notification= array(
            'alert-type'=>'success',
            'message'=>'Blog Category Deleted Successfully'
        );

        return redirect()->back()->with($notification);
    }
}
