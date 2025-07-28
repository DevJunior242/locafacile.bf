@extends('layout.dashboard')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden gap-4 w-full mx-auto p-4 mt-4">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($bailleurs as $bailleur)
            
         
        <div class="mt-2 bg-gray-50 p-4 rounded-lg shadow border border-gray-200">
            <p><strong>Nom:</strong>{{ $bailleur->name }}</p>
            <p><strong>Phone:</strong>{{ $bailleur->phone }}</p>
            <p class="{{ $bailleur->publish->count() == 0 ? 'text-red-600' : 'text-green-600' }}">
                <strong>Publications:</strong>
                {{
                $bailleur->publish->count() }}


            </p>
            <p><strong>Amount:</strong>{{ number_format($bailleur->publish_sum_prix * 4 ,0, ',', ' ' )}} F CFA</p>
         
        </div>

        
        @empty
           <p class="text-xl text-center font-black">Aucun Bailleur</p> 
        @endforelse

    </div>
     
    <div class="mt-4 flex items-center justify-center">
        {{ $bailleurs->links() }}
    </div>
</div>
@endsection




