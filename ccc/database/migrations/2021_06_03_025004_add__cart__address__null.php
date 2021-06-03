<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCartAddressNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('addressId')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('addressId')->nullable(false)->change();
        });
    }
}
