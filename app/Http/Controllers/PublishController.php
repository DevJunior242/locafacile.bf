<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Publish;
use App\Jobs\MediaUpload;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePublishRequest;

use App\Http\Requests\UpdatePublishRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PublishController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {


        $request->validate([
            'query' => ['bail', 'nullable', 'regex:/^[\pL\s\d\-]+$/u', 'max:50'],
        ]);

        if ($request->has("query")) {
            $query = $request->query("query");
            $publishs = Publish::selectRaw("*, MATCH(titre, quartier) AGAINST (? IN BOOLEAN MODE) as relevance", [$query])
                ->whereIn('status', ['attente_de_verification', 'disponible'])

                ->orderByRaw("FIELD(status, 'disponible', 'attente_de_verification')")
                ->whereFullText(['titre', 'quartier'], $query, ['mode' => 'boolean'])
                ->orderByDesc('relevance')
                ->latest()
                ->paginate(8);
        } else {
            $publishs = Publish::whereIn('status', ['attente_de_verification', 'disponible'])
                ->orderByRaw("FIELD(status, 'disponible', 'attente_de_verification')")
                ->latest()->paginate(8);
        }



        return view('publish.index', compact('publishs'));
    }





    public function publish()
    {
        return view('publish.publish');
    }

    public function publishStore(StorePublishRequest $request)
    {

        $user = Auth::user();

        if ($user->isAdmin() || $user->isBailleur()) {

             

            $file = $request->file('file');
            $extension = null;

            if ($file) {


                $extension = $file->getClientOriginalExtension();
                $filename = uniqid() . '.' . $extension;
                $relativepath = 'uploads/' . $filename;
                $path = $file->storeAs('uploads', $filename, 'public');

                MediaUpload::dispatch(
                    $extension,
                    $filename,
                    $relativepath

                );
            }
            $save =  Publish::create([
                'user_id' => Auth::id(),
                'titre' => $request->titre,
                'type_cour' => $request->type_cour,
                'type_sol' => $request->type_sol,
                'form_logement' => $request->form_logement,
                'description' => $request->description,
                'ville' => $request->ville,
                'localisation' => $request->localisation,
                'quartier' => $request->quartier,
                'prix' => $request->prix,
                'caution' => $request->caution,
                'avance' => $request->avance,
                'nombre_chambres' => $request->nombre_chambres,
                'nombre_salons' => $request->nombre_salons,
                'eau' => $request->eau,
                'plafonnée' => $request->plafonnée,
                'courant' => $request->courant,
                'cuisine' => $request->cuisine,
                'climatisation' => $request->climatisation,
                'ventilateur' => $request->ventilateur,
                'garage_parking' => $request->garage_parking,
                'balcon' => $request->balcon,
                'terrasse' => $request->terrasse,
                'jardin' => $request->jardin,
                'internet' => $request->internet,
                'chateau_eau' => $request->chateau_eau,
                'meublée' => $request->meublée,
                'douche' => $request->douche,
                'securite' => $request->securite,
                'file' => $extension,
                'path' =>  $path,
                'status' => 'attente_de_verification',

            ]);

            //dd($save);
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors([
                'error' => 'vous n\'etes pas autorisé à publier une annonce. etes vous bailleur ?',
            ]);
        }
    }

    public function show(Publish $publish)
    {
        $user = auth()->user();
        return view('publish.show', compact('publish', 'user'));
    }

    public function publishEdit(Publish $publish)
    {
        $this->authorize('view', $publish);

        return view('publish.edit', compact('publish'));
    }

    //******************************************************// 

    public function UpdatedPublish(UpdatePublishRequest $request, Publish $publish)
    {

        $this->authorize('update', $publish);


        if ($request->hasFile('file')) {
            if ($publish->path) {
                Storage::disk('public')->delete($publish->path);
            }
            $file = $request->file('file');

            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $relativepath = 'uploads/' . $filename;
            $path = $file->storeAs('uploads', $filename, 'public');

            MediaUpload::dispatch(
                $extension,
                $filename,
                $relativepath

            );
            //$path = $file->store('Upload', 'public');
            $publish->file = $request->file->getClientOriginalExtension();
            $publish->path = $path;
        }



        $publish->titre = $request->titre;
        $publish->type_cour = $request->type_cour;
        $publish->type_sol = $request->type_sol;
        $publish->form_logement = $request->form_logement;
        $publish->description = $request->description;
        $publish->user_id = Auth::id();
        $publish->ville = $request->ville;
        $publish->quartier = $request->quartier;
        $publish->localisation = $request->localisation;
        $publish->prix = $request->prix;
        $publish->etage = $request->etage;

        $publish->caution = $request->caution;
        $publish->avance = $request->avance;
        $publish->nombre_chambres = $request->nombre_chambres;
        $publish->nombre_salons = $request->nombre_salons;
        $publish->eau = $request->eau;
        $publish->plafonnée = $request->plafonnée;

        $publish->courant = $request->courant;
        $publish->cuisine = $request->cuisine;
        $publish->climatisation = $request->climatisation;
        $publish->ventilateur = $request->ventilateur;
        $publish->garage_parking = $request->garage_parking;
        $publish->balcon = $request->balcon;
        $publish->terrasse = $request->terrasse;
        $publish->jardin = $request->jardin;
        $publish->internet = $request->internet;
        $publish->chateau_eau = $request->chateau_eau;
        $publish->meublée = $request->meublée;
        $publish->douche = $request->douche;
        $publish->securite = $request->securite;
        $publish->status = 'attente_de_verification';

        $publish->save();


        return redirect()->route('dashboard');
    }

    /////////////////////////////////////////////////////////


    public function deletePublish(Publish $publish)
    {

        $this->authorize('delete', $publish);

        $publish->delete();
        if ($publish->path) {
            Storage::disk('public')->delete($publish->path);
        }
        return to_route('home')->with('success', 'votre publication a été supprimée avec succés');
    }


    public function replicate(Publish $publish)
    {
        $this->authorize('replicate', $publish);
        $repli = $publish->replicate();
        $repli->replicate_id = $publish->id;
        $repli->status = 'attente_de_verification';
        $repli->save();
        return redirect()->back();
    }
}
