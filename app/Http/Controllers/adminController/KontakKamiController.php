<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\KontakKami;
use Illuminate\Http\Request;

class KontakKamiController extends Controller
{
  
    public function index()
    {
        $kontakkami = KontakKami::latest()->get();

        return view('admin.kontak.index', compact('kontakkami'));
    }

   
    public function create()
    {
        return view('admin.kontak.create');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'kontak'  => 'required|string',
            'type'    => 'required|string|max:100',
        ]);

        KontakKami::create([
            'title'   => $request->title,
            'kontak'  => $request->kontak,
            'type'    => $request->type,
        ]);

        return redirect()
            ->route('kontakkami.index')
            ->with('success', 'Data kontak berhasil ditambahkan.');
    }

    
    public function show(KontakKami $kontakkami)
    {
        //
    }

    public function edit(KontakKami $kontakkami)
    {
        return view('admin.kontak.edit', compact('kontakkami'));
    }

   
    public function update(Request $request, KontakKami $kontakkami)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'kontak'  => 'required|string',
            'type'    => 'required|string|max:100',
        ]);

        $kontakkami->update([
            'title'   => $request->title,
            'kontak'  => $request->kontak,
            'type'    => $request->type,
        ]);

        return redirect()
            ->route('kontakkami.index')
            ->with('success', 'Data kontak berhasil diperbarui.');
    }

    
    public function destroy(KontakKami $kontakkami)
    {
        $kontakkami->delete();

        return redirect()
            ->route('kontakkami.index')
            ->with('success', 'Data kontak berhasil dihapus.');
    }
}