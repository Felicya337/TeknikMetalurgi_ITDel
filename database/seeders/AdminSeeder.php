<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Definisikan email super admin secara permanen
        $superAdminEmail = 'aitdel844@gmail.com';

        $admins = [
            [
                'name' => 'Felicya Panjaitan',
                'email' => 'felicyapanjaitan790@gmail.com',
                'password' => 'felicyaa.123',
            ],
            [
                'name' => 'General Admin', // Nama bisa apa saja
                'email' => $superAdminEmail,
                'password' => 'AdminTMItdel.1230987',
            ],
        ];

        foreach ($admins as $adminData) {
            Admin::updateOrCreate(
                ['email' => $adminData['email']], // Kunci untuk mencari
                [
                    'name' => $adminData['name'],
                    'password' => Hash::make($adminData['password']),
                    'is_active' => true,
                    // Tetapkan peran super admin berdasarkan email
                    'is_superadmin' => ($adminData['email'] === $superAdminEmail),
                ]
            );
        }

        $this->command->info('Admin seeder executed successfully!');
    }
}
