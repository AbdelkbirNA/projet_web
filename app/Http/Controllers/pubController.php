<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;

class pubController extends Controller
{

    public function index (){

        $publications = publication::paginate(10);


        return view("publications",compact('publications'));
    }
    public function all_pub(){

        // $publications = publication::latest()->get();
        $publication=publication::latest()->get();



        return view("publications.index",compact('publication'));
    }




    public function show (Publication $publication )
    {
        // $id = $request->id;

        // $publication = publication::findOrFail($id);
        // dd($publication);
        return view("publications.show",compact("publication"));

    }


    public function create(){

        return view("publications.create");
    }
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'titre_pub' => 'required|string|max:255',
            'year' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096', // Correspond à votre varchar(150)
            'description' => 'nullable|string' // Champ nullable comme dans votre structure
        ]);

        // Traitement de l'image
        $imagePath = $request->file('image')->store('publications', 'public');

        // Création
        Publication::create([
            'titre_pub' => $validated['titre_pub'],
            'year' => $validated['year'],
            'image' => $imagePath,
            'description' => $validated['description'] ?? null // Gestion de la valeur NULL
        ]);

        return redirect()->route('all_pub')->with('success', 'Publication créée avec succès');
    }


    public function Delete(Publication $publication)
    {
        $publication->delete();
        return redirect()->route('all_pub')->with("success","delete with successful");
    }

    public function edit(Publication $publication){

        return view("publications.edit",compact('publication'));
    }
    public function update(Request $request, Publication $publication)
    {
        $validatedData = $request->validate([
            'titre_pub' => 'required',
            'year' => 'required|date',
            'image' => 'sometimes|image|max:4096',
            'description' => 'nullable' // ou 'required' selon vos besoins
        ]);

        $publication->update($validatedData);

        return redirect()->route('all_pub', $publication->id)
               ->with('success', 'Publication mise à jour avec succès');
    }


}