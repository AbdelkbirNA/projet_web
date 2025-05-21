<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    public function professorIndex()
    {
        try {
            $user = Auth::user();
            
            if (!$user || $user->user_type !== 'professor') {
                throw new \Exception('Access denied');
            }

            $publications = Publication::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('professor.publications.index', compact('publications'));

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('professor.publications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre_pub' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('publications', 'public');

        Publication::create([
            'titre_pub' => $request->titre_pub,
            'description' => $request->description,
            'year' => $request->year,
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('professor.publications.index')
                         ->with('success', 'Publication créée avec succès!');
    }

    public function edit($id)
    {
        $publication = Publication::where('user_id', Auth::id())
                                ->findOrFail($id);
        
        return view('professor.publications.edit', compact('publication'));
    }
    public function update(Request $request, Publication $publication)
    {
        // Validation
        $validated = $request->validate([
            'titre_pub' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($publication->image) {
                Storage::delete('public/' . $publication->image);
            }
            
            // Stocker la nouvelle image
            $path = $request->file('image')->store('publications', 'public');
            $validated['image'] = str_replace('public/', '', $path);
        }
    
        // Mise à jour
        $publication->update($validated);
    
        return redirect()->route('professor.publications.index')
                       ->with('success', 'Publication mise à jour avec succès');
    }

    public function destroy($id)
    {
        $publication = Publication::where('user_id', Auth::id())
                                 ->findOrFail($id);
        
        Storage::disk('public')->delete($publication->image);
        $publication->delete();

        return redirect()->route('professor.publications.index')
                         ->with('success', 'Publication supprimée avec succès!');
    }

    public function studentIndex()
    {
        $publications = Publication::with(['user' => function($query) {
                $query->select('id', 'name', 'user_type');
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.publications.index', [
            'publications' => $publications
        ]);
    }
}