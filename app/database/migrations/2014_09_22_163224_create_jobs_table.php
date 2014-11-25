<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('project_id')->unsigned()->index();
            $table->integer('executable_id')->unsigned()->index();
            $table->string('name');
            $table->text('description')->nullable()->default('');
			$table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('executable_id')->references('id')->on('executables')->onDelete('cascade');

		});

		$path = storage_path()."/jobs";
		SSH::run(
			array(
				"mkdir $path",
				"chown -R hpcfront:apache $path",
				"chmod -R u+rwx $path",
				"chmod -R g+rw $path",
				"chmod -R o-rwx $path"
			)
		);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jobs');
		$path = storage_path()."/jobs";
		SSH::run(array("rm -Rf $path"));

	}

}
