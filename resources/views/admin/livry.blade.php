@extends('layout.dashboard')

@section('content')
<div class="bg-white shadow-md rounded-lg gap-4 w-full mx-auto p-4 mt-4">

    <div class="w-full bg-white p-6 rounded-lg  mx-auto">
        @include('livry.alert')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse ($livrys as $livry)
            @php
            $user = auth()->user();
            $livreur = $user->livreur;
            $accepte = $livry->acceptLivraisons()->first();
            @endphp

            <div class="bg-gray-50 p-4 rounded-lg  border border-gray-200">
                <p class="text-xs sm:text-sm lg:text-lg xl:text-xl text-gray-800">
                    @if ($livry->status == 'en attente')
                    Livraison disponible à {{ $livry->ville }} dans le quartier {{ $livry->quartier }} <br>
                    Veuillez cliquer sur le bouton
                    <span>
                        @include('livry.offre')
                    </span>
                    <span class="text-xs sm:text-sm lg:text-lg xl:text-xl text-gray-800">
                        pour accepter la livraison.

                    </span>
                    @elseif ($livry->status === 'en cours')

                    Livraison en cours de traitement à {{ $livry->ville }} dans le quartier {{ $livry->quartier }} <br>
                    Le livreur est en route pour la livraison. <br>
                    <span class="text-blue-600">Statut : En cours</span>
                    <span>
                        @include('livry.offre')
                    </span>


                    @elseif ($livry->status === 'complete')
                    Livraison livrée à {{ $livry->ville }} dans le quartier {{ $livry->quartier }} <br>
                    Livraison effectuée par <span class="text-blue-700">{{ $livry->acceptLivraisons?->livreur?->prenom
                        }}</span> /
                    {{ $livry->acceptLivraisons?->livreur?->phone }} le {{ $livry->formatted_date }} <br>
                    <span class="text-green-600">Statut : Livrée</span>
                    @else
                    <span class="text-xs sm:text-sm lg:text-lg xl:text-xl text-gray-800">
                        Statut inconnu
                    </span>

                    @endif

                    <li class="list-none text-xs sm:text-sm lg:text-lg xl:text-xl text-gray-800 mt-2">Le numéro du destinataire
                        est {{ $livry->phone }}</li>
                </p>


                @if ( $livry->status !== 'en attente')
                <div class="mt-3 flex  space-x-2.5 justify-between items-center overflow-x-scroll ">
                    <strong class="text-xs sm:text-sm lg:text-lg xl:text-xl text-gray-800">commission</strong>
                    <div class="flex justify-between items-center gap-2">
                        @if ($livry->status === 'en cours')
                        @can('markAsDelivered', $livry)
                            <form action="{{ route('livrer', $livry->id) }}" method="POST">
                            @csrf
                            <button
                                class="group h-8 rounded-lg bg-blue-600 text-white px-3 text-sm shadow hover:bg-blue-700 active:bg-blue-800 transition">
                                Livrer
                            </button>
                       </form>
                        <form action="{{ route('annuler', $livry->id) }}" method="POST">
                            @csrf
                            <button
                                class="group h-8  rounded-lg bg-red-600 text-white  px-3 text-sm shadow hover:bg-red-700 active:bg-red-800 transition">
                                Annuler
                            </button>
                        </form>

                        @else
                        <button
                            class="group cursor-not-allowed h-8 rounded-lg bg-blue-100 text-white px-3 text-sm shadow hover:bg-blue-200 active:bg-blue-800 transition">
                            Livrer
                        </button>
                        <button
                            class="group h-8 cursor-not-allowed rounded-lg bg-red-100 text-white px-3 text-sm shadow hover:bg-red-200 active:bg-red-800 transition">
                            Annuler
                        </button>
                        @endcan
                        @elseif ($livry->status === 'complete')
                        <span class="bg-green-100 text-green-800 rounded p-2 cursor-not-allowed">Terminée</span>

                        @else
                        {{ $livry->status }}
                        @endif
                    </div>
                </div>
                @endif

            </div>

            @empty
            <p class="text-xs sm:text-sm lg:text-lg xl:text-xl text-gray-800">
                Aucune livraison disponible actuellement
            </p>
            @endforelse
        </div>

        <div class="mt-6 flex justify-center">
            {{ $livrys->links() }}
        </div>
    </div>
</div>
@endsection
