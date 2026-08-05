<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\KategoriProject;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::with(['category', 'service'])
            ->where('status', 'Show')
            ->orderBy('date', 'desc');

        // filter berdasarkan kategori (kalau ada query ?kategori=slug)
        if ($request->filled('kategori')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        $programs   = $query->get();
        $categories = KategoriProject::all();

        return view('frontend.program', compact('programs', 'categories'));
    }
}