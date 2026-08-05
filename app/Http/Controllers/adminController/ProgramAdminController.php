<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\KategoriProject;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ProgramAdminController extends Controller
{
    public function index()
    {
        $programs = Program::with(['category', 'service'])
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('admin.program.index', compact('programs'));
    }

    public function create()
    {
        $categories = KategoriProject::all();
        $services = Service::all();

        return view('admin.program.create', compact('categories', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',

            'title.id' => 'required|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'title.jp' => 'nullable|string|max:255',

            'content.id' => 'required|string',
            'content.en' => 'nullable|string',
            'content.jp' => 'nullable|string',

            'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'required|in:Show,Hide',
            'url' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',

            'id_category' => 'required|exists:kategori_project,id',
            'id_service' => 'required|exists:service,id',
        ]);

        $data = $request->except('img');

        $data['slug'] = $this->generateUniqueSlug($request->input('title.id'));
        $data['hit'] = 0;

        $data = $this->autoTranslate($data, [
            'title',
            'content',
        ]);

        $uploadPath = public_path('uploads/program');

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($request->hasFile('img')) {

            $file = $request->file('img');

            $fileName = time() . '_' .
                Str::slug($request->input('title.id')) .
                '.' .
                $file->getClientOriginalExtension();

            $file->move($uploadPath, $fileName);

            $data['img'] = 'uploads/program/' . $fileName;
        }

        Program::create($data);

        return redirect()
            ->route('programadmin.index')
            ->with('success', 'Program berhasil ditambahkan.');
    }

    public function show(Program $programadmin)
    {
        $programadmin->load(['category', 'service']);

        return view('admin.program.show', [
            'program' => $programadmin
        ]);
    }

    public function edit(Program $programadmin)
    {
        $categories = KategoriProject::all();
        $services = Service::all();

        return view('admin.program.edit', [
            'program' => $programadmin,
            'categories' => $categories,
            'services' => $services,
        ]);
    }

    public function update(Request $request, Program $programadmin)
    {
        $request->validate([
            'date' => 'required|date',

            'title.id' => 'required|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'title.jp' => 'nullable|string|max:255',

            'content.id' => 'required|string',
            'content.en' => 'nullable|string',
            'content.jp' => 'nullable|string',

            'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'required|in:Show,Hide',
            'url' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',

            'id_category' => 'required|exists:kategori_project,id',
            'id_service' => 'required|exists:service,id',
        ]);

        $data = $request->except('img');

        $data['slug'] = $this->generateUniqueSlug(
            $request->input('title.id'),
            $programadmin->id
        );

        $data = $this->autoTranslate($data, [
            'title',
            'content',
        ]);

        $uploadPath = public_path('uploads/program');

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($request->hasFile('img')) {

            if ($programadmin->img && file_exists(public_path($programadmin->img))) {
                unlink(public_path($programadmin->img));
            }

            $file = $request->file('img');

            $fileName = time() . '_' .
                Str::slug($request->input('title.id')) .
                '.' .
                $file->getClientOriginalExtension();

            $file->move($uploadPath, $fileName);

            $data['img'] = 'uploads/program/' . $fileName;
        }

        $programadmin->update($data);

        return redirect()
            ->route('programadmin.index')
            ->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $programadmin)
    {
        if ($programadmin->img && file_exists(public_path($programadmin->img))) {
            unlink(public_path($programadmin->img));
        }

        $programadmin->delete();

        return redirect()
            ->route('programadmin.index')
            ->with('success', 'Program berhasil dihapus.');
    }

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        $query = Program::where('slug', $slug);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {

            $slug = $originalSlug . '-' . $count;
            $count++;

            $query = Program::where('slug', $slug);

            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
        }

        return $slug;
    }

    /**
     * Isi otomatis field EN/JP yang dikosongkan admin,
     * hasil translate dari versi Bahasa Indonesia.
     */
    private function autoTranslate(array $data, array $fields): array
    {
        foreach ($fields as $field) {

            $idText = $data[$field]['id'] ?? '';

            if (empty($idText)) {
                continue;
            }

            if (empty($data[$field]['en'])) {
                try {
                    $data[$field]['en'] = (new GoogleTranslate('en'))->translate($idText);
                } catch (\Exception $e) {
                    // abaikan jika translate gagal
                }
            }

            if (empty($data[$field]['jp'])) {
                try {
                    $data[$field]['jp'] = (new GoogleTranslate('ja'))->translate($idText);
                } catch (\Exception $e) {
                    // abaikan jika translate gagal
                }
            }
        }

        return $data;
    }
}