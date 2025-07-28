@extends('layout.app')

@section('content')
<x-nav />
<div class="max-w-4xl mx-auto py-12 px-4 mt-10">
    <h1 class="text-3xl font-bold mb-6">Mentions légales</h1>
    <p class="mb-4">Dernière mise à jour : {{ date('d/m/Y') }}</p>

    <h2 class="text-xl font-semibold mt-8 mb-2">1. Éditeur du site</h2>
    <p class="mb-2"><strong>Nom</strong> : Elisé Yonli</p>
    <p class="mb-2"><strong>Statut</strong> : Développeur indépendant</p>
    <p class="mb-2"><strong>Email</strong> : diakpaguiliyonli@gmail.com</p>
    <p class="mb-2"><strong>Téléphone</strong> : +226 75 30 35 79</p>
    <p class="mb-4"><strong>Adresse</strong> : Ouagadougou, Burkina Faso</p>

    <h2 class="text-xl font-semibold mt-8 mb-2">2. Hébergement</h2>
    <p class="mb-4">Nom de l’hébergeur : <em>[à compléter]</em><br>Adresse : <em>[à compléter]</em><br>Téléphone : <em>[à compléter]</em></p>

    <h2 class="text-xl font-semibold mt-8 mb-2">3. Propriété intellectuelle</h2>
    <p class="mb-4">Tous les contenus (textes, images, vidéos, code, logo, etc.) sont la propriété exclusive de l’éditeur, sauf mention contraire. Toute reproduction sans autorisation est interdite.</p>

    <h2 class="text-xl font-semibold mt-8 mb-2">4. Responsabilité</h2>
    <p class="mb-4">L’éditeur n’est pas responsable du contenu des annonces ni des litiges entre utilisateurs. Il agit comme intermédiaire technique entre propriétaires et locataires.</p>

    <h2 class="text-xl font-semibold mt-8 mb-2">5. Données personnelles</h2>
    <p class="mb-4">Les données collectées sont utilisées uniquement pour le fonctionnement du site. Elles ne sont jamais revendues. Voir la <a href="/confidentialite" class="text-blue-600 underline">politique de confidentialité</a>.</p>

    <h2 class="text-xl font-semibold mt-8 mb-2">6. Cookies</h2>
    <p class="mb-4">Ce site utilise des cookies pour améliorer votre expérience. Vous pouvez les désactiver dans les paramètres de votre navigateur.</p>

    <h2 class="text-xl font-semibold mt-8 mb-2">7. Contact</h2>
    <p class="mb-2">📧 <strong>diakpaguiliyonli@gmail.com</strong></p>
    <p>📱 <strong>+226 75 30 35 79</strong></p>
</div>
<div>
    <x-footer />
</div>
@endsection