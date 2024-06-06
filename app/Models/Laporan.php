<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $status_lapor = ['selesai', 'belum selesai', 'tak terselesaikan'];

    
    public function userSnapshot(){
        return $this->belongsTo(User_Snapshot::class, 'user__snapshot_id', 'user_id');
    }


    public function galleries(){
        return $this->hasMany(Gallery::class);
    }


    public function chats(){
        return $this->hasMany(Chats::class);
    }
}
