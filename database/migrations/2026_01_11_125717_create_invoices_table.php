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
        Schema::create('ma_invoices', function (Blueprint $table) {
            $table->id();

            $table->string('inv_code')->unique();
            $table->string('inv_type');
            $table->date('inv_date');

            $table->decimal('amount', 10, 2);
            $table->decimal('tax', 10, 2)->default(0);

            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ma_invoices');
    }
};
