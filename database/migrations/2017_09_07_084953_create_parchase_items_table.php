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
            $table->integer('purchase_id');
            $table->integer('item_id');
            $table->integer('cost');
            $table->integer('price');
            $table->integer('total_cost');
            $table->integer('total_price');
            $table->integer('qty');
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
        Schema::dropIfExists('parchase_items');
    }
}
