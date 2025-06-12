<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminForgotPasswordController extends Controller
{
    // Menampilkan halaman untuk memasukkan email
    public function showLinkRequestForm()
    {
        return view('admin.auth.forgot-password');
    }

    // Mengirim link reset ke email admin
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('admins')->sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __('Link reset password telah dikirim!'));
        }

        return back()->withErrors(['email' => __($status)]);
    }

    // Menampilkan halaman untuk membuat password baru
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Memproses dan menyimpan password baru
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::broker('admins')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60), // Generate remember token baru
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('admin.login.form')->with('status', __('Password Anda berhasil direset. Silakan login dengan password baru.'));
        }

        return back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
