<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index()
    {
        $curriculums = Curriculum::where('is_active', true)
            ->orderBy('semester')
            ->orderBy('course_code')
            ->get()
            ->groupBy('semester');

        return view('curriculum', compact('curriculums'));
    }
}
