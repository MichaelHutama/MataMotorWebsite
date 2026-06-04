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
    Schema::create('mechanic_assignments', function (Blueprint $table) {
        $table->string('MechanicID', 20);
        $table->string('ServiceID', 60);
        $table->primary(['MechanicID', 'ServiceID']); // composite PK
        $table->timestamps();

        $table->foreign('MechanicID')
              ->references('MechanicID')->on('mechanics')
              ->onUpdate('cascade')->onDelete('cascade');

        $table->foreign('ServiceID')
              ->references('ServiceID')->on('service_performed')
              ->onUpdate('cascade')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('mechanic_assignments');
}
};
