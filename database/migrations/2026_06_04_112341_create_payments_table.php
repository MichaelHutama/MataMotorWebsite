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
    Schema::create('payments', function (Blueprint $table) {
        $table->string('PaymentID', 50)->primary(); // T-20250604-1-PAY-1
        $table->string('TransactionID', 30)->nullable();
        $table->string('PaymentDocument')->nullable(); // path file
        $table->dateTime('PaymentTime')->nullable();
        $table->string('PaymentStatus', 50)->nullable();
        $table->integer('PaymentAmount')->nullable();
        $table->string('PaymentMethod', 50)->nullable();
        $table->timestamps();

        $table->foreign('TransactionID')
              ->references('TransactionID')->on('transactions')
              ->onUpdate('cascade')->onDelete('restrict');
    });
}

public function down(): void
{
    Schema::dropIfExists('payments');
}
};
