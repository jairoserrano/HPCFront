<?php

use Faker\Factory as Faker;

class ProjectsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Project::create([
                'name' => $faker->name,
                'description' => $faker->text,
			]);
		}
	}

}