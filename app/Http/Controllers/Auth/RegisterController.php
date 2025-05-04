<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Affiche le formulaire d'inscription
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Traite l'inscription d'un nouvel utilisateur
     */
    public function register(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required', 'in:student,professor'],
            'cne' => [
                'required_if:user_type,student',
                'nullable',
                'string',
                'size:10',
                'regex:/^[A-Za-z0-9]{10}$/',
                'unique:users'
            ],
            'matricule' => [
                'required_if:user_type,professor',
                'nullable',
                'string',
                'size:8',
                'regex:/^[A-Za-z0-9]{8}$/',
                'unique:users'
            ],
        ], [
            'cne.required_if' => 'Le CNE est obligatoire pour les étudiants',
            'cne.size' => 'Le CNE doit contenir exactement 10 caractères',
            'cne.regex' => 'Le CNE doit contenir uniquement des lettres et chiffres',
            'matricule.required_if' => 'Le matricule est obligatoire pour les professeurs',
            'matricule.size' => 'Le matricule doit contenir exactement 8 caractères',
            'matricule.regex' => 'Le matricule doit contenir uniquement des lettres et chiffres',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'cne' => $request->user_type === 'student' ? $request->cne : null,
            'matricule' => $request->user_type === 'professor' ? $request->matricule : null,
        ]);

        // Connexion automatique de l'utilisateur
        Auth::login($user);

        // Redirection vers la page d'accueil avec message de succès
        return redirect()->route('home')
            ->with('success', 'Inscription réussie ! Bienvenue ' . $user->name);
    }
}