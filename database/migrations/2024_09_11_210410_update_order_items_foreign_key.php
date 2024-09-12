<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrderItemsForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // First, drop the existing foreign key constraint
            $table->dropForeign(['medicine_id']);

            // Now, recreate the foreign key with ON DELETE CASCADE
            $table->foreign('medicine_id')
                  ->references('id')->on('medicines')
                  ->onDelete('cascade');  // Add ON DELETE CASCADE
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Revert the foreign key back to its original form
            $table->dropForeign(['medicine_id']);

            $table->foreign('medicine_id')
                  ->references('id')->on('medicines')
                  ->onDelete('restrict');  // or whatever it was before
        });
    }
}
