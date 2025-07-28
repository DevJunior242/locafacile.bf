@extends('layout.app')

@section('content')
<x-nav />

<div class="relative bg-cover bg-center bg-no-repeat h-[500px] mb-4 w-full"
    style="background-image: url('/image/bg.png')">

    <div class="w-full h-full flex flex-col justify-center items-center bg-black/50 px-4">
        <h1 class="text-2xl md:text-4xl text-center text-white font-semibold max-w-3xl leading-snug">
            Détendez-vous avec LocaZenFaso , louez votre maison facilement
        </h1>

        <form action="{{ route('home') }}" method="GET" class="flex mt-6 w-full max-w-xl overflow-x-scroll">
            <label for="search" class="sr-only">Rechercher</label>
            <input type="search" id="search" name="query" value="{{ request('query') }}" placeholder="Rechercher..."
                class="flex-grow px-4 py-2 border border-gray-300 rounded-l-2xl focus:outline-none focus:ring-2 focus:ring-blue-600 bg-white/80 text-gray-900 placeholder-gray-600"
                required>
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-r-2xl hover:bg-blue-500 transition duration-300">
                <i class="fa-solid fa-magnifying-glass"></i> </button>
        </form>
    </div>
</div>


{{-- <div class="container mx-auto p-6 bg-white   overflow-hidden gap-2 pb-8"> --}}
    <div class="w-full max-w-[1600px] mx-auto p-6 bg-white overflow-hidden gap-2 pb-8">

        <div>
            @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
                {{ session("success") }}
            </div>
            @endif
        </div>


        <section class="py-2 bg-white">
            <div class="container mx-auto">

                @auth
                <h1 class="italic sm:text-sm md:text-md lg:text-lg xl:text-xl text-gray-800 text-center font-bold">
                    Trouvez
                    la
                    location de
                    maison qui vous convienne le plus </h1>

                @endauth


            </div>
        </section>




        <section class="py-16">


            <div
                class="{{$publishs->count() < 4 ? 'flex flex-wrap justify-center gap-2' : 'grid grid-cols-1 sm:grid-cols-2  md:grid-cols-3 lg:grid-cols-4'}} gap-x-6 gap-2 w-full ">
                @forelse ($publishs as $publish)

                <div class="bg-white shadow rounded-lg sm:mt-1  md:mt-2 lg:mt-4 p-1 ">

                    <!-- Image ou Vidéo -->
                    <div class="w-full h-64 relative transition-all duration-300 transform hover:-translate-y-2  ">
                        @if (Str::endsWith($publish->path, ['jpg', 'png', 'jpeg']))
                        <a href="{{ url('showPublish/' .$publish->id)}}">

                            <img src="{{ asset('storage/'.$publish->path) }}" alt="{{ $publish->titre }}"
                                class="w-full h-full rounded-[10%] object-cover">
                            <div
                                class="absolute bottom-2 right-2 text-xs text-white bg-black/50 px-2 py-1 rounded-full">
                                {{ $publish->created_at->diffForHumans() }}
                            </div>
                        </a>

                        @elseif (Str::endsWith($publish->path, ['mp4','webm']))
                        <a href="{{ url('showPublish/' .$publish->id)}}">
                            <video   
                             poster="{{ asset('storage/thumbnails/'.pathinfo($publish->path, PATHINFO_FILENAME).'.jpg') }}"
                                class="w-full h-full  rounded-[10%] object-cover ">
                              <source src="{{ asset('storage/'.$publish->path) }}" type="video/{{ $publish->file }}">
                            </video>
                            <div
                                class="absolute bottom-2 right-4 text-xs text-white bg-black/50 px-2 py-1 rounded-full">
                                {{ $publish->created_at->diffForHumans() }}
                            </div>
                        </a>

                        @else
                        <p>aucun fichier</p>
                        @endif

                    </div>

                    <!-- Contenu de la maison -->
                    <div class="p-6 bg-white gap-6 w-full border-l-4 border-gray-500 rounded-lg">

                        <!-- Titre et lien -->
                        <div class="mt-1 sm:mt-2 md:mt-4 lg:mt-6">

                            <h3 class="text-xs sm:text-sm md:text-md lg:text-lg  font-black  text-gray-800 gap-2 ">
                                <a href="{{ url('showPublish/' .$publish->id) }}">
                                    {{ $publish->titre }} à {{ $publish->ville }}
                                </a>
                            </h3>

                            <p class="text-xs font-semibold">
                                <a href="{{ url('showPublish/' .$publish->id)}}">
                                    situé dans le quartier {{ $publish->quartier }} </a>
                            </p>
                        </div>

                        <!-- Prix et statut -->
                        <div class="flex flex-col  mt-4 gap-2">
                            <div class="flex items-center gap-2 text-xs">
                                <i class="fas fa-money-bill-wave text-blue-600"></i>
                                <a href="{{ url('showPublish/' .$publish->id)}}"
                                    class=" text-blue-800 font-bold text-xs sm:text-base "> {{
                                    number_format($publish->prix, 0, ',', ' ') }} FCFA(mois)
                                </a>

                            </div>
                            <div class="flex items-center gap-2 text-xs font-black">
                                <a href="{{ url('showPublish/' .$publish->id)}}"> condition:{{ $publish->avance }} mois
                                    d'avance et {{ $publish->caution }} mois de
                                    caution</a>

                            </div>
                            <div class="flex items-center gap-2 mt-2 text-xs">
                                status
                                @switch($publish->status)

                                @case('disponible')
                                <span class="flex items-center text-green-600">
                                    <i class="fas fa-info-circle"></i>

                                    {{ ucfirst($publish->status) }}
                                </span>
                                @break
                                @case('occupee')

                                <span class="flex items-center  text-red-600">
                                    <i class="fas fa-info-circle"></i>
                                    {{ ucfirst($publish->status) }}
                                </span>
                                @break
                                @case('archive')
                                <span class="flex items-center  text-indigo-600">
                                    <i class="fas fa-info-circle"></i>

                                    {{ ucfirst($publish->status) }}
                                </span>
                                @break
                                @default
                                <div class="flex items-center text-xs sm:text-base italic text-orange-600">
                                    <span class="self-center ">
                                        <i class="fas fa-info-circle "></i>

                                    </span>
                                    <span class="text-xs">
                                        {{ ucfirst(str_replace('_', ' ',$publish->status)) }}
                                    </span>
                                </div>

                                @endswitch

                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <P class="text-xs sm:text-sm md:text-md lg:text-lg xl:text-xl text-red-800 text-center">aucun resultat
                </P>

                @endforelse

            </div>

        </section>





        <section class="bg-white py-16 px-6 md:px-12 lg:px-24">
            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-22 items-center">

                <!-- Texte -->
                <div data-aos="fade-right">
                    <h1 class="text-2xl md:text-xl font-bold text-gray-800 mb-6">
                        LocaZenFaso vous aide à louer ou mettre en location sans les tracas des démarcheurs. Paiement
                        sécurisé, maisons vérifiées, zéro stress.
                    </h1>
                    <p class="text-lg text-gray-600 mb-8">
                        Une inscription rapide, des locataires fiables, et un accompagnement à chaque étape.
                    </p>

                    <!-- Étapes avec icônes -->
                    <ul class="space-y-6">
                        <li class="flex items-start">
                            <svg class="w-8 h-8 text-indigo-600 mr-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="text-gray-700">Inscrivez-vous gratuitement et publiez votre
                                hébergement en quelques
                                minutes.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-8 h-8 text-indigo-600 mr-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Recevez des demandes de location de la part de
                                locataires
                                sérieux.</span>
                        </li>

                        <li class="flex items-start">
                            <svg class="w-8 h-8 text-indigo-600 mr-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-gray-700">Vous êtes accompagné par notre équipe à chaque
                                étape.</span>
                        </li>
                    </ul>

                    <!-- Bouton CTA -->
                    <a href="{{ route('publish') }}"
                        class="mt-10 mb-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-xl transition">
                        Je publie ma maison
                    </a>
                </div>

                <!-- Image -->
                <div data-aos="fade-left">
                    <img src="https://manager.groupe-bdl.com/web-content/img/modeles/2025/02/family-80-modele-et-plan-maison-a-etage-fbd87ce-600x410.jpeg"
                        alt="Maison à louer" class="rounded-2xl shadow-xl w-full h-auto">
                </div>
            </div>
        </section>



        <div class="mt-4 flex items-center justify-center">
            {{ $publishs->links() }}
        </div>
    </div>
    <x-footer />
    @endsection