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
    Schema::create('service_categories', function (Blueprint $table) {
        $table->string('ServiceCategoryID', 20)->primary();
        $table->string('ServiceCategoryName', 100);
        $table->binary('ServiceIcon')->nullable();
        $table->integer('ServicePrice');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('service_categories');
}
};
