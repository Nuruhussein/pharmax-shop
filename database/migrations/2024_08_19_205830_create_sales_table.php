<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    public function up()
    {
        // Creating the 'sales' table
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('set null'); // Nullable order ID
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');  // Nullable user ID (optional user)
            $table->decimal('total_amount', 10, 2);
            $table->date('sale_date');
            $table->enum('status', ['pending', 'approved'])->default('pending'); // Default status to pending
            $table->timestamps();
        });

        // Creating the 'sale_items' table
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->onDelete('cascade'); // Sale ID for items
            $table->foreignId('medicine_id')->constrained()->onDelete('cascade'); // Medicine ID for each item
            $table->integer('quantity');
            $table->decimal('sale_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sale_items');
        Schema::dropIfExists('sales');
    }
}
