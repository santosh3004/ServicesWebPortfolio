<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'blog_category',
    ];

    public function blogs(){
        return $this->hasMany(Blog::class,'id','blog_category_id');
    }


}
