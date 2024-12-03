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
        Schema::create('stock_exits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_id');
            $table->decimal('quantity_exited', 10, 2);
            $table->date('exit_date');
            $table->string('destination')->nullable();
            $table->text('exit_notes')->nullable();
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_exits');
    }
};
