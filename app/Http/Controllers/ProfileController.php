<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Formation;
use App\Models\Competence;
use App\Models\Experience;
use App\Models\Course;
class ProfileController extends Controller
{
    // Affiche le formulaire de création
   public function create()
{
    // Vérifie si l'utilisateur est un professeur
    if (auth()->user()->user_type !== 'professor') {
        return redirect()->route('home');
    }

    // Vérifie si le professeur a déjà un profil
    $profile = Profile::where('user_id', auth()->id())->first();
    if ($profile) {
        return redirect()->route('profile.edit');
    }

    // Crée un objet profile temporaire pour le header
    $profile = new \stdClass();
    $profile->user_id = auth()->id();

    return view('profile.create', compact('profile'));
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

    public function show()
    {
        $profile = Profile::where('user_id', Auth::id())->with(['formations', 'competences', 'experiences'])->first();
        
        if (!$profile) {
            return redirect()->route('profile.create')->with('warning', 'Veuillez d\'abord créer votre profil.');
        }

        return view('profile.about', compact('profile'));
    }

    public function showProfessor($id)
{
    $profile = Profile::where('user_id', $id)->with(['formations', 'competences', 'experiences'])->first();
    
    if (!$profile) {
        return redirect()->back()->with('error', 'Profil non trouvé.');
    }

    return view('professor.show', compact('profile'));
}

public function professorCourses($id)
{
    $courses = Course::where('user_id', $id)->get();
    $professor = Profile::where('user_id', $id)->first();
    return view('courses.index', compact('courses', 'professor'));
}
public function showAbout($id)
{
    $profile = Profile::where('user_id', $id)->with(['formations', 'competences', 'experiences'])->first();

    if (!$profile) {
        return redirect()->back()->with('error', 'Profil non trouvé.');
    }

    return view('profile.about', compact('profile'));
}


    public function index()
    {
        $professors = Profile::whereHas('user', function($query) {
            $query->where('user_type', 'professor');
        })->with('user')->get();

        return view('Ensiasd.professors', compact('professors'));
    }

    public function edit()
    {
        $profile = Profile::where('user_id', auth()->id())->firstOrFail();
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'specialite' => 'nullable|string|max:255',
            'reseaux_sociaux' => 'nullable|string|max:255',
            'biographie' => 'nullable|string',
        ]);

        $profile->update($validated);

        return redirect()->route('profile.about')->with('success', 'Profil mis à jour avec succès.');
    }

    
}
