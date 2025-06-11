<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class FacilityController extends Controller
{
    public function index()
    {
        // Tampilkan semua data (aktif dan tidak aktif) di halaman admin
        $facilities = Facility::latest()->get();
        return view('admin.facility.index', compact('facilities'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'type' => 'required|in:classroom,smartclass,reading_room',
                'description' => 'nullable|string',
                'academic_days' => 'nullable|array',
                'academic_days.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
                'academic_hours' => 'nullable|string|max:255',
                'collaborative_hours' => 'nullable|string|max:255',
                'images' => 'nullable|array|max:5',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5048',
                'is_active' => 'nullable|boolean',
            ]);

            $data = $request->only(['type', 'description', 'academic_days', 'academic_hours', 'collaborative_hours']);
            $data['created_by'] = Auth::guard('admin')->id() ?? null;
            $data['is_active'] = $request->boolean('is_active');

            $facility = DB::transaction(function () use ($request, $data) {
                if ($request->hasFile('images')) {
                    $imagePaths = [];
                    foreach ($request->file('images') as $image) {
                        $imagePaths[] = $image->store('facilities/images', 'public');
                    }
                    $data['images'] = $imagePaths;
                }
                return Facility::create($data);
            });

            Log::info('Facility created', ['facility_id' => $facility->id, 'is_active' => $facility->is_active]);

            return redirect()->route('admin.facility.index')->with('success', 'Fasilitas berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating facility: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan fasilitas: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $facility = Facility::findOrFail($id);

            $request->validate([
                'type' => 'required|in:classroom,smartclass,reading_room',
                'description' => 'nullable|string',
                'academic_days' => 'nullable|array',
                'academic_days.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
                'academic_hours' => 'nullable|string|max:255',
                'collaborative_hours' => 'nullable|string|max:255',
                'images' => 'nullable|array|max:5',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5048',
                'is_active' => 'nullable|boolean',
            ]);

            $data = $request->only(['type', 'description', 'academic_days', 'academic_hours', 'collaborative_hours']);
            $data['updated_by'] = Auth::guard('admin')->id() ?? null;
            $data['is_active'] = $request->boolean('is_active');

            $facility = DB::transaction(function () use ($request, $facility, $data) {
                if ($request->hasFile('images')) {
                    if ($facility->images) {
                        foreach ($facility->images as $image) {
                            Storage::disk('public')->delete($image);
                        }
                    }
                    $imagePaths = [];
                    foreach ($request->file('images') as $image) {
                        $imagePaths[] = $image->store('facilities/images', 'public');
                    }
                    $data['images'] = $imagePaths;
                }
                $facility->update($data);
                return $facility;
            });

            Log::info('Facility updated', [
                'facility_id' => $facility->id,
                'is_active' => $facility->is_active,
                'updated_by' => $data['updated_by']
            ]);

            return redirect()->route('admin.facility.index')->with('success', 'Fasilitas berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating facility: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui fasilitas: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $facility = Facility::findOrFail($id);

            if ($facility->images) {
                foreach ($facility->images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }

            $facility->delete();

            Log::info('Facility deleted', ['facility_id' => $id]);

            return redirect()->route('admin.facility.index')->with('success', 'Fasilitas berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting facility: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus fasilitas: ' . $e->getMessage());
        }
    }

    public function userIndex()
    {
        $facilities = Facility::active()->latest()->get();
        return view('user.facility.index', compact('facilities'));
    }

    public function userShow($id)
    {
        $facility = Facility::active()->findOrFail($id);
        return view('user.facility.show', compact('facility'));
    }
}
