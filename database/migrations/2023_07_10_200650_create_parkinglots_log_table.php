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
        Schema::create('parkinglots_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parkinglot_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('amount');
            $table->timestamp('parking_date');
            $table->timestamps();

            $table->foreign('parkinglot_id')->references('idparking')->on('parkinglots');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkinglots_log');
    }
};
