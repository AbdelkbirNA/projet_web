@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>Profil du Professeur: {{ $professor->name }}</h2>
            <p class="text-muted">Matricule: {{ $professor->matricule }}</p>
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