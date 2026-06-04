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
    Schema::create('customers', function (Blueprint $table) {
        $table->string('CustomerID', 20)->primary();
        $table->string('CustomerName', 100);
        $table->binary('ProfilePicture')->nullable();
        $table->string('Email', 100)->unique();
        $table->string('Password', 255);
        $table->string('Number', 20);
        $table->string('Address', 255);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('customers');
}
};
