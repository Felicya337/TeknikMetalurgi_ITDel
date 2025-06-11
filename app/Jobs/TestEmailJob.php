<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\SimpleTestMail; // Kita akan buat Mailable ini

class TestEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        try {
            Log::info("Running TestEmailJob...");

            // Ganti dengan email Anda untuk pengetesan
            $recipientEmail = 'test-recipient@example.com';

            Mail::raw('This is a test email from the queue.', function ($message) use ($recipientEmail) {
                $message->to($recipientEmail)
                    ->subject('Queue Test Successful');
            });

            Log::info("TestEmailJob processed successfully. Email sent to " . $recipientEmail);
        } catch (\Exception $e) {
            Log::error("TestEmailJob FAILED: " . $e->getMessage());
            // Melempar kembali exception agar job ditandai gagal
            throw $e;
        }
    }
}
