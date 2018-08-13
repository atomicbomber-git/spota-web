<?php

use Illuminate\Database\Seeder;
use App\Major;
use App\User;
use App\Lecturer;

class LecturerSeeder extends Seeder
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
            factory(User::class,10)->create(['major_id'=>$major->id])->each(function($user){
                $user->lecturer()->save(factory(Lecturer::class));
            });
        }
    }
}
