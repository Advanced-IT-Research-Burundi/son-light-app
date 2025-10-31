<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::create('detail_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('designation');
            $table->string('unit')->nullable();
            $table->string('price_letter')->nullable();
            $table->integer('quantity');
            $table->double('tc')->default(0);
            $table->double('atax')->default(0);
            $table->double('tva')->default(0);
            $table->double('pf')->default(0);
            $table->double('unit_price');
            $table->double('total_price');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('detail_orders');
    }
};
