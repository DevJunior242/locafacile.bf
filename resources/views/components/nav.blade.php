<nav class="bg-white shadow-lg">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="{{url('/') }}" class="flex items-center space-x-3 text-2xl text-blue-700 font-semibold">

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
      LocaZenFaso.bf
    </a>
    <button data-collapse-toggle="navbar-default" type="button"
      class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-800 rounded-lg md:hidden   border-t "
      aria-controls="navbar-default" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M1 1h15M1 7h15M1 13h15" />
      </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0">
        <li>
          <a href="{{ url('publish') }}"
            class="block py-2 px-3 text-zinc-700 font-black hover:text-blue-600 text-sm">publier</a>
        </li>


        <li>
          <a href="{{ url('livreur') }}"
            class="block py-2 px-3 text-zinc-700 font-black hover:text-blue-600 text-sm">clients</a>
        </li>

        <li>
          <a href="{{ url('dashboard') }}"
            class="block py-2 px-3 text-zinc-700 font-black hover:text-blue-600 text-sm">dashboard</a>
        </li>

        <li>
          <a href="{{ url('contact') }}"
            class="block py-2 px-3 text-zinc-700 font-black hover:text-blue-600 text-sm">Contact</a>
        </li>

        <li>


          <!-- Notification dropdown -->
          <div x-data="{ open: false }" x-init="open = false" class="relative">
            <button @click="open = !open" class="relative w-8 h-8 flex items-center justify-center top-0.5">
              <i class="fas fa-bell text-gray-900 hover:text-blue-500 text-lg"></i>
              <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1 rounded-full">
                {{ auth()->user()->unreadNotifications->count() }}
              </span>
            </button>

            {{--
            <!-- Dropdown -->
            x-show="open" @click.away="open = false" x-transition --}}
            <div x-show="open" @click.outside="open = false" x-cloak x-transition
              class="absolute -right-12 mt-2 bg-white w-72 z-10 shadow-md rounded-md border border-gray-200 p-2">
              @foreach (auth()->user()->unreadNotifications->take(1) as $notification)
              @if (isset($notification->data['publish_id']))
              <div class="divide-y divide-gray-100">
                <a href="#" class="flex items-start px-4 py-3 hover:bg-gray-50">
                  <div class="flex-shrink-0 bg-green-100 p-2 rounded-full text-green-600">
                    <i class="fas fa-truck"></i>
                  </div>
                  <div class="ml-3">
                    <p>livraison disponible</p>
                    <a href="{{ url('livryShow') }}" class="leading-4 text-blue-600 text-xs ">
                      {{ $notification->data['message'] }}
                    </a>
                    <p class="text-xs text-gray-500">
                      @if (isset($notification->data['repliedTime']))
                      {{ \Carbon\Carbon::parse($notification->data['repliedTime'])->diffForHumans() }}
                      @endif
                    </p>
                  </div>
                </a>
              </div>
              <div class="flex items-center px-4 py-2 border border-gray-300 hover:bg-gray-200">
                <a href="{{ url('notif/'.$notification->id) }}" class="block text-red-800">marquer comme lu</a>
              </div>
              @endif
              @endforeach
            </div>
          </div>

        </li>
             @auth
        <li>
     


          <div x-data="{ open: false }" x-init="open = false" class="relative">
            <!-- Bouton -->
            <button @click="open = !open" @click.away="open = false"
              class="flex items-center space-x-2 text-zinc-700 font-black px-3 py-2 hover:text-blue-600 -mt-1">
            
              <i class="fas fa-user text-lg"></i>

             
              <span>{{ auth()->user()->lastname ?? 'Mon Compte' }}</span>
            </button>

            <!-- Dropdown -->
            <ul x-show="open" x-transition x-cloak
              class="absolute right-0 bg-white shadow-lg rounded-md w-40 mt-2 text-zinc-900 border border-gray-300 z-10">
              <li><a href="{{ route('profile') }}"
                  class="block px-4 py-2 border-t border-gray-300 hover:bg-gray-100">Voir mon profil</a></li>
               
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit"
                    class="block px-4 py-2 text-red-600 border-t border-gray-300 w-full text-left hover:bg-gray-100">Se
                    déconnecter</button>
                </form>
              </li>
            </ul>
          </div>
        


        </li>
          @endauth
      </ul>
    </div>
  </div>
</nav>


<div>
  {{ $slot }}
</div>



<script>
  document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.querySelector("[data-collapse-toggle]");
    const navbarMenu = document.getElementById("navbar-default");

    toggleButton.addEventListener("click", function () {
        const isExpanded = navbarMenu.classList.contains("hidden");
        if (isExpanded) {
            navbarMenu.classList.remove("hidden");
        } else {
            navbarMenu.classList.add("hidden");
        }
    });
});

</script>