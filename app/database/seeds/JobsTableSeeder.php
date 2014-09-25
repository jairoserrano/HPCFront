<?php
use HPCFront\Entities\Job;
use Faker\Factory as Faker;

class JobsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
        $types = array('java', 'php', 'python', 'cpp', 'c');

		foreach(range(1, 7) as $index)
		{
			Job::create([
                'name' => $faker->name,
                'description' => $faker->text,
                'excutable' => '',
                'project_id' => rand(1, 3),
                'type' => $types[rand(1, 5)],
			]);
		}
	}

}