<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;  // Pastikan Rule di-import

class LecturerController extends Controller
{
    // ... (index, create methods tetap sama) ...
    public function index()
    {
        $lecturers = Lecturer::orderBy('name')->get();
        return view('admin.lecturer.index', compact('lecturers'));
    }

    public function create()
    {
        // Ini adalah view untuk form create, tidak perlu lecturer instance
        return view('admin.lecturer.create');
    }


    // Fungsi ini menghasilkan aturan validasi dasar
    private function commonValidationRules($lecturerId = null): array
    {
        // Aturan untuk 'employee_id'
        $employeeIdRule = ['required', 'string', 'max:255'];
        if ($lecturerId) {
            // Saat update, employee_id harus unik kecuali untuk dirinya sendiri
            $employeeIdRule[] = Rule::unique('lecturers', 'employee_id')->ignore($lecturerId);
        } else {
            // Saat create, employee_id harus unik di seluruh tabel
            $employeeIdRule[] = Rule::unique('lecturers', 'employee_id');
        }

        // Aturan untuk 'email'
        $emailRule = ['required', 'email', 'max:255'];
        if ($lecturerId) {
            // Saat update, email harus unik kecuali untuk dirinya sendiri
            $emailRule[] = Rule::unique('lecturers', 'email')->ignore($lecturerId);
        } else {
            // Saat create, email harus unik di seluruh tabel
            $emailRule[] = Rule::unique('lecturers', 'email');
        }

        return [
            'employee_id' => $employeeIdRule,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => $emailRule,
            'linkedIn' => [
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
            ],
            'room' => 'required|string|max:255',
            'education' => 'nullable|string|max:16777215', // MEDIUMTEXT max approx 16MB
            'research' => 'nullable|string|max:16777215',
            'courses' => 'nullable|string|max:16777215',
            'role' => 'required|in:dosen,staf',
            'is_active' => 'sometimes|boolean', // 'sometimes' agar tidak wajib ada di request, boolean untuk 0/1
        ];
    }

    public function store(Request $request)
    {
        // Panggil commonValidationRules tanpa ID karena ini adalah operasi 'store' (create)
        $validated = $request->validate($this->commonValidationRules());

        try {
            // Handle is_active: jika tidak ada di request, defaultnya false (0)
            // Jika Anda ingin default true, pastikan checkbox dikirim atau logika ini diubah
            $validated['is_active'] = $request->boolean('is_active'); // Menggunakan boolean() lebih aman

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

            $validated['education'] = $request->input('education', ''); // Ambil dari request langsung
            $validated['research'] = $request->input('research', '');   // Ambil dari request langsung
            $validated['courses'] = $request->input('courses', '');     // Ambil dari request langsung

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
        // Panggil commonValidationRules DENGAN ID lecturer agar unique rule mengabaikan record ini
        $validated = $request->validate($this->commonValidationRules($lecturer->id));

        try {
            // Handle is_active
            $validated['is_active'] = $request->boolean('is_active');

            if ($request->hasFile('image')) {
                if ($lecturer->image && Storage::disk('public')->exists($lecturer->image)) {
                    Storage::disk('public')->delete($lecturer->image);
                }
                $validated['image'] = $request->file('image')->store('lecturer_images', 'public');
            } else {
                // Jika tidak ada file gambar baru, jangan ubah field 'image' di $validated
                // Biarkan menggunakan gambar yang sudah ada, atau null jika memang tidak ada.
                // Tidak perlu unset($validated['image']) karena 'image' sudah 'nullable'
                // dan tidak akan ada di $validated jika tidak di-upload.
            }


            if (!empty($validated['linkedIn']) && !Str::startsWith($validated['linkedIn'], ['http://', 'https://'])) {
                $validated['linkedIn'] = Str::lower(trim($validated['linkedIn']));
            } elseif (!empty($validated['linkedIn']) && Str::contains($validated['linkedIn'], 'linkedin.com/in/')) {
                $path = parse_url($validated['linkedIn'], PHP_URL_PATH);
                $username = basename($path);
                $validated['linkedIn'] = Str::lower(trim($username));
            } elseif (array_key_exists('linkedIn', $validated) && empty($validated['linkedIn'])) {
                // Jika 'linkedIn' ada di request tapi kosong, set ke null
                $validated['linkedIn'] = null;
            }
            // Jika 'linkedIn' tidak ada di request sama sekali (misal field di-disable), $validated['linkedIn'] tidak akan ada,
            // dan nilai lama di database tidak akan diubah. Ini perilaku yang diinginkan.

            $validated['updated_by'] = Auth::check() ? Auth::id() : null;

            // Ambil nilai Summernote dari request, bukan dari $validated yang mungkin belum terisi
            // $validated hanya berisi field yang lolos validasi dasar,
            // nilai summernote perlu diambil langsung dari request payload.
            $updateData = $validated; // Mulai dengan data yang sudah divalidasi
            $updateData['education'] = $request->input('education', $lecturer->education); // Gunakan nilai lama jika tidak ada di request
            $updateData['research'] = $request->input('research', $lecturer->research);
            $updateData['courses'] = $request->input('courses', $lecturer->courses);


            $lecturer->update($updateData);

            return redirect()->route('admin.lecturer.index')->with('success', 'Data dosen/staf berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect kembali dengan error validasi dan input lama
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating lecturer: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
            return redirect()->back()
                ->withInput() // Sertakan input lama agar form terisi kembali
                ->with('error', 'Gagal memperbarui data: Terjadi kesalahan pada server. Detail: ' . $e->getMessage());
        }
    }

    // ... (destroy, toggleStatus methods tetap sama) ...
    public function destroy(Lecturer $lecturer)
    {
        // ... implementasi Anda sudah benar ...
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
