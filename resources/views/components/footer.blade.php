<footer class="bg-white text-blue-700 py-24 mt-10 ">


    <div class="max-w-7xl mx-auto px-4  sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6  ">

            <div class="flex  flex-col items-center">
                <h3 class="text-lg font-semibold text-zinc-900">À propos</h3>
                <ul class="mt-2 space-y-2 ">

                    <ul class="mt-2 space-y-2 ">
                        <li><a href="{{ route('fonctionnement') }}" class="text-xs hover:underline">Comment fonctionne
                                le site </a></li>
                        <li><a href="{{ route('qui') }}" class="text-xs hover:underline">Qui sommes-nous</a></li>

                    </ul>
                </ul>

            </div>


            <div class="flex  flex-col items-center">
                <h3 class="text-lg font-semibold text-zinc-900">Informations légales</h3>
                <ul class="mt-2 space-y-2 ">
                    <ul>
                        <li><a href="/cgu" class="text-xs hover:underline">Conditions d'utilisation</a></li>
                        <li><a href="/confidentialite" class="text-xs hover:underline">Politique de confidentialité</a>
                        </li>
                        <li><a href="/legale" class="text-xs hover:underline">Mentions légales</a></li>
                    </ul>
                </ul>
            </div>
            <div class="flex  flex-col items-center">
                <h3 class="font-bold mb-2 text-zinc-900">Assistance</h3>
                 

                    <ul class="mt-2 space-y-2 ">
 
                        <li><a href="{{ route
                        ('contact') }}" class="text-xs hover:underline">Contact</a></li>
                        <li><a href="{{ route('help') }}" class="text-xs hover:underline">Centre d'aide</a></li>
  
                    </ul>
                   
            </div>


            <div class="flex  flex-col items-center">
                <h3 class="text-lg font-semibold text-zinc-900">Réseaux sociaus</h3>

                <div class="flex space-x-4 mt-3 text-blue-600">
                    <a href="#" class=""><i class="fab fa-facebook"></i></a>
                    <a href="#" class=""><i class="fab fa-twitter"></i></a>
                    <a href="#" class=""><i class="fab fa-instagram"></i></a>

                </div>
            </div>
        </div>


        <div class="border-t border-gray-700 text-center text-sm text-gray-600 mt-6 pt-4">
            &copy; {{ date('Y') }} LocaZenFaso. Tous droits réservés.
        </div>
    </div>
    {{-- <div class="flex justify-center items-center mt-4 text-5xl sm:text-5xl md:text-9xl lg:text-9xl uppercase font-bold max-w-full  mx-auto ">
        <div class="text-red-600 ml-4">loca <span class="text-yellow-200">zen</span> <span class="text-green-600">faso</span></div>
      
    </div> --}}
    {{ $slot }}
</footer>



