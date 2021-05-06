<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('media');
            $table->string('label')->default('label');
            $table->tinyInteger('small')->default(0);
            $table->tinyInteger('thumb')->default(0);
            $table->tinyInteger('base')->default(0);
            $table->tinyInteger('gallery')->default(0);
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
