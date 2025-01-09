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
        Schema::create('cash_register_receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cash_register_id')->constrained('cash_registers')->onDelete('cascade');
            $table->foreignId('requester_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('approver_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 10, 2)->comment('The amount related to the cash register receipt.');
            $table->enum('type', ['entry', 'exit'])
                  ->comment('Type of the transaction: entry or exit.');
            $table->string('label')->nullable();
            $table->enum('justification', ['with_proof', 'without_proof'])
                  ->comment('Justification type: with proof or without proof.');
            $table->text('motif')->nullable()->comment('A brief explanation or reason associated with the receipt.');
            $table->text('validation_note')->nullable()->comment('Optional note for validation purposes.');
            $table->dateTime('receipt_date')->comment('The date when the receipt was issued.');
            $table->dateTime('approval_date')->nullable()->comment('The date when the receipt was approved.');
            $table->boolean('is_approved')->default(false)->comment('Indicates whether the receipt is approved.');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_register_receipts');
    }
};
