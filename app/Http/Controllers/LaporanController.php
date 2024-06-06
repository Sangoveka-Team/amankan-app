<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\User_Snapshot;
use App\Models\Chats;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Helper\ApiFormatter;
use Exception;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(){

        try {
            Carbon::setLocale('id');

            $laporanAnda = Laporan::with(['userSnapshot','galleries'])
                ->orderBy('tgl_lapor', 'desc')
                ->get();

            $data = [
                'laporan' => $laporanAnda->map(function ($laporan){
                    $fotoLaporan = $laporan->galleries->where('image_type', 'foto_laporan')->first();

                    return [
                        'id' => $laporan->id,
                        'deskripsi_lapor' => $laporan->deskripsi,
                        'status_laporan' => $laporan->status_lapor,
                        'role_pelapor' => $laporan->userSnapshot->role,
                        'nama_pelapor' => $laporan->userSnapshot->name,
                        'lokasi_kejadian' => $laporan->lokasi_kejadian,
                        'waktu_lalu' => Carbon::parse($laporan->tgl_lapor)->diffForHumans(),
                        'maps' => $laporan->maps,
                        'gambar_laporan' => $fotoLaporan->path
                ];

                }),
            ];

            return ApiFormatter::createApi(200, 'success', $data);

        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }

    }


    public function show(string $id){
        try {
            // $laporan = Laporan::findOrFail($id);
            // dd($laporan);

            $getDataLaporan = Laporan::where('id', $id)->get();
            $getChats = Chats::where('laporan_id', $id)->get();

            $data = [
                    'detail_laporan' => $getDataLaporan->map(function ($laporan){
                        $fotoLaporan = $laporan->galleries->where('image_type', 'foto_laporan')->first();

                        return [
                            'id' => $laporan->id,
                            'gambar_laporan' => $fotoLaporan ? $fotoLaporan->path : null,
                            'status_laporan' => $laporan->status_lapor,
                            'nama_pelapor' => $laporan->userSnapshot->name,
                            'role_pelapor' => $laporan->userSnapshot->role,
                            'nomor_pelapor' => $laporan->userSnapshot->number,
                            'deskripsi_lapor' => $laporan->deskripsi,
                            'waktu_lalu' => Carbon::parse($laporan->tgl_lapor)->diffForHumans(),
                            'lokasi_kejadian' => $laporan->lokasi_kejadian,
                            'maps' => $laporan->maps,
                            // 'netizen' => $komentarLaporan ? $komentarLaporan->userSnapshot->name : null,
                            // 'foto_netizen' => $komentarLaporan ? $komentarLaporan->userSnapshot->image : null,
                            // 'komentar' => $komentarLaporan ? $komentarLaporan->message : null,
                        ];
                    }),

                    'chat_laporan' => $getChats->map(function ($chat){
                        
                        return [
                            'id' => $chat->id,
                            'nama_netizen' => $chat->userSnapshot->name,
                            'foto_netizen' => $chat->userSnapshot->image,
                            'komentar' => $chat->message,
                            'waktu' => $chat->created_at
                        ];
                    }),



                ];

            return ApiFormatter::createApi(200, 'success', $data);
        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }
    }
}
