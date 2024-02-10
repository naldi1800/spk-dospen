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
        Schema::create('history_temp', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_i');
            $table->string('mahasiswa_ii')->nullable();
            $table->string('title');
            $table->unsignedBigInteger('pembimbing_i')->nullable();
            $table->unsignedBigInteger('pembimbing_ii')->nullable();
            $table->unsignedBigInteger('penguji_i')->nullable();
            $table->unsignedBigInteger('penguji_ii')->nullable();
            $table->json('skill');
            $table->unsignedBigInteger('jurusan_id');
            $table->date('tanggal_proposal')->nullable();
            $table->date('tanggal_skripsi')->nullable();
            $table->timestamps();
        });
        Schema::table('history_temp', function (Blueprint $table) {
            $table->foreign('pembimbing_i')->references('id')->on('teachers');
            $table->foreign('pembimbing_ii')->references('id')->on('teachers');
            $table->foreign('penguji_i')->references('id')->on('teachers');
            $table->foreign('penguji_ii')->references('id')->on('teachers');
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_temp');
    }
};
