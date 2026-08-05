<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupCompanies;

class MembersController extends Controller
{
    public function members()
    {
        $members = GroupCompanies::where('status', 'Show')
    ->latest()
    ->get();

        return view('frontend.members', compact('members'));
    }
}
