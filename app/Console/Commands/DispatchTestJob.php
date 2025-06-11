<?php

namespace App\Console\Commands;

use App\Jobs\TestJob;
use Illuminate\Console\Command;

class DispatchTestJob extends Command
{
    protected $signature = 'dispatch:test-job';
    protected $description = 'Dispatch a test job to the queue';

    public function handle()
    {
        TestJob::dispatch();
        $this->info('TestJob dispatched successfully!');
    }
}
