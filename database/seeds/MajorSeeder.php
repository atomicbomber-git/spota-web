<?php

use Illuminate\Database\Seeder;
use App\Major;
use App\Faculty;
use App\Configuration;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculties = Faculty::all();

        foreach($faculties as $faculty){
            factory(Major::class,3)->create()->each(function($major){
                $major->configuration()->save(factory(Configuration::class)->make());
            });
        }
    }
}
