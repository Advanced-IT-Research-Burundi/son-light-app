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
        Schema::create('proforma_invoice_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proforma_invoice_id')
                  ->constrained()
                  ->onDelete('cascade');  
            $table->string('designation');
            $table->integer('quantity')->default(1);  
            $table->decimal('unit_price');
            $table->decimal('total_price');
            $table->string('unit')->nullable();
            $table->string('price_letter')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proforma_invoice_lists');
    }
};
