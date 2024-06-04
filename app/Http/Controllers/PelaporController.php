<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\User_Snapshot;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Helper\ApiFormatter;
use Exception;
use Carbon\Carbon;

class PelaporController extends Controller
{
    public function dashboardPelapor(){

        try {
            Carbon::setLocale('id');

            $namaUser = auth()->user()->name;

            $laporanTerakhirDashboard = Laporan::with('galleries')
                ->orderBy('tgl_lapor', 'desc')
                ->take(10)->get();

            $data = [
                'namaUser' => $namaUser,
                'laporanTerakhirDashboard' => $laporanTerakhirDashboard->map(function ($laporan){
                    $firstGallery = $laporan->galleries->first();

                    return [
                        'id' => $laporan->id,
                        'deskripsi_lapor' => $laporan->deskripsi,
                        'lokasi_kejadian' => $laporan->lokasi_kejadian,
                        'waktu_lalu' => Carbon::parse($laporan->tgl_lapor)->diffForHumans(),
                        'gambar_laporan' => $firstGallery->file_name,
                        'maps' => $laporan->maps
                    ];

                }),
            ];

            return ApiFormatter::createApi(200, 'success', $data);

        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }

    }


    public function laporanAnda(){
        
        try {
            Carbon::setLocale('id');

            $laporanAnda = Laporan::with(['userSnapshot','galleries'])
                ->where('user__snapshot_id', auth()->user()->id)
                ->orderBy('tgl_lapor', 'desc')
                ->get();

            $data = [
                'laporanAnda' => $laporanAnda->map(function ($laporan){
                    $firstGallery = $laporan->galleries->first();

                    return [
                        'id' => $laporan->id,
                        'deskripsi_lapor' => $laporan->deskripsi,
                        'status_laporan' => $laporan->status_lapor,
                        'role_pelapor' => $laporan->userSnapshot->role,
                        'nama_pelapor' => $laporan->userSnapshot->name,
                        'lokasi_kejadian' => $laporan->lokasi_kejadian,
                        'waktu_lalu' => Carbon::parse($laporan->tgl_lapor)->diffForHumans(),
                        'maps' => $laporan->maps,
                        'gambar_laporan' => $firstGallery->file_name
                    ];

                }),
            ];

            return ApiFormatter::createApi(200, 'success', $data);

        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }

    }
}
