<?php

namespace App\Policies;

use App\User;
use App\Lecturer;
use Illuminate\Auth\Access\HandlesAuthorization;

class LecturerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function handle(User $user, Lecturer $lecturer){
        return $user->major_id == $lecturer->user->major_id;
    }
}
