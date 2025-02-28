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

            // Ajout d'une colonne 'designation' pour décrire la facture
            $table->string('designation')->nullable();

            // Champ pour le numéro de facture, doit être unique
            $table->string('invoice_number')->unique()->nullable();

            // Clés étrangères
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');

            // Colonnes pour les prix et quantités
            $table->integer('quantity')->nullable();
            $table->double('amount')->default(0); // Ajout d'une valeur par défaut
            $table->double('tva')->default(0);
            $table->double('amount_ht')->default(0);
            $table->double('amount_tvac')->default(0);

            // Date de la facture
            $table->date('proforma_invoice_date')->nullable();

            // Informations additionnelles
            $table->string('price_letter')->nullable();
            $table->string('unit')->nullable();
            $table->integer('validity_period')->default(30);

            // Timestamps (created_at et updated_at)
            $table->timestamps();

            // Gérer les suppressions logiques
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proforma_invoices');
    }
};
