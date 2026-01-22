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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();


















            // Receipt type
            $table->enum('Rtype', ['in', 'out']);

            // Financial info
            $table->decimal('amount', 15, 2);
//            $table->string('currency', 10)->default('USD');

            // Basic details
            $table->string('name')->nullable();
            $table->text('notes')->nullable();

            // Payment info
            $table->enum('pay_type', ['transfer', 'cash', 'check']);
            $table->string('pay_file')->nullable();

            // Shift / account relations
            $table->unsignedBigInteger('shift_id')->nullable();
            $table->foreignId('acc_id' )->constrained('ma_accounts' , 'accountid')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('acc_detail_type')->nullable();
            $table->unsignedBigInteger('acc_details_id')->nullable();

            $table->unsignedBigInteger('currency')->nullable();
            $table->foreign('currency')->references('id')->on('currencies');

            // Approval & status
            $table->enum('approve', ['yes', 'no'])->default('no');
            $table->text('approve_note')->nullable();
            $table->boolean('printed')->default(false);
            $table->enum('posted' , ['yes' , 'no'])->default('no');


            // Meta
            $table->timestamp('Rcreated_date')->nullable();
            $table->unsignedBigInteger('by_id')->nullable();





            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
