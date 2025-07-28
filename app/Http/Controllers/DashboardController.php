<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Livry;

use App\Models\Payment;
use App\Models\Publish;
use Illuminate\Http\Request;
use App\Models\AceptLivraison;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller
{
    use AuthorizesRequests;

    public function dashboard(Request $request)
    {


        $user = auth()->user();

        if ($user->isAdmin()) {
            $nbBailleurs = User::where('role', 'bailleur')->count();
            $nbLocataires = User::where('role', 'locataire')->count();
            $nbMaisons = Publish::count();
            $nbLocations = Payment::where('payment_status', 'completed')->count();

            $dernièresPublications = Publish::latest()->take(5)->get();

            $dernièresLocations = Payment::where('payment_status', 'completed')
                ->with('publish')
                ->latest()
                ->take(5)
                ->get();

            return view('admin.dashboard', compact(
                'nbBailleurs',
                'nbLocataires',
                'nbMaisons',
                'nbLocations',
                'dernièresPublications',
                'dernièresLocations'
            ));
        } elseif ($user->isBailleur()) {
            $publishs = Publish::where('user_id', $user->id)
                ->orderByRaw("FIELD(status, 'disponible', 'attente_de_verification', 'in_progress','occupee')")
                ->latest()
                ->paginate(30);

            return view('admin.dashboard', compact(
                'publishs',

            ));
        } else {

            $Locations = Payment::where('payment_status', 'completed')
                ->where('user_id', $user->id)
                ->latest()->paginate(4);

            return view('admin.dashboard', compact(
                'Locations',

            ));
        }
    }



    public function livryShow()

    {
        $livrys = Livry::latest()->paginate(6);
        return view('admin.livry', compact('livrys'));
    }


    public function livreurShow()

    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $acceptLivraisons = AceptLivraison::with(
                [
                    'livrie.user',
                    'livreur.user'
                ]
            )->latest()->paginate(10);
        } elseif ($user->livreur) {
            $acceptLivraisons = $user->livreur
                ->acceptLivraisons()
                ->with(
                    [
                        'livrie.user'
                    ]
                )
                ->latest()->paginate(10);
        } else {
            $acceptLivraisons = collect();
        }
        return view('admin.livreur', compact('acceptLivraisons'));
    }

    public function bailleur()

    {
        $this->authorize('isAdmin', User::class);


        $bailleurs = User::where('role', 'bailleur')
            ->withSum('publish', 'prix')
            ->orderBy('publish_sum_prix', 'desc')
            ->latest()
            ->paginate(12);

        return view('admin.bailleur', compact('bailleurs'));
    }

    public function locataire()

    {
        //$this->authorize('isAdmin');
        $this->authorize('isAdmin', User::class);

        $locateurs = User::where('role', 'locataire')
            ->withCount('paiements')
            ->withSum('paiements', 'amount')
            ->orderBy('paiements_sum_amount', 'desc')
            ->latest()
            ->paginate(6);



        return view('admin.locataire', compact('locateurs'));
    }
}
