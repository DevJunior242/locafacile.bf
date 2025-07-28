@extends('layout.app')
<x-nav />

@section('content')

<div class="max-w-[1100px] mx-auto px-4 sm:px-6 lg:px-8 py-8 mb-12">
    <div class="bg-white shadow-sm rounded-sm ">
        <!-- Media Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="w-full h-64 relative ">
                @if (Str::endsWith($publish->path, ['jpg', 'png', 'jpeg']))

                <img src="{{ asset('storage/'.$publish->path) }}" alt="{{ $publish->titre }}"
                    class="max-w-full h-64 rounded object-cover">


                @elseif (Str::endsWith($publish->path, ['mp4','webm']))
                <video class="w-full h-64  rounded object-cover" controls
                    poster="{{ asset('storage/thumbnails/'.pathinfo($publish->path, PATHINFO_FILENAME).'.jpg') }}">
                    <source src="{{ asset('storage/'.$publish->path) }}" type="video/{{ $publish->file }}">
                    votre navigateur ne supporte pas la video
                </video>

                @else
                <p>aucun fichier</p>
                @endif

            </div>

            <!-- Location -->
            <div class="mb-6 border-l-4 border-gray-500 pl-4">
                <h1 class="text-xl font-bold text-gray-800">{{ $publish->titre }}</h1>
                <div class="mb-8 mt-2 border-2 border-white bg-green-600 p-2">
                    @if ($publish->description)
                    <p class=" text-white  whitespace-pre-line">{{ $publish->description}}</p>

                    @endif
                    <p class=" text-white  whitespace-pre-line">
                        {{ str_replace('_', ' ', $publish->form_logement )}} situé {{ $publish->quartier }} prés de {{
                        $publish->localisation }} .Cour {{ $publish->type_cour }} avec {{ $publish->caution }} de mois
                        de caution et {{ $publish->avance }} mois d' avance</p>
                </div>

                <p class="text-3xl font-extrabold text-blue-600">
                    {{ number_format($publish->prix, 0, ',', ' ') }} F CFA
                </p>
                <div class="flex items-center text-gray-600 mb-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="font-semibold">{{ $publish->quartier }}, {{ $publish->ville }}</span>
                </div>
                @if ($publish->localisation)
                <small class="text-gray-900 font-bold">coté de {{ $publish->localisation }}</small>

                @endif

            </div>
        </div>


        <!-- Main Content -->
        <div class="p-6 md:p-8">
            <!-- Title and Status -->
            <div class="flex items-center gap-2 text-xs sm:text-base italic">
                <div>
                    <p class="text-gray-700">la maison est actullement</p>

                </div>

                @switch($publish->status)

                @case('disponible')
                <span class="flex items-center gap-2 text-xs sm:text-base italic text-green-600">

                    {{ ucfirst($publish->status) }}
                </span>
                @break
                @case('occupee')

                <span class="flex items-center gap-2 text-xs sm:text-base italic text-red-600">
                    {{ ucfirst($publish->status) }}
                </span>
                @break
                @case('archive')
                <span class="flex items-center gap-2 text-xs sm:text-base italic text-indigo-600">

                    {{ ucfirst($publish->status) }}
                </span>
                @break
                @default

                <span class="flex items-center gap-2 text-xs sm:text-base italic text-pink-600">
                    {{ ucfirst(str_replace('_', ' ',$publish->status)) }}
                </span>
                @endswitch

            </div>



            <!-- Features Grid -->


            <div class=" mt-4 pb-4 bg-white hover:bg-zinc-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Caractéristiques de la maison</h3>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs sm:text-sm xl:text-xl lg:text-lg text-gray-800">
                    <div class="flex items-center gap-2">
                        <span class="{{ $publish->cuisine ? 'text-green-600' : 'text-red-600' }}">
                            <i class="{{ $publish->cuisine ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </span>
                        Cuisine
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="{{ $publish->eau ? 'text-green-600' : 'text-red-600' }}">
                            <i class="{{ $publish->eau ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </span>
                        Eau
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="{{ $publish->courant ? 'text-green-600' : 'text-red-600' }}">
                            <i class="{{ $publish->courant ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </span>
                        Courant
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="{{ $publish->climatisation ? 'text-green-600' : 'text-red-600' }}">
                            <i
                                class="{{ $publish->climatisation ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </span>
                        Clime
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="{{ $publish->chateu_eau ? 'text-green-600' : 'text-red-600' }}">
                            <i class="{{ $publish->chateu_eau ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </span>
                        Chateau d'eau
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="{{ $publish->ventilateur ? 'text-green-600' : 'text-red-600' }}">
                            <i class="{{ $publish->ventilateur ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </span>
                        Ventilateur
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="{{ $publish->balcon ? 'text-green-600' : 'text-red-600' }}">
                            <i class="{{ $publish->balcon ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </span>
                        Balcon
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="{{ $publish->terrasse ? 'text-green-600' : 'text-red-600' }}">
                            <i class="{{ $publish->terrasse ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </span>
                        Terrasse
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="{{ $publish->garage_parking ? 'text-green-600' : 'text-red-600' }}">
                            <i
                                class="{{ $publish->garage_parking ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </span>
                        Garage
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="{{ $publish->meuble ? 'text-green-600' : 'text-red-600' }}">
                            <i class="{{ $publish->meuble ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </span>
                        Meublé
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="{{ $publish->plafond ? 'text-green-600' : 'text-red-600' }}">
                            <i class="{{ $publish->plafond ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </span>
                        Plafond
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="{{ $publish->jardin ? 'text-green-600' : 'text-red-600' }}">
                            <i class="{{ $publish->jardin ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </span>
                        Jardin
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="{{ $publish->internet ? 'text-green-600' : 'text-red-600' }}">
                            <i class="{{ $publish->internet ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </span>
                        Internet
                    </div>

                    <div class="flex items-center gap-2">
                        @if ($publish->type_sol)
                        <span class="text-green-600"> <i class="fas fa-check-circle"></i></span>
                        {{ucfirst($publish->type_sol)}}
                        @endif
                    </div>
                    <div>La maison dispose de <span class="font-semibold text-gray-800">{{ $publish->nombre_chambres
                            }}</span> chambre(s).</div>
                    <div>La maison possède <span class="font-bold"> {{ $publish->nombre_salons }}</span> salon(s).</div>

                    <div>{{ $publish->securite ? 'La sécurité est assurée (' . ucfirst($publish->securite) . ').' : 'La
                        sécurité n\'est pas précisée.' }}</div>
                    <div>
                        @if ($publish->etage && $publish->etage > 0)
                        <p>niveau de logement: <strong>R + {{ $publish->etage }}</strong></p>
                        @elseif($publish->etage === 0)
                        <p>niveau de l'etage: <strong>Rez-de-chaussée</strong></p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mt-8">

                @if ($publish->isDisponible() && ($user->isAdmin() || $user->isLocataire()))
                <a href="{{route('paymentLink', $publish)}}" target="_blank"
                    class="flex-1  bg-blue-600 text-white font-bold py-3 px-4 rounded-lg text-center transition duration-300">
                    louer maintenant
                </a>

                @endif

                @if ($user->isAdmin() || $user->id ===$publish->user_id)
                @if ($publish->isVerified())
                <a href="{{ url('publishEdit/'.$publish->id) }}"
                    class="flex-1 border border-green-600 text-green-600  font-bold py-3 px-4 rounded-lg text-center  ">
                    edit
                </a>
                <a href="{{ url('deletePublish/'.$publish->id) }}"
                    class="flex-1 border border-red-500 text-red-500 hover:bg-red-50 font-bold py-3 px-4 rounded-lg text-center transition duration-300 "
                    onclick="return confirm('Etes vous sur de vouloir supprimer cette publication?' )">
                    Supprimer
                </a>
                @endif


                @if ($publish->isBusy())
                <form action="{{ url('replicate/'.$publish->id) }}" method="POST">
                    @csrf
                    <button class="border border-green-600 text-green-600 p-2 rounded-lg">republier</button>
                </form>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>



<x-footer />

@endsection