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
            $table->bigInteger('TaxId')->nullable()->unsigned();  // bigint without foreign key constraint
            $table->decimal('TotalAmount', 10, 2);
            $table->decimal('TotalTax', 10, 2)->nullable();
            $table->decimal('TotalDiscount', 10, 2)->nullable();
            $table->decimal('TotalAmountWith', 10, 2);
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
