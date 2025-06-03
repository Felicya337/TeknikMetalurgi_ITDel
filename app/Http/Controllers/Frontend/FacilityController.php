<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display active facilities for public/user view
     */
    public function index()
    {
        // Hanya tampilkan fasilitas yang aktif untuk user, dikelompokkan berdasarkan tipe
        $facilities = Facility::active()
            ->latest()
            ->get()
            ->groupBy('type');

        return view('facility', compact('facilities'));
    }

    /**
     * Display specific facility detail for public/user view
     */
    public function show($id)
    {
        // Hanya tampilkan jika fasilitas aktif
        $facility = Facility::active()->findOrFail($id);

        return view('facilities.show', compact('facility'));
    }
}
