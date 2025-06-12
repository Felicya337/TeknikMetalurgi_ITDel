<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class LoginAdmin extends Command
{
    protected $signature = 'admin:login';
    protected $description = 'Log in the first admin user for testing (CLI only, does not persist session)';

    public function handle()
    {
        try {
            $admin = Admin::first();
            if ($admin) {
                Auth::guard('admin')->login($admin);
                $this->info('Admin logged in successfully (for testing purposes): ' . $admin->email);
                $this->warn('Note: This login is for CLI testing and does not persist a session.');
            } else {
                $this->error('No admin user found. Please seed the admins table.');
            }
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
