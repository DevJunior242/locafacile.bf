<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProfileComplete;

use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class UserController extends Controller
{
    public function UserCreate()
    {
        return view('user.UserCreate');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'firstname' => ['required', 'regex:/^[\pL\s\-]+$/u', 'min:2', 'max:55',],
                'lastname' => ['required', 'regex:/^[\pL\s\-]+$/u', 'min:2', 'max:55',],
                'email' => 'bail|required|email|unique:users',
                'password' => 'bail|required|min:8|confirmed',
                'role' => ['bail', 'required', 'string', Rule::in(['bailleur', 'locataire', 'admin'])],
                'phone' => ['bail', 'required', 'regex:/^(\+226|00226)?[0567]\d{7}$/', 'unique:users'],
            ],
            [
                'phone.regex' => 'Le numéro de téléphone doit être un numéro valide du Burkina Faso (+226).',
                'phone.required' => 'Le numéro de télephone est obligatoire.',
                'phone.unique' => 'Le numéro de téléphone doit etre unique',
                'role.required' => 'veuillez choisir un role',
                'password.required' => 'Le mot de passe est obligatoire.',
                'password.min' => 'minimum 8 caracteres requis.',
                'password.confirmed' => 'la confirmation du mot de passe ne correspond pas.',
                'email.required' => 'L\'address email est requis.',
                'email.unique' => 'L\'address email est unique.',
                'firstname.required' => 'Le nom est obligatoire',
                'firstname.regex' => 'Le nom ne doit contenir que des lettres et des espaces.',
                'lastname.required' => 'Le prenom est obligatoire',
                'lastname.regex' => 'Le prenom ne doit contenir que des lettres et des espaces.',
            ]
        );
        if ($request->role === 'admin' && Auth::user()?->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' =>  $request->input('email'),
            'password' => Hash::make($request->password),
            'phone' =>  $request->phone,
            'role' => $request->role,
        ]);
        return redirect()->route('login');
    }
    public function completeProfile()
    {
        return view('auth.completeprofile');
        
    }
    public function completeProfileUpdate(ProfileComplete $request)
    {

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        } else {
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->role = $request->role;
            $user->phone = $request->phone;
            $user->save();
         }

        return  redirect()->intended('dashboard');
    }


    public function login()
    {
        return view('user.login');
    }

    public function loginUpdate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([

            'email' => ['required', 'email'],

            'password' => ['required'],

        ], [
            'password.required' => 'Le mot de passe est obligatoire.',
            'email.required' => 'L\'address email est requis.',
            'email.email' => 'L\'address email doit etre valide.',

        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')
                ->with('success', 'Bienvenue  ' . Auth::user()->name . '!');
        }
        return back()->withErrors([
            'login' =>  'identifiants uncorectes'
        ])->withInput();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return  redirect()->route('login');
    }

    public function emailVerify()
    {
        return view('auth.verify-email');
    }

    public function emailVerifyUpdate(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('home');
    }

    public function emailResend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return redirect()->back()->with('success', 'le mail a été envoyé');
    }

    public function forgotPassword()
    {

        return view('auth.forgot-password');
    }
    public function passwordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::ResetLinkSent
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => (__($status))]);
    }

    public function resetPassword(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }
    public function resetPasswordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',

            'password' => 'required|min:8|confirmed'
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->ForceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email', [__($status)]]);
    }
}
