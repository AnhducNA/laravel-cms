<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        User::create(['id' => 1, 'name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('password'), 'created_at' => $now]);
        User::create(['id' => 2, 'name' => 'User Manager', 'email' => 'useradmin@gmail.com', 'password' => Hash::make('password'), 'created_at' => $now]);
        User::create(['id' => 3, 'name' => 'Article Manager', 'email' => 'articleadmin@gmail.com', 'password' => Hash::make('password'), 'created_at' => $now]);
        User::create(['id' => 4, 'name' => 'Category Manager', 'email' => 'categoryadmin@gmail.com', 'password' => Hash::make('password'), 'created_at' => $now]);
        User::create(['id' => 5, 'name' => 'Tag Manager', 'email' => 'tagadmin@gmail.com', 'password' => Hash::make('password'), 'created_at' => $now]);
    }
}
