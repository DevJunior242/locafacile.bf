@extends('layout.app')

@section('content')

<div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-8">
    
    <h2 class="text-2xl font-bold text-center mb-4">Bienvenue sur la page de contact</h2>
    <p class="text-gray-700 text-center mb-6">
        Locafacile est un service gratuit et à destination des locataires
    </p>

    <p class="mt-4 mb-4 text-center text-gray-700 font-semibold">
        Livraison gratuite pour les locataires
    </p>




    <div class="p-4 border border-zinc-300 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-800 text-center">Contacter notre equipe de support </h3>
        <p class="text-gray-600 mt-4">
            Vous souhaitez obtenir plus d'informations sur le processus ?
            Contactez notre équipe de support pour toute assistance.
        </p>
        <form action="{{ url('contactAppUpdate/'.$publish->id) }}" method="POST" class="mt-4">
            @csrf

            <button type="submit"
                class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition {{ $publish->status ==='occupé' ? 'cursor-not-allowed' :'' }}">
                process
            </button>
        </form>
    </div>

</div>
@endsection