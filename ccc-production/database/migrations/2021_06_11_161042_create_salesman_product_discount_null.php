<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesmanProductDiscountNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salesman_products', function (Blueprint $table) {
            $table->decimal('salesmanPrice',10,2)->nullable()->change();
            $table->decimal('salesmanDiscount',10,2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salesman_products', function (Blueprint $table) {
            $table->decimal('salesmanPrice',10,2)->nullable(false)->change();
            $table->decimal('salesmanDiscount',10,2)->nullable(false)->change();
        });
    }
}
