<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sale_id')->unsigned()->nullable();
            $table->bigInteger('item_id')->unsigned()->nullable();
            $table->integer('cost');
            $table->integer('price');
            $table->integer('total_cost');
            $table->integer('total_price');
            $table->integer('total_profix');
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('sale_id')->references('id')
                ->on('sales')->onDelete('set null');

            $table->foreign('item_id')->references('id')
                ->on('items')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_items');
    }
}
