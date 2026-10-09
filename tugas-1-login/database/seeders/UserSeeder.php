<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'haikaltzy',
            'nama_lengkap' => 'muhamad haikal',
            'password' => Hash::make('oncommanis22'),
        ]);

        User::create([
            'username' => 'cobacobatzy',
            'nama_lengkap' => 'cocacola',
            'password' => Hash::make('oncompahit12'),
        ]);
    }
}
