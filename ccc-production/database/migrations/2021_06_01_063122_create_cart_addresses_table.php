<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cartId');
            $table->unsignedBigInteger('addressId');
            $table->string('address')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('country')->nullable();
            $table->enum('addressType',['shipping','billing'])->default('billing');
            $table->enum('sameAsBilling',[0,1])->default(0);
            $table->timestamps();
            $table->foreign('cartId')->references('id')->on('carts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('addressId')->references('id')->on('addresses')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_addresses');
    }
}
