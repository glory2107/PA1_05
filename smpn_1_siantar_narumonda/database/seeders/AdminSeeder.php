<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Akun pertama
        Admin::create([
            'username' => 'admin',
            'email' => 'mutiaramarpaung0406@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        // Akun kedua
        Admin::create([
            'username' => 'admin2',
            'email' => 'erinwownih@gmail.com',
            'password' => Hash::make('password456'),
        ]);
    }
}