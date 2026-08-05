<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClientController extends Controller
{
    public function index()
    {
        $client = Client::latest()->get();

        return view('admin.client.index', compact('client'));
    }

    public function create()
    {
        return view('admin.client.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|max:255',
            'img'    => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:Show,Hide',
            'url'    => 'nullable|url',
        ]);

        $namaGambar = null;

        if ($request->hasFile('img')) {

            $file = $request->file('img');

            $namaGambar = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/client'), $namaGambar);
        }

        Client::create([
            'title'  => $request->title,
            'img'    => $namaGambar,
            'status' => $request->status,
            'url'    => $request->url,
        ]);

        return redirect()
            ->route('client.index')
            ->with('success', 'Client berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('admin.client.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $request->validate([
            'title'  => 'required|max:255',
            'img'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:Show,Hide',
            'url'    => 'nullable|url',
        ]);

        $namaGambar = $client->img;

        if ($request->hasFile('img')) {

            if ($client->img && File::exists(public_path('uploads/client/' . $client->img))) {
                File::delete(public_path('uploads/client/' . $client->img));
            }

            $file = $request->file('img');

            $namaGambar = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/client'), $namaGambar);
        }

        $client->update([
            'title'  => $request->title,
            'img'    => $namaGambar,
            'status' => $request->status,
            'url'    => $request->url,
        ]);

        return redirect()
            ->route('client.index')
            ->with('success', 'Client berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        if ($client->img && File::exists(public_path('uploads/client/' . $client->img))) {
            File::delete(public_path('uploads/client/' . $client->img));
        }

        $client->delete();

        return redirect()
            ->route('client.index')
            ->with('success', 'Client berhasil dihapus.');
    }
}