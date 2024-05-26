<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('ArrivalNumber');
            $table->dateTime('DateArrival');
            $table->bigInteger('SupplierId')->unsigned();  // bigint without foreign key constraint
            $table->bigInteger('ProductId')->unsigned();  // bigint without foreign key constraint
            $table->integer('Qty');
            $table->decimal('PrixAchat', 10, 2);
            $table->decimal('PrixGros', 10, 2);
            $table->decimal('PrixDetail', 10, 2);
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
        Schema::dropIfExists('stocks');
    }
}
