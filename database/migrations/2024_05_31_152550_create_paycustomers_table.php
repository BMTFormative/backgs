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
        Schema::create('payheaders', function (Blueprint $table) {
            $table->id();
            $table->string('SaleNumber');  
            $table->dateTime('DatePayment');  
            $table->bigInteger('GlobalepaymentId')->unsigned();  
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
