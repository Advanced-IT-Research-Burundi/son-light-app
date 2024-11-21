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
        Schema::disableForeignKeyConstraints();

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proforma_invoice_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->nullable()->constrained();
            $table->string('designation')->nullable();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('quantity')->nullable();
            $table->double('amount');
            $table->double(column: 'tva')->default(0);
            $table->double(column: 'amount_ht')->default(0);
            $table->double(column: 'amount_tvac')->default(0);
            $table->date('order_date');
            $table->date('delivery_date');
            $table->string('price_letter')->default('null');
            $table->string('unit')->nullable();
            $table->string('status');
            $table->integer('status_livraison');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('orders');
} 
};
