<?php
namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->get();

        return view('admin.video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.video.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'    => 'required|date',
            'title'   => 'required|max:100',
            'content' => 'required',
            'source'  => 'required|url',
            'status'  => 'required|in:Show,Hide',
        ]);

        Video::create([
            'date'    => $request->date,
            'title'   => $request->title,
            'content' => $request->content,
            'source'  => $request->source,
            'hit'     => 0,
            'status'  => $request->status,
            'slug'    => Str::slug($request->title),
        ]);

        return redirect()
            ->route('video.index')
            ->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(Video $video)
    {
        return view('admin.video.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'date'    => 'required|date',
            'title'   => 'required|max:100',
            'content' => 'required',
            'source'  => 'required|url',
            'status'  => 'required|in:Show,Hide',
        ]);

        $video->update([
            'date'    => $request->date,
            'title'   => $request->title,
            'content' => $request->content,
            'source'  => $request->source,
            'status'  => $request->status,
            'slug'    => Str::slug($request->title),
        ]);

        return redirect()
            ->route('video.index')
            ->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()
            ->route('video.index')
            ->with('success', 'Video berhasil dihapus.');
    }
}