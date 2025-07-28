@extends('layout.user')

@section('content')



<div
    class="flex flex-col items-center justify-center min-h-screen p-4 space-y-4 antialiased text-gray-900 bg-gray-100">

    <main>
        <div class="w-full max-w-[1100px] px-4 py-6 space-y-6 bg-white rounded-md ">


            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            <h1 class="text-xl font-semibold text-center">finalisez votre inscription</h1>
            <form action="{{ route('completeProfile.Update') }}" method="POST" class="space-y-6">
                @csrf


                <div>
                    <input
                        class="w-full px-4 py-2 border border-zinc-300 rounded-md   focus:outline-none focus:ring focus:ring-blue-600 "
                        type="text" name="firstname" value="{{ old('firstname') }}" placeholder="nom utilisateur"
                        required />
                    @error('firstname')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <input
                        class="w-full px-4 py-2 border border-zinc-300 rounded-md   focus:outline-none focus:ring focus:ring-blue-600 "
                        type="text" name="lastname" value="{{ old('lastname') }}" placeholder="votre prenom" required />
                    @error('lastname')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="text" name="phone"
                        class="w-full px-4 py-2 border border-zinc-300 rounded-md  focus:outline-none focus:ring focus:ring-blue-600 "
                        placeholder="Téléphone" value="{{ old('phone') }}" required>
                    @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="role" class="block mb-1">Veuillez choisir votre rôle</label>
                    <select name="role"
                        class="w-full px-4 py-2 border border-zinc-300 rounded-md  focus:outline-none focus:ring focus:ring-blue-600 "
                        required>
                        <option value="" disabled selected>Qui suis-je ?</option>
                        <option value="bailleur">Bailleur</option>
                        <option value="locataire">Locataire</option>
                        @if(Auth::check() && Auth::user()->role === 'admin')
                        <option value="admin">Administrateur</option>
                        @endif
                    </select>
                    @error('role')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button type="submit"
                        class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-blue-700 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-white">
                        valider
                    </button>
                </div>
            </form>



        </div>
    </main>
</div>

</div>

@endsection