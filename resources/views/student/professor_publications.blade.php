@extends('layouts.master')

@section('title', 'Publications du Professeur')

@section('content')
<section class="professor-publications">
    <div class="container">
        <h1 class="section-title">Publications de {{ $professor->name }}</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="management-actions">
            <a href="{{ route('professors') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
        </div>

        <div class="publications-list">
            @forelse($publications as $publication)
            <div class="publication-card">
                <div class="publication-header">
                    <h3 class="publication-title">{{ $publication->titre_pub }}</h3>
                    <span class="publication-year">{{ $publication->year }}</span>
                </div>
                
                <div class="publication-content">
                    <p class="publication-description">{{ $publication->description }}</p>
                    
                    @if($publication->image)
                    <div class="publication-image-container">
                        <img src="{{ asset('storage/' . $publication->image) }}" 
                             alt="Image de la publication {{ $publication->titre_pub }}"
                             class="publication-image">
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <p>Ce professeur n'a pas encore de publications.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Publications - Styles */
.professor-publications {
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
    display: flex;
    justify-content: flex-end;
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

.publication-image-container {
    margin-top: var(--space-4);
    text-align: center;
}

.publication-image {
    max-width: 100%;
    max-height: 400px;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-sm);
    object-fit: contain;
}

.empty-state {
    text-align: center;
    padding: var(--space-12) var(--space-6);
    color: var(--color-text-light);
}

.empty-state i {
    font-size: var(--font-size-4xl);
    margin-bottom: var(--space-4);
    color: var(--color-primary-light);
}

.empty-state p {
    font-size: var(--font-size-lg);
    margin: 0;
}

/* Dark Mode Styles */
.dark .publication-card {
    background-color: var(--color-background-dark-theme);
    border: 1px solid var(--color-border-dark-theme);
}

.dark .publication-description {
    color: var(--color-text-dark-theme);
}

.dark .empty-state {
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
    
    .publication-image {
        max-height: 300px;
    }
}
</style>
@endpush