<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExecutablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('executables', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('path');
            $table->string('type');
            $table->timestamps();
		});

		$path = storage_path()."/executables";
		SSH::run(array("mkdir $path"));


    }


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('executables');

		$path = storage_path().'/executables';
		SSH::run(array("rm -Rf $path"));

    }

}
