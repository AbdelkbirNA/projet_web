@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Publications de {{ $professor->name }}</h2>
        <a href="{{ route('student_main') }}" class="btn btn-secondary">
            Retour à la liste
        </a>
    </div>

    @forelse($publications as $publication)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $publication->titre_pub }}</h5>
            <p class="card-text">{{ $publication->description }}</p>
            <div class="d-flex justify-content-between">
                <small class="text-muted">Année: {{ $publication->year }}</small>
                @if($publication->image)
                <a href="{{ asset('storage/' . $publication->image) }}" 
                   target="_blank" class="btn btn-sm btn-outline-primary">
                    Voir l'image
                </a>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-info">
        Ce professeur n'a pas encore de publications.
    </div>
    @endforelse
</div>
@endsection