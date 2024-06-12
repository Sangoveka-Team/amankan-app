<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('id_laporan', 100);
            $table->foreignId('user__snapshot_id')->constrained('user__snapshots')->onUpdate('cascade');
            $table->text('lokasi_kejadian');
            $table->dateTime('tgl_lapor');
            $table->enum('status_lapor', ['selesai', 'belum selesai', 'gagal', 'tidak valid']);
            $table->text('deskripsi');
            $table->string('maps');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
