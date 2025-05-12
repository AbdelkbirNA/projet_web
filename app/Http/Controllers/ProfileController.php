<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Formation;
use App\Models\Competence;
use App\Models\Experience;

class ProfileController extends Controller
{
    // Affiche le formulaire de création
    public function create()
    {
        return view('profile.create');
    }

    // Enregistre les données dans la base
    public function store(Request $request)
    {
        // 1. Valider les champs
        $data = $request->validate([
            'photo' => 'nullable|image',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'statut' => 'nullable|string',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string',
            'adresse' => 'nullable|string',
            'specialite' => 'nullable|string',
            'reseaux_sociaux' => 'nullable|string',
            'biographie' => 'nullable|string',

            // Tableaux imbriqués
            'formations.*.titre' => 'required|string',
            'formations.*.etablissement' => 'required|string',
            'formations.*.date_debut' => 'nullable|date',
            'formations.*.date_fin' => 'nullable|date',
            'formations.*.description' => 'nullable|string',

            'competences.*.nom' => 'required|string',
            'competences.*.niveau' => 'nullable|string',

            'experiences.*.titre' => 'required|string',
            'experiences.*.lieu' => 'nullable|string',
            'experiences.*.date_debut' => 'nullable|date',
            'experiences.*.date_fin' => 'nullable|date',
            'experiences.*.description' => 'nullable|string',
        ]);

        // 2. Gérer la photo si présente
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        // 3. Ajouter l'utilisateur connecté
        $data['user_id'] = Auth::id();

        // 4. Créer le profil
        $profile = Profile::create($data);

        // 5. Sauvegarder les formations
        if ($request->has('formations')) {
            foreach ($request->formations as $formation) {
                $profile->formations()->create($formation);
            }
        }

        // 6. Sauvegarder les compétences
        if ($request->has('competences')) {
            foreach ($request->competences as $competence) {
                $profile->competences()->create($competence);
            }
        }

        // 7. Sauvegarder les expériences
        if ($request->has('experiences')) {
            foreach ($request->experiences as $experience) {
                $profile->experiences()->create($experience);
            }
        }

        // 8. Rediriger avec message
        return redirect()->route('home')->with('success', 'Profil créé avec succès !');
    }
}
