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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('idreservation');
            $table->string('police_number', 45);
            $table->string('vehicle_type', 45);
            $table->string('vehicle_brand', 45);
            $table->string('parking_name', 45);
            $table->integer('parking_number');
            $table->integer('status')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('parkinglots_id')->constrained('parkinglots', 'idparking');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
