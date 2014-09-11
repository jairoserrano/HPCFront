<?php

use HPCFront\Entities\Role;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        $roles = [
            ['name' => 'administrador'],
            ['name' => 'job_sumitter'],

        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role['name'],
            ]);
        }
    }

}