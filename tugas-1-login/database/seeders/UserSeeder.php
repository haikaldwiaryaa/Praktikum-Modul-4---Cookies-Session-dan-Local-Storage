<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'nama_lengkap' => 'Administrator',
                'password' => Hash::make('password123'),
            ]
        );
        $admin->role = 'admin';
        $admin->save();

        $customer = User::firstOrCreate(
            ['username' => 'haikaltzy'],
            [
                'nama_lengkap' => 'muhamad haikal',
                'password' => Hash::make('oncommanis22'),
            ]
        );
        $customer->role = 'customer';
        $customer->save();

        $staff = User::firstOrCreate(
            ['username' => 'staff1'],
            [
                'nama_lengkap' => 'Staff Toko',
                'password' => Hash::make('password123'),
            ]
        );
        $staff->role = 'staff';
        $staff->save();
    }
}
