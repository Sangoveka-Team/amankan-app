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
        Schema::create('user__snapshots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->string('name', 150);
            $table->string('username', 100)->unique();
            $table->string('email')->unique();
            $table->enum('role', ['admin', 'keamanan', 'pelapor']);
            $table->string('number', 16);
            $table->string('nik', 16);
            $table->string('user_image');
            $table->timestamps();
            // tambahkan role untuk user_snapshot (kdd role nya amjing)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user__snapshots');
    }
};
