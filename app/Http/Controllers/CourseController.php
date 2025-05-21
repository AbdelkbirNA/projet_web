<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index(Request $request)
{
    $query = Course::query();

    if ($request->filled('course_date')) {
        $query->whereDate('course_date', $request->course_date);
    }

    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    // Charger aussi les questions associées à chaque cours
    $courses = $query->with('questions')->get();

    $announcements = [
        "Nouveau cours de PHP disponible !",
        "Syllabus mis à jour pour le cours Laravel."
    ];

    return view('courses.index', [
        'courses' => $courses,
        'announcements' => $announcements,
        'isProfessor' => Auth::user()->isProfessor(),
        'isStudent' => Auth::user()->isStudent(),
    ]);
}


    public function create()
    {
        if (!Auth::user()->isProfessor()) {
            abort(403, 'Seuls les professeurs peuvent ajouter un cours.');
        }

        return view('courses.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isProfessor()) {
            abort(403, 'Seuls les professeurs peuvent ajouter un cours.');
        }

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
            $file->storeAs('resources', $filename, 'public');
            $data['resources'] = 'resources/' . $filename;
        }

        $course = Course::create($data);

        if ($request->has('create_quiz') && $request->input('create_quiz')) {
            return redirect()->route('questions.create', $course);
        }

        return redirect()->route('courses.index')->with('success', 'Cours créé avec succès.');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        if (!Auth::user()->isProfessor()) {
            abort(403, 'Seuls les professeurs peuvent modifier les cours.');
        }

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        if (!Auth::user()->isProfessor()) {
            abort(403, 'Seuls les professeurs peuvent modifier les cours.');
        }

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

            $path = $request->file('resources')->store('resources', 'public');
            $course->resources = $path;
        }

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'syllabus' => $request->syllabus,
            'course_date' => $request->course_date,
        ]);

        return redirect()->route('courses.index')->with('success', 'Cours mis à jour.');
    }

    public function destroy(Course $course)
    {
        if (!Auth::user()->isProfessor()) {
            abort(403, 'Seuls les professeurs peuvent supprimer les cours.');
        }

        if ($course->resources) {
            Storage::disk('public')->delete($course->resources);
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Cours supprimé.');
    }

    public function viewResource($filename)
    {
        if (!Storage::disk('public')->exists($filename)) {
            abort(404, 'Fichier non trouvé.');
        }

        $file = Storage::disk('public')->get($filename);
        $mimeType = Storage::disk('public')->mimeType($filename);

        return response($file, 200)->header('Content-Type', $mimeType);
    }

    public function downloadResource($filename)
    {
        if (!Storage::disk('public')->exists($filename)) {
            abort(404, 'Fichier non trouvé.');
        }

        return Storage::disk('public')->download($filename);
    }
}
