<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCashRegisterDenominationsTable extends Migration
{
    public function up()
    {
        Schema::table('cash_register_denominations', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->change();
            $table->foreignId('updated_by')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('cash_register_denominations', function (Blueprint $table) {
            // Si vous souhaitez revenir en arrière, vous pouvez annuler les modifications ici
            $table->foreignId('created_by')->nullable(false)->change();
            $table->foreignId('updated_by')->nullable(false)->change();
        });
    }
}
