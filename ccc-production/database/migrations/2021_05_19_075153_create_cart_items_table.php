<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cartId');
            $table->unsignedBigInteger('productId');
            $table->integer('quantity');
            $table->decimal('basePrice',10,2);
            $table->decimal('price',10,2);
            $table->decimal('discount');
            $table->timestamps();
            $table->foreign('cartId')->references('id')->on('carts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('productId')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
