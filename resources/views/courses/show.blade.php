@extends('layouts.master')

@section('title', $course->title . ' - ENSIASD')
@section('description', 'Détails du cours : ' . $course->description)

@section('content')
<section class="course-details">
    <div class="container">
        <div class="course-card">
            <div class="course-header">
                <div class="course-badge">
                    <span class="badge {{ $course->type === 'cours' ? 'badge-primary' : ($course->type === 'td' ? 'badge-secondary' : 'badge-accent') }}">
                        {{ strtoupper($course->type) }}
                    </span>
                </div>
                <h1 class="course-title">{{ $course->title }}</h1>
                <div class="course-meta">
                    <span class="meta-item">
                        <i class="far fa-calendar-alt"></i> {{ $course->course_date->format('d/m/Y') }}
                    </span>
                </div>
            </div>

            <div class="course-content">
                <div class="course-section">
                    <h2 class="section-title">
                        <i class="fas fa-info-circle"></i> Description
                    </h2>
                    <div class="section-content">
                        {{ $course->description ?: 'Aucune description disponible.' }}
                    </div>
                </div>

                <div class="course-section">
                    <h2 class="section-title">
                        <i class="fas fa-book"></i> Syllabus
                    </h2>
                    <div class="section-content">
                        {{ $course->syllabus ?: 'Aucun syllabus disponible.' }}
                    </div>
                </div>

                <div class="course-section">
                    <h2 class="section-title">
                        <i class="fas fa-file-download"></i> Ressources
                    </h2>
                    <div class="section-content">
                        @if($course->resources)
                            <div class="resource-actions">
                                <a href="{{ Storage::url($course->resources) }}" target="_blank" class="btn-resource">
                                    <i class="fas fa-eye"></i> Consulter
                                </a>
                                <a href="{{ Storage::url($course->resources) }}" download class="btn-resource">
                                    <i class="fas fa-download"></i> Télécharger
                                </a>
                            </div>
                        @else
                            <div class="no-resource">
                                <i class="far fa-folder-open"></i> Aucune ressource disponible
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="course-footer">
                <a href="{{ route('courses.index') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
                
                @auth
@if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'professor')
                        <div class="admin-actions">
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-edit">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">
                                    <i class="fas fa-trash-alt"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Course Details Section */
.course-details {
    padding: var(--space-12) 0;
    background-color: var(--color-background-alt);
}

.container {
    max-width: 900px;
}

/* Course Card */
.course-card {
    background-color: var(--color-background);
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    border: 1px solid var(--color-border);
}

/* Course Header */
.course-header {
    padding: var(--space-8) var(--space-8) var(--space-6);
    background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
    color: white;
    position: relative;
}

.course-badge {
    position: absolute;
    top: var(--space-4);
    right: var(--space-4);
}

.badge {
    display: inline-block;
    padding: var(--space-2) var(--space-3);
    border-radius: var(--border-radius-full);
    font-size: var(--font-size-sm);
    font-weight: var(--font-weight-bold);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-primary {
    background-color: var(--color-primary-light);
    color: var(--color-primary-dark);
}

.badge-secondary {
    background-color: var(--color-secondary);
    color: var(--color-text);
}

.badge-accent {
    background-color: var(--color-success);
    color: white;
}

.course-title {
    font-size: var(--font-size-3xl);
    margin-bottom: var(--space-2);
    color: white;
}

.course-meta {
    display: flex;
    gap: var(--space-6);
    margin-top: var(--space-4);
}

.meta-item {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: var(--font-size-sm);
    opacity: 0.9;
}

/* Course Content */
.course-content {
    padding: var(--space-6) var(--space-8);
}

.course-section {
    margin-bottom: var(--space-8);
}

.course-section:last-child {
    margin-bottom: 0;
}

.section-title {
    font-size: var(--font-size-xl);
    margin-bottom: var(--space-3);
    color: var(--color-primary);
    display: flex;
    align-items: center;
    gap: var(--space-3);
}

.section-content {
    padding-left: var(--space-8);
    line-height: 1.7;
}

/* Resource Styles */
.resource-actions {
    display: flex;
    gap: var(--space-4);
}

.btn-resource {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-3) var(--space-4);
    border-radius: var(--border-radius);
    background-color: var(--color-background-alt);
    color: var(--color-primary);
    font-weight: var(--font-weight-medium);
    transition: var(--transition);
}

.btn-resource:hover {
    background-color: var(--color-primary-light);
    color: var(--color-primary-dark);
}

.no-resource {
    color: var(--color-text-light);
    display: flex;
    align-items: center;
    gap: var(--space-2);
}

/* Course Footer */
.course-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--space-4) var(--space-8);
    border-top: 1px solid var(--color-border);
    background-color: var(--color-background-alt);
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-3) var(--space-4);
    border-radius: var(--border-radius);
    background-color: transparent;
    color: var(--color-text);
    border: 1px solid var(--color-border);
    transition: var(--transition);
}

.btn-back:hover {
    background-color: var(--color-secondary);
}

.admin-actions {
    display: flex;
    gap: var(--space-3);
}

.btn-edit {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-3) var(--space-4);
    border-radius: var(--border-radius);
    background-color: rgba(59, 130, 246, 0.1);
    color: var(--color-primary);
    transition: var(--transition);
}

.btn-edit:hover {
    background-color: rgba(59, 130, 246, 0.2);
}

.btn-delete {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-3) var(--space-4);
    border-radius: var(--border-radius);
    background-color: rgba(239, 68, 68, 0.1);
    color: var(--color-error);
    transition: var(--transition);
}

.btn-delete:hover {
    background-color: rgba(239, 68, 68, 0.2);
}

/* Dark Mode Styles */
.dark .course-details {
    background-color: var(--color-background-alt-dark-theme);
}

.dark .course-card {
    background-color: var(--color-background-dark-theme);
    border-color: var(--color-border-dark-theme);
}

.dark .section-content {
    color: var(--color-text-light-dark-theme);
}

.dark .btn-resource {
    background-color: var(--color-background-alt-dark-theme);
    color: var(--color-primary-dark-theme);
}

.dark .btn-resource:hover {
    background-color: var(--color-background-dark-theme);
}

.dark .no-resource {
    color: var(--color-text-light-dark-theme);
}

.dark .course-footer {
    background-color: var(--color-background-alt-dark-theme);
    border-top-color: var(--color-border-dark-theme);
}

.dark .btn-back {
    color: var(--color-text-dark-theme);
    border-color: var(--color-border-dark-theme);
}

.dark .btn-back:hover {
    background-color: var(--color-background-dark-theme);
}

/* Responsive Styles */
@media (max-width: 768px) {
    .course-header {
        padding: var(--space-6) var(--space-4);
    }
    
    .course-content {
        padding: var(--space-4);
    }
    
    .course-footer {
        flex-direction: column;
        gap: var(--space-3);
        padding: var(--space-4);
    }
    
    .admin-actions {
        width: 100%;
        justify-content: space-between;
    }
    
    .btn-back, .btn-edit, .btn-delete {
        flex: 1;
        justify-content: center;
    }
    
    .resource-actions {
        flex-direction: column;
    }
}
</style>
@endpush