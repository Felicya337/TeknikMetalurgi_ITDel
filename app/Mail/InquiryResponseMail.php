<?php

namespace App\Mail;

use App\Models\UserInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // PENTING!
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

// Implementasi ShouldQueue akan memberitahu Laravel untuk mengirim email ini melalui antrean
class InquiryResponseMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $inquiry;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserInquiry $inquiry)
    {
        // Tetapkan koneksi dan antrean secara eksplisit untuk kejelasan
        $this->onConnection('database');
        $this->onQueue('emails'); // Anda bisa membuat antrean khusus 'emails' atau gunakan 'default'
        $this->inquiry = $inquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::info('Building email for inquiry_id: ' . $this->inquiry->id . ' on queue job.');

        return $this->subject('Tanggapan dari ' . config('app.name'))
            ->view('emails.inquiry_response') // Pastikan view ini ada
            ->with(['inquiry' => $this->inquiry]);
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(\Throwable $exception)
    {
        Log::error('Failed to send inquiry response email for inquiry_id: ' . $this->inquiry->id, [
            'error' => $exception->getMessage()
        ]);
    }
}
