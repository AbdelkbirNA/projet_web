<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function main()
    {
        $professors = User::where('user_type', 'professor')->get();
        return view('student.main', compact('professors'));
    }

    public function showProfessorPublications(User $professor)
    {
        // Vérification supplémentaire pour s'assurer que c'est bien un professeur
        if (!$professor->isProfessor()) {
            abort(404);
        }

        $publications = $professor->publications;
        return view('student.professor_publications', compact('professor', 'publications'));
    }
}
