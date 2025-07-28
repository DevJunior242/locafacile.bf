<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePublishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
                'replicate_id' => 'nullable|exists:publishes,id',
                'titre' => ['bail', 'required', 'regex:/^[\pL\s\d\-]+$/u', 'max:50'],
                'description' => ['nullable', 'regex:/^[\pL\s\d\,\'\"\.\-\_\(\)]+$/u', 'min:100', 'max:500'],
                'prix' => 'bail|required|integer|min:12500|max:9999999999',
                'caution' => 'bail|required|integer|min:0|max:10',
                'avance' => 'bail|required|integer|min:0|max:10',
                'nombre_chambres' => 'bail|required|integer|min:0|max:20',
                'nombre_salons' => 'bail|required|integer|min:0|max:10',

                'ville' => ['required', Rule::in(['Ouagadougou'])],
                'quartier' => ['bail', 'required', 'regex:/^[\pL\s\d\-]+$/u', 'max:50'],
                'localisation' => ['bail', 'nullable', 'regex:/^[\pL\s\-]+$/u', 'max:50'],

                'file' => [
                    'bail',
                    'nullable',
                    'file',
                    'mimes:jpeg,jpg,png,mp4,webm',
                    function ($attribute, $value, $fail) {
                        $extension = $value->getClientOriginalExtension();
                        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                            $img = getimagesize($value->getRealPath());
                            if ($img[0] < 100 || $img[1] < 100) {
                                $fail('L\'image doit avoir une largeur et une hauteur d\'au moins 100 pixels');
                            }

                            if ($img[0] / $img[1] > 5 || $img[1] / $img[0] > 5) {
                                $fail('la ratio de l\'image est trop extreme');
                            }
                        }

                        if (in_array($extension, ['mp4', 'webm'])) {

                            if ($value->getSize() > 50 * 1024 * 1024) {
                                $fail('La vidéo est trop lourde. Maximum 50 Mo autorisés.');
                                return;
                            }
                            try {
                                $ffprobe = \FFMpeg\FFProbe::create();
                                $duration = $ffprobe->format($value->getRealPath())
                                    ->get('duration');
                                if ($duration < 30) {
                                    $fail('video trop courte ,choisir une video d\'au moins 30s ');
                                }
                                if ($duration > 300) {
                                    $fail('La durée de la video ne doit pas depasser 5 minutes');
                                }
                            } catch (Exception $e) {

                                $fail('Impossible de vérifier la vidéo. Elle est peut-être trop lourde ou corrompue.');
                            }
                        }
                    },
                    'max:50240',
                ],
                'douche' => ['required', Rule::in(['interne', 'externe', 'interne_et_externe'])],
                'securite' => ['required', Rule::in(['gardient', 'barbeles', 'cloture'])],
                'type_cour' => ['required', Rule::in(['commune', 'unique'])],
                'type_sol' => ['required', Rule::in(['carrelée', 'cimentée'])],
                'form_logement' => ['required', Rule::in(['appartement', 'villa_simple', 'villa_duplex', 'chambre_salon', 'entre_couche', 'studio', 'magasin', 'boutique'])],



                'eau' => 'required|boolean',
                'plafonnée' => 'required|boolean',

                'chateau_eau' => 'required|boolean',
                'climatisation' => 'required|boolean',
                'courant' => 'required|boolean',
                'garage_parking' => 'required|boolean',
                'jardin' => 'required|boolean',
                'meublée' => 'required|boolean',
                'terrasse' => 'required|boolean',
                'balcon' => 'required|boolean',
                'internet' => 'required|boolean',
                'cuisine' => 'required|boolean',
                'ventilateur' => 'required|boolean',

        ];
    }

    public function messages()
    {
        return  [
            'file.max' => 'la taille max de fichier est de 50 Mo',
            'file.mimes' => 'le format du  fichier est incorect',
            'file.required' => 'le fichier est requis',
            'nombre_chambres.max' => 'Le nombre de chambres ne peut pas dépasser 20.',
            'nombre_salons.max'   => 'Le nombre de salons ne peut pas dépasser 10.',
            'ville.in' => 'La ville doit etre Ougadougou',
            'ville.required' => 'la ville est requise',
            'ville.regex' => 'Le nom de la ville ne doit contenir que des lettres et des espaces.',
            'quartier.required' => 'le nom du quartier est requis',
            'quartier.regex' => 'Le nom du quartier ne doit contenir que des lettres et des espaces.',
            'description.required' => 'la description est requise',
            'description.regex' => ' la description ne doit contenir que des lettres, chiffres et alphanumerique',
            'description.min' => 'la description doit contenir au moins 100 mots',
            'description.max' => 'la description doit pas contenir plus de  500 mots',
            'titre.required' => 'le titre es requis',
            'titre.regex' => 'le titre ne doit contenir que des lettres, espacess et chiffres',
            'titre.max' => 'le titre ne doit pas dépasser 50 caractéres',
            'titre.min' => 'Le titre doit conténir au moins 5 caractéres',
            'prix.required' => 'le prix est requis',
            'prix.min' => 'Minimum 15000',
            'prix.max' => 'max 999999999',
            'caution.required' => 'La caution est requise.',
            'caution.integer' => 'La caution doit etre un nombre entier.',
            'avance.required' => 'L\'avance est requise.',
            'avance.integer' => 'L\'avance doit etre un nombre entier.',
            'nombre_salons.required' => 'Le nombre de salons est requis.',
            'nombre_salons.integer' => 'Le nombre des salons doit etre un nombre entier.',
            'nombre_chambres.required' => 'Le nombre de chambres est requis.',
            'nombre_chambres.integer' => 'Le nombre de chambres doit etre un nombre entier.',
            'douche.required' => 'La douche est requise',
            'eau.required' => 'cocher une case',
            'plafond.required' => 'cocher une case',
            'courant.required' => 'cocher une case',
            'securite.required' => 'cocher une case',
            'terrasse.required' => 'cocher une case',
            'meuble.required' => 'cocher une case',
            'internet.required' => 'cocher une case',
            'cuisine.required' => 'cocher une case',
            'balcon.required' => 'cocher une case',
            'jardin.required' => 'cocher une case',
            'garage_parking.required' => 'cocher une case',
            'climatisation.required' => 'cocher une case',
            'ventilateur.required' => 'cocher une case',
            'chateau_eau.required' => 'cocher une case',
        ];
    }
}
