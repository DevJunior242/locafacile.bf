@extends('layout.app')
@section('content')
<div
    class="flex flex-col items-center justify-center min-h-screen p-4 space-y-4 antialiased text-gray-900 bg-gray-100 ">
    @if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
        {{ session("success") }}
    </div>
    @endif
    <main>
        <a href="{{ route('dashboard') }}" class="text-blue-600 text-xs"><i class="fa-solid fa-left-long"></i></a>
        <div class="w-full max-w-sm px-4 py-6 space-y-6 bg-white rounded-md ">



            <h1 class="text-xl font-semibold text-center">changer les informations de votre profile</h1>
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <input
                    class="w-full px-4 py-2 border border-zinc-300 rounded-md   focus:outline-none focus:ring focus:ring-blue-100 "
                    type="text" name="name" value="{{ auth()->user()->name }}" placeholder="Username" required />
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <input
                    class="w-full px-4 py-2 bg-zinc-500 border border-zinc-100 rounded-md   focus:outline-none focus:ring focus:ring-blue-600 "
                    type="email" name="email" value="{{ auth()->user()->email }}" placeholder="Email address" disabled
                    readonly />
                <small>pour modifier votre address email , veuillez contacter le support</small>
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror


                <input type="text" name="phone" value="{{ auth()->user()->phone }}"
                    class="w-full px-4 py-2 border border-zinc-300 rounded-md    focus:outline-none focus:ring focus:ring-blue-600 "
                    placeholder="Téléphone">
                @error('phone')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror



                <div class="mt-4 bg-white p-6 text-blue-600 border border-zinc-300 rounded-md shadow-md">
                    <button type="submit"
                        class="w-full px-4 py-2 font-medium text-center bg-blue-600 text-white transition-colors duration-200 rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-1 ">
                        enregistrer les modifications
                    </button>
                </div>
            </form>


        </div>
    </main>
</div>




@endsection