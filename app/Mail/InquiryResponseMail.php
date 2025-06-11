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

    public function __construct(UserInquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    public function build()
    {
        Log::info('Building email for inquiry_id: ' . $this->inquiry->id);
        return $this->subject('Tanggapan dari ' . config('app.name'))
                    ->view('emails.inquiry_response')
                    ->with(['inquiry' => $this->inquiry]);
    }
}
