<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->integer('cost');
            $table->integer('price');
            $table->integer('qty');
            $table->bigInteger('unit_id')->unsigned()->nullable();
            $table->bigInteger('product_type_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('unit_id')->references('id')
                ->on('units')->onDelete('set null');

            $table->foreign('product_type_id')->references('id')
                ->on('product_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
