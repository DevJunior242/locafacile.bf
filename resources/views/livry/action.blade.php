<div class="mt-3 flex space-x-2.5 justify-between items-center">
    <strong>Actions :</strong>
    <div class="flex gap-2 mt-2">
        @if ($livry->status == 'en cours')
        @can('markAsDelivered', $livry)
        <a href="{{route('livrer', $livry->id) }}">
            <button
                class="group h-8 select-none rounded-lg bg-blue-600 px-3 text-sm leading-8 text-zinc-50 shadow-[0_-1px_0_1px_#1e3a8a_inset,0_0_0_1px_#1d4ed8_inset,0_0.5px_0_1.5px_#60a5fa_inset] hover:bg-blue-700 active:bg-blue-800 active:shadow-[-1px_0px_1px_0px_rgba(0,0,0,.2)_inset,1px_0px_1px_0px_rgba(0,0,0,.2)_inset,0px_0.125rem_0px_0px_rgba(0,0,0,.6)_inset]">
                <span class="block group-active:[transform:translate3d(0,1px,0)]">livrer
                </span>
            </button>
        </a>
        <a href="{{ route('annuler', $livry->id) }}">
            <button
                class="group h-8 select-none rounded-lg bg-red-600 px-3 text-sm leading-8 text-zinc-50 shadow-[0_-1px_0_1px_#7f1d1d_inset,0_0_0_1px_#b91c1c_inset,0_0.5px_0_1.5px_#f87171_inset] hover:bg-red-700 active:bg-red-800 active:shadow-[-1px_0px_1px_0px_rgba(0,0,0,.2)_inset,1px_0px_1px_0px_rgba(0,0,0,.2)_inset,0px_0.125rem_0px_0px_rgba(0,0,0,.6)_inset]"><span
                    class="block group-active:[transform:translate3d(0,1px,0)]">Cancel</span></button>
        </a>


        @else
        <a href="#">
            <button
                class="group h-8 select-none rounded-lg bg-blue-600 px-3 text-sm leading-8 text-zinc-50 shadow-[0_-1px_0_1px_#1e3a8a_inset,0_0_0_1px_#1d4ed8_inset,0_0.5px_0_1.5px_#60a5fa_inset] hover:bg-blue-700 active:bg-blue-800 active:shadow-[-1px_0px_1px_0px_rgba(0,0,0,.2)_inset,1px_0px_1px_0px_rgba(0,0,0,.2)_inset,0px_0.125rem_0px_0px_rgba(0,0,0,.6)_inset]">
                <span class="block group-active:[transform:translate3d(0,1px,0)]">livrer
                </span>
            </button>
        </a>
        <a href="#">
            <button
                class="group h-8 select-none rounded-lg bg-red-600 px-3 text-sm leading-8 text-zinc-50 shadow-[0_-1px_0_1px_#7f1d1d_inset,0_0_0_1px_#b91c1c_inset,0_0.5px_0_1.5px_#f87171_inset] hover:bg-red-700 active:bg-red-800 active:shadow-[-1px_0px_1px_0px_rgba(0,0,0,.2)_inset,1px_0px_1px_0px_rgba(0,0,0,.2)_inset,0px_0.125rem_0px_0px_rgba(0,0,0,.6)_inset]"><span
                    class="block group-active:[transform:translate3d(0,1px,0)]">annuler</span></button>

        </a>

        @endcan

        @elseif ($livry->status === 'livrée')
        <span class="bg-green-100 text-green-800 rounded p-2 cursor-not-allowed">Terminée</span>
        @elseif ($livry->status === 'annulée')
        <span class="bg-gray-200 text-gray-600 rounded p-2 cursor-not-allowed">Annulée</span>
        @else
        {{ $livry->status }}
        @endif
    </div>

</div>