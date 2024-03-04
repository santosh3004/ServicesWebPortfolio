<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    public function allblog(){
        $blogs=Blog::latest()->get();
        return view('admin.blogs.blogs_all',compact('blogs'));
    }

    public function addblog(){
        return view('admin.blogs.blogs_add');
    }
}
