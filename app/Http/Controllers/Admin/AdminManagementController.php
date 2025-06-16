<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class AdminManagementController extends Controller
{
    // Definisikan email super admin yang dilindungi
    private $protectedSuperAdminEmail = 'aitdel844@gmail.com';

    // Helper function untuk mengecek apakah admin dilindungi
    private function isProtected(Admin $admin)
    {
        return $admin->email === $this->protectedSuperAdminEmail;
    }

    public function index()
    {
        // Jangan tampilkan super admin utama & diri sendiri di daftar
        $admins = Admin::where('email', '!=', $this->protectedSuperAdminEmail)
            ->where('id', '!=', auth()->id())
            ->latest()
            ->paginate(10);
        return view('admin.management.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.management.form');
    }

    public function store(Request $request)
    {
        // ... (fungsi store tetap sama)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_superadmin' => $request->has('is_superadmin'),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.management.index')->with('success', 'Admin baru berhasil dibuat.');
    }

    public function edit(Admin $admin)
    {
        // Blokir pengeditan super admin utama
        if ($this->isProtected($admin)) {
            return redirect()->route('admin.management.index')->with('error', 'Akun Super Admin utama tidak dapat diubah.');
        }
        return view('admin.management.form', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        // Blokir update super admin utama
        if ($this->isProtected($admin)) {
            return redirect()->route('admin.management.index')->with('error', 'Akun Super Admin utama tidak dapat diubah.');
        }

        // ... (validasi update tetap sama)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Admin::class . ',email,' . $admin->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->is_superadmin = $request->has('is_superadmin');
        $admin->is_active = $request->has('is_active');
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        return redirect()->route('admin.management.index')->with('success', 'Data admin berhasil diperbarui.');
    }

    public function destroy(Admin $admin)
    {
        // Blokir penghapusan diri sendiri DAN super admin utama
        if ($admin->id === auth()->id() || $this->isProtected($admin)) {
            return back()->with('error', 'Akun ini tidak dapat dihapus.');
        }
        $admin->delete();
        return redirect()->route('admin.management.index')->with('success', 'Akun admin berhasil dihapus.');
    }

    public function resetPassword(Admin $admin)
    {
        // Blokir reset password super admin utama
        if ($this->isProtected($admin)) {
            return back()->with('error', 'Password Super Admin utama tidak dapat direset dari sini.');
        }

        // ... (logika reset password tetap sama)
        $newPassword = Str::random(10);
        $admin->password = Hash::make($newPassword);
        $admin->save();

        $successMessage = 'Password untuk ' . $admin->name . ' berhasil direset. Password Baru:';
        return redirect()->route('admin.management.index')
            ->with('success', $successMessage)
            ->with('new_password', $newPassword);
    }
}
