<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaturan;
use App\Models\Service;
use App\Models\Client;
use App\Models\Program;
use App\Models\Blog;
use App\Models\Review;
use App\Models\Video;
use App\Models\Album;
use App\Models\GroupCompanies;

class LandingPageController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::first();

        $services = Service::where('status', 'Show')->latest()->get();

        $members = GroupCompanies::where('status', 'Show')->latest()->get();

        $programs = Program::where('status', 'Show')->latest()->get();

        $blogs = Blog::where('status', 'Show')->latest()->take(3)->get();

        $reviews = Review::where('status', 'Show')->latest()->take(3)->get();

        $videos = Video::where('status', 'Show')->latest()->take(3)->get();

        $albums = Album::latest()->take(6)->get();

        return view('frontend.landingPage', compact(
            'pengaturan',
            'services',
            'members',
            'programs',
            'blogs',
            'reviews',
            'videos',
            'albums'
        ));
    }
}