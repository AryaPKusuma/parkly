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
        Schema::create('parkinglots', function (Blueprint $table) {
            $table->id('idparking');
            $table->string('parking_name');
            $table->integer('capacity');
            $table->string('address', 100);
            $table->integer('cost');
            $table->tinyInteger('status');
            $table->string('photo');
            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();
            $table->integer('rating')->nullable();
            $table->string('lonlat')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('profit')->default(0);
            $table->timestamps();
            $table->foreignId('user_id');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkinglots');
    }
};
