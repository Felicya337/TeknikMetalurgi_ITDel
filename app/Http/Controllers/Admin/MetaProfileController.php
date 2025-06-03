<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetaProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MetaProfileController extends Controller
{
    public function index()
    {
        $metaProfiles = MetaProfile::latest()->get();
        return view('admin.metaprofile.index', compact('metaProfiles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'metakey' => 'required|string|max:255|unique:metaprofiles,metakey',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('metaprofile_images', 'public');
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['created_by'] = Auth::guard('admin')->id() ?? null;

        MetaProfile::create($data);

        return redirect()->route('admin.metaprofile.index')->with('success', 'Meta Profile berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $metaProfile = MetaProfile::findOrFail($id);

        $request->validate([
            'metakey' => 'required|string|max:255|unique:metaprofiles,metakey,' . $metaProfile->id,
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($metaProfile->image && Storage::disk('public')->exists($metaProfile->image)) {
                Storage::disk('public')->delete($metaProfile->image);
            }
            $data['image'] = $request->file('image')->store('metaprofile_images', 'public');
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['updated_by'] = Auth::guard('admin')->id() ?? null;

        $metaProfile->update($data);

        return redirect()->route('admin.metaprofile.index')->with('success', 'Meta Profile berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $metaProfile = MetaProfile::findOrFail($id);

        if ($metaProfile->image && Storage::disk('public')->exists($metaProfile->image)) {
            Storage::disk('public')->delete($metaProfile->image);
        }

        $metaProfile->delete();

        return redirect()->route('admin.metaprofile.index')->with('success', 'Meta Profile berhasil dihapus.');
    }
}
