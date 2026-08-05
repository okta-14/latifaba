<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FotoController extends Controller
{
    public function index()
    {
        $fotos = Foto::with('album')
            ->latest()
            ->get();

        return view('admin.foto.index', compact('fotos'));
    }

    public function create()
    {
        $albums = Album::orderBy('title')->get();

        return view('admin.foto.create', compact('albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_album' => 'required|exists:album,id',
            'img'      => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data = $request->only('id_album');

        $uploadPath = public_path('uploads/foto');

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($request->hasFile('img')) {

            $file = $request->file('img');

            $album = Album::find($request->id_album);

            $fileName = time() . '_' .
                Str::slug($album->title ?? 'foto') . '.' .
                $file->getClientOriginalExtension();

            $file->move($uploadPath, $fileName);

            $data['img'] = 'uploads/foto/' . $fileName;
        }

        Foto::create($data);

        return redirect()
            ->route('foto.index')
            ->with('success', 'Foto berhasil ditambahkan.');
    }

    public function show($id)
    {
        $foto = Foto::with('album')->findOrFail($id);

        return view('admin.foto.show', compact('foto'));
    }

    public function edit($id)
    {
        $foto = Foto::findOrFail($id);

        $albums = Album::orderBy('title')->get();

        return view('admin.foto.edit', compact('foto', 'albums'));
    }

    public function update(Request $request, $id)
    {
        $foto = Foto::findOrFail($id);

        $request->validate([
            'id_album' => 'required|exists:album,id',
            'img'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data = $request->only('id_album');

        $uploadPath = public_path('uploads/foto');

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($request->hasFile('img')) {

            if ($foto->img && file_exists(public_path($foto->img))) {
                unlink(public_path($foto->img));
            }

            $file = $request->file('img');

            $album = Album::find($request->id_album);

            $fileName = time() . '_' .
                Str::slug($album->title ?? 'foto') . '.' .
                $file->getClientOriginalExtension();

            $file->move($uploadPath, $fileName);

            $data['img'] = 'uploads/foto/' . $fileName;
        }

        $foto->update($data);

        return redirect()
            ->route('foto.index')
            ->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);

        if ($foto->img && file_exists(public_path($foto->img))) {
            unlink(public_path($foto->img));
        }

        $foto->delete();

        return redirect()
            ->route('foto.index')
            ->with('success', 'Foto berhasil dihapus.');
    }
}