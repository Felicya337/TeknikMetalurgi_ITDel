<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StructureOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StructureOrganizationController extends Controller
{
    public function index()
    {
        $structures = StructureOrganization::orderBy('order', 'asc')->paginate(10);
        $allStructures = StructureOrganization::orderBy('name')->get();
        $hasLevelZero = StructureOrganization::where('level', 0)->exists();
        return view('admin.structure_organization.index', compact('structures', 'allStructures', 'hasLevelZero'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'degree' => 'nullable|string|max:255',
            'level' => [
                'required',
                'integer',
                'min:0',
                'max:4',
                function ($attribute, $value, $fail) {
                    if ($value === 0 && StructureOrganization::where('level', 0)->exists()) {
                        $fail('Hanya satu struktur organisasi yang diperbolehkan memiliki level 0.');
                    }
                },
            ],
            'parent_id' => [
                'nullable',
                'exists:structureorganizations,id',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value && $request->level == 0) {
                        $fail('Struktur dengan level 0 tidak boleh memiliki induk.');
                    }
                    if ($value) {
                        $parent = StructureOrganization::find($value);
                        if ($parent && $parent->level >= $request->level) {
                            $fail('Induk harus memiliki level lebih rendah dari level struktur.');
                        }
                    }
                },
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'title', 'degree', 'level', 'parent_id']);
        $data['created_by'] = Auth::guard('admin')->id() ?? null;
        $data['is_active'] = $request->has('is_active');
        $data['order'] = StructureOrganization::max('order') + 1 ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('structure/images', 'public');
        }

        StructureOrganization::create($data);
        return redirect()->route('admin.structure_organization.index')->with('success', 'Struktur Organisasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $structure = StructureOrganization::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'degree' => 'nullable|string|max:255',
            'level' => [
                'required',
                'integer',
                'min:0',
                'max:4',
                function ($attribute, $value, $fail) use ($id) {
                    if ($value === 0 && StructureOrganization::where('level', 0)->where('id', '!=', $id)->exists()) {
                        $fail('Hanya satu struktur organisasi yang diperbolehkan memiliki level 0.');
                    }
                },
            ],
            'parent_id' => [
                'nullable',
                'exists:structureorganizations,id',
                function ($attribute, $value, $fail) use ($request, $id) {
                    if ($value && $request->level == 0) {
                        $fail('Struktur dengan level 0 tidak boleh memiliki induk.');
                    }
                    if ($value && $value == $id) {
                        $fail('Struktur tidak boleh menjadi induk dari dirinya sendiri.');
                    }
                    if ($value) {
                        $parent = StructureOrganization::find($value);
                        if ($parent && $parent->level >= $request->level) {
                            $fail('Induk harus memiliki level lebih rendah dari level struktur.');
                        }
                    }
                },
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'title', 'degree', 'level', 'parent_id']);
        $data['updated_by'] = Auth::guard('admin')->id() ?? null;
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($structure->image) {
                Storage::disk('public')->delete($structure->image);
            }
            $data['image'] = $request->file('image')->store('structure/images', 'public');
        }

        $structure->update($data);
        return redirect()->route('admin.structure_organization.index')->with('success', 'Struktur Organisasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $structure = StructureOrganization::findOrFail($id);
        if ($structure->image) {
            Storage::disk('public')->delete($structure->image);
        }
        $structure->delete();
        return redirect()->route('admin.structure_organization.index')->with('success', 'Struktur Organisasi berhasil dihapus.');
    }
}
