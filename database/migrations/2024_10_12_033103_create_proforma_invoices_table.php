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
        Schema::create('proforma_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('designation')->nullable();
            $table->string('invoice_number')->nullable();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('company_id')->constrained();
            $table->integer('quantity')->nullable();
            $table->double('amount');
            $table->double(column: 'tva')->default(0);
            $table->double(column: 'amount_ht')->default(0);
            $table->double(column: 'amount_tvac')->default(0);
            $table->date('proforma_invoice_date');
            $table->string('price_letter')->nullable();
            $table->string('unit')->nullable();
            $table->integer('validity_period')->default(30);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proforma_invoices');
    }
};
