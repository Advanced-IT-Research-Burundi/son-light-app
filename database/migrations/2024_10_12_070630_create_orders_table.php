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
            $table->decimal('amount', 10, 2); // Modifié pour avoir la même précision que les autres montants
            $table->decimal('tva', 10, 2)->default(0); // Modifié pour avoir la même précision que les autres montants
            $table->decimal('amount_ht', 10, 2)->default(0); // Modifié pour avoir la même précision que les autres montants
            $table->decimal('amount_tvac', 10, 2)->default(0); // Modifié pour avoir la même précision que les autres montants
            $table->date('order_date');
            $table->date('delivery_date');
            $table->string('price_letter')->nullable();
            $table->string('unit')->nullable();
            $table->string('status');
            $table->decimal('tc', 10, 2)->default(0);
            $table->decimal('atax', 10, 2)->default(0);
            $table->decimal('pf', 10, 2)->default(0);
            $table->boolean('status_livraison')->default(false);
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
