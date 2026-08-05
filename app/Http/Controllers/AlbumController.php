<?php

namespace App\Http\Controllers;

use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::withCount('fotos')
                        ->where('status','Show')
                        ->latest()
                        ->get();

        return view('frontend.album',compact('albums'));
    }
}