@extends('layouts.app')

@section('content')
<h1>Cours du Professeur {{ isset($professor) ? $professor->prenom . ' ' . $professor->nom : '' }}</h1>

@if(session('success'))
    <div style="color:green;">{{ session('success') }}</div>
@endif

<a href="{{ route('courses.create') }}">Ajouter un cours</a>

<form method="GET" action="{{ route('courses.index') }}" style="margin-bottom:20px;">
    <label for="course_date">Filtrer par date :</label>
    <input type="date" name="course_date" id="course_date" value="{{ request('course_date') }}">

    <label for="type">Filtrer par type :</label>
    <select name="type" id="type">
        <option value="">-- Tous les types --</option>
        <option value="cours" {{ request('type') == 'cours' ? 'selected' : '' }}>Cours</option>
        <option value="td" {{ request('type') == 'td' ? 'selected' : '' }}>TD</option>
        <option value="tp" {{ request('type') == 'tp' ? 'selected' : '' }}>TP</option>
        <option value="annonce" {{ request('type') == 'annonce' ? 'selected' : '' }}>Annonce</option>
    </select>

    <button type="submit">Filtrer</button>
    <a href="{{ route('courses.index') }}">Réinitialiser</a>
</form>

<h2>Liste des Cours</h2>
<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Date du cours</th>
            <th>Ressources</th>
            <th>Actions</th>
            <th>Questionnaire</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
            <tr>
                <td><a href="{{ route('courses.show', $course) }}">{{ $course->title }}</a></td>
                <td>{{ Str::limit($course->description, 50) }}</td>
                <td>{{ $course->course_date }}</td>
                <td>
                    @if($course->resources)
                        <a href="{{ route('courses.resources.view', $course->resources) }}" target="_blank">Consulter</a> |
                        <a href="{{ route('courses.resources.download', $course->resources) }}" target="_blank">Télécharger</a>
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('courses.edit', $course) }}">Modifier</a> |
                    <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display:inline" onsubmit="return confirm('Confirmer la suppression ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Supprimer</button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('questions.create', $course) }}" class="btn btn-sm btn-primary">
                        Créer un questionnaire
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection