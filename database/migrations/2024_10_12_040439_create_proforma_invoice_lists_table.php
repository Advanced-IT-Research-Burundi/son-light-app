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

            // Clé étrangère vers la table proforma_invoices
            $table->foreignId('proforma_invoice_id')
                  ->constrained()
                  ->onDelete('cascade');  // Suppression en cascade

            // Informations sur le produit
            $table->string('product_name');
            $table->integer('quantity')->default(1);  // Valeur par défaut de 1

            // Prix unitaire et prix total avec précision
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);

            // Unité du produit
            $table->string('unit')->nullable();

            // Informations complémentaires
            $table->string('price_letter')->nullable();  // Lettre de prix si nécessaire

            // Timestamps pour le suivi des modifications
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
