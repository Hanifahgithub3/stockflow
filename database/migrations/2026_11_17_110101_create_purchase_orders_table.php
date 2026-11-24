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
       Schema::create('purchase_orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('supplier_id')->constrained()->restrictOnDelete();
    $table->string('po_number')->unique();
    $table->date('order_date');
    $table->string('status', 30)->default('draft'); // draft | submitted | partially_received | completed | cancelled
    $table->decimal('total_amount', 14, 2)->default(0);
    $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
