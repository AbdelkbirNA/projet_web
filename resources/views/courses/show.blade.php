@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-body">
            <h1 class="card-title">{{ $course->title }}</h1>
            <p class="card-text"><strong>Description:</strong><br>{{ $course->description }}</p>
            <p class="card-text"><strong>Syllabus:</strong><br>{{ $course->syllabus }}</p>
            <p class="card-text"><strong>Date du cours:</strong> {{ $course->course_date }}</p>
            <p class="card-text"><strong>Ressources:</strong><br>
                @if($course->resources)
                    <a href="{{ Storage::url($course->resources) }}" target="_blank" class="btn btn-outline-primary">Télécharger les ressources</a>
                @else
                    <span class="text-muted">Aucune ressource disponible.</span>
                @endif
            </p>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
