<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate(
            [
                'name' => ['required', 'regex:/^[\pL\s\-]+$/u', 'min:4', 'max:255',],
                'phone' => ['nullable', 'regex:/^(\+226|00226)?[0567]\d{7}$/', 'unique:users,phone,' . $user->id,],
            ],
            [
                'phone.regex' => 'Le numéro de téléphone doit être un numéro valide du Burkina Faso (+226).',
                                'phone.unique' => 'Le numéro de téléphone est déja utilisé.',

                'name.regex' => 'Le nom doit contenir des lettres.',
                'name.required' => 'Le nom est obligatoire.',
                'name.min' => 'Le nom doit contenir au moins 4 caracteres.',

                'name.max' => 'Le nom doit contenir au maximum 255 caracteres.',

            ]
        );
        $data = $request->only(['name']);
        if ($request->filled('phone')) {
            $data['phone'] = $request->phone;
        }

        $user->update($data);
        return redirect()->back()->with('success', 'votre profil a été mis à jour');
    }
}
