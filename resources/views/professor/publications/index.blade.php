@extends('layouts.master')

@section('title', 'Mes Publications - Professeur')
@section('description', 'Gestion des publications académiques')

@section('content')
<section class="publications-management">
    <div class="container">
        <h1 class="section-title">Mes Publications</h1>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <div class="management-actions">
            <a href="{{ route('professor.publications.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Créer une publication
            </a>
        </div>

        <div class="publications-list">
            @if($publications->count() > 0)
                @foreach($publications as $pub)
                <div class="publication-card">
                    <div class="publication-header">
                        <h3 class="publication-title">{{ $pub->titre_pub }}</h3>
                        <span class="publication-year">{{ date('d/m/Y', strtotime($pub->year)) }}</span>
                    </div>
                    
                    <div class="publication-content">
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
                            @if($pub->type)
                            <span class="meta-item">
                                <i class="fas fa-tag"></i> {{ $pub->type }}
                            </span>
                            @endif
                            
                            @if($pub->doi)
                            <span class="meta-item">
                                <i class="fas fa-link"></i>
                                <a href="https://doi.org/{{ $pub->doi }}" target="_blank" rel="noopener noreferrer">
                                    DOI
                                </a>
                            </span>
                            @endif
                        </div>
                        
                        <div class="publication-actions">
                            <a href="{{ route('professor.publications.edit', $pub->id) }}" class="btn-action btn-edit">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            
                            <form action="{{ route('professor.publications.destroy', $pub->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette publication ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">
                                    <i class="fas fa-trash-alt"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <h3>Aucune publication disponible</h3>
                    <p>Commencez par créer votre première publication</p>
                    <a href="{{ route('professor.publications.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nouvelle publication
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Publications - Styles */
.publications-management {
    padding: var(--space-16) 0;
}

.section-title {
    font-size: var(--font-size-3xl);
    text-align: center;
    margin-bottom: var(--space-10);
    position: relative;
    padding-bottom: var(--space-4);
    color: var(--color-primary);
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background-color: var(--color-primary);
    border-radius: var(--border-radius-full);
}

.management-actions {
    margin-bottom: var(--space-8);
    text-align: right;
}

.publications-list {
    display: grid;
    gap: var(--space-6);
}

.publication-card {
    background-color: var(--color-background);
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
}

.publication-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.publication-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--space-4) var(--space-6);
    background-color: var(--color-primary);
    color: white;
}

.publication-title {
    font-size: var(--font-size-xl);
    font-weight: var(--font-weight-medium);
    margin: 0;
}

.publication-year {
    background-color: rgba(255, 255, 255, 0.2);
    padding: var(--space-1) var(--space-3);
    border-radius: var(--border-radius-full);
    font-size: var(--font-size-sm);
}

.publication-content {
    padding: var(--space-6);
}

.publication-description {
    color: var(--color-text);
    line-height: 1.6;
    margin-bottom: var(--space-4);
}

/* Modification pour l'image - Taille réduite */
.publication-image-container {
    margin: var(--space-4) 0;
    max-height: 300px; /* Hauteur maximale réduite */
    overflow: hidden;
    background-color: var(--color-background-alt);
    border-radius: var(--border-radius);
    display: flex;
    justify-content: center;
    align-items: center;
}

.publication-image {
    max-width: 100%;
    max-height: 300px;
    width: auto;
    height: auto;
    object-fit: contain; /* Conserve les proportions */
    border-radius: var(--border-radius);
}

.publication-meta {
    display: flex;
    gap: var(--space-4);
    margin-bottom: var(--space-4);
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: var(--font-size-sm);
    color: var(--color-text-light);
}

.meta-item a {
    color: var(--color-primary);
    text-decoration: none;
}

.meta-item a:hover {
    text-decoration: underline;
}

.publication-actions {
    display: flex;
    gap: var(--space-3);
    padding-top: var(--space-4);
    border-top: 1px solid var(--color-border);
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-2) var(--space-3);
    border-radius: var(--border-radius-sm);
    font-size: var(--font-size-sm);
    transition: var(--transition);
}

.btn-edit {
    background-color: rgba(59, 130, 246, 0.1);
    color: var(--color-primary);
}

.btn-edit:hover {
    background-color: rgba(59, 130, 246, 0.2);
}

.btn-delete {
    background-color: rgba(239, 68, 68, 0.1);
    color: var(--color-error);
}

.btn-delete:hover {
    background-color: rgba(239, 68, 68, 0.2);
}

.empty-state {
    text-align: center;
    padding: var(--space-12) var(--space-6);
    background-color: var(--color-background);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
}

.empty-state i {
    font-size: var(--font-size-4xl);
    color: var(--color-primary-light);
    margin-bottom: var(--space-4);
}

.empty-state h3 {
    font-size: var(--font-size-xl);
    margin-bottom: var(--space-2);
    color: var(--color-text);
}

.empty-state p {
    color: var(--color-text-light);
    margin-bottom: var(--space-4);
}

/* Dark Mode Styles */
.dark .publication-card {
    background-color: var(--color-background-dark-theme);
    border: 1px solid var(--color-border-dark-theme);
}

.dark .publication-header {
    background-color: var(--color-primary-dark-theme);
}

.dark .publication-description {
    color: var(--color-text-dark-theme);
}

.dark .publication-image-container {
    background-color: var(--color-background-alt-dark-theme);
}

.dark .meta-item {
    color: var(--color-text-light-dark-theme);
}

.dark .publication-actions {
    border-top-color: var(--color-border-dark-theme);
}

.dark .empty-state {
    background-color: var(--color-background-dark-theme);
    border: 1px solid var(--color-border-dark-theme);
}

.dark .empty-state h3 {
    color: var(--color-text-dark-theme);
}

.dark .empty-state p {
    color: var(--color-text-light-dark-theme);
}

/* Responsive Styles */
@media (max-width: 768px) {
    .publication-header {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-2);
    }
    
    .publication-year {
        align-self: flex-end;
    }
    
    .publication-actions {
        flex-direction: column;
    }
    
    .btn-action {
        justify-content: center;
    }
    
    /* Adaptation de l'image pour mobile */
    .publication-image-container {
        max-height: 200px;
    }
    
    .publication-image {
        max-height: 200px;
    }
}
</style>
@endpush