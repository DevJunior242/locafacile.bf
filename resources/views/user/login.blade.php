@extends('layout.user')
@section('content')


<div
    class="flex flex-col items-center justify-center min-h-screen p-4 space-y-4 antialiased text-gray-900 bg-gray-100 ">
  
    <main>
        <div class="w-full max-w-sm px-4 py-6 space-y-6 bg-white rounded-md ">

            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            <h1 class="text-xl font-semibold text-center text-blue-600">Connexion</h1>
            <form action="{{ route('login.Update') }}" method="POST" class="space-y-6">
                @csrf
                <input
                    class="w-full px-4 py-2 border border-zinc-300 text-zinc-700 rounded-md   focus:outline-none focus:ring focus:ring-blue-100 "
                    type="email" name="email" placeholder="address email" value="{{ old('email') }}" required />
                @error('email')
                <span class="text-red-700 text-sm">{{ $message }}</span>
                @enderror
                <input
                    class="w-full px-4 py-2 border border-zinc-300 rounded-md  text-zinc-700  focus:outline-none focus:ring focus:ring-blue-600 "
                    type="password" name="password" placeholder="votre mot de passse" required />
                @error('password')
                <span class="text-red-700 text-sm">{{ $message }}</span>
                @enderror
                <div class="flex  justify-end">


                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline underline-offset-2 ">mot de passe
                        oublié?</a>
                </div>
                <div>
                    <button type="submit"
                        class="w-full px-4 py-2 font-medium text-center bg-blue-600 text-white transition-colors duration-200 rounded-md">
                        connecter
                    </button>
                </div>
            </form>

            <!-- Or -->
            <div class="flex items-center justify-center space-x-2 flex-nowrap">
                <span class="w-20 h-px bg-gray-300"></span>
                <span>OU</span>
                <span class="w-20 h-px bg-gray-300"></span>
            </div>

            <!-- Social login links -->
            <!-- Brand icons src https://boxicons.com -->
            <a href="{{ route('auth.google') }}"
                class="flex items-center justify-center px-4 py-2 space-x-2 text-white transition-all duration-200 bg-black rounded-md hover:bg-opacity-80 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-1 dark:focus:ring-offset-darker">
                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                    <path fill="#EA4335"
                        d="M24 9.5c3.5 0 6.4 1.2 8.5 3.2l6.3-6.3C34.6 2.3 29.7 0 24 0 14.6 0 6.5 5.8 2.5 14.2l7.4 5.7C12 13.2 17.5 9.5 24 9.5z" />
                    <path fill="#4285F4"
                        d="M46.1 24.5c0-1.6-.1-3.2-.4-4.7H24v9h12.4c-.5 2.7-2 5-4.2 6.6l6.6 5.1c3.8-3.5 6.3-8.8 6.3-16z" />
                    <path fill="#FBBC05" d="M10 28.4c-1.2-3.5-1.2-7.3 0-10.8L2.6 12C-.9 18.3-.9 29.7 2.6 36l7.4-5.6z" />
                    <path fill="#34A853"
                        d="M24 48c6.5 0 12-2.1 16-5.6l-7.4-5.7c-2.2 1.5-5.1 2.3-8.6 2.3-6.5 0-12-4.3-14-10.1l-7.4 5.7C6.5 42.2 14.6 48 24 48z" />
                    <path fill="none" d="M0 0h48v48H0z" />
                </svg>
                <span>continuer avec google</span>
            </a>



            <!-- Register link -->
            <div class="text-sm text-gray-600 ">
                pas encore compte? <a href="{{ route('UserCreate') }}" class="text-blue-600 hover:underline">créer un
                    compte</a>
            </div>
        </div>
    </main>
</div>


@endsection