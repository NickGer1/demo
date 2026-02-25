<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Тестовый админ
        DB::table('users')->updateOrInsert(
            ['login' => 'Admin26'],
            [
                'full_name' => 'Администратор Системы',
                'phone' => '+79999999999',
                'email' => 'admin@example.com',
                'password' => Hash::make('Demo20'),
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Тестовый обычный пользователь
        DB::table('users')->updateOrInsert(
            ['login' => 'user'],
            [
                'full_name' => 'Иванов Иван Иванович',
                'phone' => '+79123456789',
                'email' => 'user@example.com',
                'password' => Hash::make('user'),
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
