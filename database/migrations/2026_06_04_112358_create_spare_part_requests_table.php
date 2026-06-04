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
    Schema::create('spare_part_requests', function (Blueprint $table) {
        $table->string('SparePartRequestID', 80)->primary(); // SPR-SVP-T-20250604-1-1-1
        $table->string('ServiceID', 60);
        $table->string('MechanicID', 20)->nullable();
        $table->string('Notes', 255)->nullable();
        $table->string('Status', 50);
        $table->timestamps();

        $table->foreign('ServiceID')
              ->references('ServiceID')->on('service_performed')
              ->onUpdate('cascade')->onDelete('cascade');

        $table->foreign('MechanicID')
              ->references('MechanicID')->on('mechanics')
              ->onUpdate('cascade')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::dropIfExists('spare_part_requests');
}
};
