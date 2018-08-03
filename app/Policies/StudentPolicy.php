<?php

namespace App\Policies;

use App\User;
use App\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    public function handle(User $user, Student $student){
        return $user->major_id == $student->user->major_id;
    }
}
