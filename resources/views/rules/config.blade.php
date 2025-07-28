@extends('layout.app')

@section('content')
<x-nav />
<div class="max-w-4xl mx-auto py-12 px-4 mt-10">
    <h1 class="text-xl font-extrabold text-gray-700 mb-2.5"># Politique de Confidentialité</h1>
    <p class="text-zinc-800 font-black text-xs mt-4">Nous nous engageons à protéger vos données personnelles. Cette
        politique
        explique comment nous collectons, utilisons et stockons vos informations.</p>


    <div class="mt-2">
        <h1 class="text-xl font-semibold mt-8 mb-2">Vous pouvez consulter les maisons disponibles par ville
            ou quartier, avec photos, prix et localisation
            approximative.
        </h1>
    </div>
    <div class="mt-2">
        <h1 class="text-xl font-semibold mt-8 mb-2">1. Données collectées</h1>
        <p>Nous collectons uniquement les données nécessaires à :</p>
        <li> la création de votre compte,</>
        <li>  la mise en relation entre locataire et propriétaire,
        </li>
        
        <li>
             le traitement des paiements.
        </li>


    </div>
    <div class="mt-2">
        <h1 class="text-xl font-semibold mt-8 mb-2">2. Utilisation des données</h1>
        <p>Vos données sont utilisées exclusivement pour le bon fonctionnement du site. Elles ne sont ni revendues ni
            partagées avec des tiers non autorisés.</p>

    </div>
    <div class="mt-2">
        <h1 class="text-xl font-semibold mt-8 mb-2">3. Cookies</h1>
        <p>Nous utilisons des cookies pour améliorer l'expérience utilisateur (ex. : session, préférences)..</p>
    </div>
    <div class="mt-2">
        <h1 class="text-xl font-semibold mt-8 mb-2"> 4. Sécurité</h1>
        <p>Vos données sont stockées de manière sécurisée et ne sont accessibles qu'aux personnes autorisées.
        </p>

    </div>
    <div class="mt-2">
        <h1 class="text-xl font-semibold mt-8 mb-2"> 6. Contact</h1>
        <p>Pour toute question concernant vos données <span><a href="{{ route('contact') }}"
                    class="text-xs text-blue-600 hover:underline">contactez-nous</a></span></p>
    </div>
    
</div>

<div>
    <x-footer />
</div>
@endsection