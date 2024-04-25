<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Chats;
use App\Models\Gallery;
use Carbon\Carbon;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin-amankan-123',
            'password' => bcrypt('admin-amankan'),
            'role' => 'admin',
            'verified_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'RT 2',
            'username' => 'rt2-amankan-123',
            'password' => bcrypt('rt2-amankan'),
            'role' => 'rt',
            'verified_at' => Carbon::now()
        ]);
        User::create([
            'name' => 'RT 3',
            'username' => 'rt3-amankan-123',
            'password' => bcrypt('rt3-amankan'),
            'role' => 'rt',
            'verified_at' => Carbon::now()
        ]);
        User::create([
            'name' => 'RT 4',
            'username' => 'rt4-amankan-123',
            'password' => bcrypt('rt4-amankan'),
            'role' => 'rt',
            'verified_at' => Carbon::now()
        ]);
        User::create([
            'name' => 'RT 5',
            'username' => 'rt5-amankan-123',
            'password' => bcrypt('rt5-amankan'),
            'role' => 'rt',
            'verified_at' => Carbon::now()
        ]);


    }
}
