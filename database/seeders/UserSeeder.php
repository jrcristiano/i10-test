<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private $table = 'users';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table($this->table)->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@i10.com',
                'password' => Hash::make('password'),
                'role' => UserRole::ADMIN,
            ],
            [
                'name' => 'Cristiano',
                'email' => 'cristiano@i10.com',
                'password' => Hash::make('password'),
                'role' => UserRole::REDATOR,
            ],
            [
                'name' => 'Carol',
                'email' => 'carol@i10.com',
                'password' => Hash::make('password'),
                'role' => UserRole::REDATOR,
            ],
            [
                'name' => 'Consumidor',
                'email' => 'consumidor@i10.com',
                'password' => Hash::make('password'),
                'role' => UserRole::CONSUMIDOR,
            ],
        ]);
    }
}
