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
            $table->string('name');
            $table->text('description')->nullable()->default('');
            $table->string('executable')->nullable()->default('');
            $table->enum('type', array('java', 'php', 'python', 'C++', 'C'));
			$table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jobs');
	}

}
