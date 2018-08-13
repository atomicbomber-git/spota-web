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
        $majors = Major::all();
        foreach($majors as $major){
            factory(User::class,10)->create(['major_id' => $major->id])->each(function($user){
                $user->admin()->save(factory(Admin::class)->make());
            });
        }
    }
}
