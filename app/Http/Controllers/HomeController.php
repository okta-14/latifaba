<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Program;
use App\Models\Blog;
use App\Models\Video;
use App\Models\GroupCompanies;

class HomeController extends Controller
{
    public function index()
    {
        // 3 review terbaru yang sudah disetujui
        $reviews = Review::where('status', 'Show')
            ->latest()
            ->take(3)
            ->get();

        // 3 program terbaru yang statusnya Show
        $programs = Program::where('status', 'Show')
            ->orderBy('date', 'desc')
            ->take(3)
            ->get();

        // 4 blog/artikel terbaru yang statusnya Show
        // (1 dipakai untuk featured-news, 3 sisanya untuk news-list)
        $blogs = Blog::where('status', 'Show')
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();

        $videos = Video::where('status', 'Show')
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();


        $members = GroupCompanies::where('status', 'Show')
            ->latest()
            ->get();

        return view('frontend.home', compact(
            'reviews',
            'programs',
            'blogs',
            'videos',
            'members'
        ));
    }
}