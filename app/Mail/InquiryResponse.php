<?php

namespace App\Mail;

use App\Models\UserInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;

    public function __construct(UserInquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    public function build()
    {
        return $this->subject('Tanggapan dari TeknikMetalurgiITDel')
            ->view('emails.inquiry_response')
            ->with(['inquiry' => $this->inquiry]);
    }
}
