@extends('layouts.master')

@section('title', 'Mes Publications - Professeur')
@section('description', 'Gestion des publications académiques')

@push('styles')
<style>
    /* Style général */
    .publications-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }
    
    /* En-tête */
    .page-header {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #dddfe2;
    }
    
    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #1d2129;
        margin-bottom: 5px;
    }
    
    /* Alertes */
    .alert {
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 15px;
        font-size: 15px;
        display: flex;
        align-items: center;
    }
    
    .alert-success {
        background-color: #e7f5e9;
        color: #2b8a3e;
        border-left: 4px solid #2b8a3e;
    }
    
    .alert-danger {
        background-color: #fff3bf;
        color: #e67700;
        border-left: 4px solid #e67700;
    }
    
    /* Boutons */
    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 15px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-primary {
        background-color: #1877f2;
        color: white;
        border: none;
    }
    
    .btn-primary:hover {
        background-color: #166fe5;
    }
    
    /* Cartes de publication - Style Facebook */
    .publication-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        border: 1px solid #dddfe2;
    }
    
    /* Conteneur d'image avec ratio 16:9 comme Facebook */
    .publication-image-container {
        position: relative;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
        overflow: hidden;
        background-color: #f0f2f5;
    }
    
    .publication-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    /* Corps de la publication */
    .publication-body {
        padding: 12px 16px;
    }
    
    .publication-title {
        font-size: 18px;
        font-weight: 600;
        color: #1d2129;
        margin-bottom: 8px;
    }
    
    .publication-description {
        color: #4b4f56;
        line-height: 1.4;
        margin-bottom: 12px;
        font-size: 15px;
    }
    
    /* Métadonnées */
    .publication-meta {
        display: flex;
        align-items: center;
        color: #65676b;
        font-size: 13px;
        margin-bottom: 12px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    /* Actions */
    .publication-actions {
        display: flex;
        border-top: 1px solid #dddfe2;
        padding-top: 8px;
    }
    
    .btn-outline {
        background: none;
        border: none;
        color: #65676b;
        flex: 1;
        justify-content: center;
        padding: 8px;
        border-radius: 4px;
    }
    
    .btn-outline:hover {
        background-color: #f0f2f5;
    }
    
    /* État vide */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background-color: white;
        border-radius: 8px;
        border: 1px solid #dddfe2;
        color: #65676b;
    }
    
    .empty-state-icon {
        font-size: 50px;
        color: #bec3c9;
        margin-bottom: 15px;
    }
    
    /* Responsive */
    @media (max-width: 600px) {
        .publications-container {
            padding: 15px;
        }
        
        .page-title {
            font-size: 20px;
        }
        
        .publication-image-container {
            padding-top: 75%; /* Ratio plus carré sur mobile */
        }
    }
</style>
@endpush

@section('content')
<div class="publications-container">
    <div class="page-header">
        <h1 class="page-title">Mes Publications</h1>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
        </div>
    @endif
    
    <div style="margin-bottom: 20px;">
        <a href="{{ route('professor.publications.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Créer une publication
        </a>
    </div>
    
    @if($publications->count() > 0)
        @foreach($publications as $pub)
        <div class="publication-card">
            <div class="publication-body">
                <h3 class="publication-title">{{ $pub->titre_pub }}</h3>
                
                @if($pub->image)
                <div class="publication-image-container">
                    <img src="{{ asset('storage/' . $pub->image) }}" 
                         alt="{{ $pub->titre_pub }}" 
                         class="publication-image"
                         loading="lazy">
                </div>
                @endif
                
                <p class="publication-description">{{ $pub->description }}</p>
                
                <div class="publication-meta">
                    <span>
                        <i class="far fa-calendar-alt mr-1"></i>
                        {{ date('d/m/Y', strtotime($pub->year)) }}
                    </span>
                    
                    @if($pub->type)
                    <span>
                        <i class="fas fa-tag mr-1"></i>
                        {{ $pub->type }}
                    </span>
                    @endif
                    
                    @if($pub->doi)
                    <span>
                        <i class="fas fa-link mr-1"></i>
                        <a href="https://doi.org/{{ $pub->doi }}" target="_blank" rel="noopener noreferrer" style="color: #1877f2;">
                            DOI
                        </a>
                    </span>
                    @endif
                </div>
                
                <div class="publication-actions">
                    <a href="{{ route('professor.publications.edit', $pub->id) }}" class="btn-outline">
                        <i class="fas fa-edit mr-1"></i> Modifier
                    </a>
                    
                    <form action="{{ route('professor.publications.destroy', $pub->id) }}" method="POST" style="flex: 1;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-outline" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette publication ?')">
                            <i class="fas fa-trash mr-1"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 10px;">Aucune publication disponible</h3>
            <p style="margin-bottom: 20px;">Commencez par créer votre première publication</p>
            <a href="{{ route('professor.publications.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nouvelle publication
            </a>
        </div>
    @endif
</div>
@endsection