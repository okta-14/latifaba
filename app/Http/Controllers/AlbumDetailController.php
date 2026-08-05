<?php

namespace App\Http\Controllers;

use App\Models\Album;

class AlbumDetailController extends Controller
{
    public function detail($slug)
    {
        $album = Album::with('fotos')
                    ->where('slug',$slug)
                    ->where('status','Show')
                    ->firstOrFail();

        $album->increment('hit');

        return view('frontend.albumDetail',compact('album'));
    }
}