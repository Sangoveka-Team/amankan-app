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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('username', 50)->unique();
            $table->string('password', 100);
            $table->string('email')->unique();
            $table->timestamp('verified_at')->nullable();
            $table->string('number', 16);
            $table->enum('role', ['admin', 'keamanan', 'pelapor']);
            $table->string('nik', 16);
            $table->string('user_image');
            $table->text('alamat');
            $table->string('lokasi_rumah')->nullable();
            $table->boolean('permintaan_petugas')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */ 
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
