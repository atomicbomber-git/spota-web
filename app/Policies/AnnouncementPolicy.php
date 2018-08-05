<?php

namespace App\Policies;

use App\User;
use App\Announcement;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
{
    use HandlesAuthorization;

    public function handle(User $user, Announcement $announcement){
        return $user->major_id == $announcement->major_id;
    }

    public function update(User $user, Announcement $announcement){
        return $user->id == $announcement->user_id;
    }

    public function destroy(User $user, Announcement $announcement){
        return $user->id == $announcement->user_id && $user->major_id == $announcement->major_id;
    }
}
