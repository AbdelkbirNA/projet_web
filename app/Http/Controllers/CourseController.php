<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;

class CourseController extends Controller
{

    // Formulaire création
    public function create()
    {
        return view('courses.create');
    }
public function professorCourses($id)
{
    $courses = \App\Models\Course::where('user_id', $id)->get();
    $professor = \App\Models\Profile::where('user_id', $id)->first();
    return view('courses.index', compact('courses', 'professor'));
}
    // Enregistre un nouveau cours
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'syllabus' => 'nullable|string',
            'course_date' => 'nullable|date',
            'resources' => 'nullable|file|mimes:pdf,doc,docx,zip',
            'create_quiz' => 'nullable|boolean',
        ]);

        if ($request->hasFile('resources')) {
            $file = $request->file('resources');
            $filename = time().'_'.$file->getClientOriginalName();
            // Stocker dans 'public/resources'
            $file->storeAs('resources', $filename, 'public');
            // Stocker le chemin relatif complet en base
            $data['resources'] = 'resources/' . $filename;
        }

        $course = Course::create($data);

        if ($request->has('create_quiz') && $request->input('create_quiz')) {
            return redirect()->route('questions.create', $course);
        }

        return redirect()->route('courses.index')->with('success', 'Cours créé avec succès.');
    }

    // Affiche un cours en détail
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    // Formulaire édition
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    // Mise à jour d’un cours
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'syllabus' => 'nullable|string',
            'resources' => 'nullable|file|mimes:pdf,doc,docx,zip',
            'course_date' => 'nullable|date',
        ]);

        if ($request->hasFile('resources')) {
            if ($course->resources) {
                Storage::disk('public')->delete($course->resources);
            }
            // Stocker dans 'public/resources'
            $path = $request->file('resources')->store('resources', 'public');
            $course->resources = $path;
        }

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'syllabus' => $request->syllabus,
            'course_date' => $request->course_date,
        ]);

        $course->save();

        return redirect()->route('courses.index')->with('success', 'Cours mis à jour.');
    }

    // Supprimer un cours
    public function destroy(Course $course)
    {
        if ($course->resources) {
            Storage::disk('public')->delete($course->resources);
        }
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Cours supprimé.');
    }

    // Afficher la ressource
    public function viewResource($filename)
    {
        if (!Storage::disk('public')->exists($filename)) {
            abort(404, 'Fichier non trouvé.');
        }

        $file = Storage::disk('public')->get($filename);
        $mimeType = Storage::disk('public')->mimeType($filename);

        return response($file, 200)->header('Content-Type', $mimeType);
    }

    // Télécharger la ressource
    public function downloadResource($filename)
    {
        if (!Storage::disk('public')->exists($filename)) {
            abort(404, 'Fichier non trouvé.');
        }

        return Storage::disk('public')->download($filename);
    }

   public function index(Request $request)
{
    $query = Course::query();

    if ($request->filled('course_date')) {
        $query->whereDate('course_date', $request->course_date);
    }

    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    $courses = $query->get();

    $announcements = [
        "Nouveau cours de PHP disponible !",
        "Syllabus mis à jour pour le cours Laravel."
    ];

    return view('courses.index', compact('courses', 'announcements'));
}

}
