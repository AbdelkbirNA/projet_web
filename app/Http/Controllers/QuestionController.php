<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Course $course)
    {
        $questions = $course->questions()->paginate(10);
        return view('questions.index', compact('course', 'questions'));
    }

    public function create(Course $course)
    {
        return view('questions.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        if ($request->input('type') !== 'qcm') {
            $request->merge(['options_text' => '']);
        }

        $data = $request->validate([
            'type' => 'required|in:qcm,open',
            'question_text' => 'required|string',
            'options_text' => 'nullable|string',
            'answer' => 'required|string',
        ]);

        if ($data['type'] === 'qcm') {
            $optionsArray = array_filter(array_map('trim', explode("\n", $data['options_text'])));
            if (empty($optionsArray)) {
                return back()->withErrors(['options_text' => 'Vous devez fournir au moins une option.'])->withInput();
            }
            if (!in_array($data['answer'], $optionsArray, true)) {
                return back()->withErrors(['answer' => 'La réponse correcte doit être une des options.'])->withInput();
            }
            $data['options'] = json_encode($optionsArray);
        } else {
            $data['options'] = null;
        }

        $course->questions()->create([
            'type' => $data['type'],
            'question_text' => $data['question_text'],
            'options' => $data['options'],
            'answer' => $data['answer'],
        ]);

        return redirect()->route('questions.index', $course)->with('success', 'Question ajoutée.');
    }

    public function edit(Question $question)
    {
        $options_text = null;
        if ($question->type === 'qcm' && $question->options) {
            $optionsArray = json_decode($question->options, true);
            $options_text = implode("\n", $optionsArray);
        }

        return view('questions.edit', compact('question', 'options_text'));
    }

    public function update(Request $request, Question $question)
    {
        if ($request->input('type') !== 'qcm') {
            $request->merge(['options_text' => '']);
        }

        $data = $request->validate([
            'type' => 'required|in:qcm,open',
            'question_text' => 'required|string',
            'options_text' => 'nullable|string',
            'answer' => 'required|string',
        ]);

        if ($data['type'] === 'qcm') {
            $optionsArray = array_filter(array_map('trim', explode("\n", $data['options_text'])));
            if (empty($optionsArray)) {
                return back()->withErrors(['options_text' => 'Vous devez fournir au moins une option.'])->withInput();
            }
            if (!in_array($data['answer'], $optionsArray, true)) {
                return back()->withErrors(['answer' => 'La réponse correcte doit être une des options.'])->withInput();
            }
            $data['options'] = json_encode($optionsArray);
        } else {
            $data['options'] = null;
        }

        $question->update([
            'type' => $data['type'],
            'question_text' => $data['question_text'],
            'options' => $data['options'],
            'answer' => $data['answer'],
        ]);

        return redirect()->route('questions.index', $question->course)->with('success', 'Question mise à jour.');
    }

    public function destroy(Question $question)
    {
        $course = $question->course;
        $question->delete();

        return redirect()->route('questions.index', $course)->with('success', 'Question supprimée.');
    }

    public function showForStudent(Course $course)
    {
        $questions = $course->questions;
        return view('questions.showForStudent', compact('course', 'questions'));
    }
}
