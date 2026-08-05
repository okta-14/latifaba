<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tags;

class BlogDetailController extends Controller
{

    // DETAIL BLOG
    public function detail($slug)
    {

        $blog = Blog::with('category')
                    ->where('slug',$slug)
                    ->where('status','Show')
                    ->firstOrFail();

        $blog->increment('hit');

        $latestBlogs = Blog::where('status','Show')
                    ->where('id','!=',$blog->id)
                    ->latest()
                    ->take(5)
                    ->get();

        return view('frontend.blogDetail',compact('blog','latestBlogs'));

    }


    // TAG
    public function tag($slug)
    {

        $tag = Tags::where('slug', $slug)->firstOrFail();

        $tag->increment('hit');

        $blogs = Blog::with('category')
                    ->where('status', 'Show')
                    ->whereRaw("FIND_IN_SET(?, REPLACE(tags, ';', ','))", [$tag->id])
                    ->latest()
                    ->get();

        return view('frontend.tag', compact('tag', 'blogs'));

    }

}