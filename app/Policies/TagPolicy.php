<?php

namespace App\Policies;

use App\Models\User;

class TagPolicy
{
    /**
     * Determine if the given user can create a tag.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine if the given user can update the tag.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine if the given user can delete the tag.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->is_admin;
    }
}
