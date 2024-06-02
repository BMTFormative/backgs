<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();  // Primary key for the taxes table
            $table->string('TaxName');  // Name of the tax (e.g., VAT, GST)
            $table->decimal('TaxRate', 5, 2);  // Tax rate as a percentage
            $table->date('EffectiveDate');  // Start date from which the tax rate is applicable
            $table->date('EndDate')->nullable();  // End date until which the tax rate is applicable
            $table->text('Description')->nullable();  // Additional information about the tax
            $table->timestamps();  // Timestamps for record creation and last update
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxes');
    }
}
