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
            $table->string('name', 150);
            $table->string('username', 100)->unique();
            $table->timestamp('verified_at')->nullable();
            $table->string('password', 100);
            $table->string('number', 16);
            $table->enum('role', ['admin', 'rt', 'pelapor']);
            $table->string('wilayah', 12)->nullable();
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
