<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Admin;
use App\Major;

class AdminSeeder extends Seeder
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
                    'major_id' => $major_id
                ]);

                $users->each(function($user) {
                    factory(Admin::class)->create([
                        'user_id' => $user->id
                    ]);
                });
            });
        }
    }
}
