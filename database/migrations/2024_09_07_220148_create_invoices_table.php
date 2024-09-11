<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->decimal('total_amount', 10, 2);
            $table->date('invoice_date');
            $table->timestamps();
            
            $table->foreign('sale_id')->references('id')->on('sales');
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}