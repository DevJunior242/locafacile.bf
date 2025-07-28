@extends('layout.dashboard')

@section('content')



<div class="bg-white shadow-md rounded-lg overflow-hidden gap-4 w-full mx-auto p-4 mt-4">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ( $locateurs as $locateur)
            
       
        <div class="mt-2 bg-gray-50 p-4 rounded-lg shadow border border-gray-200">
            <p><strong>Nom:</strong>{{ $locateur->name }}</p>
            <p><strong>Phone:</strong>{{ $locateur->phone }}</p>
            <p class="{{ $locateur->paiements_count == 0 ? 'text-red-600' : 'text-green-600' }}">
                <strong>Commands:</strong>
                {{
              $locateur->paiements_count }}


            </p>
            <p>
                <strong>Amount:</strong>{{ number_format( $locateur?->paiements_sum_amount ,0, ',', ' ' )}} F CFA 
            </p>
             
        </div>

        @empty
            <p>Aucun Locataire</p>
        @endforelse
         

    </div>

    <div class="mt-4 flex items-center justify-center">
        {{ $locateurs->links() }}
    </div>
</div>



@endsection