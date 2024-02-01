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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('position_id');
            $table->string('NIDN')->unique();
            $table->string('name');
            $table->string('email')->unique()->default(null);
            $table->string('telp')->unique()->default(null);
            $table->json('skills');
            $table->json('title');
            $table->boolean('pembimbing')->default(false);
            $table->boolean('penguji')->default(false);
            $table->boolean('login')->default(false);
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('NIDN')->references('NIDN')->on('teachers');
         });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
