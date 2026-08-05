<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoFrontController extends Controller
{
    public function index()
    {
        $videos = Video::where('status', 'Show')
            ->latest()
            ->get();

        return view('frontend.video', compact('videos'));
    }

    public function incrementHit(Video $video)
    {
        $video->increment('hit');

        return response()->json([
            'success' => true
        ]);
    }
}