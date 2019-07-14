<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('supplier_id')->nullable();
            $table->string('payment_type');
            $table->string('cash')->nullable();
            $table->integer('total');
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
        Schema::dropIfExists('parchases');
    }
}
