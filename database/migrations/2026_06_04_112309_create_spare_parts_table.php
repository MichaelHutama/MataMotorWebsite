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
    Schema::create('spare_parts', function (Blueprint $table) {
        $table->string('SparePartID', 20)->primary();
        $table->string('SparePartCategoryID', 20);
        $table->string('Name', 100);
        $table->text('Description')->nullable();
        $table->integer('Stock');
        $table->integer('Price');
        $table->string('Image')->nullable(); // simpan path file, bukan BLOB
        $table->timestamps();

        $table->foreign('SparePartCategoryID')
              ->references('SparePartCategoryID')->on('spare_part_categories')
              ->onUpdate('cascade')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('spare_parts');
}
};
