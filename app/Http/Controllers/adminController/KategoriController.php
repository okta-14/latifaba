<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->get();

        return view('admin.kategori.index', compact('kategoris'));
    }


    public function create()
    {
        return view('admin.kategori.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->title);

        Kategori::create($data);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('admin.kategori.edit', compact('kategoris'));
    }


    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->title);

        $kategori->update($data);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}