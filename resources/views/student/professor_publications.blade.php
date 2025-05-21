@extends('layouts.type')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Publications de {{ $professor->name }}</h2>
        <a href="{{ route('professors') }}" class="btn btn-secondary">
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
                <div class="publication-image-container mt-3">
                    <img src="{{ asset('storage/' . $publication->image) }}" 
                         alt="Image de la publication {{ $publication->titre_pub }}"
                         class="img-fluid publication-image"
                         style="max-height: 300px;">
                </div>
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

<style>
    .publication-image {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .publication-image-container {
        width: 100%;
        text-align: center;
        margin-top: 15px;
    }
</style>
@endsection