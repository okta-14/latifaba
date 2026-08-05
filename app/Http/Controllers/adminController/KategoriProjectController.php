<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\KategoriProject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriProjectController extends Controller
{
    public function index()
    {
        $kategori = KategoriProject::latest()->get();

        return view('admin.kategoriProject.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategoriProject.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        KategoriProject::create([
            'title' => $request->title,
            'slug'  => Str::slug($request->title),
        ]);

        return redirect()
            ->route('kategoriProject.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = KategoriProject::findOrFail($id);

        return view('admin.kategoriProject.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriProject::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
        ]);

        $kategori->update([
            'title' => $request->title,
            'slug'  => Str::slug($request->title),
        ]);

        return redirect()
            ->route('kategoriProject.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = KategoriProject::findOrFail($id);

        $kategori->delete();

        return redirect()
            ->route('kategoriProject.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}