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
       Schema::create('stock_movements', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')->constrained()->restrictOnDelete();
    $table->string('transaction_type', 20); // stock_in | stock_out | adjustment
    $table->decimal('quantity', 12, 2);
    $table->string('reference_number')->nullable()->index();
    $table->text('notes')->nullable();
    $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
