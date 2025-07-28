@extends('layout.app')
@section('content')
<x-nav />
<div class=" mx-auto mt-4 p-6 bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-[1100px]">
    <!-- Section promotionnelle -->

    <div class="bg-blue-100 p-6 rounded-lg text-center shadow-md mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Devenez livreur et rejoignez notre équipe dynamique !</h1>
        <p class="text-gray-700 mt-2">
            Vous connaissez bien votre ville et souhaitez arrondir vos fins de mois ? Devenez livreur et profitez d’une
            opportunité flexible et rentable ! 🚀
        </p>
        <ul class="text-left mt-4 text-gray-700 space-y-2 ">
            <li class="flex items-center">
                <x-heroicon-s-check-circle class="h-6 w-6 text-green-500 mr-2" /> Gagnez de l'argent facilement en
                effectuant des livraisons près de chez vous.
            </li>
            <li class="flex items-center">
                <x-heroicon-s-check-circle class="h-6 w-6 text-green-500 mr-2" /> Travaillez à votre rythme et
                choisissez vos horaires selon votre disponibilité.
            </li>
            <li class="flex items-center">
                <x-heroicon-s-check-circle class="h-6 w-6 text-green-500 mr-2" /> Rejoignez une communauté fiable et
                organisée qui facilite les échanges et vous accompagne.
            </li>
            <li class="flex   items-center">
                <x-heroicon-s-check-circle class="h-6 w-6 text-green-500 mr-2" /> Développez votre réseau en collaborant
                avec des clients et des entreprises locales.
            </li>
        </ul>

        <h2 class="mt-4 text-xl font-semibold text-blue-700">Comment ça marche ?</h2>

        <ol class="text-left mt-2 text-gray-700 space-y-2  pl-5">
            <li class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-500 text-white mr-2">1</div>
                Inscrivez-vous en quelques minutes avec vos informations et votre numéro de téléphone.
            </li>
            <li class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-500 text-white mr-2">2</div>
                Une fois validé, recevez des demandes de livraison dans votre ville.
            </li>
            <li class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-500 text-white mr-2">3</div>
                Effectuez vos livraisons et recevez votre paiement rapidement.
            </li>
        </ol>



        <h2 class="mt-4 text-xl font-semibold text-blue-700">Tarification pour les livreurs</h2>
        <ul class="text-left mt-2 text-gray-700 space-y-2">
            <li class="flex items-center">
                <x-heroicon-s-currency-dollar class="h-6 w-6 text-yellow-500 mr-2" /> Tarif de base : <strong>2500
                    FCFA</strong> par livraison courte (moins de 5 km).
            </li>
            <li class="flex items-center">
                <x-heroicon-s-currency-dollar class="h-6 w-6 text-yellow-500 mr-2" /> Tarif moyen : <strong>3000
                    FCFA</strong> pour une distance entre 5 et 10 km.
            </li>
            <li class="flex items-center">
                <x-heroicon-s-currency-dollar class="h-6 w-6 text-yellow-500 mr-2" /> Tarif long trajet : <strong>3500
                    FCFA</strong> et plus pour les livraisons supérieures à 10 km.
            </li>
            <li class="flex flex-wrap items-center">
                <x-heroicon-s-currency-dollar class="h-6 w-6 text-yellow-500 mr-2" /> 🎁 Bonus : Prime pour les livreurs
                actifs (exemple : <strong>5 000 FCFA</strong> après 20 livraisons réussies).
            </li>
        </ul>
    </div>


    <div class="mt-4 bg-white p-6 shadow  gap-4">
        @if (session('success'))
        <div class="alert alert-success" role="alert">

            <span>{{ session("success") }}</span>

        </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-100/50 atext-center text-red-700 p-3 rounded">
            @foreach ($errors->all() as $error)
            <span>{{ $error }}</span>
            @endforeach
        </div>
        @endif

        <form action="{{ url('AddLivreur') }}" method="POST" class="space-y-2 ">
            @csrf

            <div class="mt-2 bg-white p-2  rounded-md">
                <label for="prenom" class="block text-gray-700 text-sm font-bold mb-2">preNom</label>
                <input type="text" name="prenom"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                    required>
                @error('prenom')
                <span class="text-red-600 ">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2 bg-white p-2  rounded-md">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                <input type="text" name="phone"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                    required>
                @error('phone')
                <span class="text-red-600 ">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2 bg-white p-2  rounded-md">
                <label for="ville" class="block text-gray-700 font-medium">veuillez choisir votre ville</label>
                <select name="ville"
                    class=" w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                    required>
                    <option value="" selected disabled> suis je dans quels city?</option>
                    <option value="Ouagadougou">Ouagadougou</option>
                    <option value="Bobo-Dioulasso">Bobo-Dioulasso</option>
                    <option value="Koudougou">Koudougou</option>
                    <option value="Fada N’Gourma">Fada N’Gourma</option>
                    <option value="Banfora">Banfora</option>

                    @error('ville')
                    <span class="text-red-600 ">{{ $message }}</span>
                    @enderror
                </select>
            </div>
            <div class="mt-8 ">
                <button type="submit" class="bg-blue-700 hover:bg-blue-500 text-white p-4 w-full">devenir
                    livreur</button>
            </div>
        </form>


    </div>
</div>
<div>
    <x-footer />
</div>
@endsection