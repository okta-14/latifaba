<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::all();
        return view('admin.pengaturan.index', compact('pengaturan'));
    }

    public function create()
    {
        return view('admin.pengaturan.create');
    }

    public function store(Request $request)
    {
        // Tambah https:// otomatis kalau admin mengisi URL tanpa http(s)
        $this->normalizeUrls($request);

        // VALIDASI
        $request->validate([
            'company' => 'required|max:255',
            'address.id' => 'required',
            'address.en' => 'nullable',
            'address.jp' => 'nullable',
            'phone' => 'required|max:255',
            'fax' => 'nullable|max:255',
            'email' => 'required|email',
            'website' => 'nullable|url|max:255',
            'map' => 'nullable',
            'script' => 'nullable',
            'intro' => 'nullable',
            'cek' => 'nullable|max:5',
            'url_popup' => 'nullable|url|max:255',
            'header' => 'nullable|max:255',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,ico|max:2048',
            'background' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background_intro' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'popup' => 'nullable|max:255',
            'copyright' => 'nullable|max:255',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keyword' => 'nullable',
            'seo' => 'nullable',
            'catalog' => 'nullable|url|max:255',
            'member' => 'nullable|url|max:255',
        ]);

        // SIAPKAN DATA (kecuali file)
        $data = $request->except(['favicon', 'background', 'background_intro', 'logo']);

        // AUTO-TRANSLATE ADDRESS
        $data = $this->autoTranslate($data, ['address']);

        // BUAT FOLDER JIKA BELUM ADA
        $uploadPath = public_path('uploads/pengaturan');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // HANDLE UPLOAD FAVICON
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $fileName = time() . '_favicon.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
            $data['favicon'] = 'uploads/pengaturan/' . $fileName;
        }

        // HANDLE UPLOAD BACKGROUND
        if ($request->hasFile('background')) {
            $file = $request->file('background');
            $fileName = time() . '_background.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
            $data['background'] = 'uploads/pengaturan/' . $fileName;
        }

        // HANDLE UPLOAD BACKGROUND_INTRO
        if ($request->hasFile('background_intro')) {
            $file = $request->file('background_intro');
            $fileName = time() . '_background_intro.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
            $data['background_intro'] = 'uploads/pengaturan/' . $fileName;
        }

        // HANDLE UPLOAD LOGO
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_logo.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
            $data['logo'] = 'uploads/pengaturan/' . $fileName;
        }

        // SIMPAN KE DATABASE
        Pengaturan::create($data);

        return redirect()->route('pengaturan.index')
            ->with('success', 'Data pengaturan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengaturan = Pengaturan::findOrFail($id);

        // Ambil nilai mentah dari database, apapun setting model-nya
        $raw = $pengaturan->getRawOriginal('address');

        if (is_array($raw)) {
            $address = $raw;
        } else {
            $decoded = json_decode((string) $raw, true);

            $address = is_array($decoded)
                ? $decoded
                : ['id' => (string) $raw]; // data lama berupa teks biasa
        }

        return view('admin.pengaturan.edit', compact('pengaturan', 'address'));
    }

    public function update(Request $request, $id)
    {
        $pengaturan = Pengaturan::findOrFail($id);

        // Tambah https:// otomatis kalau admin mengisi URL tanpa http(s)
        $this->normalizeUrls($request);

        // VALIDASI
        $request->validate([
            'company' => 'required|max:255',
            'address.id' => 'required',
            'address.en' => 'nullable',
            'address.jp' => 'nullable',
            'phone' => 'required|max:255',
            'fax' => 'nullable|max:255',
            'email' => 'required|email',
            'website' => 'nullable|url|max:255',
            'map' => 'nullable',
            'script' => 'nullable',
            'intro' => 'nullable',
            'cek' => 'nullable|max:5',
            'url_popup' => 'nullable|url|max:255',
            'header' => 'nullable|max:255',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,ico|max:2048',
            'background' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background_intro' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'popup' => 'nullable|max:255',
            'copyright' => 'nullable|max:255',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keyword' => 'nullable',
            'seo' => 'nullable',
            'catalog' => 'nullable|url|max:255',
            'member' => 'nullable|url|max:255',
        ]);

        // File tidak ikut di $data, jadi gambar lama tidak tertimpa kosong
        $data = $request->except(['favicon', 'background', 'background_intro', 'logo']);

        // AUTO-TRANSLATE ADDRESS
        $data = $this->autoTranslate($data, ['address']);

        $uploadPath = public_path('uploads/pengaturan');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // HANDLE UPLOAD FAVICON
        if ($request->hasFile('favicon')) {
            // Hapus file lama
            if ($pengaturan->favicon && file_exists(public_path($pengaturan->favicon))) {
                unlink(public_path($pengaturan->favicon));
            }
            $file = $request->file('favicon');
            $fileName = time() . '_favicon.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
            $data['favicon'] = 'uploads/pengaturan/' . $fileName;
        }

        // HANDLE UPLOAD BACKGROUND
        if ($request->hasFile('background')) {
            if ($pengaturan->background && file_exists(public_path($pengaturan->background))) {
                unlink(public_path($pengaturan->background));
            }
            $file = $request->file('background');
            $fileName = time() . '_background.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
            $data['background'] = 'uploads/pengaturan/' . $fileName;
        }

        // HANDLE UPLOAD BACKGROUND_INTRO
        if ($request->hasFile('background_intro')) {
            if ($pengaturan->background_intro && file_exists(public_path($pengaturan->background_intro))) {
                unlink(public_path($pengaturan->background_intro));
            }
            $file = $request->file('background_intro');
            $fileName = time() . '_background_intro.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
            $data['background_intro'] = 'uploads/pengaturan/' . $fileName;
        }

        // HANDLE UPLOAD LOGO
        if ($request->hasFile('logo')) {
            if ($pengaturan->logo && file_exists(public_path($pengaturan->logo))) {
                unlink(public_path($pengaturan->logo));
            }
            $file = $request->file('logo');
            $fileName = time() . '_logo.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
            $data['logo'] = 'uploads/pengaturan/' . $fileName;
        }

        $pengaturan->update($data);

        return redirect()->route('pengaturan.index')
            ->with('success', 'Data pengaturan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengaturan = Pengaturan::findOrFail($id);

        // Hapus file-file yang terkait
        if ($pengaturan->favicon && file_exists(public_path($pengaturan->favicon))) {
            unlink(public_path($pengaturan->favicon));
        }
        if ($pengaturan->logo && file_exists(public_path($pengaturan->logo))) {
            unlink(public_path($pengaturan->logo));
        }
        if ($pengaturan->background && file_exists(public_path($pengaturan->background))) {
            unlink(public_path($pengaturan->background));
        }
        if ($pengaturan->background_intro && file_exists(public_path($pengaturan->background_intro))) {
            unlink(public_path($pengaturan->background_intro));
        }

        $pengaturan->delete();

        return redirect()->route('pengaturan.index')
            ->with('success', 'Data pengaturan berhasil dihapus.');
    }

    /**
     * Tambahkan https:// pada URL yang diisi tanpa http:// atau https://
     * supaya sesuai dengan contoh di form (example.com).
     */
    private function normalizeUrls(Request $request): void
    {
        $merge = [];

        foreach (['website', 'url_popup', 'catalog', 'member'] as $field) {
            $value = trim((string) $request->input($field));

            if ($value !== '' && !preg_match('~^https?://~i', $value)) {
                $merge[$field] = 'https://' . $value;
            }
        }

        if ($merge) {
            $request->merge($merge);
        }
    }

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
                    //
                }
            }

            if (empty($data[$field]['jp'])) {
                try {
                    $data[$field]['jp'] = (new GoogleTranslate('ja'))->translate($idText);
                } catch (\Exception $e) {
                    //
                }
            }
        }

        return $data;
    }
}