<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeysToCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Modify the foreign key on the 'invoices' table
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['sale_id']); // Drop the existing foreign key

            $table->foreign('sale_id')
                  ->references('id')->on('sales')
                  ->onDelete('cascade'); // Add the 'ON DELETE CASCADE' option
        });

        // Repeat for other related tables like 'order_items', 'sales' if needed
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['medicine_id']); // Drop the existing foreign key

            $table->foreign('medicine_id')
                  ->references('id')->on('medicines')
                  ->onDelete('cascade'); // Add 'ON DELETE CASCADE'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['sale_id']);

            $table->foreign('sale_id')
                  ->references('id')->on('sales');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['medicine_id']);

            $table->foreign('medicine_id')
                  ->references('id')->on('medicines');
        });
    }
}
