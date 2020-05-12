<?php


namespace App\Policies;

use App\Models\Diligencia;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class DiligenciaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param User|null $user
     * @param Diligencia $diligencia
     * @return mixed
     */
    public function view(?User $user, Diligencia $diligencia)
    {
        if ($diligencia->published) {
            return true;
        }

        // visitors cannot view unpublished items
        if ($user === null) {
            return false;
        }

        // admin overrides published status
        if ($user->can('view unpublished posts')) {
            return true;
        }

        // authors can view their own unpublished posts
        return $user->id == $diligencia->user_id;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('create posts')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param User $user
     * @param Diligencia $diligencia
     * @return mixed
     */
    public function update(User $user, Diligencia $diligencia)
    {
        if ($user->can('edit own posts')) {
            return $user->id == $diligencia->user_id;
        }

        if ($user->can('edit all posts')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param User $user
     * @param Diligencia $diligencia
     * @return mixed
     */
    public function delete(User $user, Diligencia $diligencia)
    {
        if ($user->can('delete own posts')) {
            return $user->id == $diligencia->user_id;
        }

        if ($user->can('delete any post')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param User $user
     * @param Diligencia $diligencia
     * @return mixed
     */
    public function restore(User $user, Diligencia $diligencia)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param User $user
     * @param Diligencia $diligencia
     * @return mixed
     */
    public function forceDelete(User $user, Diligencia $diligencia)
    {
        //
    }
}
