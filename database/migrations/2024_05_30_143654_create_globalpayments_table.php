<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('globalpayments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('DatePayment');
            $table->decimal('Amount', 10, 2);
            $table->bigInteger('CustomerId')->unsigned(); // Change to bigInteger, unsigned
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
        Schema::dropIfExists('globalpayments');
    }
}
