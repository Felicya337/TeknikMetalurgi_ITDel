<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\StudentAchievement; // Import model StudentAchievement

class AchievementController extends Controller
{
    private $perPage = 10; // Jumlah item per halaman

    public function index()
    {
        $achievements = Achievement::active()->latest()->paginate($this->perPage);
        return view('achievements.achievement', compact('achievements'));
    }

    public function publication()
    {
        $publications = Achievement::where('type', 'publikasi')
            ->active()
            ->latest()
            ->paginate($this->perPage);

        return view('achievements.publication', compact('publications'));
    }

    public function research()
    {
        $researches = Achievement::where('type', 'penelitian')
            ->active()
            ->latest()
            ->paginate($this->perPage);

        return view('achievements.research', compact('researches'));
    }

    public function achievement()
    {
        // Gunakan StudentAchievement model untuk prestasi mahasiswa
        $achievements = StudentAchievement::active()
            ->latest()
            ->paginate($this->perPage);

        return view('achievements.achievement', compact('achievements'));
    }

    public function allAchievements()
    {
        // Gunakan StudentAchievement model untuk semua prestasi
        $achievements = StudentAchievement::active()
            ->latest()
            ->paginate($this->perPage);

        return view('user.achievement.index', compact('achievements'));
    }
}
