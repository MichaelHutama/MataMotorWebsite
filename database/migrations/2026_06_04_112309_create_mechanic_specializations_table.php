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
    Schema::create('mechanic_specializations', function (Blueprint $table) {
        $table->string('MechanicID', 20);
        $table->string('ServiceCategoryID', 20);
        $table->primary(['MechanicID', 'ServiceCategoryID']); // composite PK
        $table->timestamps();

        $table->foreign('MechanicID')
              ->references('MechanicID')->on('mechanics')
              ->onUpdate('cascade')->onDelete('cascade');

        $table->foreign('ServiceCategoryID')
              ->references('ServiceCategoryID')->on('service_categories')
              ->onUpdate('cascade')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('mechanic_specializations');
}
};
