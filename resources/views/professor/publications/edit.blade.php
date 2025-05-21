@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier la publication</h2>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('professor.publications.update', $publication->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label for="titre_pub">Titre *</label>
            <input type="text" class="form-control" id="titre_pub" name="titre_pub" value="{{ old('titre_pub', $publication->titre_pub) }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $publication->description) }}</textarea>
        </div>
        
        <div class="form-group mb-3">
            <label for="year">Date *</label>
            <input type="date" class="form-control" id="year" name="year" value="{{ old('year', $publication->year->format('Y-m-d')) }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <small class="form-text text-muted">Laissez vide pour conserver l'image actuelle</small>
            
            @if($publication->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $publication->image) }}" alt="Image actuelle" style="max-width: 200px;">
                    <p class="text-muted">Image actuelle</p>
                </div>
            @endif
        </div>
        
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('professor.publications.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection