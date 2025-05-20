@extends('layouts.app')

@section('content')
<h1>Ajouter un cours</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Titre:</label><br>
    <input type="text" name="title" value="{{ old('title', $course->title ?? '') }}" required><br><br>

    <label>Type de contenu:</label><br>
<select name="type" required>
    <option value="">-- Sélectionner --</option>
    <option value="cours" {{ old('type', $course->type ?? '') == 'cours' ? 'selected' : '' }}>Cours</option>
    <option value="td" {{ old('type', $course->type ?? '') == 'td' ? 'selected' : '' }}>TD</option>
    <option value="tp" {{ old('type', $course->type ?? '') == 'tp' ? 'selected' : '' }}>TP</option>
    <option value="annonce" {{ old('type', $course->type ?? '') == 'annonce' ? 'selected' : '' }}>Annonce</option>
</select><br><br>


    <label>Description:</label><br>
    <textarea name="description">{{ old('description', $course->description ?? '') }}</textarea><br><br>

    <label>Syllabus:</label><br>
    <textarea name="syllabus">{{ old('syllabus', $course->syllabus ?? '') }}</textarea><br><br>

    <label>Date du cours:</label><br>
    <input type="date" name="course_date" value="{{ old('course_date', isset($course) && $course->course_date ? $course->course_date->format('Y-m-d') : '') }}"><br><br>

    <label>Ressources (PDF, DOC, ZIP):</label><br>
    <input type="file" name="resources"><br><br>

    @if (!empty($course->resources))
        <p>
            Ressource actuelle : 
            <a href="{{ route('courses.resources.view', basename($course->resources)) }}" target="_blank">Consulter</a>
        </p>
    @endif

    <!-- Nouvelle option -->
    <label>
        <input type="checkbox" name="create_quiz" value="1" {{ old('create_quiz') ? 'checked' : '' }}>
        Créer un questionnaire après la création du cours
    </label><br><br>

    <button type="submit">Enregistrer</button>
</form>

