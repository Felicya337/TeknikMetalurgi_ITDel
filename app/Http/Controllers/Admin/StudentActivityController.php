<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentActivityController extends Controller
{
    public function index()
    {
        $activities = StudentActivity::latest()->paginate(10);
        return view('admin.studentactivity.index', compact('activities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:kegiatan_mahasiswa,kegiatan_prodi,club_mahasiswa',
            'is_active' => 'nullable', // Ubah menjadi nullable
        ]);

        $data = $request->only(['title', 'description', 'type']);
        $data['created_by'] = Auth::guard('admin')->id();

        // Perbaikan handling checkbox is_active
        $data['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('activities/images', 'public');
        }

        StudentActivity::create($data);

        return redirect()->route('admin.studentactivity.index')->with('success', 'Kegiatan Mahasiswa berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $activity = StudentActivity::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:kegiatan_mahasiswa,kegiatan_prodi,club_mahasiswa',
            'is_active' => 'nullable', // Ubah menjadi nullable
        ]);

        $data = $request->only(['title', 'description', 'type']);
        $data['updated_by'] = Auth::guard('admin')->id();

        // Perbaikan handling checkbox is_active
        $data['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            if ($activity->image) {
                Storage::disk('public')->delete($activity->image);
            }
            $data['image'] = $request->file('image')->store('activities/images', 'public');
        }

        $activity->update($data);

        return redirect()->route('admin.studentactivity.index')->with('success', 'Kegiatan Mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $activity = StudentActivity::findOrFail($id);

        if ($activity->image) {
            Storage::disk('public')->delete($activity->image);
        }

        $activity->delete();

        return redirect()->route('admin.studentactivity.index')->with('success', 'Kegiatan Mahasiswa berhasil dihapus.');
    }
}
