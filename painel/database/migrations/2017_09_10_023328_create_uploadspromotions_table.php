<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadspromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploadspromotions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->string('way');
            $table->string('mime');
            $table->string('original_filename');
            $table->integer('promotions_id')->unsigned();
            $table->foreign('promotions_id')->references('id')->on('promotions');
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
        Schema::drop('uploadspromotions');
    }
}
