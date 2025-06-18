<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturers = Lecturer::orderBy('name')->get();
        return view('admin.lecturer.index', compact('lecturers'));
    }

    public function create()
    {
        return view('admin.lecturer.create');
    }

    private function commonValidationRules($lecturerId = null): array
    {
        $rules = [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            'name' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'education' => 'nullable|string|max:16777215',
            'research' => 'nullable|string|max:16777215',
            'courses' => 'nullable|string|max:16777215',
            'role' => 'required|in:dosen,staf',
            'is_active' => 'sometimes|boolean',
        ];

        // Tambahkan validasi untuk employee_id dan email hanya untuk create, bukan update
        if ($lecturerId === null) {
            $rules['employee_id'] = ['required', 'string', 'max:255', Rule::unique('lecturers', 'employee_id')];
            $rules['email'] = ['required', 'email', 'max:255', Rule::unique('lecturers', 'email')];
        } else {
            $rules['employee_id'] = ['required', 'string', 'max:255'];
            $rules['email'] = ['required', 'email', 'max:255'];
        }

        // Validasi LinkedIn tetap sama
        $rules['linkedIn'] = [
            'nullable',
            'string',
            'max:255',
            function ($attribute, $value, $fail) {
                if (empty($value)) {
                    return;
                }
                $usernamePattern = '/^[a-zA-Z0-9-]{3,100}$/';
                $urlPattern = '/^https:\/\/(www\.)?linkedin\.com\/in\/[a-zA-Z0-9-]+(\/)?$/';
                if (!preg_match($usernamePattern, $value) && !preg_match($urlPattern, $value)) {
                    $fail('Format LinkedIn tidak valid. Masukkan username (misal: nama-anda) atau URL LinkedIn lengkap.');
                }
            },
        ];

        return $rules;
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->commonValidationRules());

        try {
            $validated['is_active'] = $request->boolean('is_active');

            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('lecturer_images', 'public');
            }

            if (!empty($validated['linkedIn']) && !Str::startsWith($validated['linkedIn'], ['http://', 'https://'])) {
                $validated['linkedIn'] = Str::lower(trim($validated['linkedIn']));
            } elseif (!empty($validated['linkedIn']) && Str::contains($validated['linkedIn'], 'linkedin.com/in/')) {
                $path = parse_url($validated['linkedIn'], PHP_URL_PATH);
                $username = basename($path);
                $validated['linkedIn'] = Str::lower(trim($username));
            }

            $validated['created_by'] = Auth::check() ? Auth::id() : null;
            $validated['updated_by'] = Auth::check() ? Auth::id() : null;

            $validated['education'] = $request->input('education', '');
            $validated['research'] = $request->input('research', '');
            $validated['courses'] = $request->input('courses', '');

            Lecturer::create($validated);

            return redirect()->route('admin.lecturer.index')->with('success', 'Data dosen/staf berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error storing lecturer: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan data: Terjadi kesalahan pada server. Detail: ' . $e->getMessage());
        }
    }

    public function show(Lecturer $lecturer)
    {
        return view('admin.lecturer.read', compact('lecturer'));
    }

    public function edit(Lecturer $lecturer)
    {
        return view('admin.lecturer.edit', compact('lecturer'));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $validated = $request->validate($this->commonValidationRules($lecturer->id));

        try {
            $validated['is_active'] = $request->boolean('is_active');

            if ($request->hasFile('image')) {
                if ($lecturer->image && Storage::disk('public')->exists($lecturer->image)) {
                    Storage::disk('public')->delete($lecturer->image);
                }
                $validated['image'] = $request->file('image')->store('lecturer_images', 'public');
            }

            if (!empty($validated['linkedIn']) && !Str::startsWith($validated['linkedIn'], ['http://', 'https://'])) {
                $validated['linkedIn'] = Str::lower(trim($validated['linkedIn']));
            } elseif (!empty($validated['linkedIn']) && Str::contains($validated['linkedIn'], 'linkedin.com/in/')) {
                $path = parse_url($validated['linkedIn'], PHP_URL_PATH);
                $username = basename($path);
                $validated['linkedIn'] = Str::lower(trim($username));
            } elseif (array_key_exists('linkedIn', $validated) && empty($validated['linkedIn'])) {
                $validated['linkedIn'] = null;
            }

            $validated['updated_by'] = Auth::check() ? Auth::id() : null;

            $updateData = $validated;
            $updateData['education'] = $request->input('education', $lecturer->education);
            $updateData['research'] = $request->input('research', $lecturer->research);
            $updateData['courses'] = $request->input('courses', $lecturer->courses);

            $lecturer->update($updateData);

            return redirect()->route('admin.lecturer.index')->with('success', 'Data dosen/staf berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating lecturer: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: Terjadi kesalahan pada server. Detail: ' . $e->getMessage());
        }
    }

    public function destroy(Lecturer $lecturer)
    {
        try {
            if ($lecturer->image && Storage::disk('public')->exists($lecturer->image)) {
                Storage::disk('public')->delete($lecturer->image);
            }
            $lecturer->delete();
            return redirect()->route('admin.lecturer.index')->with('success', 'Data dosen/staf berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
