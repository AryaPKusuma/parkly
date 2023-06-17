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
        Schema::create('payment_status', function (Blueprint $table) {
            $table->id('idpayment');
            $table->date('payment_date');
            $table->decimal('payment_amount');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->foreignId('parkinglots_id')->constrained('parkinglots', 'idparking');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_status');
    }
};
