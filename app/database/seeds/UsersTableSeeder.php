<?php
use HPCFront\Entities\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => \Hash::make('123456'),

			]);
		}
	}

}