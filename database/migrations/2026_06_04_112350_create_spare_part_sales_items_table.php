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
    Schema::create('spare_part_sales_items', function (Blueprint $table) {
        $table->string('SparePartSalesID', 50);
        $table->string('SparePartID', 20);
        $table->integer('Amount')->nullable();
        $table->primary(['SparePartSalesID', 'SparePartID']); // composite PK
        $table->timestamps();

        $table->foreign('SparePartSalesID')
              ->references('SparePartSalesID')->on('spare_part_sales')
              ->onUpdate('cascade')->onDelete('cascade');

        $table->foreign('SparePartID')
              ->references('SparePartID')->on('spare_parts')
              ->onUpdate('cascade')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('spare_part_sales_items');
}
};
