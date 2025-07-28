@if (auth()->check() && auth()->user()->role == 'bailleur')


<h2 class="text-2xl font-bold mb-6">LA LISTES DES MES MAISONS</h2>

<div class="{{ $publishs->count()  > 0 ? 'grid grid-cols-1  lg:grid-cols-2 w-full gap-x-6' : ''}}">

    @forelse ( $publishs as $publish )



    <div class="bg-white shadow-lg rounded-3xl   mt-12 border-t-2 border-gray-900 p-4">
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

        <div class="p-4 bg-white gap-6 w-full">
            <!-- Titre et lien -->
            <div class="mt-1 sm:mt-2 md:mt-4 lg:mt-6">

                <h3 class="text-xs sm:text-sm md:text-md lg:text-lg  font-black  text-gray-800 gap-2">
                    <a href="{{ url('showPublish/'.$publish->id) }}">
                        {{ $publish->titre }} à {{ $publish->ville }}
                    </a>
                </h3>

                <p class="text-xs font-semibold">
                    <a href="{{ url('showPublish/'.$publish->id) }}">
                        situé dans le quartier {{ $publish->quartier }} </a>
                </p>
            </div>
            <!-- Prix et statut -->
            <div class="flex flex-col   mt-4 gap-2">
                <div class="">

                    <span class=" text-blue-800 font-bold text-xs sm:text-base ">
                        {{ number_format($publish->prix, 0, ',', ' ') }} F CFA(mois)
                    </span>
                </div>
                <div class="flex items-center gap-2 text-xs font-black">
                    <small>
                        condition:{{ $publish->avance }} mois d'avance et {{ $publish->caution }} mois de caution
                    </small>
                </div>
                <div class="flex items-center gap-2 mt-2 text-xs sm:text-base">
                    status
                    @switch($publish->status)

                    @case('disponible')
                    <span class="flex items-center gap-2 text-xs sm:text-base italic text-green-600">
                        <i class="fas fa-info-circle"></i>

                        {{ ucfirst($publish->status) }}
                    </span>
                    @break
                    @case('occupee')

                    <span class="flex items-center gap-2 text-xs sm:text-base italic text-red-600">
                        <i class="fas fa-info-circle"></i>
                        {{ ucfirst($publish->status) }}
                    </span>
                    @break
                    @case('archive')
                    <span class="flex items-center gap-2 text-xs sm:text-base italic text-indigo-600">
                        <i class="fas fa-info-circle"></i>

                        {{ ucfirst($publish->status) }}
                    </span>
                    @break
                    @default

                    <span class="flex items-center gap-2 text-xs sm:text-base italic text-pink-600">
                        <i class="fas fa-info-circle "></i>
                        {{ ucfirst(str_replace('_', ' ',$publish->status)) }}
                    </span>
                    @endswitch
                    @if ($publish->canRepublier(auth()->user()))
                    <form action="{{ url('replicate/'.$publish->id) }}" method="POST">

                        @csrf
                        <button class="bg-blue-600 text-white p-2 rounded-lg">
                            républier </button>
                    </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @empty

    {{-- <p>aucune publication pour le moment veuillez ajouter une nouvelle</p> --}}


    <section class="bg-white py-16 px-6 md:px-12 lg:px-24">
        <div class="max-w-3xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Texte -->
            <div data-aos="fade-right">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                    publiez votre maison en toute confiance avec <span class="text-indigo-600">LocaFacile</span>
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
                            <path d="M12 11c0-2.21 1.79-4 4-4s4 1.79 4 4-1.79 4-4 4-4-1.79-4-4zM4 21h16M4 17h16" />
                        </svg>
                        <span class="text-gray-700">Le contact est révélé après paiement sécurisé par le
                            locataire.</span>
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
                    class="mt-10 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-xl transition">
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

    @endforelse

</div>



<div class="mt-4 flex items-center justify-center">
    {{ $publishs->links() }}
</div>

@endif