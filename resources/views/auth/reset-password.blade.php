@extends('layout.app')



<div class="flex justify-center items-center min-h-screen bg-gray-100">

    <div class="bg-white shadow-md p-6 rounded-lg w-full max-w-xl">
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
        <p class="text-md text-gray-700 uppercase fw-bold text-center">reinitialisez votre motde passe</p>
        <div class="">

            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <input type="hidden" name="token" value="{{ $token }}">
                </div>
                <div>
                    <input type="email" name="email" placeholder="votre address email" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="devjunior@gmail.com">

                    @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                </div>


                <div>
                    <input type="password" name="password"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Mot de passe" required>
                    @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="password" name="password_confirmation"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Confirmer le mot de passe" required>
                    @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white p-3 rounded hover:bg-blue-700 transition">mettre à
                        jour</button>
                </div>
            </form>
        </div>
    </div>








</div>