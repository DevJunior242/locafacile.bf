{{-- Dernières locations --}}
@if (auth()->check() && auth()->user()->role === 'locataire')
<h3 class="text-xl font-bold mb-4">🛒 mes Derniers achats de maisons</h3>
<div class="space-y-3">
    @forelse($Locations as $locat)

    <div class="bg-white p-4 shadow rounded-md">
        <h4 class="font-semibold">
            <a href="{{ url('showPublish/' .$locat->publish_id) }}" class="text-blue-500 hover:underline">
                {{ optional($locat->publish)->titre ?? 'Maison supprimée' }}
            </a>

        </h4>

        <p class="text-gray-600 text-sm font-bold">Contact : {{ $locat->customer_phone ?? 'Inconnu' }}</p>
        <p class="text-gray-600 text-sm font-bold">montant : {{ number_format($locat->amount,0, ',', '') ??
            'Inconnu' }} FCFA</p>

        <p class="text-gray-600 text-sm">loyer mensuel de : {{ number_format($locat->publish?->prix ,0, ',',
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
                <span class="font-semibold">{{ $locat->publish?->quartier }}-{{ $locat->publish?->ville
                    }}</span>
            </div>
        </div>
        <p class="text-xs text-gray-400 mt-1">Le {{ $locat->created_at->format('d/m/Y à H:i') }}</p>
    </div>
    @empty
    <p class="text-gray-500 italic">Aucune location récente.
        <a href="{{ url('/') }}" class="flex items-center text-blue-600">visitez les maisons disponibles</a>
    </p>
    @endforelse
    <div class="flex tems-center justify-center">
        {{ $Locations ->links() }}
    </div>
    @endif

</div>