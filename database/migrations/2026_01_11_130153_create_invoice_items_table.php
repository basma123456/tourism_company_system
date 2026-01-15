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
        Schema::create('ma_invoices_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inv_id')->constrained('ma_invoices')->cascadeOnDelete()->cascadeOnDelete();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->decimal('amounts' , 10 , 2 )->default(0)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ma_invoices_items');
    }
};
