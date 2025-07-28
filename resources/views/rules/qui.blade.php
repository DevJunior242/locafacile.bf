@extends('layout.app')

@section('content')
<x-nav />
<div class="max-w-4xl mx-auto py-12 px-4 mt-10">
    <h1 class="text-3xl font-bold mb-6">Qui sommes-nous</h1>
    <p class="mb-4">Nous sommes une plateforme innovante de location de maisons basée au Burkina Faso. Notre mission : rendre la recherche de logement <strong>plus simple, plus rapide et plus sécurisée</strong>, sans intermédiaires douteux ni frais cachés.</p>

    <h2 class="text-xl font-semibold mt-8 mb-2">Notre vision</h2>
    <p class="mb-4">Trouver un logement ne devrait pas être un parcours du combattant. Dans un pays où les rues ne sont pas toujours bien identifiées et où les arnaques sont fréquentes, nous avons créé une solution locale, fiable et 100% transparente.</p>

    <h2 class="text-xl font-semibold mt-8 mb-2">Ce que nous faisons</h2>
    <ul class="list-disc list-inside space-y-2 mb-4">
        <li><strong>Vérification terrain</strong> : chaque maison publiée est vérifiée par notre équipe.</li>
        <li><strong>Paiement sécurisé</strong> via Paydunya.</li>
        <li><strong>Suivi en temps réel</strong> : les maisons sont marquées "occupées" automatiquement.</li>
        <li><strong>Zéro commission</strong> sur le loyer.</li>
    </ul>

    <h2 class="text-xl font-semibold mt-8 mb-2">Pourquoi nous faire confiance ?</h2>
    <ul class="list-disc list-inside space-y-2 mb-4">
        <li>Présence sur le terrain avec des livreurs formés</li>
        <li>Transparence des informations</li>
        <li>Paiement encadré et sécurisé</li>
        <li>Un service pensé pour les réalités locales</li>
    </ul>

    <h2 class="text-xl font-semibold mt-8 mb-2">À propos du fondateur</h2>
    <p class="mb-4">
        <strong>Elisé Yonli</strong>, développeur Laravel passionné, est à l’origine de cette plateforme. Son objectif est de mettre la technologie au service des locataires et rendre les locations accessibles sans intermédiaires inutiles.
    </p>
    <blockquote class="border-l-4 pl-4 italic text-gray-600 mb-4">
        « J’ai moi-même été confronté à la difficulté de trouver un logement à Ouaga sans perdre du temps ou de l’argent. Cette plateforme est la solution que j’aurais aimé trouver. »
    </blockquote>

    <h2 class="text-xl font-semibold mt-8 mb-2">Contact</h2>
    <p class="mb-2">📧 <strong>diakpaguiliyonli@gmail.com</strong></p>
    <p class="mb-2">📱 <strong>+226 75 30 35 79</strong></p>
    <p>📍 Ouagadougou, Burkina Faso</p>
</div>
<div>
    <x-footer />
</div>
@endsection