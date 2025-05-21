@extends('layouts.master')

@section('title', 'Gestion des Cours')

@section('content')
<section class="courses-management">
    <div class="container">
        <h1 class="section-title">Gestion des Cours</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

@if($isProfessor)
    <div class="management-actions">
        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un cours
        </a>
    </div>
@endif


        <div class="filter-section">
            <form method="GET" action="{{ route('courses.index') }}" class="filter-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="course_date">Filtrer par date :</label>
                        <input type="date" name="course_date" id="course_date" value="{{ request('course_date') }}" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="type">Filtrer par type :</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">-- Tous les types --</option>
                            <option value="cours" {{ request('type') == 'cours' ? 'selected' : '' }}>Cours</option>
                            <option value="td" {{ request('type') == 'td' ? 'selected' : '' }}>TD</option>
                            <option value="tp" {{ request('type') == 'tp' ? 'selected' : '' }}>TP</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-filter"></i> Filtrer
                    </button>
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-sync-alt"></i> Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        <div class="courses-list">
            <div class="table-responsive">
                <table class="courses-table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Date du cours</th>
                            <th>Ressources</th>
                            <th>Actions</th>
                            <th>Questionnaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>
                                    <a href="{{ route('courses.show', $course) }}" class="course-title">{{ $course->title }}</a>
                                </td>
                                <td>{{ Str::limit($course->description, 50) }}</td>
                                <td>{{ $course->course_date }}</td>
                                <td>
                                    @if($course->resources)
                                        <div class="resource-actions">
                                            <a href="{{ route('courses.resources.view', $course->resources) }}" target="_blank" class="btn-resource">
                                                <i class="fas fa-eye"></i> Consulter
                                            </a>
                                            <a href="{{ route('courses.resources.download', $course->resources) }}" target="_blank" class="btn-resource">
                                                <i class="fas fa-download"></i> Télécharger
                                            </a>
                                        </div>
                                    @else
                                        <span class="no-resource">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
@if(auth()->user()->user_type === 'professor')
    <div class="action-buttons">
        <a href="{{ route('courses.edit', $course) }}" class="btn-action btn-edit">
            <i class="fas fa-edit"></i> Modifier
        </a>
        <form action="{{ route('courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-action btn-delete">
                <i class="fas fa-trash-alt"></i> Supprimer
            </button>
        </form>
    </div>
@endif

                                </td>
<td>
    @if($isProfessor)
        <a href="{{ route('questions.create', $course) }}" class="btn-questionnaire">
            <i class="fas fa-question-circle"></i> Créer
        </a>
    @elseif($isStudent)
        <a href="{{ route('questions.index', $course) }}" class="btn-questionnaire">
            <i class="fas fa-pencil-alt"></i> Voir
        </a>
    @endif
</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Gestion des Cours - Styles */
.courses-management {
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

.filter-section {
    background-color: var(--color-background-alt);
    padding: var(--space-6);
    border-radius: var(--border-radius);
    margin-bottom: var(--space-8);
    box-shadow: var(--shadow-sm);
}

.filter-form .form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--space-6);
    margin-bottom: var(--space-4);
}

.form-group {
    margin-bottom: var(--space-4);
}

.form-group label {
    display: block;
    margin-bottom: var(--space-2);
    font-weight: var(--font-weight-medium);
    color: var(--color-text);
}

.form-control {
    width: 100%;
    padding: var(--space-3) var(--space-4);
    border: 1px solid var(--color-border);
    border-radius: var(--border-radius);
    font-size: var(--font-size-base);
    transition: var(--transition);
}

.form-control:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.form-actions {
    display: flex;
    gap: var(--space-4);
    justify-content: flex-end;
}

.courses-list {
    background-color: var(--color-background);
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow);
}

.table-responsive {
    overflow-x: auto;
}

.courses-table {
    width: 100%;
    border-collapse: collapse;
}

.courses-table thead {
    background-color: var(--color-primary);
    color: white;
}

.courses-table th {
    padding: var(--space-4) var(--space-6);
    text-align: left;
    font-weight: var(--font-weight-semibold);
}

.courses-table td {
    padding: var(--space-4) var(--space-6);
    border-bottom: 1px solid var(--color-border);
    vertical-align: middle;
}

.courses-table tbody tr:last-child td {
    border-bottom: none;
}

.courses-table tbody tr:hover {
    background-color: var(--color-secondary);
}

.course-title {
    color: var(--color-primary);
    font-weight: var(--font-weight-medium);
    transition: var(--transition);
}

.course-title:hover {
    color: var(--color-primary-dark);
    text-decoration: underline;
}

.action-buttons {
    display: flex;
    gap: var(--space-3);
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

.resource-actions {
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
}

.btn-resource {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    color: var(--color-primary);
    font-size: var(--font-size-sm);
    transition: var(--transition);
}

.btn-resource:hover {
    color: var(--color-primary-dark);
    text-decoration: underline;
}

.btn-questionnaire {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-2) var(--space-3);
    background-color: rgba(16, 185, 129, 0.1);
    color: var(--color-success);
    border-radius: var(--border-radius-sm);
    font-size: var(--font-size-sm);
    transition: var(--transition);
}

.btn-questionnaire:hover {
    background-color: rgba(16, 185, 129, 0.2);
}

.no-resource {
    color: var(--color-text-light);
    font-style: italic;
}

/* Dark Mode Styles */
.dark .filter-section {
    background-color: var(--color-background-alt-dark-theme);
}

.dark .courses-list {
    background-color: var(--color-background-dark-theme);
    border: 1px solid var(--color-border-dark-theme);
}

.dark .courses-table td {
    border-bottom-color: var(--color-border-dark-theme);
}

.dark .courses-table tbody tr:hover {
    background-color: var(--color-background-alt-dark-theme);
}

.dark .form-control {
    background-color: var(--color-background-alt-dark-theme);
    border-color: var(--color-border-dark-theme);
    color: var(--color-text-dark-theme);
}

.dark .form-control:focus {
    border-color: var(--color-primary-dark-theme);
    box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
}

/* Responsive Styles */
@media (max-width: 768px) {
    .courses-table {
        display: block;
    }
    
    .courses-table thead {
        display: none;
    }
    
    .courses-table tbody tr {
        display: block;
        margin-bottom: var(--space-6);
        border: 1px solid var(--color-border);
        border-radius: var(--border-radius);
        padding: var(--space-4);
    }
    
    .courses-table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: var(--space-3) 0;
        border-bottom: 1px solid var(--color-border);
    }
    
    .courses-table td::before {
        content: attr(data-label);
        font-weight: var(--font-weight-semibold);
        margin-right: var(--space-4);
        color: var(--color-primary);
    }
    
    .courses-table td:last-child {
        border-bottom: none;
    }
    
    .action-buttons {
        justify-content: flex-end;
    }
    
    .form-actions {
        flex-direction: column;
    }
}
</style>
@endpush