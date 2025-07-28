<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div>
        @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
            {{ session("success") }}
        </div>
        @endif
    </div>
    @if (auth()->check() && auth()->user()->role === 'admin')
    <h2 class="text-2xl font-bold mb-6">Tableau de bord - Admin</h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 w-full gap-6 mt-4">
        <div class="bg-white p-4 shadow rounded-xl flex items-center space-x-2">
            <p class="text-gray-500">
                <span class="self-center text-blue-700"><i class="fa-solid fa-user-plus"></i></span>
                Bailleurs
            </p>
            <p class="text-2xl font-semibold">{{ $nbBailleurs }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded-xl flex items-center space-x-2">
            <p class="text-gray-500 flex items-center">

                <span class="self-center text-blue-700">
                    <i class="fa-solid fa-users-line"></i>
                </span>
                Locataires
            </p>
            <p class="text-2xl font-semibold">{{ $nbLocataires }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded-xl flex items-center space-x-2">
            <p class="text-gray-500 flex items-center">
                <span class="self-center text-blue-700"><i class="fa-solid fa-house"></i></span>

                Maisons publiées
            </p>
            <p class="text-2xl font-semibold">{{ $nbMaisons }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded-xl flex items-center space-x-2">
            <p class="text-gray-500 flex items-center">
                <span class="self-center text-blue-700"><i class="fa-duotone fa-solid fa-kaaba"></i></span>
                Locations effectuées
            </p>
            <p class="text-2xl font-semibold">{{ $nbLocations }}</p>
        </div>
    </div>

    {{-- Dernières publications --}}
    <h3 class="text-xl font-bold mb-4">🆕 Dernières publications</h3>
    <div class="space-y-3 mb-10">
        @forelse($dernièresPublications as $pub)
        <div class="bg-white p-4 shadow rounded-md">
            <h4 class="font-semibold text-lg">

                <a href="{{ url('showPublish/' .$pub->id) }}"
                    class="text-blue-500 hover:underline">
                    {{ $pub->titre }}
                </a>
            </h4>
            <div class="mt-2">
                <p class="text-gray-600 text-sm font-bold">Phone:{{$pub->user?->phone ?? 'inconnu'}}</p>

                <p class="text-gray-600 text-sm font-bold">Bailleur:{{$pub->user?->name ?? 'inconnu'}}</p>
                <p class="text-gray-600 text-sm font-bold">Prix(mois):{{number_format($pub->prix,0,',', '') ??
                    'inconnu'}} FCFA</p>

                <p class="text-gray-600 text-sm font-bold">{{ Str::limit($pub->description, 80) }}</p>
                <div class="mb-6">
                    <div class="flex items-center text-gray-600 mb-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-semibold">{{ $pub->quartier }}-{{ $pub->ville}}</span>

                    </div>
                </div>
             
            </div>

        </div>
        @empty
        <p class="text-gray-500 italic">Aucune publication récente.</p>
        @endforelse
    </div>

    {{-- Dernières locations --}}
    <h3 class="text-xl font-bold mb-4 flex items-center space-x-2">
        <span class="text-blue-700 mr-2"> <i class="fa-solid fa-cart-plus"></i> </span>

        Derniers achats de maisons
    </h3>
    <div class="space-y-3">
        @forelse($dernièresLocations as $location)
        {{-- @dd($location) --}}
        <div class="bg-white p-4 shadow rounded-md">
            <h4 class="font-semibold">
                <a href="{{ url('showPublish/'.$location->publish_id) }}"
                    class="text-blue-500 hover:underline">
                    {{ optional($location->publish)->titre ?? 'Maison supprimée' }} </a>
            </h4>
            <p class="text-gray-600 text-sm">Louée par : {{ $location->customer_name ?? 'Inconnu' }}</p>
            <p class="text-gray-600 text-sm font-bold">Contact : {{ $location->customer_phone ?? 'Inconnu' }}</p>
            <p class="text-gray-600 text-sm font-bold">montant : {{ number_format($location->amount,0, ',', '') ??
                'Inconnu' }} FCFA</p>

            <p class="text-gray-600 text-sm">loyer mensuel de : {{ number_format($location->publish?->prix ,0, ',',
                '') ?? 'Inconnu' }} fcfa</p>

            <div class="mb-6">
                <div class="flex items-center text-gray-600 mb-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="font-semibold">{{ $location->publish?->quartier }}-{{ $location->publish?->ville
                        }}</span>
                </div>
            </div>
        </div>
        @empty
        <p class="text-gray-500 italic">Aucune location récente.</p>
        @endforelse
    </div>
    @endif
    {{-- pub de bailleur --}}
    @include('admin.baill')
    @include('admin.locat')
</div>