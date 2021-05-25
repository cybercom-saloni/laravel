<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerId')->default(null);
            $table->decimal('total',10,2)->default(0);
            $table->unsignedBigInteger('shippingId')->default(null);
            $table->decimal('shippingAmount',10,2)->default(0);
            $table->unsignedBigInteger('paymentId')->default(null);
            $table->decimal('discount',10,2)->default(0);
            $table->enum('status',['Confirm','Pending','InProcess','Shipped','Cancelled'])->default('Pending');
            $table->timestamps();
            $table->foreign('shippingId')->references('id')->on('shippings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('customerId')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('paymentId')->references('id')->on('payments')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
