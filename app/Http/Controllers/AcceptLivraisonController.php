<?php

namespace App\Http\Controllers;

use App\Models\Livry;
 
use App\Models\AceptLivraison;
use Illuminate\Support\Facades\Gate;



class  AcceptLivraisonController extends Controller
{
    public function Accepter($livrie_id)
    {

        $user = auth()->user();
        $livrie = Livry::find($livrie_id);

        $response = Gate::inspect('accepter', $livrie);
        if ($response->denied()) {
            return back()->withErrors($response->message());
        }

        $dejaAccepter = AceptLivraison::where('livrie_id', $livrie_id)

            ->first();

        if (!$dejaAccepter) {
            AceptLivraison::create([
                
                'livrie_id' => $livrie_id,
                'livreur_id' => $user->livreur->id,

            ]);

            $livrie->update([
                'status' => 'en cours',
            ]);

            return back()->with('success', 'livraison accepter');
           
        } else {
           
           return redirect()->back()->withErrors('livraison deja acceptée ',);
        }
    }



    public function destroy($livrie_id)
    {
        $user = auth()->user();
        $livreur = $user->livreur;
        $accept = AceptLivraison::where([
            'livrie_id' => $livrie_id,
            'status' => 'accept'
        ])->first();

        if (!$accept || $accept->livreur_id !== ($livreur->id ?? null) && !$user->isAdmin()) {
            abort(403);
        }
 
        $accept->delete();
        $accept->livrie->update([
            'status' => 'en attente',
        ]);
        return back()->with('success', 'commande  annuler avec succés');
    }
}
