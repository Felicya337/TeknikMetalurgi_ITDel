<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\StudentActivity;

class StudentActivityController extends Controller
{
    public function index()
    {
        $studentactivities = StudentActivity::ofType('kegiatan_mahasiswa')
            ->active()
            ->latest()
            ->get();

        return view('student_activity.activity', compact('studentactivities'));
    }

    public function program()
    {
        $studentactivities = StudentActivity::ofType('kegiatan_prodi')
            ->active()
            ->latest()
            ->get();

        return view('student_activity.program', compact('studentactivities'));
    }

    public function club()
    {
        $studentactivities = StudentActivity::ofType('club_mahasiswa')
            ->active()
            ->latest()
            ->get();

        return view('student_activity.club', compact('studentactivities'));
    }
}
