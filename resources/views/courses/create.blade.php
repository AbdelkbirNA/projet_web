@extends('layouts.master')

@section('title', 'Ajouter un cours - ENSIASD')
@section('description', 'Page d\'ajout de nouveau cours pour professeur ENSIASD')

@section('content')
<section class="add-course">
    <div class="container">
        <div class="course-form-card">
            <h1 class="section-title">Ajouter un nouveau cours</h1>

            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Titre du cours:</label>
                    <input type="text" name="title" value="{{ old('title', $course->title ?? '') }}" required class="form-control" placeholder="Titre de votre cours">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Type de contenu:</label>
                    <select name="type" required class="form-control">
                        <option value="">-- Sélectionner --</option>
                        <option value="cours" {{ old('type', $course->type ?? '') == 'cours' ? 'selected' : '' }}>Cours</option>
                        <option value="td" {{ old('type', $course->type ?? '') == 'td' ? 'selected' : '' }}>TD</option>
                        <option value="tp" {{ old('type', $course->type ?? '') == 'tp' ? 'selected' : '' }}>TP</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Description:</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Description détaillée du cours...">{{ old('description', $course->description ?? '') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Syllabus:</label>
                    <textarea name="syllabus" class="form-control" rows="4" placeholder="Plan détaillé du cours...">{{ old('syllabus', $course->syllabus ?? '') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Date du cours:</label>
<input type="date" name="course_date" value="{{ old('course_date', isset($course) && $course->course_date ? $course->course_date->format('Y-m-d') : '') }}" class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Ressources (PDF, DOC, ZIP):</label>
                    <div class="file-upload">
                        <label class="upload-label">
                            <input type="file" name="resources" class="upload-input" accept=".pdf,.doc,.docx,.zip">
                            <span class="upload-text"><i class="fas fa-cloud-upload-alt"></i> Sélectionner un fichier</span>
                            <span class="file-name">Aucun fichier sélectionné</span>
                        </label>
                    </div>
                </div>
                
                @if (!empty($course->resources))
                <div class="current-resource">
                    <label class="form-label">Ressource actuelle:</label>
                    <a href="{{ route('courses.resources.view', basename($course->resources)) }}" target="_blank" class="resource-link">
                        <i class="fas fa-file-alt"></i> Consulter
                    </a>
                </div>
                @endif
                
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="create_quiz" value="1" {{ old('create_quiz') ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                        Créer un questionnaire après la création du cours
                    </label>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Add Course Section */
.add-course {
    padding: var(--space-16) 0;
    background-color: var(--color-background-alt);
}

.course-form-card {
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

/* Resource Styles */
.current-resource {
    padding: var(--space-3);
    background-color: var(--color-background-alt);
    border-radius: var(--border-radius);
    margin-bottom: var(--space-4);
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

/* Checkbox Styles */
.checkbox-group {
    margin: var(--space-6) 0;
}

.checkbox-label {
    display: flex;
    align-items: center;
    position: relative;
    padding-left: 30px;
    cursor: pointer;
    user-select: none;
}

.checkbox-label input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: var(--color-background);
    border: 1px solid var(--color-border);
    border-radius: var(--border-radius-sm);
}

.checkbox-label:hover input ~ .checkmark {
    background-color: var(--color-secondary);
}

.checkbox-label input:checked ~ .checkmark {
    background-color: var(--color-primary);
    border-color: var(--color-primary);
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.checkbox-label input:checked ~ .checkmark:after {
    display: block;
}

.checkbox-label .checkmark:after {
    left: 7px;
    top: 3px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
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
.dark .add-course {
    background-color: var(--color-background-alt-dark-theme);
}

.dark .course-form-card {
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

.dark .checkmark {
    background-color: var(--color-background-dark-theme);
    border-color: var(--color-border-dark-theme);
}

/* Responsive Styles */
@media (max-width: 768px) {
    .course-form-card {
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