<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>dashboard</title>
    @vite('resources/css/app.css')

   
</head>

<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar - Caché sur mobile -->
        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-64 bg-blue-800">
                <div class="flex items-center justify-center h-16 px-4 bg-blue-900">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3 text-2xl text-white font-semibold">
                        <span class="self-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-map-pin-house-icon lucide-map-pin-house">
                                <path
                                    d="M15 22a1 1 0 0 1-1-1v-4a1 1 0 0 1 .445-.832l3-2a1 1 0 0 1 1.11 0l3 2A1 1 0 0 1 22 17v4a1 1 0 0 1-1 1z" />
                                <path d="M18 10a8 8 0 0 0-16 0c0 4.993 5.539 10.193 7.399 11.799a1 1 0 0 0 .601.2" />
                                <path d="M18 22v-3" />
                                <circle cx="10" cy="10" r="3" />
                            </svg>
                        </span>
                        LocaZenFaso</a>

                </div>
                <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
                    <nav class="flex-1 space-y-1">
                        <!-- Tableau de bord -->

                        <a href="{{ url('dashboard') }}"
                            class="flex items-center px-4 py-3 text-white bg-blue-700 rounded-lg">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Tableau de bord
                        </a>

                        <!-- Utilisateurs -->
                        @can('isAdmin', \App\Models\User::class)

                        <a href="{{ route('user') }}"
                            class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">
                            <i class="fa-solid fa-users"></i>
                            Utilisateurs
                        </a>
                        @endcan


                        <!-- Locataires -->

                        @can('isAdmin', \App\Models\User::class)
                        <a href="{{ url('locataire') }}"
                            class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">
                            <i class="fas fa-house-user mr-3"></i>
                            Locataires
                        </a>

                        @endcan

                        <!-- Bailleurs -->
                        @can('isAdmin', \App\Models\User::class)

                        <a href="{{ url('bailleur') }}"
                            class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">
                            <i class="fas fa-user-tie mr-3"></i>
                            Bailleurs
                        </a>
                        @endcan
                        <!-- Livreurs -->
                        <a href="{{ url('livreurShow') }}"
                            class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">
                            <i class="fas fa-truck mr-3"></i>
                            Livreurs
                        </a>

                        <!-- Livraisons -->
                        <a href="{{ url('livryShow') }}"
                            class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">
                            <i class="fas fa-boxes mr-3"></i>
                            Livraisons
                        </a>

                  

                        <!-- Paiements -->
                        <a href="{{url('paymentDunya')}}"
                            class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">
                            <i class="fas fa-money-bill-wave mr-3"></i>
                            Paiements
                        </a>
                    </nav>

                    <!-- Section compte -->
                    <div class="mt-auto space-y-1 pb-4">
                        <a href="{{ route('cgu') }}" class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">
                            <i class="fas fa-cog mr-3"></i>
                            Paramètres
                        </a>
                        @auth
                        <form action="{{ route('logout') }}" method="POST"
                            class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">

                            @csrf
                            <button type="submit" class="block px-4 py-2  text-red-600 w-full text-left cursor-pointer">
                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion</button>
                        </form>


                        @endauth

                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="flex flex-col flex-1 overflow-hidden ">
            <!-- Header -->
            <header class="flex items-center justify-end h-16 px-4 bg-white border-b border-gray-200">
                <!-- Bouton menu mobile -->
                <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100">
                    <i class="fa-solid fa-bars"></i>
                </button>


                <!-- Notifications et profil -->
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button id="notifications-button" class="p-2 rounded-full text-gray-500 hover:bg-gray-100">
                            <i class="fas fa-bell"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1 rounded-full">{{
                                auth()->user()->unreadNotifications->count() }}</span>

                        </button>
                        <!-- Dropdown notifications -->
                        <div id="notifications-dropdown"
                            class="hidden absolute right-0 mt-2 w-72 bg-white rounded-md shadow-lg z-10">
                            <div class="p-4 border-b border-zinc-200">
                                <h3 class="font-medium">Notifications
                                    <span class=" text-red-600">({{
                                        auth()->user()->unreadNotifications->count() }})</span>
                                </h3>
                            </div>
                            @foreach (auth()->user()->unreadNotifications->take(1) as $notification)

                            @if (isset($notification->data['publish_id']))
                            <div class="divide-y divide-gray-100">
                                <a href="#" class="flex items-start px-4 py-3 hover:bg-gray-50">
                                    <div class="flex-shrink-0 bg-green-100 p-2 rounded-full text-green-600">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium">Livraison disponible</p>
                                        <a href="{{ url('livryShow') }}" class="leading-4 text-blue-600">{{
                                            $notification->data['message']}}</a>

                                        <p class="text-xs text-gray-500">
                                            @if (isset($notification->data['repliedTime']))
                                            {{
                                            \Carbon\Carbon::parse($notification->data['repliedTime'])->diffForHumans()
                                            }}
                                            @endif
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="flex items-center   px-4 py-2 border border-gray-200  hover:bg-gray-200">
                                <a href="{{ url('notif/'.$notification->id) }}" class="block  text-red-800 ">marquer
                                    comme
                                    lu</a>

                            </div>
                            @endif
                            @endforeach



                        </div>
                    </div>
                    @auth
                    <div class="relative">
                        <button id="profile-button" class="flex items-center  space-x-2">
                             
                            <i class="fas fa-user text-lg"></i>

                          
                            <span class="hidden md:inline text-sm font-medium">{{ auth()->user()->name }}</span>
                        </button>
                        <!-- Dropdown profil -->
                        <div id="profile-dropdown"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                            <div class="py-1">
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2"></i>Mon compte
                                </a>
                                
                                <div class="border-t border-gray-100"></div>
                                <form action="{{ route('logout') }}" method="POST"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    @csrf
                                    <button type="submit"
                                        class="block px-4 py-2  text-red-600 w-full text-left cursor-pointer"> <i
                                            class="fas fa-sign-out-alt mr-2"></i>Déconnexion</button>
                                </form>



                            </div>
                        </div>

                    </div>
                    @endauth
                </div>
            </header>

            <!-- Contenu -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6">

                <div>
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Menu mobile - caché par défaut -->
    <div id="mobile-menu" class="lg:hidden fixed inset-0 z-40 hidden">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
        <div class="fixed inset-y-0 left-0 flex flex-col w-64 bg-blue-800">
            <div class="flex items-center justify-between h-16 px-4 bg-blue-900">
                <a href="{{url('/') }}" class="flex items-center space-x-3 text-2xl text-white font-semibold">

                    <span class="self-center ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-map-pin-house-icon lucide-map-pin-house">
                            <path
                                d="M15 22a1 1 0 0 1-1-1v-4a1 1 0 0 1 .445-.832l3-2a1 1 0 0 1 1.11 0l3 2A1 1 0 0 1 22 17v4a1 1 0 0 1-1 1z" />
                            <path d="M18 10a8 8 0 0 0-16 0c0 4.993 5.539 10.193 7.399 11.799a1 1 0 0 0 .601.2" />
                            <path d="M18 22v-3" />
                            <circle cx="10" cy="10" r="3" />
                        </svg>
                    </span>
                    Locazenfaso
                </a>

                <button id="close-mobile-menu" class="p-2 text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
                <nav class="flex-1 space-y-1">

                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 text-white bg-blue-700 rounded-lg">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Tableau de bord
                    </a>
                    @can('isAdmin', \App\Models\User::class)
                    <a href="{{ route('user') }}" class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">
                        <i class="fas fa-users mr-3"></i>
                        Utilisateurs
                    </a>
                    <a href="{{ url('locataire') }}"
                        class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">
                        <i class="fas fa-house-user mr-3"></i>
                        Locataires
                    </a>
                    <a href="{{ url('bailleur') }}"
                        class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">
                        <i class="fas fa-user-tie mr-3"></i>
                        Bailleurs
                    </a>
                    @endcan
                    <a href="{{ url('livreurShow') }}"
                        class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">
                        <i class="fas fa-truck mr-3"></i>
                        Livreurs
                    </a>
                    <a href="{{ url('livryShow') }}"
                        class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">
                        <i class="fas fa-boxes mr-3"></i>
                        Livraisons
                    </a>
                   
                    <a href="{{ url('paymentDunya') }}"
                        class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">
                        <i class="fas fa-money-bill-wave mr-3"></i>
                        Paiements
                    </a>
                </nav>

                <div class="mt-auto space-y-1 pb-4">
                    <a href="#" class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">
                        <i class="fas fa-cog mr-3"></i>
                        Paramètres
                    </a>
                    @auth
                    <form action="{{ route('logout') }}" method="POST"
                        class="flex items-center px-4 py-3 text-white hover:bg-blue-600 rounded-lg">

                        @csrf
                        <button type="submit" class="block px-4 py-2  text-red-600 w-full text-left cursor-pointer"> <i
                                class="fas fa-sign-out-alt mr-2"></i>Déconnexion</button>
                    </form>


                    @endauth

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menu mobile
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const closeMobileMenu = document.getElementById('close-mobile-menu');
            
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.remove('hidden');
            });
            
            closeMobileMenu.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
            
            // Dropdown notifications
            const notificationsButton = document.getElementById('notifications-button');
            const notificationsDropdown = document.getElementById('notifications-dropdown');
            
            notificationsButton.addEventListener('click', function(e) {
                e.stopPropagation();
                notificationsDropdown.classList.toggle('hidden');
            });
            
            // Dropdown profil
            const profileButton = document.getElementById('profile-button');
            const profileDropdown = document.getElementById('profile-dropdown');
            
            profileButton.addEventListener('click', function(e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });
            
            // Fermer les dropdowns quand on clique ailleurs
            document.addEventListener('click', function() {
                notificationsDropdown.classList.add('hidden');
                profileDropdown.classList.add('hidden');
            });
        });

       
   
   
 
    </script>

</body>

</html>