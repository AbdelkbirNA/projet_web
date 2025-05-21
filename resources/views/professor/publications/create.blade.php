@extends('layouts.master')

@section('title', 'Ajouter une Publication')

@section('content')
<section class="add-publication">
    <div class="container">
        <h1 class="section-title">Ajouter une nouvelle publication</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="publication-form">
            <form action="{{ route('professor.publications.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="titre_pub">Titre *</label>
                    <input type="text" class="form-control" id="titre_pub" name="titre_pub" value="{{ old('titre_pub') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="year">Date *</label>
                        <input type="date" class="form-control" id="year" name="year" value="{{ old('year') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Image *</label>
                        <div class="file-upload">
                            <label for="image" class="file-upload-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span id="file-name">Choisir un fichier...</span>
                            </label>
                            <input type="file" id="image" name="image" required accept="image/jpeg,image/png,image/jpg,image/gif">
                        </div>
                        <small class="form-text">Formats acceptés: jpeg, png, jpg, gif (max: 2MB)</small>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('professor.publications.index') }}" class="btn btn-outline-secondary">
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
/* Ajout Publication - Styles */
.add-publication {
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

.publication-form {
    background-color: var(--color-background);
    padding: var(--space-8);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    max-width: 800px;
    margin: 0 auto;
}

.form-group {
    margin-bottom: var(--space-6);
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

textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--space-6);
}

.file-upload {
    position: relative;
    margin-top: var(--space-2);
}

.file-upload-label {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    padding: var(--space-3) var(--space-4);
    background-color: var(--color-background-alt);
    border: 1px dashed var(--color-border);
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
}

.file-upload-label:hover {
    background-color: var(--color-background-alt-dark);
    border-color: var(--color-primary);
}

.file-upload-label i {
    color: var(--color-primary);
}

.file-upload input[type="file"] {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    border: 0;
}

.form-text {
    display: block;
    margin-top: var(--space-2);
    font-size: var(--font-size-sm);
    color: var(--color-text-light);
}

.form-actions {
    display: flex;
    gap: var(--space-4);
    justify-content: flex-end;
    margin-top: var(--space-8);
    padding-top: var(--space-6);
    border-top: 1px solid var(--color-border);
}

/* Dark Mode Styles */
.dark .publication-form {
    background-color: var(--color-background-dark-theme);
    border: 1px solid var(--color-border-dark-theme);
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

.dark .file-upload-label {
    background-color: var(--color-background-alt-dark-theme);
    border-color: var(--color-border-dark-theme);
}

.dark .form-text {
    color: var(--color-text-light-dark-theme);
}

.dark .form-actions {
    border-top-color: var(--color-border-dark-theme);
}

/* Responsive Styles */
@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
}

/* Script pour afficher le nom du fichier sélectionné */

</style>
@push('scripts')
<script>
document.getElementById('image').addEventListener('change', function(e) {
    const fileName = e.target.files[0] ? e.target.files[0].name : 'Choisir un fichier...';
    document.getElementById('file-name').textContent = fileName;
});
</script>
@endpush
@endpush