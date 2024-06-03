<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Helper\ApiFormatter;
use Exception;

class PelaporController extends Controller
{
    public function dashboardPelapor(){

        try {
            $namaUser = auth()->user()->name;

            $laporanTerakhir = Laporan::orderBy('tgl_lapor', 'desc')->get();

            $data = [
                'namaUser' => $namaUser,
                'laporanTerakhir' => $laporanTerakhir
            ];

            return ApiFormatter::createApi(200, 'success', $data);

        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }

    }
}
