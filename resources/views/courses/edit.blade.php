@extends('layouts.master')

@section('title', 'Modifier Cours - ENSIASD')
@section('description', 'Page de modification de cours pour professeur ENSIASD')

@section('content')
<section class="edit-course">
    <div class="container">
        <div class="edit-course-card">
            <h1 class="section-title">Modifier le cours</h1>
            

            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">Titre:</label>
                    <input type="text" name="title" value="{{ old('title', $course->title) }}" required class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Description:</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $course->description) }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Syllabus:</label>
                    <textarea name="syllabus" class="form-control" rows="4">{{ old('syllabus', $course->syllabus) }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Date du cours:</label>
                    <input type="date" name="course_date" value="{{ old('course_date', $course->course_date ? $course->course_date->format('Y-m-d') : '') }}" class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Ressources actuelles:</label>
                    <div class="current-resource">
                        @if($course->resources)
                            <a href="{{ route('courses.resources.view', basename($course->resources)) }}" target="_blank" class="resource-link">
                                <i class="fas fa-file-alt"></i> Consulter le fichier
                            </a>
                        @else
                            <span class="no-resource">Aucun fichier attaché</span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Changer ressources:</label>
                    <div class="file-upload">
                        <label class="upload-label">
                            <input type="file" name="resources" class="upload-input">
                            <span class="upload-text"><i class="fas fa-cloud-upload-alt"></i> Sélectionner un fichier</span>
                            <span class="file-name">Aucun fichier sélectionné</span>
                        </label>
                    </div>
                    <small class="form-note">Laisser vide pour ne pas modifier</small>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Edit Course Section */
.edit-course {
    padding: var(--space-16) 0;
    background-color: var(--color-background-alt);
}

.edit-course-card {
    background-color: var(--color-background);
    border-radius: var(--border-radius-lg);
    padding: var(--space-8);
    box-shadow: var(--shadow-md);
    max-width: 800px;
    margin: 0 auto;
}

.section-title {
    font-size: var(--font-size-3xl);
    color: var(--color-primary);
    margin-bottom: var(--space-8);
    padding-bottom: var(--space-4);
    border-bottom: 2px solid var(--color-primary);
}

/* Alert Styles */
.alert-error {
    background-color: rgba(239, 68, 68, 0.1);
    color: var(--color-error);
    padding: var(--space-4);
    border-radius: var(--border-radius);
    margin-bottom: var(--space-6);
    border-left: 4px solid var(--color-error);
}

.alert-error ul {
    margin: 0;
    padding-left: var(--space-4);
}

/* Form Styles */
.form-group {
    margin-bottom: var(--space-6);
}

.form-label {
    display: block;
    margin-bottom: var(--space-2);
    font-weight: var(--font-weight-semibold);
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
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

/* Resource Styles */
.current-resource {
    padding: var(--space-3);
    background-color: var(--color-background-alt);
    border-radius: var(--border-radius);
}

.resource-link {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    color: var(--color-primary);
    font-weight: var(--font-weight-medium);
}

.resource-link:hover {
    text-decoration: underline;
}

.no-resource {
    color: var(--color-text-light);
    font-style: italic;
}

/* File Upload Styles */
.file-upload {
    margin-bottom: var(--space-2);
}

.upload-label {
    display: block;
    cursor: pointer;
}

.upload-input {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}

.upload-text {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-3) var(--space-4);
    background-color: var(--color-primary);
    color: var(--color-white);
    border-radius: var(--border-radius);
    transition: var(--transition);
}

.upload-text:hover {
    background-color: var(--color-primary-dark);
}

.file-name {
    margin-left: var(--space-4);
    color: var(--color-text-light);
    font-size: var(--font-size-sm);
}

.form-note {
    display: block;
    color: var(--color-text-light);
    font-size: var(--font-size-sm);
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: var(--space-4);
    margin-top: var(--space-8);
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-3) var(--space-6);
    border-radius: var(--border-radius);
    font-weight: var(--font-weight-medium);
    transition: var(--transition);
}

.btn-primary {
    background-color: var(--color-primary);
    color: var(--color-white);
    border: none;
}

.btn-primary:hover {
    background-color: var(--color-primary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.btn-secondary {
    background-color: transparent;
    color: var(--color-text);
    border: 1px solid var(--color-border);
}

.btn-secondary:hover {
    background-color: var(--color-secondary);
    border-color: var(--color-border);
}

/* Dark Mode Styles */
.dark .edit-course {
    background-color: var(--color-background-alt-dark-theme);
}

.dark .edit-course-card {
    background-color: var(--color-background-dark-theme);
    border: 1px solid var(--color-border-dark-theme);
}

.dark .section-title {
    color: var(--color-primary-dark-theme);
    border-bottom-color: var(--color-primary-dark-theme);
}

.dark .form-label {
    color: var(--color-text-dark-theme);
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

.dark .current-resource {
    background-color: var(--color-background-dark-theme);
}

.dark .resource-link {
    color: var(--color-primary-dark-theme);
}

.dark .btn-secondary {
    color: var(--color-text-dark-theme);
    border-color: var(--color-border-dark-theme);
}

.dark .btn-secondary:hover {
    background-color: var(--color-background-alt-dark-theme);
}

/* Responsive Styles */
@media (max-width: 768px) {
    .edit-course-card {
        padding: var(--space-6);
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Afficher le nom du fichier sélectionné
document.querySelector('.upload-input').addEventListener('change', function(e) {
    const fileName = e.target.files[0] ? e.target.files[0].name : 'Aucun fichier sélectionné';
    document.querySelector('.file-name').textContent = fileName;
});
</script>
@endpush