<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Chats;
use App\Models\Gallery;
use App\Models\User_Snapshot;
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
            'email' => 'ricko.admin@gmail.com',
            'password' => bcrypt('admin-amankan-01'),
            'number' => '081932432218',
            'role' => 'admin',
            'nik' => '6371040404040006', 
            'user_image' => 'img05.jpg',
            'verified_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'Bhakti Ramadhani',
            'username' => 'bhakti',
            'password' => bcrypt('admin-amankan-02'),
            'email' => 'bhakti.keamanan@gmail.com',
            'role' => 'keamanan',
            'number' => '081612345678',
            'nik' => '6371040405040002',
            'user_image' => 'img02.jpg',
            'verified_at' => Carbon::now()
        ]);
        User::create([
            'name' => 'Syarifuddin',
            'username' => 'keamanan1-amankan',
            'password' => bcrypt('keamanan1-amankan-123'),
            'email' => 'syarifudin.keamanan@gmail.com',
            'role' => 'keamanan',
            'number' => '081512345678',
            'nik' => '6371040404040006',
            'user_image' => 'img05.jpg',
            'verified_at' => Carbon::now()
        ]);
        User::create([
            'name' => 'Aminudin',
            'username' => 'keamanan2-amankan',
            'password' => bcrypt('keamanan2-amankan-123'),
            'email' => 'aminudin.keamanan@gmail.com',
            'role' => 'keamanan',
            'number' => '081712345678',
            'nik' => '6371040804970006',
            'user_image' => 'img03.jpg',
            'verified_at' => Carbon::now()
        ]);
        User::create([
            'name' => 'Rozaq',
            'username' => 'rozaqgaming321',
            'password' => bcrypt('rozaq321'),
            'email' => 'rozaq.pelapor@gmail.com',
            'role' => 'pelapor',
            'number' => '081812345678',
            'nik' => '6371046404040002',
            'user_image' => 'img04.jpg',
            'verified_at' => Carbon::now()
        ]);
        User::create([
            'name' => 'Intan Nur Kholisa',
            'username' => 'intan-ojousama',
            'email' => 'intan.pelapor@gmail.com',
            'password' => bcrypt('intan123'),
            'role' => 'pelapor',
            'number' => '081812345678',
            'nik' => '6371046404040002',
            'user_image' => 'img04.jpg',
            'verified_at' => null
        ]);




        User_Snapshot::create([
            'user_id' => 1,
            'name' => 'Ricko Aprilianto',
            'username' => 'ricko',
            'email' => 'ricko.admin@gmail.com',
            'role' => 'admin',
            'number' => '081932432218',
            'nik' => '6371040404040006',
            'user_image' => 'img05.jpg',
        ]);

        User_Snapshot::create([
            'user_id' => 2,
            'name' => 'Bhakti Ramadhani',
            'username' => 'bhakti',
            'email' => 'bhakti.keamanan@gmail.com',
            'role' => 'admin',
            'number' => '081612345678',
            'nik' => '6371040405040002',
            'user_image' => 'img02.jpg',
        ]);

        User_Snapshot::create([
            'user_id' => 3,
            'name' => 'Syarifuddin',
            'username' => 'keamanan1-amankan',
            'email' => 'syarifudin.keamanan@gmail.com',
            'role' => 'keamanan',
            'number' => '081512345678',
            'nik' => '6371040404040006',
            'user_image' => 'img05.jpg',
        ]);

        User_Snapshot::create([
            'user_id' => 4,
            'name' => 'Aminudin',
            'username' => 'keamanan2-amankan',
            'email' => 'aminudin.keamanan@gmail.com',
            'role' => 'keamanan',
            'number' => '081712345678',
            'nik' => '6371040804970006',
            'user_image' => 'img03.jpg',
        ]);

        User_Snapshot::create([
            'user_id' => 5,
            'name' => 'Rozaq',
            'username' => 'rozaqgaming321',
            'email' => 'rozaq.pelapor@gmail.com',
            'role' => 'pelapor',
            'number' => '081812345678',
            'nik' => '6371046404040002',
            'user_image' => 'img04.jpg',
        ]);

        User_Snapshot::create([
            'user_id' => 6,
            'name' => 'Intan Nur Kholisa',
            'username' => 'intan-ojousama',
            'email' => 'intan.pelapor@gmail.com',
            'role' => 'pelapor',
            'number' => '081812345678',
            'nik' => '6371046404040002',
            'user_image' => 'img04.jpg',
        ]);

    }
}
