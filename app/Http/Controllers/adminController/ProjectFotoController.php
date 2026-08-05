<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProjectFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectFotoController extends Controller
{
    public function index()
    {
        $fotos = ProjectFoto::with('program')->latest()->get();

        return view('admin.projectfoto.index', compact('fotos'));
    }


    public function create()
    {
        $programs = Program::all();

        return view('admin.projectfoto.create', compact('programs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_project' => 'required|exists:program,id',
            'img'        => 'required|array|min:1',
            'img.*'      => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $uploadPath = public_path('uploads/project_foto');


        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }


        foreach ($request->file('img') as $file) {

            $fileName = time() . '_' .
                Str::random(8) .
                '.' .
                $file->getClientOriginalExtension();


            $file->move($uploadPath, $fileName);


            ProjectFoto::create([
                'id_project' => $request->id_project,
                'img'        => 'uploads/project_foto/' . $fileName,
            ]);
        }


        return redirect()
            ->route('projectfoto.index')
            ->with('success', 'Foto berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $foto     = ProjectFoto::findOrFail($id);
        $programs = Program::all();

        return view('admin.projectfoto.edit', compact('foto', 'programs'));
    }


    public function update(Request $request, $id)
    {
        $foto = ProjectFoto::findOrFail($id);


        $request->validate([
            'id_project' => 'required|exists:program,id',
            'img'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $data = $request->only('id_project');


        $uploadPath = public_path('uploads/project_foto');


        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }


        if ($request->hasFile('img')) {

            // hapus gambar lama
            if ($foto->img && file_exists(public_path($foto->img))) {

                unlink(public_path($foto->img));

            }


            $file = $request->file('img');


            $fileName = time() . '_' .
                Str::random(8) .
                '.' .
                $file->getClientOriginalExtension();


            $file->move($uploadPath, $fileName);


            $data['img'] = 'uploads/project_foto/' . $fileName;
        }


        $foto->update($data);


        return redirect()
            ->route('projectfoto.index')
            ->with('success', 'Foto berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $foto = ProjectFoto::findOrFail($id);


        // hapus gambar
        if ($foto->img && file_exists(public_path($foto->img))) {

            unlink(public_path($foto->img));

        }


        $foto->delete();


        return redirect()
            ->route('projectfoto.index')
            ->with('success', 'Foto berhasil dihapus.');
    }
}