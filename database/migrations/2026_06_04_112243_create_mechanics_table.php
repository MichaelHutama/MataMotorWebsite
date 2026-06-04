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
    Schema::create('mechanics', function (Blueprint $table) {
        $table->string('MechanicID', 20)->primary();
        $table->string('MechanicName', 100);
        $table->string('Number', 20);
        $table->boolean('IsActive');
        $table->string('Password', 255);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('mechanics');
}
};
