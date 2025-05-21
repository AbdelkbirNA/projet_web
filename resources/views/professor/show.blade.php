@extends('layouts.app')

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
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('prof_main') }}" class="btn btn-secondary">
                Retour à la liste
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Publications</h3>
            
            @forelse($publications as $publication)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $publication->titre_pub }}</h5>
                    <p class="card-text">{{ $publication->description }}</p>
                    <p class="card-text">
                        <small class="text-muted">
                            Année: {{ $publication->year }}
                        </small>
                    </p>
                </div>
            </div>
            @empty
            <div class="alert alert-info">
                Ce professeur n'a pas encore de publications.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection