<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\User_Snapshot;
use App\Models\Chats;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Helper\ApiFormatter;
use Exception;
use App\Helper\uniqueGenerateIdLapor;
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
                        'tanggal_lapor' => $laporan->tgl_lapor,
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
            Carbon::setLocale('id');

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
                            'tanggal_lapor' => Carbon::parse($laporan->tgl_lapor)->isoFormat('dddd, D MMMM YYYY - HH.mm [WIB]'),
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
                            'id_user' => $chat->userSnapshot->id,
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

    public function createLaporan(Request $request){
        try {
            Carbon::setLocale('id');

            $laporan = new Laporan;

            $str = uniqueGenerateIdLapor::generateUniqueRandomString(10, Laporan::class, 'id_laporan');

            $carbonDate = Carbon::now();

            // Mengeluarkan tanggal, bulan, dan tahun
            $day = $carbonDate->day;
            $month = $carbonDate->month;
            $year = $carbonDate->year;

            $laporan->id_laporan = "SILT" . $day . $month . $year . $str;
            $laporan->user__snapshot_id = auth()->user()->id;
            $laporan->tgl_lapor = Carbon::now()->format('Y-m-d H:i:s');
            $laporan->status_lapor = "belum selesai";
            $laporan->lokasi_kejadian = $request->lokasi_kejadian;
            $laporan->deskripsi = $request->deskripsi;
            $laporan->maps = $request->maps;

            $laporan->save();

            if ($request->hasFile('image')) {
                $images = $request->file('image'); 
                // dd($images);  

                foreach ($images as $image) {
                    $imageName = time() . '.' . $image->getClientOriginalextension();
                    $image->move(public_path('img/' . $imageName));
                    $path = 'img/' . $imageName;
                    $fileImage = new Gallery;
                    $fileImage->laporan_id = $laporan->id;
                    $fileImage->image_type = 'foto_laporan';
                    $fileImage->path = $path;

                    // dd($fileImage);
                    $fileImage->save();

                }
            } else {
                // Log error jika file tidak valid
                Log::error('Invalid image file');
            }

            $imgLaporan = Gallery::where('laporan_id', $laporan->id)->get();


            if ($imgLaporan !== null) {
                $data = [
                    "laporan" => $laporan,
                    "images" => $imgLaporan,
                ];

            return ApiFormatter::createApi(200, 'success', $data);
            } else {
                return ApiFormatter::createApi(401, 'failed');
            }
            

        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }

    }
}
