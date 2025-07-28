@extends('layout.dashboard')

@section('content')
<div class="bg-white   gap-4 w-full mx-auto p-4 mt-4">
    <h1 class="flex justify-center items-center">
      @if (auth()->user()->isAdmin())
        les livraison
        @else
        mes livraisons
        @endif
    </h1>
    <div class="w-full bg-white p-6 overflow-x-scroll mx-auto">
        @if($acceptLivraisons->isEmpty())
        <div class="flex justify-center items-center">
            <p>vous avez affectué aucune livraison veuillez creer un compte livreur

            </p>
        </div>
        @if (!auth()->user()->livreur)
              <div class="flex justify-center items-center">
            <a href="{{ route('livreurView') }}" class="text-blue-600 hover:underline">devenir livreur</a>

        </div>
        @else
             <div class="flex justify-center items-center">
            <a href="{{ route('livryShow') }}" class="text-blue-600 hover:underline">obtenir mon ma premiere livraison</a>

        </div>
        @endif
      
        @else

        <table class="tabble-auto w-full p-2">
            <thead class="bg-gray-200">
                <tr>
                    @if (auth()->user()->isAdmin()
                    )

                    <th class="border border-zinc-300">Livreur</th>
                    @endif
                    <th class="border border-zinc-300">Client</th>
                    <th class="border border-zinc-300">Ville</th>
                    <th class="border border-zinc-300">Quartier</th>
                    <th class="border border-zinc-300">Status</th>
                    <th class="border border-zinc-300">Date</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($acceptLivraisons as $accept)
                <tr>
                    @if (auth()->user()->isAdmin()
                    )
                    <td class="p-2 border border-zinc-300 ">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold flex items-center justify-center">
                                {{strtoupper(substr($accept->livreur->user->firstname,0,1) ) ?? "N/A"}}
                            </div>
                            <div class="ml-4 ">
                                {{ $accept->livreur->user->firstname ?? "N/A"}}
                            </div>
                        </div>

                    </td>
                    @endif


                    <td class="p-2 border border-zinc-300">{{ $accept->livrie->user->firstname ?? "inconnu"}}</td>
                    <td class="p-2 border border-zinc-300">{{ $accept->livrie->ville ?? "inconnu"}}</td>
                    <td class="p-2 border border-zinc-300">{{ $accept->livrie->quartier ?? "inconnu"}}</td>

                    <td class="p-2 border border-zinc-300">

                        @if($accept->status === 'accept')
                        <span class="text-yellow-500">Acceptée</span>
                        @else
                        <span class="text-green-600">Effectuée</span>
                        @endif

                    </td>
                    <td class="border px-4 py-2">{{ $accept->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

     <div class=" flex justify-center items-center mt-4">
    {{ $acceptLivraisons->links() }}
</div>

    </div>

</div>
@endif

</div>
@endsection