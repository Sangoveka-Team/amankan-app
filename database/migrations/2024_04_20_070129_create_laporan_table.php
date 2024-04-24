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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('user_image')->nullable();
            $table->string('nama', 150);
            $table->string('nomor', 16);
            $table->text('alamat');
            $table->dateTime('tanggal');
            $table->string('status_lapor');
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
