<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Student;
use App\Major;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $majors = Major::all();
        foreach($majors as $major){
            factory(User::class,50)->create(['major_id'=>$major->id])->each(function($user){
                $user->student()->save(factory(Student::classs)->make());
            });
        }
    }
}
