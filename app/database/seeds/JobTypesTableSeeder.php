<?php

use HPCFront\Entities\JobType;

class JobTypesTableSeeder extends Seeder {

	public function run()
	{
        $jobs_types = [
            ['name' => 'job_rotator'],

        ];

		foreach($jobs_types as $jobs_type)
		{
			JobType::create([
                'name' => $jobs_type['name']
			]);
		}
	}

}