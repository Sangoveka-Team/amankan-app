<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\User_Snapshot;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Helper\ApiFormatter;
use Exception;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboardAdmin(){

        try {
            $allLaporan = Laporan::all();
            $pelaporTerdaftar = User::where('role', 'pelapor')->get();
            $petugasTerdaftar = User::where('role', 'keamanan')->get();
            $laporanBelumSelesai = Laporan::where('status_lapor', 'belum selesai')->get();
            $laporanSelesai = Laporan::where('status_lapor', 'selesai')->get();
            $laporanGagal = Laporan::where('status_lapor', 'gagal')->get();
            $laporanTidakValid = Laporan::where('status_lapor', 'tidak valid')->get();

            $allLaporanCount = $allLaporan->count();
            $pelaporTerdaftarCount = $pelaporTerdaftar->count();
            $petugasTerdaftarCount = $petugasTerdaftar->count();
            $laporanBelumSelesaiCount = $laporanBelumSelesai->count();
            $laporanSelesaiCount = $laporanSelesai->count();
            $laporanGagalCount = $laporanGagal->count();
            $laporanTidakValidCount= $laporanTidakValid->count();

            $konfirmasiAkunPetugas = User::where('role', 'pelapor')->where('permintaan_petugas', true)->get();


            $data = [
                "jumlahSemuaLaporan" => $allLaporanCount,
                "jumlahPelaporTerdaftar" => $pelaporTerdaftarCount,
                "jumlahPetugasTerdaftar" => $petugasTerdaftarCount,
                "jumlahLaporanBelumSelesai" => $laporanBelumSelesaiCount,
                "jumlahLaporanSelesai" => $laporanSelesaiCount,
                "jumlahLaporanGagal" => $laporanGagalCount,
                "jumlahLaporanTidakValid" => $laporanTidakValidCount,
                "namaUser" => auth()->user()->name,
                "konfirmasiAkunPetugas" => $konfirmasiAkunPetugas,
            ];

            return ApiFormatter::createApi(200, 'success', $data);


        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }
    }



    public function getSemuaAkun() {

        try {
            $getAllUser = User::all();

            $mappedUser = $getAllUser->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'role' => $user->role,
                ];
            });
            return ApiFormatter::createApi(200, 'success', $mappedUser);


        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }

    }



    public function detailAkun($id){

        try {
            $user = User::findOrFail($id);

            return ApiFormatter::createApi(200, 'success', $user);
        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }

    }

}
