<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AlbumAdminController extends Controller
{
    public function index()
    {
        $albums = Album::latest()->get();

        return view('admin.album.index', compact('albums'));
    }


    public function create()
    {
        return view('admin.album.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|max:100',
            'date'   => 'required|date',
            'status' => 'required|in:Show,Hide',
            'img'    => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $data = $request->except('img');


        $data['slug'] = Str::slug($request->title);
        $data['hit'] = 0;


        $uploadPath = public_path('uploads/album');


        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }


        if ($request->hasFile('img')) {

            $file = $request->file('img');


            $fileName = time() . '_' .
                Str::slug($request->title) .
                '.' .
                $file->getClientOriginalExtension();


            $file->move($uploadPath, $fileName);


            $data['img'] = 'uploads/album/' . $fileName;
        }


        Album::create($data);


        return redirect()
            ->route('albumadmin.index')
            ->with('success', 'Album berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $album = Album::findOrFail($id);


        return view('admin.album.edit', compact('album'));
    }




    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);


        $request->validate([
            'title'  => 'required|max:100',
            'date'   => 'required|date',
            'status' => 'required|in:Show,Hide',
            'img'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);



        $data = $request->except('img');


        $data['slug'] = Str::slug($request->title);



        $uploadPath = public_path('uploads/album');



        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }



        if ($request->hasFile('img')) {


            // hapus gambar lama
            if ($album->img && file_exists(public_path($album->img))) {

                unlink(public_path($album->img));

            }



            $file = $request->file('img');



            $fileName = time() . '_' .
                Str::slug($request->title) .
                '.' .
                $file->getClientOriginalExtension();



            $file->move($uploadPath, $fileName);



            $data['img'] = 'uploads/album/' . $fileName;
        }



        $album->update($data);



        return redirect()
            ->route('albumadmin.index')
            ->with('success', 'Album berhasil diperbarui.');
    }





    public function destroy($id)
    {
        $album = Album::findOrFail($id);



        // hapus gambar
        if ($album->img && file_exists(public_path($album->img))) {

            unlink(public_path($album->img));

        }



        $album->delete();



        return redirect()
            ->route('albumadmin.index')
            ->with('success', 'Album berhasil dihapus.');
    }
}