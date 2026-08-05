<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
public function index(Request $request)
{
    $search = trim($request->input('search'));

    $blogs = Blog::with('category')
        ->where('status', 'Show')
        ->when($search, function ($query) use ($search) {
            $searchLower = mb_strtolower($search);
            $query->where(function ($q) use ($search, $searchLower) {
                $q->whereRaw("LOWER(JSON_UNQUOTE(title)) LIKE ?", ["%{$searchLower}%"])
                  ->orWhereRaw("LOWER(JSON_UNQUOTE(caption)) LIKE ?", ["%{$searchLower}%"])
                  ->orWhere('keyword', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->get();

    return view('frontend.blog', compact('blogs'));
}
}