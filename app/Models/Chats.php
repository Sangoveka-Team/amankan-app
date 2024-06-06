<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Laporan(){
        return $this->belongsTo(Laporan::class);
    }

    public function userSnapshot(){
        return $this->belongsTo(User_Snapshot::class, 'user__snapshot_id', 'id');
    }
}
