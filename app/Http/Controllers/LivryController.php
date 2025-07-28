<?php

namespace App\Http\Controllers;

use App\Models\Livry;
use Illuminate\Support\Facades\Gate;


class LivryController extends Controller
{

    public function livrer(Livry $livry)
    {

        $response =  Gate::inspect('livrer', $livry);

        if ($response->denied()) {
            return back()->withErrors($response->message());
        }


        $livry->update(['status' => 'complete']);
        $livry->acceptLivraisons()
        ->update(['status' => 'effectue']);

        return redirect()->back()->with('success', ' livraison livrée');
    }

    public function annuler(Livry $livry)
    {
       
      
        $response =  Gate::inspect('annuler', $livry);

        if ($response->denied()) {
            return back()->withErrors($response->message());
        }
     
        $livry->update(['status' => 'en attente']);
        $livry->acceptLivraisons()->delete();
        return redirect()->back()->with('success', ' livraison annulée');
    }
}
