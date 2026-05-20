<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Entretien;
use App\Models\Candidature;

class EntretienPolicy
{
    /**
     * VIEW
     */
    public function view(User $user, Entretien $entretien): bool
    {
        return $user->is($entretien->candidature?->user);
    }

    /**
     * CREATE (important)
     */
    public function create(User $user, Candidature $candidature): bool
    {
        return $user->is($candidature->user);
    }

    /**
     * UPDATE
     */
    public function update(User $user, Entretien $entretien): bool
    {
        return $user->is($entretien->candidature?->user);
    }

    /**
     * DELETE
     */
    public function delete(User $user, Entretien $entretien): bool
    {
        return $user->is($entretien->candidature?->user);
    }

    /**
     * OPTIONAL (future proof)
     */
    public function restore(User $user, Entretien $entretien): bool
    {
        return $user->is($entretien->candidature?->user);
    }

    public function forceDelete(User $user, Entretien $entretien): bool
    {
        return $user->is($entretien->candidature?->user);
    }
}