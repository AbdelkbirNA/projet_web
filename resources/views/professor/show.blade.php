@extends('layouts.professor-layout')

@section('title', 'Prof. ' . $profile->prenom . ' ' . $profile->nom)
@section('description', 'Portfolio académique du Professeur ' . $profile->prenom . ' ' . $profile->nom)

@section('professor_name', 'Prof. ' . $profile->prenom . ' ' . $profile->nom)
@section('professor_title', 'Professeur en ' .$profile->statut)
@section('professor_speciality', 'Spécialiste en '.$profile->specialite)
@section('professor_image', $profile->photo ? asset('storage/' . $profile->photo) : asset('IMG/prof1.jpeg'))

@section('content')
    <!-- About Section dynamique -->
    <link rel="stylesheet" href="{{ asset('css/prof_content.css') }}">
    <section id="about" class="about section">
        <div class="container">
            <h2 class="section-title">À propos </h2>
            <div class="about-content">
                <div class="about-image">
<img src="{{ $profile->photo ? asset('storage/' . $profile->photo) : asset('IMG/prof1.jpeg') }}" alt="Photo de {{ $profile->prenom }} {{ $profile->nom }}" class="about-img">                </div>
                <div class="about-text">
                    @if($profile->biographie)
                        <p>{{ $profile->biographie }}</p>
                    @else
                        <p>
                            Professeur à l'ENSIASD, spécialisé en {{ $profile->specialite ?? 'Informatique' }}.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>

       <!-- Publications Section -->
    <section id="publications" class="publications section">
        <div class="container">
            <h2 class="section-title">Publications</h2>
            <p class="section-description">
                Une sélection de mes publications récentes dans des revues et conférences internationales.
            </p>
<div class="publications-list">
    @forelse($lastPublications as $publication)
        <div class="publication-item">
            <h3 class="publication-title">{{ $publication->titre_pub }}</h3>
            <p class="journal-name">{{ $publication->description }}</p>
            <div class="publication-meta">
                <span class="publication-date">
                    Publié le : {{ $publication->created_at ? $publication->created_at->format('d/m/Y') : 'Date inconnue' }}
                </span>
            </div>
        </div>
    @empty
        <p>Aucune publication récente.</p>
    @endforelse
</div>

<div style="text-align:center; margin-top: 1rem;">
    <a href="{{ isset($profile) ? route('student.professor.publications', ['professor' => $profile->user_id]) : '#' }}"  class="btn btn-small btn-primary">
        Voir toutes les publications 
    </a>
</div>

    <!-- Courses Section -->
    <section id="courses" class="courses section">
        <div class="container">
            <h2 class="section-title">Cours</h2>
            <div class="courses-grid">
                <!-- Courses dynamqiue  -->
        
<div class="courses-grid">
    @forelse($lastCourses as $course)
        <div class="course-item">
            <h3 class="course-title">{{ $course->title }}</h3>
            <p class="course-description">{{ $course->description }}</p>
            @if($course->created_at)
            <div class="course-meta">
                <span class="course-date">
                    Créé le : {{ $course->created_at->format('d/m/Y') }}
                </span>
            </div>
            @endif
        </div>
    @empty
        <p>Aucun cours disponible.</p>
    @endforelse
</div>
<div style="text-align:center; margin-top: 1rem;">
    <a href="{{ route('professor.courses', ['id' => $profile->user_id]) }}" class="btn btn-small btn-primary">
    Voir tous les cours
</a>
</div>

              
    
@endsection