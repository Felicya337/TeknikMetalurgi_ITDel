<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::latest()->paginate(10);
        return view('admin.achievement.index', compact('achievements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'type' => 'required|string|max:255',
            'subtype' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only(['title', 'description', 'author', 'date', 'type', 'subtype']);
        $data['is_active'] = $request->has('is_active') ? true : false;
        $data['created_by'] = Auth::guard('admin')->id() ?? null;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('achievements/images', 'public');
        }

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('achievements/files', 'public');
        }

        Achievement::create($data);

        return redirect()->route('admin.achievement.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $achievement = Achievement::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'type' => 'required|string|max:255',
            'subtype' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only(['title', 'description', 'author', 'date', 'type', 'subtype']);
        $data['is_active'] = $request->has('is_active') ? true : false;
        $data['updated_by'] = Auth::guard('admin')->id() ?? null;

        if ($request->hasFile('image')) {
            if ($achievement->image) {
                Storage::disk('public')->delete($achievement->image);
            }
            $data['image'] = $request->file('image')->store('achievements/images', 'public');
        }

        if ($request->hasFile('file')) {
            if ($achievement->file) {
                Storage::disk('public')->delete($achievement->file);
            }
            $data['file'] = $request->file('file')->store('achievements/files', 'public');
        }

        $achievement->update($data);

        return redirect()->route('admin.achievement.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $achievement = Achievement::findOrFail($id);

        if ($achievement->image) {
            Storage::disk('public')->delete($achievement->image);
        }

        if ($achievement->file) {
            Storage::disk('public')->delete($achievement->file);
        }

        $achievement->delete();

        return redirect()->route('admin.achievement.index')->with('success', 'Prestasi berhasil dihapus.');
    }

    public function dashboard()
    {
        $achievements = Achievement::all(); // Get all achievements
        return view('admin.dashboard', compact('achievements'));
    }
}
