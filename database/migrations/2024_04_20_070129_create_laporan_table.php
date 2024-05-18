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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('id_laporan', 100);
            $table->foreignId('user_snapshot_id')->constrained('user_snapshots')->onUpdate('cascade');
            $table->string('user_image')->nullable();
            $table->string('name', 150);
            $table->string('number', 16);
            $table->text('address');
            $table->dateTime('tgl_lapor');
            $table->enum('status_lapor', ['selesai', 'belum selesai', 'tak terselesaikan']);
            $table->string('daerah_rt')->nullable();
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
