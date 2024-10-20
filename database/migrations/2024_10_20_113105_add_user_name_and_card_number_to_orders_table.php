<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserNameAndCardNumberToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Adding the 'user_name' and 'card_number' columns to the 'orders' table
            $table->string('user_name')->nullable()->after('user_id');
            $table->string('card_number')->nullable()->after('user_name');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Dropping the 'user_name' and 'card_number' columns
            $table->dropColumn(['user_name', 'card_number']);
        });
    }
}
