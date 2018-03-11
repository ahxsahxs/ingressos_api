<?php

use Illuminate\Database\Seeder;

class JobsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Job::create([
            'title' => str_random(10),
            'description' => str_random(1000),
            'local' => bcrypt('Goiânia - GO'),
            'remote' => 'no',
            'type' => 3,
            'company_id' => 1
        ]);
    }
}
