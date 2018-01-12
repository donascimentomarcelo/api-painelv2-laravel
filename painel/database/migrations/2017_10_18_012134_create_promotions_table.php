<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name');
           $table->string('title');
           $table->string('description');
           $table->timestamp('dt_start');
           $table->timestamp('dt_end');
           $table->string('status');
           $table->string('responsable');
           $table->string('email');
           $table->double('price', 15, 8);
           $table->integer('percent');
           $table->double('result', 15, 8);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('promotions');
    }
}
