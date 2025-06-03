<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Collaborate;
use Illuminate\Http\Request;

class CollaborateController extends Controller
{
    public function index()
    {
        // Ambil hanya kolaborasi yang aktif
        $collaborates = Collaborate::where('is_active', true)->get(); // atau ->latest()->get(); Jika ingin diurutkan berdasarkan yang terbaru
        return view('frontend.collaborate.index', compact('collaborates'));
    }

    // Metode lain tidak diperlukan untuk contoh ini, tetapi Anda dapat menambahkannya jika perlu.
}
