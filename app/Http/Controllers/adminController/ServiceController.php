<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::latest()->get();

        return view('admin.service.index', compact('service'));
    }

    public function create()
    {
        return view('admin.service.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title.id'   => 'required|max:255',
            'title.en'   => 'nullable|max:255',
            'title.jp'   => 'nullable|max:255',

            'short.id'   => 'required',
            'short.en'   => 'nullable',
            'short.jp'   => 'nullable',

            'content.id' => 'required',
            'content.en' => 'nullable',
            'content.jp' => 'nullable',

            'icon'    => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'img'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status'  => 'required|in:Show,Hide',
            'url'     => 'nullable|url',
        ]);

        $data = [
            'title'   => $request->title,
            'short'   => $request->short,
            'content' => $request->content,
            'status'  => $request->status,
            'slug'    => Str::slug($request->input('title.id')),
            'url'     => $request->url,
        ];

        $data = $this->autoTranslate($data, ['title', 'short', 'content']);

        if (!File::exists(public_path('uploads/service/icon'))) {
            File::makeDirectory(public_path('uploads/service/icon'), 0777, true);
        }

        if (!File::exists(public_path('uploads/service/img'))) {
            File::makeDirectory(public_path('uploads/service/img'), 0777, true);
        }

        if ($request->hasFile('icon')) {

            $file = $request->file('icon');

            $iconName = time() . '_icon.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/service/icon'), $iconName);

            $data['icon'] = $iconName;
        }

        if ($request->hasFile('img')) {

            $file = $request->file('img');

            $imgName = time() . '_img.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/service/img'), $imgName);

            $data['img'] = $imgName;
        }

        Service::create($data);

        return redirect()
            ->route('service.index')
            ->with('success', 'Service berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return view('admin.service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'title.id'   => 'required|max:255',
            'title.en'   => 'nullable|max:255',
            'title.jp'   => 'nullable|max:255',

            'short.id'   => 'required',
            'short.en'   => 'nullable',
            'short.jp'   => 'nullable',

            'content.id' => 'required',
            'content.en' => 'nullable',
            'content.jp' => 'nullable',

            'icon'    => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'img'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status'  => 'required|in:Show,Hide',
            'url'     => 'nullable|url',
        ]);

        $data = [
            'title'   => $request->title,
            'short'   => $request->short,
            'content' => $request->content,
            'status'  => $request->status,
            'slug'    => Str::slug($request->input('title.id')),
            'url'     => $request->url,
        ];

        $data = $this->autoTranslate($data, ['title', 'short', 'content']);

        if ($request->hasFile('icon')) {

            if ($service->icon && File::exists(public_path('uploads/service/icon/' . $service->icon))) {
                File::delete(public_path('uploads/service/icon/' . $service->icon));
            }

            $file = $request->file('icon');

            $iconName = time() . '_icon.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/service/icon'), $iconName);

            $data['icon'] = $iconName;
        }

        if ($request->hasFile('img')) {

            if ($service->img && File::exists(public_path('uploads/service/img/' . $service->img))) {
                File::delete(public_path('uploads/service/img/' . $service->img));
            }

            $file = $request->file('img');

            $imgName = time() . '_img.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/service/img'), $imgName);

            $data['img'] = $imgName;
        }

        $service->update($data);

        return redirect()
            ->route('service.index')
            ->with('success', 'Service berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if ($service->icon && File::exists(public_path('uploads/service/icon/' . $service->icon))) {
            File::delete(public_path('uploads/service/icon/' . $service->icon));
        }

        if ($service->img && File::exists(public_path('uploads/service/img/' . $service->img))) {
            File::delete(public_path('uploads/service/img/' . $service->img));
        }

        $service->delete();

        return redirect()
            ->route('service.index')
            ->with('success', 'Service berhasil dihapus.');
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