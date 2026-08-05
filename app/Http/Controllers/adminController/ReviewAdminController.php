<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ReviewAdminController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();

        return view('admin.review.index', compact('reviews'));
    }

    public function create()
    {
        return view('admin.review.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required|max:255',
            'pekerjaan.id'   => 'required|max:255',
            'review.id'      => 'required',
            'stars'          => 'required|integer|min:1|max:5',
            'status'         => 'required|in:Show,Hide',
        ]);

        $data = $request->all();

        $data = $this->autoTranslate($data, [
            'pekerjaan',
            'review',
        ]);

        Review::create([
            'nama'       => $data['nama'],
            'pekerjaan'  => $data['pekerjaan'],
            'review'     => $data['review'],
            'stars'      => $data['stars'],
            'status'     => $data['status'],
        ]);

        return redirect()
            ->route('reviewadmin.index')
            ->with('success', 'Review berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);

        return view('admin.review.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'nama'           => 'required|max:255',
            'pekerjaan.id'   => 'required|max:255',
            'review.id'      => 'required',
            'stars'          => 'required|integer|min:1|max:5',
            'status'         => 'required|in:Show,Hide',
        ]);

        // Ambil data lama
        $pekerjaan = is_array($review->pekerjaan) ? $review->pekerjaan : [];
        $reviewText = is_array($review->review) ? $review->review : [];

        // Update bahasa Indonesia
        $pekerjaan['id'] = $request->input('pekerjaan.id');
        $reviewText['id'] = $request->input('review.id');

        // Jika admin mengisi manual EN/JP gunakan itu,
        // jika kosong pakai data lama
        $pekerjaan['en'] = $request->input('pekerjaan.en') ?: ($pekerjaan['en'] ?? '');
        $pekerjaan['jp'] = $request->input('pekerjaan.jp') ?: ($pekerjaan['jp'] ?? '');

        $reviewText['en'] = $request->input('review.en') ?: ($reviewText['en'] ?? '');
        $reviewText['jp'] = $request->input('review.jp') ?: ($reviewText['jp'] ?? '');

        // Jika teks Indonesia berubah, translate ulang
        if (($review->pekerjaan['id'] ?? '') != $request->input('pekerjaan.id')) {

            try {
                $pekerjaan['en'] = (new GoogleTranslate('en'))->translate($pekerjaan['id']);
            } catch (\Exception $e) {}

            try {
                $pekerjaan['jp'] = (new GoogleTranslate('ja'))->translate($pekerjaan['id']);
            } catch (\Exception $e) {}
        }

        if (($review->review['id'] ?? '') != $request->input('review.id')) {

            try {
                $reviewText['en'] = (new GoogleTranslate('en'))->translate($reviewText['id']);
            } catch (\Exception $e) {}

            try {
                $reviewText['jp'] = (new GoogleTranslate('ja'))->translate($reviewText['id']);
            } catch (\Exception $e) {}
        }

        $review->update([
            'nama'       => $request->nama,
            'pekerjaan'  => $pekerjaan,
            'review'     => $reviewText,
            'stars'      => $request->stars,
            'status'     => $request->status,
        ]);

        return redirect()
            ->route('reviewadmin.index')
            ->with('success', 'Review berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        $review->delete();

        return redirect()
            ->route('reviewadmin.index')
            ->with('success', 'Review berhasil dihapus.');
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
                    $data[$field]['en'] = '';
                }
            }

            if (empty($data[$field]['jp'])) {
                try {
                    $data[$field]['jp'] = (new GoogleTranslate('ja'))->translate($idText);
                } catch (\Exception $e) {
                    $data[$field]['jp'] = '';
                }
            }
        }

        return $data;
    }
}