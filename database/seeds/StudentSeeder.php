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
        $major_ids = Major::select('id')->get();

        foreach($major_ids as $major_id){

            // Generate users
            DB::transaction(function() use($major_id) {
                $users = factory(User::class, 5)->create([
                    'type' => 'M', // Student type
                    'major_id' => $major_id
                ]);

                $users->each(function($user) {
                    factory(Student::class)->create([
                        'user_id' => $user->id
                    ]);
                });
            });
        }
    }
}
