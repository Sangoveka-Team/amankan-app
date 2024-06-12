<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helper\uniqueGenerateIdLapor;
use App\Models\Laporan;
use Illuminate\Support\Str;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laporans')->insert([
            [
                'id_laporan' => 'AMANKAN-LAP' . Str::random(10),
                'user__snapshot_id' => 5, 
                'lokasi_kejadian' => 'Jl. Merdeka No. 1, Jakarta',
                'tgl_lapor' => '2024-06-01 10:00:00',
                'status_lapor' => 'selesai',
                'deskripsi' => 'Maling Sepeda Motor',
                'maps' => 'https://maps.example.com/?q=Jl.%20Merdeka%20No.%201,%20Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_laporan' => 'AMANKAN-LAP' . Str::random(10),
                'user__snapshot_id' => 5, 
                'lokasi_kejadian' => 'Jl. Sudirman No. 2, Bandung',
                'tgl_lapor' => Carbon::now(),
                'status_lapor' => 'belum selesai',
                'deskripsi' => 'Pencopet di jalan Ahmad Yani',
                'maps' => 'https://maps.example.com/?q=Jl.%20Sudirman%20No.%202,%20Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        DB::table('galleries')->insert([
            [
                'laporan_id' => 1,
                'image_type' => 'foto_laporan',
                'path' => 'img/img001.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'laporan_id' => 2,
                'image_type' => 'foto_laporan',
                'path' => 'img/img001.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        DB::table('chats')->insert([
            [
                'laporan_id' => 1,
                'user__snapshot_id' => 5,
                'message' => 'Wah, ini mengerikan sekali, ayo tangkap saya akan ikut membantu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'laporan_id' => 1,
                'user__snapshot_id' => 3,
                'message' => 'Halo, saya akan segera kesana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
