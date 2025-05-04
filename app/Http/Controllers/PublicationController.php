<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Support\Facades\Auth;

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

    public function studentIndex()
    {
        // Récupération de toutes les publications avec leurs auteurs
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