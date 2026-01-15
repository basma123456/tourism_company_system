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
        Schema::create('transite_places', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flight_ticket_id');
            $table->string('from_transite_city');
            $table->string('to_transite_city');

            // Foreign key (optional but recommended)
            $table->foreign('flight_ticket_id')
                ->references('id')
                ->on('ma_flight_tickets')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transite_places');
    }
};
