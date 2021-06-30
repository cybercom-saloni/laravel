<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductsFieldNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('sku')->nullable()->change();
            $table->decimal('price',$precision = 10, $scale = 2)->nullable()->change();
            $table->Integer('discount')->nullable()->change();
            $table->Integer('quantity')->nullable()->change();
            $table->String('description')->nullable()->change();
            $table->Integer('status')->nullable()->change();
            $table->unsignedBigInteger('category_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();
            $table->string('sku')->nullable(false)->change();
            $table->decimal('price',$precision = 10, $scale = 2)->nullable(false)->change();
            $table->Integer('discount')->nullable(false)->change();
            $table->Integer('quantity')->nullable(false)->change();
            $table->String('description')->nullable(false)->change();
            $table->Integer('status')->nullable(false)->change();
            $table->unsignedBigInteger('category_id')->nullable(false)->change();
        });
    }
}
