<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaledetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saledetails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('SaleId')->unsigned();  // bigint without foreign key constraint
            $table->bigInteger('ProductId')->unsigned();  // bigint without foreign key constraint
            $table->bigInteger('TaxId')->unsigned();  // bigint without foreign key constraint
            $table->integer('Qty');
            $table->decimal('UnitPrice', 10, 2);
            $table->decimal('PrixVente', 10, 2); // Before tax
            $table->decimal('Discount', 10, 2); //  Calculated from Discount 
            $table->decimal('TaxAmount', 10, 2); //  Calculated from TaxRate in the Tax Table
            $table->decimal('Montant', 10, 2); // Sum of TotalPrice and (TaxAmount Or Discount )          
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
        Schema::dropIfExists('saledetails');
    }
}
