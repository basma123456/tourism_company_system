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
        Schema::create('ma_flight_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('airline_id');
            $table->string('ticket_no')->unique();
            $table->string('traveller_name');
            $table->string('from_city');
            $table->string('to_city');
            $table->decimal('price', 10, 2)->nullable()->default(0);
            $table->decimal('airline_com', 10, 2)->nullable()->default(0);
            $table->decimal('additional_fees', 10, 2)->nullable()->default(0);
            $table->decimal('discount', 10, 2)->nullable()->default(0);
            $table->date('book_date')->nullable();
            $table->date('travel_date')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->foreign('airline_id')->references('id')->on('airlines');
            $table->foreign('client_id')->references('id')->on('clients');
//            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ma_flight_tickets');
    }
};
