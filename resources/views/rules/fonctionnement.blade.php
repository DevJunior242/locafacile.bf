@extends('layout.app')

@section('content')
<x-nav />

<div class="max-w-4xl mx-auto py-12 px-4 mt-10">
    <h1 class="text-xl font-extrabold text-gray-700 mb-2.5">Comment fonctionne notre site</h1>
    <h2 class="text-zinc-800 font-black text-sm">Notre site facilite la location de maisons en mettant en relation
        propriétaires et locataires, tout en assurant une certaine sécurité dans les échanges.</h2>


    
    <div>

    <h2 class="text-xl font-semibold mt-8 mb-2">1. Recherchez une maison</h2>
    <p class="mb-4">Naviguez librement parmi les maisons disponibles, classées par ville et quartier.</p>

    <h2 class="text-xl font-semibold mt-8 mb-2">2. Payez un montant réduit</h2>
    <p class="mb-4">
        Une fois votre choix fait, vous payez un montant unique et réduit via Paydunya(orange, moov et wave), ce qui déclenche toute la procédure :
    </p>
    <ul class="list-disc list-inside space-y-2 mb-4">
        <li>Un livreur dans la même ville est automatiquement notifié</li>
        <li>Il vérifie la maison sur le terrain</li>
        <li>Nous vous transmettons les coordonnées du propriétaire une fois validé</li>
        <li>Zéro frais caché, zéro commission au bailleur</li>
    </ul>

    <div class="bg-gray-100 p-4 rounded-lg mb-6">
        <h3 class="font-semibold mb-2">Exemple local concret :</h3>
        <p class="mb-2 font-semibold">Avec un démarcheur traditionnel :</p>
        <ul class="list-disc list-inside ml-4 text-sm text-gray-700 mb-4">
            <li>Maison à 20 000 F CFA/mois</li>
            <li>1 mois offert au démarcheur (20 000 F)</li>
            <li>Essence ou transport : 2 000 à 5 000 F</li>
            <li>+ 4 mois de caution au bailleur</li>
            <li><strong>Total : +20 000 F perdus</strong> sans garantie ni contrat écrit</li>
        </ul>

        <p class="mb-2 font-semibold">Avec notre plateforme :</p>
        <ul class="list-disc list-inside ml-4 text-sm text-gray-700">
            <li>Maison à 20 000 F CFA/mois</li>
            <li>Vous payez <strong>50% seulement</strong> du loyer = <strong>10 000 F CFA</strong></li>
            <li>Pas d'essence, pas de commission, pas de frais supplémentaires</li>
            <li>Nous gérons tout avec nos livreurs</li>
            <li><strong>Gain : vous économisez au moins 10 000 F</strong> et vous êtes sécurisé</li>
        </ul>
    </div>

    </div>
    
    <div>
        <h1 class="text-xl font-semibold mt-8 mb-2">3. Mise à jour automatique</h1>
        <p>Dès qu’un paiement est validé pour une maison, celle-ci passe automatiquement en statut "occupée" afin
            d’éviter les doublons.</p>
    </div>
    <div>
        <h1 class="text-xl font-semibold mt-8 mb-2"> 4. Assistance</h1>
        <p>Nous restons disponibles pour toute question ou problème lié à l’utilisation du site. N’hésitez pas à nous
            contacter via la page d’aide ou par e-mail.
        </p>

    </div>
</div>

<x-footer />

@endsection