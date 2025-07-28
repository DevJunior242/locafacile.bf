@extends('layout.app')
<div class="max-w-md mx-auto mt-4">
    @if (session('success'))
    <div class="bg-green-300 text-green-700 p-3 rounded-lg mb-4 text-center" role="alert">

        <span>{{ session("success") }}</span>

    </div>
    @endif

    @if ($errors->any())
    <div class="bg-red-300 text-red-700 p-3 rounded-lg mb-4 text-center" role="alert">
        @foreach ($errors->all() as $error)
        <span>{{ $error }}</span>
        @endforeach
    </div>
    @endif
<p class="text-center text-gray-800 font-bold capitalize">veuillez saisir email valide pour recevoir le lien de reinitialisation de mot de passe</p>
     <form action="{{ route('password.email') }}" method="POST" class="space-y-4 mt-4">
        @csrf
        <div>
            <input type="email" name="email" id="email"  value="{{ old('email') }}"  class="w-full p-2 border border-zinc-300 rounded-sm  focus:outline-none focus:ring-2 focus:ring-blue-600" required placeholder="email de reinitialisation de mot de passe">
        </div>
        <div class="form-group mt-2">
            <button class="w-full bg-blue-600 p-2 text-white text-md rounded">valider</button>
        </div>
    </form>
</div>