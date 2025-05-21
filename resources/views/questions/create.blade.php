@extends('layouts.master')

@section('title', 'Ajouter une question - ' . $course->title)
@section('description', 'Page d\'ajout de nouvelle question pour le cours ' . $course->title)

@section('content')
<section class="add-question">
    <div class="container">
        <div class="question-form-card">
            <h1 class="section-title">Ajouter une question au cours : <span class="course-name">{{ $course->title }}</span></h1>

            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('questions.store', $course) }}" method="POST" id="questionForm">
                @csrf

                <div class="form-group">
                    <label class="form-label">Type de question :</label>
                    <select name="type" id="type" required onchange="toggleOptions()" class="form-control">
                        <option value="">-- Choisir --</option>
                        <option value="qcm" {{ old('type') == 'qcm' ? 'selected' : '' }}>Question à choix multiple (QCM)</option>
                        <option value="open" {{ old('type') == 'open' ? 'selected' : '' }}>Question ouverte</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Question :</label>
                    <textarea name="question_text" required class="form-control" rows="3" placeholder="Entrez votre question ici...">{{ old('question_text') }}</textarea>
                </div>

                <div id="options_div" class="form-group" style="display:none;">
                    <label class="form-label">Options du QCM :</label>
                    <textarea name="options_text" rows="5" id="options_textarea" class="form-control" placeholder="Entrez une option par ligne...">{{ old('options_text') }}</textarea>
                    <small class="form-note">Séparez chaque option par une nouvelle ligne. La première option sera considérée comme la réponse correcte.</small>
                </div>

                <div id="answer_div" class="form-group" style="display:none;">
                    <label class="form-label">Réponse correcte :</label>
                    <input type="text" name="answer" id="correct_answer" class="form-control" placeholder="Entrez la réponse correcte" value="{{ old('answer') }}">
                    <small class="form-note">Cette réponse doit correspondre exactement à l'une des options listées.</small>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Ajouter la question
                    </button>
                    <a href="{{ route('questions.index', $course) }}" class="btn btn-secondary">
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
/* Add Question Section */
.add-question {
    padding: var(--space-12) 0;
    background-color: var(--color-background-alt);
}

.question-form-card {
    background-color: var(--color-background);
    border-radius: var(--border-radius-lg);
    padding: var(--space-8);
    box-shadow: var(--shadow-md);
    max-width: 800px;
    margin: 0 auto;
}

.section-title {
    font-size: var(--font-size-2xl);
    color: var(--color-primary);
    margin-bottom: var(--space-8);
    padding-bottom: var(--space-4);
    border-bottom: 2px solid var(--color-primary-light);
}

.course-name {
    color: var(--color-text);
    font-weight: var(--font-weight-normal);
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
    min-height: 100px;
    resize: vertical;
}

.form-note {
    display: block;
    color: var(--color-text-light);
    font-size: var(--font-size-sm);
    margin-top: var(--space-2);
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
.dark .add-question {
    background-color: var(--color-background-alt-dark-theme);
}

.dark .question-form-card {
    background-color: var(--color-background-dark-theme);
    border: 1px solid var(--color-border-dark-theme);
}

.dark .section-title {
    color: var(--color-primary-dark-theme);
    border-bottom-color: var(--color-primary-light-dark-theme);
}

.dark .course-name {
    color: var(--color-text-dark-theme);
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

.dark .btn-secondary {
    color: var(--color-text-dark-theme);
    border-color: var(--color-border-dark-theme);
}

.dark .btn-secondary:hover {
    background-color: var(--color-background-alt-dark-theme);
}

/* Responsive Styles */
@media (max-width: 768px) {
    .question-form-card {
        padding: var(--space-6);
    }
    
    .section-title {
        font-size: var(--font-size-xl);
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
function toggleOptions() {
    const type = document.getElementById('type').value;
    const optionsDiv = document.getElementById('options_div');
    const optionsTextarea = document.getElementById('options_textarea');
    const answerDiv = document.getElementById('answer_div');
    const correctAnswerInput = document.getElementById('correct_answer');

    if (type === 'qcm') {
        optionsDiv.style.display = 'block';
        answerDiv.style.display = 'block';
        optionsTextarea.setAttribute('required', '');
        correctAnswerInput.setAttribute('required', '');
    } else if (type === 'open') {
        optionsDiv.style.display = 'none';
        answerDiv.style.display = 'block';
        optionsTextarea.removeAttribute('required');
        correctAnswerInput.setAttribute('required', '');
    } else {
        optionsDiv.style.display = 'none';
        answerDiv.style.display = 'none';
        optionsTextarea.removeAttribute('required');
        correctAnswerInput.removeAttribute('required');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    toggleOptions();

    // Validation côté client
    document.getElementById('questionForm').addEventListener('submit', function (e) {
        const type = document.getElementById('type').value;
        const answer = document.getElementById('correct_answer').value.trim();
        const optionsText = document.getElementById('options_textarea').value.trim();

        if (type === 'qcm') {
            const options = optionsText.split('\n').map(opt => opt.trim()).filter(Boolean);
            if (!options.includes(answer)) {
                e.preventDefault();
                alert('La réponse correcte doit correspondre exactement à l’une des options listées.');
            }
        }
    });
});
</script>
@endpush