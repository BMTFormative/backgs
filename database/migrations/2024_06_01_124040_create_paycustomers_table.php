<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaycustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paycustomers', function (Blueprint $table) {
            $table->id();  
            $table->string('SaleNumber');  
            $table->bigInteger('CustomerId')->unsigned();  // bigint without foreign key constraint
            $table->dateTime('DatePayment');  
            $table->bigInteger('GlobalepaymentId')->nullable()->unsigned();  
            $table->decimal('Amount', 10, 2);  
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
        Schema::dropIfExists('paycustomers');
    }
}
