<?php

namespace App\Policies;

use App\Models\Depense;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DepensePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Depense $depense): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Depense $depense): bool
    {
        // Autoriser la mise à jour uniquement si l'utilisateur est l'auteur de la dépense
        return $user->id === $depense->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Depense $depense): bool
    {
        // Autoriser la suppression uniquement si l'utilisateur est l'auteur de la dépense
        return $user->id === $depense->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Depense $depense): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Depense $depense): bool
    {
        return true;
    }
}
