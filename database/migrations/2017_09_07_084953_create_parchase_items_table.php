<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParchaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parchase_items', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('purchase_id')->unsigned()->nullable();
            $table->bigInteger('item_id')->unsigned()->nullable();
            $table->integer('cost');
            $table->integer('price');
            $table->integer('total_cost');
            $table->integer('total_price');
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('purchase_id')->references('id')
                ->on('parchases')->onDelete('set null');

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
        Schema::dropIfExists('parchase_items');
    }
}
