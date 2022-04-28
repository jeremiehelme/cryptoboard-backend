<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_currency', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('portfolio_id');
            $table->float('quantity')->default(0);
            $table->float('invested')->default(0);
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
        Schema::dropIfExists('portfolio_currency');
    }
}
