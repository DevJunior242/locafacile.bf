@extends('layout.app')


@section('content')
<x-nav />

<div class="flex flex-col items-center justify-center   bg-white mt-12">
    <div class="w-full max-w-[1100px] px-4 py-6 space-y-6 bg-white rounded-md shadow-md">

        <h1 class="text-xl text-blue-600 uppercase font-bold">Publier une nouvelle Maison</h1>
        <div class="mt-2">
            @if ($errors->any())
            <div class="bg-red-100/50 text-red-700 p-3 rounded text-center">
                @foreach ($errors->all() as $error)
                <span>{{ $error }}</span>
                @endforeach
            </div>
            @endif
        </div>
        <form action="{{ route('publishStore') }}" enctype="multipart/form-data" method="POST" class="space-y-6">
            @csrf
            <div class="space-y-4">
                <input type="text" name="titre" required value="{{ old('titre') }}"
                    class="w-full px-4 py-2 border border-zinc-300 rounded-md focus:outline-none focus:ring focus:ring-blue-600 focus:ring-offset-1"
                    placeholder="Ex: Maison VIP à Ouaga 2000">
                @error('titre')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror


                <input type="text" name="ville" required value="{{ old('ville') }}"
                    class="w-full px-4 py-2 border border-zinc-300 rounded-md focus:outline-none focus:ring focus:ring-blue-600 focus:ring-offset-1"
                    placeholder="ajouter le nom de la ville">
                @error('ville')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror


                <input type="text" name="quartier" required value="{{ old('quartier') }}"
                    class="w-full px-4 py-2 border border-zinc-300 rounded-md focus:outline-none focus:ring focus:ring-blue-600 focus:ring-offset-1"
                    placeholder="ajouter le nom du quartier">
                @error('quartier')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror


              <div>
                  <small>Localisation</small>
                <input type="text" name="localisation" value="{{ old('localisation') }}"
                    class="w-full px-4 py-2 border border-zinc-300 rounded-md focus:outline-none focus:ring focus:ring-blue-600 focus:ring-offset-1"
                    placeholder="exp:coté de siao, ids, badenya etc">
                @error('localisation')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
              </div>


                <div>
                    <input type="number" name="nombre_chambres" required min="0" max="20" step="1"
                        value="{{ old('nombre_chambres') }}"
                        class="w-full px-4 py-2 border border-zinc-300 rounded-md focus:outline-none focus:ring focus:ring-blue-600 focus:ring-offset-1"
                        placeholder="Nombres de  chambress">
                    @error('nombre_chambres')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="number" name="nombre_salons" required min="0" max="10" step="1"
                        value="{{ old('nombre_salons') }}"
                        class="w-full px-4 py-2 border border-zinc-300 rounded-md focus:outline-none focus:ring focus:ring-blue-600 focus:ring-offset-1"
                        placeholder="nombre de salon">
                    @error('nombre_salons')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="etage" class="text-xs">etage(facultatif)</label>
                    <input type="number" name="etage"  min="0" max="10" step="1" value="{{ old('etage') }}"
                        class="w-full px-4 py-2 border border-zinc-300 rounded-md focus:outline-none focus:ring focus:ring-blue-600 focus:ring-offset-1"
                        placeholder="ex:0(RDc), 1, 2 , etc ">
                    <small class="text-xs text-zinc-500">
                        Indique l’étage uniquement si le logement est situé en hauteur.
                        Par exemple : <strong>0</strong> pour le rez-de-chaussée, <strong>1</strong> pour le 1ᵉʳ étage,
                        etc.
                        <br>Tu peux laisser vide si ce n’est pas applicable.
                    </small>
                    @error('etage')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                <input type="number" name="prix" required min="12500" max="9999999999" step="1"
                    value="{{ old('prix') }}"
                    class="w-full px-4 py-2 border border-zinc-300 rounded-md focus:outline-none focus:ring focus:ring-blue-600 focus:ring-offset-1"
                    placeholder="Ajouter le prix de la maison">
                @error('prix')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror



                <div>
                    <small>caution de la location</small>
                    <input type="number" name="caution" required min="0" max="10" step="1" value="{{ old('caution') }}"
                        class="w-full px-4 py-2 border border-zinc-300 rounded-md focus:outline-none focus:ring focus:ring-blue-600 focus:ring-offset-1"
                        placeholder="exemple:2 mois">

                    @error('caution')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>



                <div>
                    <small>avance de la location</small>
                    <input type="number" name="avance" required min="0" max="10" step="1" value="{{ old('avance') }}"
                        class="w-full px-4 py-2 border border-zinc-300 rounded-md focus:outline-none focus:ring focus:ring-blue-600 focus:ring-offset-1"
                        placeholder="exemple: 1 mois">
                    @error('avance')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            {{-- type de location --}}
            <div class="space-y-4">

                <label for="type_cour" class="block mb-1">veuillez choisir votre type de location</label>
                <select name="type_cour"
                    class="w-full px-4 py-2 border border-zinc-300   rounded-md  focus:outline-none focus:ring focus:ring-blue-600  focus:ring-offset-1"
                    required>
                    <option value="" selected disabled>commune / unique?</option>
                    <option value="commune">commune</option>
                    <option value="unique">unique</option>



                </select>
                @error('type_cour')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <label for="form_logement" class="block mb-1">Veuillez choisir votre forme de logement</label>
                <select name="form_logement"
                    class="w-full px-4 py-2 border border-zinc-300 rounded-md  focus:outline-none focus:ring focus:ring-blue-600  focus:ring-offset-1"
                    required>
                    <option value="" selected disabled>formes de logement?</option>
                    <option value="appartement">appartement</option>
                    <option value="villa_simple">villa simple</option>
                    <option value="villa_duplex">villa duplex</option>
                    <option value="chambre_salon">chambre salon</option>
                    <option value="entre_couche">entré couché</option>
                    <option value="studio">studio</option>
                    <option value="magasin">magasin</option>
                    <option value="boutique">boutique</option>
                </select>
                @error('form_logement')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <label for="type_sol" class="block mb-1">type sol</label>
                <select name="type_sol"
                    class="w-full px-4 py-2 border border-zinc-300 rounded-md  focus:outline-none focus:ring focus:ring-blue-600  focus:ring-offset-1"
                    required>
                    <option value="" selected disabled>selectionner</option>
                    <option value="carrelée">carrelée</option>
                    <option value="cimentée">cimentée</option>

                </select>
                @error('type_sol')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-4">
                <!-- Equipements -->
                <fieldset class="border border-zinc-300 p-4 rounded-md">
                    <legend class="text-md font-semibold text-gray-600">Équipements disponibles</legend>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <!-- Eau -->
                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="eau" value="1" {{ old('eau')=='1' ? 'checked' : '' }}
                                    class="accent-blue-600">
                                <span>Eau disponible</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="eau" value="0" {{ old('eau')=='0' ? 'checked' : '' }}
                                    class="accent-red-600">
                                <span>Pas d'eau</span>
                            </label>
                            @error('eau')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror

                        </div>

                        {{-- cuisine --}}
                        <div>

                            <label class="flex items-center space-x-2">
                                <input type="radio" name="cuisine" value="1" {{ old('cuisine')=='1' ? 'checked' : '' }}
                                    class="accent-blue-600">
                                <span>cuisine disponible</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="cuisine" value="0" {{ old('cuisine')=='0' ? 'checked' : '' }}
                                    class="accent-red-600">
                                <span>Pas d'cuisine</span>
                            </label>
                            @error('cuisine')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror

                        </div>
                        <!-- Courant -->

                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="courant" value="1" {{ old('courant')=='1' ? 'checked' : '' }}
                                    class="accent-blue-600">
                                <span>Courant disponible</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="courant" value="0" {{ old('courant')=='0' ? 'checked' : '' }}
                                    class="accent-red-600">
                                <span>Pas de courant</span>
                            </label>
                            @error('courant')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- plafond --}}
                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="plafonnée" value="1" {{ old('plafonnée')=='1' ? 'checked' : ''
                                    }} class="accent-blue-600">
                                <span>Plafonnée</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="plafonnée" value="0" {{ old('plafonnée')=='0' ? 'checked' : ''
                                    }} class="accent-red-600">
                                <span>Non Plafonnée</span>
                            </label>
                            @error('plafonnée')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Ventilateur -->

                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="ventilateur" value="1" {{ old('ventilateur')=='1' ? 'checked'
                                    : '' }} class="accent-blue-600">
                                <span>Ventilateur disponible</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="ventilateur" value="0" {{ old('ventilateur')=='0' ? 'checked'
                                    : '' }} class="accent-red-600">
                                <span>Pas de ventilateur</span>
                            </label>
                            @error('ventilateur')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- clim --}}
                        <div>

                            <label class="flex items-center space-x-2">
                                <input type="radio" name="climatisation" value="1" {{ old('climatisation')=='1'
                                    ? 'checked' : '' }} class="accent-blue-600">
                                <span>climatisation disponible</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="climatisation" value="0" {{ old('climatisation')=='0'
                                    ? 'checked' : '' }} class="accent-red-600">
                                <span>Pas de climatisation</span>
                            </label>
                            @error('climatisation')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- garage --}}
                        <div>

                            <label class="flex items-center space-x-2">
                                <input type="radio" name="garage_parking" value="1" {{ old('garage_parking')=='1'
                                    ? 'checked' : '' }} class="accent-blue-600">
                                <span>garage_parking disponible</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="garage_parking" value="0" {{ old('garage_parking')=='0'
                                    ? 'checked' : '' }} class="accent-red-600">
                                <span>Pas de garage_parking</span>
                            </label>
                            @error('garage_parking')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- jardin --}}

                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="jardin" value="1" {{ old('jardin')=='1' ? 'checked' : '' }}
                                    class="accent-blue-600">
                                <span>jardin disponible</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="jardin" value="0" {{ old('jardin')=='0' ? 'checked' : '' }}
                                    class="accent-red-600">
                                <span>Pas de jardin</span>
                            </label>
                            @error('jardin')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- balcon --}}

                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="balcon" value="1" {{ old('balcon')=='1' ? 'checked' : '' }}
                                    class="accent-blue-600">
                                <span>balcon disponible</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="balcon" value="0" {{ old('balcon')=='0' ? 'checked' : '' }}
                                    class="accent-red-600">
                                <span>Pas de balcon</span>
                            </label>
                            @error('balcon')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror

                        </div>
                        {{-- terrass --}}

                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="terrasse" value="1" {{ old('terrasse')=='1' ? 'checked' : ''
                                    }} class="accent-blue-600">
                                <span>terrasse disponible</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="terrasse" value="0" {{ old('terrasse')=='0' ? 'checked' : ''
                                    }} class="accent-red-600">
                                <span>Pas de terrasse</span>
                            </label>
                            @error('terrasse')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror

                        </div>
                        {{-- meuble --}}

                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="meublée" value="1" {{ old('meublée')=='1' ? 'checked' : '' }}
                                    class="accent-blue-600">
                                <span>battiment meublé </span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="meublée" value="0" {{ old('meublée')=='0' ? 'checked' : '' }}
                                    class="accent-red-600">
                                <span>non meublé</span>
                            </label>
                            @error('meublée')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- internet --}}

                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="internet" value="1" {{ old('internet')=='1' ? 'checked' : ''
                                    }} class="accent-blue-600">
                                <span>internet disponible</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="internet" value="0" {{ old('internet')=='0' ? 'checked' : ''
                                    }} class="accent-red-600">
                                <span>Pas de internet</span>
                            </label>
                            @error('internet')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- chateau_eau --}}

                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="chateau_eau" value="1" {{ old('chateau_eau')=='1' ? 'checked'
                                    : '' }} class="accent-blue-600">
                                <span>chateau_eau disponible</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="chateau_eau" value="0" {{ old('chateau_eau')=='0' ? 'checked'
                                    : '' }} class="accent-red-600">
                                <span>Pas de chateau_eau</span>
                            </label>
                            @error('chateau_eau')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </fieldset>
            </div>
            <div class="space-y-4">

                <label for="douche" class="block mb-1">douche interne / externee</label>
                <select name="douche"
                    class="w-full px-4 py-2 border border-zinc-300   rounded-md  focus:outline-none focus:ring focus:ring-blue-600  focus:ring-offset-1"
                    required>
                    <option value="" selected disabled>interne / externe?</option>
                    <option value="interne">interne</option>
                    <option value="externe">externe</option>
                    <option value="interne_et_externe">interne et externe</option>



                </select>
                @error('douche')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <label for="securite" class="block mb-1">Veuillez choisir votre model de securité</label>
                <select name="securite"
                    class="w-full px-4 py-2 border border-zinc-300 rounded-md  focus:outline-none focus:ring focus:ring-blue-600  focus:ring-offset-1"
                    required>
                    <option value="" selected disabled>model de securite?</option>
                    <option value="gardient">gardient</option>
                    <option value="barbeles">barbelés</option>
                    <option value="cloture">clôture</option>

                </select>
                @error('securite')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <p id="error" class="text-red-600 text-sm hidden"></p>

                <input type="file" name="file" id="inputFile"
                    class="w-full px-4 py-2 border border-zinc-300 rounded-md focus:outline-none focus:ring focus:ring-blue-600 focus:ring-offset-1"
                    required accept="image/*, video/*">
                @error('file')
                <span class="text-red-600 ">{{ $message }}</span>
                @enderror

            </div>
            <div class="">

                <textarea name="description" cols="20" rows="5"
                    class="w-full border border-zinc-300 rounded-md focus:outline-none focus:ring focus:ring-blue-600 focus:ring-offset-1"
                    placeholder="Appartement de 2 chambres situé à Tampouy. Parfait pour jeune couple ou étudiant.">{{ old('description') }}</textarea>
                @error('description')
                <span class="text-red-600 ">{{ $message }}</span>
                @enderror

            </div>
            <div class="">
                <button type="submit" class="py-4 text-white bg-blue-500   w-full !rounded-lg">publier!</button>

            </div>

        </form>

    </div>
</div>
<x-footer />
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function(){
        const inputFile = document.getElementById('inputFile');
        const error = document.getElementById('error');

         inputFile.addEventListener('change', function(){
             const file = this.files[0];
             if(file)
             {
                const fileType = file.type;
                const maxSize = 50 * 1024 * 1024;

                const validateFileType = ['image/jpeg', 'image/png','image/jpg', 'video/mp4', 'video/webm'];
                if(!validateFileType.includes(fileType)){
                    error.textContent = 'veuillez choisir un fichier image ou video valide(jpeg, png, jpg, mp4,  webm)';
                    error.classList.remove('hidden');
                    inputfile.value = '';
                    return;
                }

                if(file.size > maxSize){
                    error.textContent = 'le fichier ne doit pas depasser 50 Mo';
                    error.classList.remove('hidden');
                    inputFile.value = '';
                    return;

                } 
                
                    error.classList.add('hidden');
                    error.textContent = '';
                
             }
         });
    });
</script>