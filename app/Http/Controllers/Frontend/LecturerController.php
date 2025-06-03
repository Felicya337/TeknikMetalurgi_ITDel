<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    /**
     * Display a listing of active lecturers/staff.
     */
    public function index()
    {
        // Get all active lecturers/staff grouped by role
        $lecturers = [
            'dosen' => Lecturer::where('role', 'dosen')
                ->where('is_active', true)
                ->orderBy('name')
                ->get(),
            'staf' => Lecturer::where('role', 'staf')
                ->where('is_active', true)
                ->orderBy('name')
                ->get()
        ];

        return view('lecturer', compact('lecturers'));
    }
}
