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
    Schema::create('transactions', function (Blueprint $table) {
        $table->string('TransactionID', 30)->primary(); // T-20250604-1
        $table->string('CustomerID', 20)->nullable();
        $table->dateTime('TransactionTime')->useCurrent();
        $table->timestamps();

        $table->foreign('CustomerID')
              ->references('CustomerID')->on('customers')
              ->onUpdate('cascade')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::dropIfExists('transactions');
}
};
