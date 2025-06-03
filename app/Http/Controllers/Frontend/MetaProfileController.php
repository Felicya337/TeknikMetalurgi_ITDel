<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MetaProfile; // Pastikan path model benar
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk Str::startsWith

class MetaProfileController extends Controller
{
    public function index()
    {
        $metaprofiles = MetaProfile::where('is_active', 1)
            ->orderBy('created_at', 'asc')
            ->get();
        return view('metaprofile', compact('metaprofiles'));
    }
}
