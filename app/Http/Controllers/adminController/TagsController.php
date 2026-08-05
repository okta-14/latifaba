<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tags::latest()->get();

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title.id' => 'required|max:255',
            'title.en' => 'nullable|max:255',
            'title.jp' => 'nullable|max:255',
        ]);

        $slug = Str::slug($request->input('title.id'));

        if (Tags::where('slug', $slug)->exists()) {
            return back()
                ->withErrors(['title.id' => 'Tag dengan nama ini sudah ada.'])
                ->withInput();
        }

        $data = $request->only('title');
        $data['slug'] = $slug;
        $data['hit'] = 0;

        $data = $this->autoTranslate($data);

        Tags::create($data);

        return redirect()
            ->route('tags.index')
            ->with('success', 'Tag berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tag = Tags::findOrFail($id);

        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = Tags::findOrFail($id);

        $request->validate([
            'title.id' => 'required|max:255',
            'title.en' => 'nullable|max:255',
            'title.jp' => 'nullable|max:255',
        ]);

        $slug = Str::slug($request->input('title.id'));

        if (Tags::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            return back()
                ->withErrors(['title.id' => 'Tag dengan nama ini sudah ada.'])
                ->withInput();
        }

        $data = $request->only('title');
        $data['slug'] = $slug;

        $data = $this->autoTranslate($data);

        $tag->update($data);

        return redirect()
            ->route('tags.index')
            ->with('success', 'Tag berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tag = Tags::findOrFail($id);

        $tag->delete();

        return redirect()
            ->route('tags.index')
            ->with('success', 'Tag berhasil dihapus.');
    }

    private function autoTranslate(array $data): array
    {
        $idText = $data['title']['id'] ?? '';

        if (empty($idText)) {
            return $data;
        }

        if (empty($data['title']['en'])) {
            try {
                $data['title']['en'] = (new GoogleTranslate('en'))->translate($idText);
            } catch (\Exception $e) {
                //
            }
        }

        if (empty($data['title']['jp'])) {
            try {
                $data['title']['jp'] = (new GoogleTranslate('ja'))->translate($idText);
            } catch (\Exception $e) {
                //
            }
        }

        return $data;
    }
}