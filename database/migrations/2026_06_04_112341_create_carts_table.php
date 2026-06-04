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
    Schema::create('carts', function (Blueprint $table) {
        $table->string('CartID', 40)->primary(); // CUS-1-CART-1
        $table->string('CustomerID', 20);
        $table->string('SparePartID', 20);
        $table->integer('Quantity');
        $table->boolean('IsChecked');
        $table->timestamps();

        $table->foreign('CustomerID')
              ->references('CustomerID')->on('customers')
              ->onUpdate('cascade')->onDelete('cascade');

        $table->foreign('SparePartID')
              ->references('SparePartID')->on('spare_parts')
              ->onUpdate('cascade')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('carts');
}
};
