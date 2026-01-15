<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     *
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ma_tourism_files', function (Blueprint $table) {
            $table->id();
            $table->string('Fcode')->nullable();
            $table->enum('Ftype' ,['hajj' , 'umrah' , 'domestic_tourism' , 'external_tourism'] )->nullable();
            $table->string('Fname')->nullable();
            $table->foreignId('emp' )->constrained('clients')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('adults_no')->nullable();
            $table->integer('child_no')->nullable();
            $table->integer('infants_no')->nullable();
            $table->dateTime('arrival_date')->nullable();
            $table->dateTime('leave_date')->nullable();
            $table->foreignId('nationality' )->constrained('countries')->cascadeOnUpdate()->cascadeOnDelete();
            $table->dateTime('created_date')->nullable();
            $table->boolean('closed')->nullable()->default(0);
            $table->boolean('approved')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ma_tourism_files');
    }
};
