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
                $user = factory(User::class)->create([
                    'type' => 'A', // Admin type
                    'major_id' => $major_id
                ]);

                $admin = factory(Admin::class)->create([
                    'user_id' => $user->id,
                ]);
            });
        }
    }
}
