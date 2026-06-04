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
    Schema::create('service_performed', function (Blueprint $table) {
        $table->string('ServiceID', 60)->primary(); // SVP-T-20250604-1-1
        $table->string('TransactionID', 30);
        $table->string('QueueID', 30)->nullable();
        $table->string('VehicleID', 30)->nullable();
        $table->string('ServiceCategoryID', 20)->nullable();
        $table->integer('PriceAtService');
        $table->string('Status', 50);
        $table->integer('Rating')->nullable();
        $table->string('ReviewDesc', 255)->nullable();
        $table->timestamps();

        $table->foreign('TransactionID')
              ->references('TransactionID')->on('transactions')
              ->onUpdate('cascade')->onDelete('cascade');

        $table->foreign('QueueID')
              ->references('QueueID')->on('queues')
              ->onUpdate('cascade')->onDelete('set null');

        $table->foreign('VehicleID')
              ->references('VehicleID')->on('vehicles')
              ->onUpdate('cascade')->onDelete('set null');

        $table->foreign('ServiceCategoryID')
              ->references('ServiceCategoryID')->on('service_categories')
              ->onUpdate('cascade')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::dropIfExists('service_performed');
}
};
