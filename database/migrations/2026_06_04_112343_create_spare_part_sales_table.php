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
    Schema::create('spare_part_sales', function (Blueprint $table) {
        $table->string('SparePartSalesID', 50)->primary(); // SPS-T-20250604-1-1
        $table->string('TransactionID', 30);
        $table->string('Type', 50);
        $table->string('Status', 50);
        $table->integer('PriceAtPurchase');
        $table->string('DeliveryMethod', 50)->nullable();
        $table->string('ReceiverName', 100)->nullable();
        $table->string('ReceiverPhone', 20)->nullable();
        $table->string('ReceiverAddress', 255)->nullable();
        $table->string('Notes', 255)->nullable();
        $table->timestamps();

        $table->foreign('TransactionID')
              ->references('TransactionID')->on('transactions')
              ->onUpdate('cascade')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('spare_part_sales');
}
};
