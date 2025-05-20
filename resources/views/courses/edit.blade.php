@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier le cours</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Titre:</label>
            <input type="text" name="title" value="{{ old('title', $course->title) }}" required class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Description:</label>
            <textarea name="description" class="form-control">{{ old('description', $course->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Syllabus:</label>
            <textarea name="syllabus" class="form-control">{{ old('syllabus', $course->syllabus) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Date du cours:</label>
            <input type="date" name="course_date" value="{{ old('course_date', $course->course_date ? $course->course_date->format('Y-m-d') : '') }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Ressources actuelles:</label><br>
@if($course->resources)
    <a href="{{ route('courses.resources.view', basename($course->resources)) }}" target="_blank">Consulter</a>
@else
    <em>Aucun fichier</em>
@endif

        </div>
        <div class="mb-3">
            <label class="form-label">Changer ressources (laisser vide pour ne pas changer):</label>
            <input type="file" name="resources" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary ms-2">Retour à la liste</a>
    </form>
</div>
@endsection
