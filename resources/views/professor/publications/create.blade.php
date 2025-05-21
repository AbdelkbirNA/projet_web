{{-- @extends('layouts.app') --}}
@extends('layouts.master')
@section('content')
<div class="container">
    <h2>Ajouter une nouvelle publication</h2>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('professor.publications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group mb-3">
            <label for="titre_pub">Titre *</label>
            <input type="text" class="form-control" id="titre_pub" name="titre_pub" value="{{ old('titre_pub') }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>
        
        <div class="form-group mb-3">
            <label for="year">Date *</label>
            <input type="date" class="form-control" id="year" name="year" value="{{ old('year') }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="image">Image *</label>
            <input type="file" class="form-control-file" id="image" name="image" required>
            <small class="form-text text-muted">Formats acceptés: jpeg, png, jpg, gif (max: 2MB)</small>
        </div>
        
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('professor.publications.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection