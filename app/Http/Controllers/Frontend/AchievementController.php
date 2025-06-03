<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Achievement;

class AchievementController extends Controller
{
    private $perPage = 6; // Jumlah item per halaman

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
        $achievements = Achievement::where('type', 'pencapaian')
            ->active()
            ->latest()
            ->paginate($this->perPage);

        return view('achievements.achievement', compact('achievements'));
    }

    public function allAchievements()
    {
        $achievements = Achievement::active()->latest()->paginate($this->perPage);
        return view('user.achievement.index', compact('achievements'));
    }
}
