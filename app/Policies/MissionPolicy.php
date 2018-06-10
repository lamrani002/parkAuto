<?php

namespace App\Policies;

use App\User;
use App\Mission;
use Illuminate\Auth\Access\HandlesAuthorization;

class MissionPolicy
{
  public function before($user,$ability){
      if($user->is_admin){
        return true;
      }
  }
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the mission.
     *
     * @param  \App\User  $user
     * @param  \App\Mission  $mission
     * @return mixed
     */
    public function view(User $user, Mission $mission)
    {
        return true;
    }

    /**
     * Determine whether the user can create missions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;

    }

    /**
     * Determine whether the user can update the mission.
     *
     * @param  \App\User  $user
     * @param  \App\Mission  $mission
     * @return mixed
     */
    public function update(User $user, Mission $mission)
    {
        if ($user->is_admin) {
            return $user->id === $mission->user_id;
        }
      else {
        return false;
      }

    }

    /**
     * Determine whether the user can delete the mission.
     *
     * @param  \App\User  $user
     * @param  \App\Mission  $mission
     * @return mixed
     */
    public function delete(User $user, Mission $mission)
    {
      if ($user->is_admin) {
          return $user->id === $mission->user_id;
      }
    else {
      return false;
    }
    }
}
