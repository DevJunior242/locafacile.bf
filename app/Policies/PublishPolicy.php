<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Publish;
use Illuminate\Auth\Access\Response;

class PublishPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Publish $publish)
    {
        return $user->isAdmin() || $publish->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Publish $publish): bool
    {
        return ($user->isAdmin() || $publish->user_id === $user->id) && $publish->isVerified();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Publish $publish)
    {
        return ($user->isAdmin() || $publish->user_id === $user->id) && $publish->isVerified();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Publish $publish): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Publish $publish): bool
    {
        return false;
    }

    public function replicate(User $user, Publish $publish)
    {

        if (!is_null($publish->replicate_id)) {
            return false;
        }
        $original = $publish->replicate_id ? $publish->original : $publish;
        $allrealyReplicate = $original->replications()
            ->where('user_id', $user->id)

            ->whereIn('status', ['disponible', 'archive', 'in_progress', 'attente_de_verification'])
            ->exists();

        if ($allrealyReplicate) {
            return false;
        }
        return  $publish->status === 'occupee'  &&
            ($user->isAdmin() || $publish->user_id === $user->id);
    }
}
