<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_credits', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('supplier_id')->unsigned()->nullable();
            $table->integer('amount');
            $table->boolean('is_payback')->default(0);
            $table->string('remark');
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')
                ->on('suppliers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_credits');
    }
}
