<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // Liste questions d’un cours
    public function index(Course $course)
    {
        $questions = $course->questions()->paginate(10);
        return view('questions.index', compact('course', 'questions'));
    }

    // Formulaire création question
    public function create(Course $course)
    {
        return view('questions.create', compact('course'));
    }

    // Stocker question
    public function store(Request $request, Course $course)
    {
$data = $request->validate([
    'type' => 'required|in:qcm,open',
    'question_text' => 'required|string',
    'options_text' => 'nullable|required_if:type,qcm|string',
]);


        if ($data['type'] == 'qcm') {
            $optionsArray = array_filter(array_map('trim', explode("\n", $data['options_text'])));
            if (empty($optionsArray)) {
                return back()->withErrors(['options_text' => 'Vous devez fournir au moins une option.'])->withInput();
            }
            $data['options'] = json_encode($optionsArray);
        } else {
            $data['options'] = null;
        }

        $course->questions()->create([
            'type' => $data['type'],
            'question_text' => $data['question_text'],
            'options' => $data['options'],
        ]);

        return redirect()->route('questions.index', $course)->with('success', 'Question ajoutée.');
    }

    // Formulaire édition
    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    // Mettre à jour
    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'type' => 'required|in:qcm,open',
            'question_text' => 'required|string',
            'options_text' => 'required_if:type,qcm|string',
        ]);

        if ($data['type'] == 'qcm') {
            $optionsArray = array_filter(array_map('trim', explode("\n", $data['options_text'])));
            if (empty($optionsArray)) {
                return back()->withErrors(['options_text' => 'Vous devez fournir au moins une option.'])->withInput();
            }
            $data['options'] = json_encode($optionsArray);
        } else {
            $data['options'] = null;
        }

        $question->update([
            'type' => $data['type'],
            'question_text' => $data['question_text'],
            'options' => $data['options'],
        ]);

        return redirect()->route('questions.index', $question->course)->with('success', 'Question mise à jour.');
    }

    // Supprimer question
    public function destroy(Question $question)
    {
        $course = $question->course;
        $question->delete();

        return redirect()->route('questions.index', $course)->with('success', 'Question supprimée.');
    }
}
