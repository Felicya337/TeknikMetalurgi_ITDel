<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Mail\InquiryResponseMail;
use Exception;

class InquiryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        // ... (kode ini tidak perlu diubah) ...
        $questions = UserInquiry::questions()->orderByDesc('created_at')->paginate(10, ['*'], 'questions');
        $reviews = UserInquiry::reviews()->orderByDesc('created_at')->paginate(10, ['*'], 'reviews');
        return view('admin.inquiries.index', compact('questions', 'reviews'));
    }

    public function show(UserInquiry $inquiry)
    {
        // ... (kode ini tidak perlu diubah) ...
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function respond(Request $request, UserInquiry $inquiry)
    {
        $request->validate(['response' => 'required|string|min:10|max:5000']);

        try {
            $inquiry->update([
                'admin_response' => $request->response,
                'is_responded' => true,
                'responded_at' => now(),
                'responded_by' => auth('admin')->id(),
            ]);

            Log::info('Inquiry (id: ' . $inquiry->id . ') updated. Attempting to send email synchronously.');

            // =================================================================
            //                  INI PERBAIKAN FINAL UNTUK TES
            //  Cara yang benar untuk mengirim email langsung (synchronously)
            // =================================================================
            $mailable = new InquiryResponseMail($inquiry);
            Mail::to($inquiry->email)->send($mailable->onConnection('sync'));

            Log::info('Email for inquiry (id: ' . $inquiry->id . ') has been sent synchronously.');

            return redirect()->route('admin.inquiries.index')
                ->with('success', 'Tanggapan berhasil dikirim secara langsung!');
        } catch (Exception $e) {
            Log::error('Failed to send synchronous email for inquiry_id: ' . $inquiry->id, [
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Gagal mengirim email. Kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(UserInquiry $inquiry): RedirectResponse
    {
        // ... (kode ini tidak perlu diubah) ...
        try {
            $inquiry->delete();
            return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->route('admin.inquiries.index')->with('error', 'Gagal menghapus inquiry.');
        }
    }
}
