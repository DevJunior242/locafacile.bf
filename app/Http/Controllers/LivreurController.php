<?php

namespace App\Http\Controllers;

use App\Models\Livreur;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
  
class LivreurController extends Controller
{

    public function livreurView()
    {
        return view('livreur.create');
    }


    public function AddLivreur(Request $request)
    {

        $user = auth()->user();


        if ($user->livreur) {
            return redirect()->back()->withErrors('vous avez deja un compte actif',);
        }

        // Validation du formulaire+
        $validated = $request->validate([

            'prenom' =>  ['required', 'regex:/^[\pL\s\-]+$/u', 'min:4', 'max:255',],

            'ville' => ['required', Rule::in(['Ouagadougou', 'Bobo-Dioulasso', 'Koudougou', 'Fada N’Gourma', 'Banfora'])],
            'phone' => ['required', 'regex:/^(\+226|00226)?[0567]\d{7}$/', 'unique:livreurs,phone'],
        ], [
            'phone.regex' => 'Le numéro de téléphone doit être un numéro valide du Burkina Faso (+226).',
            'phone.required' => 'Le numéro de télephone est obligatoire.',
        ]);

        // Créer un livreur

        $livreur = new Livreur();
        $livreur->user_id = $user->id;
        $livreur->name =  $user->firstname;
        $livreur->prenom =  $validated['prenom'];
        $livreur->ville = $validated['ville'];
        $livreur->phone = $validated['phone'];
        $livreur->status = 'active';
        $livreur->save();

        return redirect()->route('livreurShow')->with('success', 'livreur mis à jour');
    }


    public function UpdateLivreurStatus(Livreur $livreur)
    {
        $user = auth()->user();
        if (!$livreur || !$user->isAdmin() &&  $livreur->user_id !== $user->id) {
            abort(404);
        }

        $livreur->status = ($livreur->status == 'active') ? 'inactive' : 'active';
        $livreur->save();

        return redirect()->back()->with('success', 'livreur mis à jour');
    }
}
