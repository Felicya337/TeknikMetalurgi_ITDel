<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Felicya Panjaitan',
                'email' => 'felicyapanjaitan790@gmail.com',
                'password' => 'felicyaa.123',
            ],
            [
                'name' => 'General Admin',
                'email' => 'aitdel844@gmail.com',
                'password' => 'AdminTMItdel.1230987',
            ],
        ];

        foreach ($admins as $adminData) {
            Admin::firstOrCreate(
                ['email' => $adminData['email']], // Kunci untuk mencari
                [                                 // Data untuk dibuat jika tidak ada
                    'name' => $adminData['name'],
                    'password' => Hash::make($adminData['password']), // Password di-hash
                    'is_active' => true,
                ]
            );
        }

        $this->command->info('Admin seeder executed successfully!');
    }
}
