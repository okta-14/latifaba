<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ReviewController extends Controller
{
    public function create()
    {
        return view('frontend.review.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|max:255',
            'pekerjaan' => 'required|max:255',
            'review'    => 'required',
            'stars'     => 'required|integer|min:1|max:5',
        ]);

        // Data pekerjaan
        $pekerjaan = [
            'id' => $request->pekerjaan,
            'en' => '',
            'jp' => '',
        ];

        // Data review
        $review = [
            'id' => $request->review,
            'en' => '',
            'jp' => '',
        ];

        // Translate pekerjaan
        try {
            $pekerjaan['en'] = (new GoogleTranslate('en'))->translate($request->pekerjaan);
        } catch (\Exception $e) {
            $pekerjaan['en'] = '';
        }

        try {
            $pekerjaan['jp'] = (new GoogleTranslate('ja'))->translate($request->pekerjaan);
        } catch (\Exception $e) {
            $pekerjaan['jp'] = '';
        }

        // Translate review
        try {
            $review['en'] = (new GoogleTranslate('en'))->translate($request->review);
        } catch (\Exception $e) {
            $review['en'] = '';
        }

        try {
            $review['jp'] = (new GoogleTranslate('ja'))->translate($request->review);
        } catch (\Exception $e) {
            $review['jp'] = '';
        }

        Review::create([
            'nama'      => $request->nama,
            'pekerjaan' => $pekerjaan,
            'review'    => $review,
            'stars'     => $request->stars,
            'status'    => 'Hide', // Menunggu persetujuan admin
        ]);

        return redirect()
            ->route('home')
            ->with(
                'review_success',
                'Review Anda berhasil dikirim dan sedang ditinjau oleh admin.'
            );
    }
}