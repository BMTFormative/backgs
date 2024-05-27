<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('SaleNumber');
            $table->dateTime('DateSale');
            $table->string('OrderType');
            $table->bigInteger('CustomerId')->unsigned(); // Change to bigInteger, unsigned
            $table->bigInteger('ProductId')->unsigned(); // Change to bigInteger, unsigned
            $table->integer('Qty');
            $table->decimal('Prix', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
