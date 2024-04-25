<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $status_lapor = ['selesai', 'belum selesai', 'tak terselesaikan'];

    public function User(){
        return $this->belongsTo(User::class);
    }
}
