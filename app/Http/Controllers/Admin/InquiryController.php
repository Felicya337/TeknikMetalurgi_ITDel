<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
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
        $questions = UserInquiry::questions()
            ->orderByDesc('created_at')
            ->paginate(10, ['*'], 'questions');

        $reviews = UserInquiry::reviews()
            ->orderByDesc('created_at')
            ->paginate(10, ['*'], 'reviews');

        return view('admin.inquiries.index', compact('questions', 'reviews'));
    }

    public function show(UserInquiry $inquiry)
    {
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function respond(Request $request, UserInquiry $inquiry)
    {
        $request->validate([
            'response' => 'required|string|min:10|max:5000',
        ]);

        try {
            // Update data di database
            $inquiry->update([
                'admin_response' => $request->response,
                'is_responded' => true,
                'responded_at' => now(),
                'responded_by' => auth('admin')->id(),
            ]);

            Log::info('Inquiry (id: ' . $inquiry->id . ') updated. Attempting to queue email.');

            // Mengirim email ke antrean.
            // Cukup gunakan ->send(). Laravel akan otomatis memasukkannya ke antrean
            // karena Mailable-nya sudah `implements ShouldQueue`.
            Mail::to($inquiry->email)->send(new InquiryResponseMail($inquiry));

            Log::info('Email for inquiry (id: ' . $inquiry->id . ') has been successfully queued.');

            return redirect()->route('admin.inquiries.index')
                ->with('success', 'Tanggapan berhasil disimpan. Email akan dikirim di latar belakang.');
        } catch (Exception $e) {
            Log::error('Failed to process response for inquiry_id: ' . $inquiry->id, [
                'error' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem saat memproses tanggapan.');
        }
    }

    public function destroy(UserInquiry $inquiry): RedirectResponse
    {
        try {
            $inquiry->delete();
            Log::info('Inquiry deleted successfully: ' . $inquiry->id);
            return redirect()->route('admin.inquiries.index')
                ->with('success', 'Pertanyaan atau ulasan berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Failed to delete inquiry: ' . $inquiry->id, [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('admin.inquiries.index')
                ->with('error', 'Gagal menghapus inquiry: ' . $e->getMessage());
        }
    }
}
