@extends('layout.app')

@section('content')
<div class="flex justify-center items-center bg-gray-100">

    <div>
        @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
            {{ session("success") }}
        </div>
        @endif
    </div>
    <div class="w-full max-w-3xl bg-white p-6 rounded-lg shadow-md">
        <p class="text-xl text-zinc-600">vous avez besoin de vérifier votre address email</p>
        <form action="{{ route('verification.send') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <button class="bg-green-600 text-white p-3 rounded-lg  w-full">cliquez pour vérifier l'email</button>
            </div>

        </form>

    </div>
</div>
@endsection