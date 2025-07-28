@extends('layout.dashboard')

@section('content')



<div class="bg-white  overflow-x-scroll gap-4 w-full mx-auto p-4">

    <h1 class="text-2xl capitalize text-blue-600 flex justify-center items-center mb-4">listes de utilisateurs
    </h1>
    <div class="flex justify-end ml-4 mb-4">
        <div class="relative">
            <form action="{{ route('user') }}" method="GET" class="flex mt-6 w-full max-w-xl overflow-x-scroll">
                <label for="search" class="sr-only">Rechercher</label>
                <input type="search" id="search" name="query" value="{{ request('query') }}" placeholder="Rechercher..."
                    class="flex-grow px-4 py-2 border border-gray-300 rounded-l-2xl focus:outline-none focus:ring-2 focus:ring-blue-600 bg-white/80 text-gray-900 placeholder-gray-600"
                    required>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-r-2xl hover:bg-blue-500 transition duration-300">
                    <i class="fa-solid fa-magnifying-glass"></i> </button>
            </form>
        </div>


    </div>

    <table class="tabble-auto w-full p-2  ">
        <thead class="bg-gray-200">
            <tr>

                <th class="border border-zinc-300">Nom</th>
                <th class="border border-zinc-300">Email</th>
                <th class="border border-zinc-300">Phone</th>
                <th class="border border-zinc-300">role</th>
                <th class="border border-zinc-300">Actions</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($users as $user)
            <tr>

                <td class="p-2 border border-zinc-300 ">
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold flex items-center justify-center">
                            {{strtoupper(substr($user->lastname,0,1) )}}
                        </div>
                        <div class="ml-4 ">
                            {{ $user->name}}
                        </div>
                    </div>

                </td>

                <td class="p-2 border border-zinc-300">{{ $user->email }}</td>
                <td class="p-2 border border-zinc-300">{{ $user->phone }}</td>
                <td class="p-2 border border-zinc-300">{{ $user->role}}</td>

                <td class="p-2 border border-zinc-300">
                    <div class="flex items-center">
                        @if ($user->isBan())
                        <a href="{{ url('unban/' . $user->id) }}" class="text-green-600">
                            unban
                        </a>
                        @else
                        <a href="{{ url('ban/' .$user->id) }}" class="text-red-600">
                            ban
                        </a>
                        @endif
                    </div>



                </td>
            </tr>

            @empty
            <p>aucun utilisateur</p>
            @endforelse


        </tbody>
    </table>
    <div class="mt-4 flex items-center justify-center">
        {{ $users->links() }}
    </div>
</div>



@endsection