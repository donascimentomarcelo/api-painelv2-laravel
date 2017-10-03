<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('uploads', function(Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->string('way');
            $table->string('mime');
            $table->string('original_filename');
            // $table->bigInteger('order');
            $table->integer('projects_id')->unsigned();
            $table->foreign('projects_id')->references('id')->on('projects');
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
		Schema::drop('uploads');
	}

}
