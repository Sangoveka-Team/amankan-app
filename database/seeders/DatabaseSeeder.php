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
            'name' => 'Ricko Aprilianto',
            'username' => 'ricko',
            'password' => bcrypt('admin-amankan'),
            'number' => '081932432218',
            'role' => 'admin',
            'nik' => '6371040404040006',
            'user_image' => 'img05.jpg',
            'verified_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'RT 01',
            'username' => 'rt1-amankan-123',
            'password' => bcrypt('rt1-amankan'),
            'role' => 'rt',
            'number' => '081512345678',
            'nik' => '6371040404040006',
            'user_image' => 'img05.jpg',
            'verified_at' => Carbon::now()
        ]);
        User::create([
            'name' => 'RT 02',
            'username' => 'rt2-amankan-123',
            'password' => bcrypt('rt2-amankan'),
            'role' => 'rt',
            'number' => '081612345678',
            'nik' => '6371040405040002',
            'user_image' => 'img02.jpg',
            'verified_at' => Carbon::now()
        ]);
        User::create([
            'name' => 'RT 03',
            'username' => 'rt3-amankan-123',
            'password' => bcrypt('rt3-amankan'),
            'role' => 'rt',
            'number' => '081712345678',
            'nik' => '6371040804970006',
            'user_image' => 'img03.jpg',
            'verified_at' => Carbon::now()
        ]);
        User::create([
            'name' => 'RT 04',
            'username' => 'rt4-amankan-123',
            'password' => bcrypt('rt4-amankan'),
            'role' => 'rt',
            'number' => '081812345678',
            'nik' => '6371046404040002',
            'user_image' => 'img04.jpg',
            'verified_at' => Carbon::now()
        ]);
        User::create([
            'name' => 'RT 05',
            'username' => 'rt5-amankan-123',
            'password' => bcrypt('rt5-amankan'),
            'role' => 'rt',
            'number' => '081912345678',
            'nik' => '6371040404840002',
            'user_image' => 'img05.jpg',
            'verified_at' => Carbon::now()
        ]);


    }
}
