@extends('layout.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
    <div
        class="w-full max-w-2xl p-12 mx-4 text-center transition-all transform bg-white shadow-lg rounded-xl hover:shadow-xl">
        
        <!-- Error Icon -->
        <div class="flex items-center justify-center w-24 h-24 mx-auto mb-8 bg-red-100 rounded-full">
            <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>

        <!-- Main Content -->
        <h1 class="mb-6 text-4xl font-extrabold text-red-600">
            Échec du paiement !
        </h1>

        <p class="mb-8 text-xl text-gray-700">
            Votre paiement n'a pas pu être traité. Veuillez réessayer ou contacter le support.
        </p>

        <!-- Contact Information -->
        <div class="pt-8 mt-8 border-t border-gray-100">
            <p class="text-lg text-gray-700">
                Besoin d'aide ? Contactez-nous à :
            </p>
            <a href="mailto:devjunior242@gmail.com"
                class="inline-block mt-2 text-xl font-medium text-blue-600 transition-colors duration-200 hover:text-blue-800">
                devjunior242@gmail.com
            </a>
        </div>

        <!-- Retry Button -->
        <div class="mt-12">
            <a href="{{ url()->previous() }}"
                class="inline-block px-8 py-4 text-lg font-semibold text-white transition-colors duration-200 bg-red-600 rounded-lg hover:bg-red-700">
                Réessayer le paiement
            </a>
        </div>
    </div>
</div>
@endsection
