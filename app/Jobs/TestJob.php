<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 30;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        try {
            Log::info('TestJob processed successfully', [
                'job_id' => $this->job->getJobId(),
                'queue' => $this->job->getQueue(),
            ]);
        } catch (\Exception $e) {
            Log::error('TestJob failed: ' . $e->getMessage(), [
                'job_id' => $this->job->getJobId(),
                'trace' => $e->getTraceAsString(),
            ]);
            $this->fail($e);
        }
    }

    public function failed(\Throwable $exception)
    {
        Log::error('TestJob failed after retries: ' . $exception->getMessage(), [
            'job_id' => $this->job->getJobId(),
        ]);
    }
}
