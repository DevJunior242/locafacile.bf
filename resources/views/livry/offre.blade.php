@php
$user = auth()->user();
$livreur = $user->livreur;

$accepte = $livry->acceptLivraisons()->first();
@endphp

<div class="mt-3 flex justify-between items-center">

    @if (!in_array($livry->status, ['complete', 'annulée']))
    {{-- <div class="flex items-center justify-start gap-2 mt-2"> --}}
        <div class="flex justify-between items-center gap-6 overflow-x-scroll mt-2">

            @if ($livry && $livry->status === 'en attente')

            <form action="{{route('Accepter', $livry->id) }}" method="POST">
                @csrf

                <button
                    class="group h-8 select-none rounded-lg bg-blue-600 px-3 text-sm leading-8 text-zinc-50 shadow-[0_-1px_0_1px_#1e3a8a_inset,0_0_0_1px_#1d4ed8_inset,0_0.5px_0_1.5px_#60a5fa_inset] hover:bg-blue-700 active:bg-blue-800 active:shadow-[-1px_0px_1px_0px_rgba(0,0,0,.2)_inset,1px_0px_1px_0px_rgba(0,0,0,.2)_inset,0px_0.125rem_0px_0px_rgba(0,0,0,.6)_inset]"><span
                        class="block group-active:[transform:translate3d(0,1px,0)]">
                        accepter
                    </span>
                </button>

            </form>
            @else
            <p class="text-sm text-gray-800 italic"></p>
            @endif
            @if ($livry && $livry->status === 'en cours' && (auth()->user()->role === 'admin' || $livreur && $accepte &&
            $livreur->id == $accepte->livreur_id))
            <p class="text-sm text-gray-800 italic">annuler ma demande </p>

            <form action="{{route('destroy',  $livry->id) }}" method="POST"
                class="flex items-center justify-center mt-2">
                @csrf
                @method('DELETE')
                <button
                    class="group h-8 select-none rounded-lg bg-red-600 px-3 text-sm leading-8 text-zinc-50 shadow-[0_-1px_0_1px_#7f1d1d_inset,0_0_0_1px_#b91c1c_inset,0_0.5px_0_1.5px_#f87171_inset] hover:bg-red-700 active:bg-red-800 active:shadow-[-1px_0px_1px_0px_rgba(0,0,0,.2)_inset,1px_0px_1px_0px_rgba(0,0,0,.2)_inset,0px_0.125rem_0px_0px_rgba(0,0,0,.6)_inset] "><span
                        class="block group-active:[transform:translate3d(0,1px,0)]">annuler</span></button>
            </form>
            @endif

        </div>

        @elseif ($livry->status === 'complete')
        <p class="text-sm text-gray-500 italic ml-4">
            livrée par <span class="text-blue-700">{{
                $livry->acceptLivraisons?->livreur?->prenom}}</span> / {{
            $livry->acceptLivraisons?->livreur->phone}} le {{ $livry->formatted_date }}</span>
        </p>
        @endif
    </div>

 






