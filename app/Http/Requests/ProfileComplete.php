<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileComplete extends FormRequest
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
            'firstname' => ['required', 'regex:/^[\pL\s\-]+$/u', 'min:2', 'max:55',],
            'lastname' => ['required', 'regex:/^[\pL\s\-]+$/u', 'min:2', 'max:55',],

            'role' => ['required', 'string', Rule::in(['bailleur', 'locataire', 'admin'])],
            'phone' => ['bail', 'required', 'regex:/^(\+226|00226)?[0567]\d{7}$/', 'unique:users'],
        ];
    }

    public function messages()
    {
        return [
                'firstname.required' => 'Le nom est obligatoire',
                'firstname.regex' => 'Le nom ne doit contenir que des lettres et des espaces.',
                'lastname.required' => 'Le prenom est obligatoire',
                'lastname.regex' => 'Le prenom ne doit contenir que des lettres et des espaces.',

                'role.required' => 'veuillez choisir un role',
                'phone.regex' => 'Le numéro de téléphone doit être un numéro valide du Burkina Faso (+226).',

        ];
    }
}
