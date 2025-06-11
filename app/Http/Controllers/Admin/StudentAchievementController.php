<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentAchievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAchievementController extends Controller
{
    public function index()
    {
        $achievements = StudentAchievement::latest()->paginate(10);
        return view('admin.student_achievement.index', compact('achievements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'waktu_pelaksanaan' => 'nullable|date',
            'tingkat' => 'nullable|string|max:255',
            'prestasi_yang_dicapai' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only(['nama_kegiatan', 'waktu_pelaksanaan', 'tingkat', 'prestasi_yang_dicapai']);
        $data['is_active'] = $request->has('is_active') ? true : false;
        $data['created_by'] = Auth::guard('admin')->id() ?? null;

        StudentAchievement::create($data);

        return redirect()->route('admin.student_achievement.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $achievement = StudentAchievement::findOrFail($id);

        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'waktu_pelaksanaan' => 'nullable|date',
            'tingkat' => 'nullable|string|max:255',
            'prestasi_yang_dicapai' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only(['nama_kegiatan', 'waktu_pelaksanaan', 'tingkat', 'prestasi_yang_dicapai']);
        $data['is_active'] = $request->has('is_active') ? true : false;
        $data['updated_by'] = Auth::guard('admin')->id() ?? null;

        $achievement->update($data);

        return redirect()->route('admin.student_achievement.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $achievement = StudentAchievement::findOrFail($id);
        $achievement->delete();

        return redirect()->route('admin.student_achievement.index')->with('success', 'Prestasi berhasil dihapus.');
    }

    public function dashboard()
    {
        $achievements = StudentAchievement::all();
        return view('admin.dashboard', compact('achievements'));
    }
}
