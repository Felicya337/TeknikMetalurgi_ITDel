<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;

class DashboardController extends Controller
{
    public function index()
    {
        $achievements = Achievement::all();
        return view('admin.dashboard', compact('achievements'));
    }
}
