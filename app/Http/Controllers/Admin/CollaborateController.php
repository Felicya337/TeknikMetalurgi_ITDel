<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collaborate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CollaborateController extends Controller
{
    public function index()
    {
        $collaborates = Collaborate::latest()->paginate(10);
        return view('admin.collaborate.index', compact('collaborates'));
    }

    public function create()
    {
        return view('admin.collaborate.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution_name' => 'required|string|max:255',
            'institution_description' => 'nullable|string',
            'company_profile' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
            'date' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('collaborate_logos', 'public');
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['created_by'] = Auth::guard('admin')->id() ?? null;

        Collaborate::create($data);

        return redirect()->route('admin.collaborate.index')->with('success', 'Kolaborasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $collaborate = Collaborate::findOrFail($id);
        return view('admin.collaborate.read', compact('collaborate'));
    }

    public function edit($id)
    {
        $collaborate = Collaborate::findOrFail($id);
        return view('admin.collaborate.edit', compact('collaborate'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'institution_name' => 'required|string|max:255',
            'institution_description' => 'nullable|string',
            'company_profile' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
            'date' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $collaborate = Collaborate::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('logo')) {
            if ($collaborate->logo && Storage::disk('public')->exists($collaborate->logo)) {
                Storage::disk('public')->delete($collaborate->logo);
            }
            $data['logo'] = $request->file('logo')->store('collaborate_logos', 'public');
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['updated_by'] = Auth::guard('admin')->id() ?? null;

        $collaborate->update($data);

        return redirect()->route('admin.collaborate.index')->with('success', 'Kolaborasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $collaborate = Collaborate::findOrFail($id);

        if ($collaborate->logo && Storage::disk('public')->exists($collaborate->logo)) {
            Storage::disk('public')->delete($collaborate->logo);
        }

        $collaborate->delete();

        return redirect()->route('admin.collaborate.index')->with('success', 'Kolaborasi berhasil dihapus.');
    }
}
