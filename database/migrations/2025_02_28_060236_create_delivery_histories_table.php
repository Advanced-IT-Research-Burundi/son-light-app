<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detail_order_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamp('delivered_at');
            $table->string('status')->default('pending'); // Le statut peut être "pending", "delivered", etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_histories');
    }
}
