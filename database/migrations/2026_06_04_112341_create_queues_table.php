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
    Schema::create('queues', function (Blueprint $table) {
        $table->string('QueueID', 30)->primary(); // Q-20250604-1
        $table->string('CustomerID', 20);
        $table->string('VehicleID', 30);
        $table->date('BookingTime');
        $table->string('ServiceCategoryID', 20); // FK ke ServiceCategory (sesuai DDL)
        $table->text('Description')->nullable();
        $table->string('QueueStatus', 50);
        $table->timestamps();

        $table->foreign('CustomerID')
              ->references('CustomerID')->on('customers')
              ->onUpdate('cascade')->onDelete('cascade');

        $table->foreign('VehicleID')
              ->references('VehicleID')->on('vehicles')
              ->onUpdate('cascade')->onDelete('cascade');

        $table->foreign('ServiceCategoryID')
              ->references('ServiceCategoryID')->on('service_categories')
              ->onUpdate('cascade')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('queues');
}
};
