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
            $table->foreignId('requerant_id')->constrained('users');
            $table->foreignId('user_id')->constrained('users'); // Caissier
            $table->foreignId('approbation_id')->constrained('users'); // DAF
            $table->decimal('amount', 10, 2);
            $table->string('motif');
            $table->text('note_validation')->nullable();
            $table->dateTime('cash_register_receipts_date');
            $table->dateTime('cash_register_receipts_approbation_date')->nullable();
            $table->softDeletes(); 
            $table->timestamps();
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
