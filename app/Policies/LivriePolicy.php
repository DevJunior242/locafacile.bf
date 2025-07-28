<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Livry;

use App\Models\AceptLivraison;
use App\Models\AcceptLivraison;
use Illuminate\Auth\Access\Response;



class LivriePolicy
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
    public function view(User $user, Livry $livry): bool
    {
        return false;
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
    public function update(User $user, Livry $livry): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Livry $livry, AceptLivraison $AcceptLivraison): Response
    { 
        if ($AcceptLivraison->livreur_id !== $user->livreur->id) {
            return Response::deny('non autorisé');
        }
        if (!$user->isAdmin()) {
           
            return Response::deny('non autorisé');
        }
        return Response::allow();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Livry $livry): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Livry $livry): bool
    {
        return false;
    }

    public function livrer(User $user, Livry $livry): Response
    {
         
        if ($livry->status !== 'en cours') {
            return Response::deny('hum ...');
        }

        if (!$user->isAdmin() && !$livry->isauthorized()) {
            //$user->isOwner()
            return Response::deny('non autorisé');
        }

        return Response::allow();
    }

    public function annuler(User $user, Livry $livry): Response
    {
        
        if ($livry->status !== 'en cours') {
            return Response::deny('hum ...');
        }

        if (!$user->isAdmin() && !$livry->isauthorized()) {
           
            return Response::deny('non autorisé');
        }

        return Response::allow();
    }

    public function accepter(User $user, Livry $livry): Response
    {
        $livreur = $user->livreur;


        //livreur
        if (!$livreur) {
            return Response::deny('vous n\'etes pas un livreur. creez un compte livreur');
        }
        if ($livreur->ville !== $livry->ville) {
            return Response::deny('vous ne pouvez pas accepter cette livraison car elle n\'est pas dans votre ville');
        }
        if ($livreur->status !== 'active') {
            return Response::deny('votre compte n\'est pas actif');
        }

        $livryInPro = Livry::whereHas('acceptLivraisons', function ($query) use ($livreur) {
            $query->where('livreur_id', $livreur->id);
        })->where('status', 'en cours')->exists();
        if ($livryInPro) {

            return Response::deny('vous avez deja une livraison en cours');
        }

        if ($livry->status === 'en cours') {
            return Response::deny('vous ne pouvez pas acepter une livraison en cours');
        }

        return Response::allow();
    }
    public function destroy(User $user, Livry $livry): Response
    {

        return  $user->isAdmin() || $livry->livreur_id === ($livreur->id ?? null)

            ? Response::allow()

            : Response::denyAsNotFound();
    }

    public function markAsDelivered(User $user, Livry $livry): Response
    {
        return  $user->isAdmin() || $livry->isauthorized()

            ? Response::allow()

            : Response::denyAsNotFound();
    }
}
