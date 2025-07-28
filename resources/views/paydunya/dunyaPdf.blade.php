@extends('layout.dashboard')

@section('content')



<div class="bg-white shadow-md rounded-lg overflow-x-scroll gap-4 w-full mx-auto p-4 mt-4">

    <h1 class="text-2xl capitalize text-blue-600 flex justify-center items-center mb-4">telécharger les factures de
        paiement </h1>
    <table class="tabble-auto w-full p-2  ">
        <thead class="bg-gray-200">
            <tr>

                <th class="border border-zinc-300">Nom</th>
                <th class="border border-zinc-300">Email</th>
                <th class="border border-zinc-300">Phone</th>
                <th class="border border-zinc-300">amount</th>

                <th class="border border-zinc-300 p-2">Statut</th>

                <th class="border border-zinc-300 p-2">date</th>
                <th class="border border-zinc-300">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paydunya as $pay)

            <tr>
                
                <td class="p-2 border border-zinc-300">{{ $pay->customer_name }}</td>
                <td class="p-2 border border-zinc-300">{{ $pay->customer_email }}</td>
                <td class="p-2 border border-zinc-300">{{ $pay->customer_phone }}</td>
                <td class="p-2 border border-zinc-300">{{ $pay->amount }}</td>

                <td class="p-2 border border-zinc-300">{{
                    $pay->payment_status }}</td>

                <td class="p-2 border border-zinc-300 text-xs">{{ $pay->created_at->format('d/m/Y à H:i:s') }}</td>
                <td class="p-2 border border-zinc-300">
                    <a href="{{ url('dunyaPdf/' .$pay->id) }}"
                        class="text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-arrow-down-to-line-icon lucide-arrow-down-to-line">
                            <path d="M12 17V3" />
                            <path d="m6 11 6 6 6-6" />
                            <path d="M19 21H5" />
                        </svg>
                    </a>

                </td>
            </tr>


            @endforeach
        </tbody>
    </table>
    <div class="mt-4 flex items-center justify-center">
        {{ $paydunya->links() }}
    </div>
</div>



@endsection