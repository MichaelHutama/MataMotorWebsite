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
    Schema::create('vehicles', function (Blueprint $table) {
        $table->string('VehicleID', 30)->primary(); // CUS-1-VEC-1 butuh lebih panjang
        $table->string('CustomerID', 20)->nullable();
        $table->string('VehicleCategory', 20);
        $table->string('Brand', 100);
        $table->year('ProductionYear')->nullable();
        $table->string('PlateNumber', 20);
        $table->timestamps();

        $table->foreign('CustomerID')
              ->references('CustomerID')->on('customers')
              ->onUpdate('cascade')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::dropIfExists('vehicles');
}
};
