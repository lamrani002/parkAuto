<?php

namespace App\Policies;

use App\User;
use App\Vehicule;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiculePolicy
{
    use HandlesAuthorization;

    public function before($user,$ability){
        if($user->is_admin){
          return true;
        }
    }

    /**
     * Determine whether the user can view the vehicule.
     *
     * @param  \App\User  $user
     * @param  \App\Vehicule  $vehicule
     * @return mixed
     */
    public function view(User $user, Vehicule $vehicule)
    {
        return true;
    }

    /**
     * Determine whether the user can create vehicules.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the vehicule.
     *
     * @param  \App\User  $user
     * @param  \App\Vehicule  $vehicule
     * @return mixed
     */
    public function update(User $user, Vehicule $vehicule)
    {
        if ($user->is_admin) {
            return $user->id === $mission->user_id;
        }
      else {
        return false;
      }
    }

    /**
     * Determine whether the user can delete the vehicule.
     *
     * @param  \App\User  $user
     * @param  \App\Vehicule  $vehicule
     * @return mixed
     */
    public function delete(User $user, Vehicule $vehicule)
    {
      if ($user->is_admin) {
          return $user->id === $mission->user_id;
      }
    else {
      return false;
    }
    }
}
