@extends('layouts.master')

@section('title', 'Questions du cours - ' . $course->title)
@section('description', 'Liste des questions pour le cours ' . $course->title)

@section('content')
<section class="questions-list">
    <div class="container">
<div class="questions-header">
    <h1 class="page-title">Questions du cours : <span class="course-name">{{ $course->title }}</span></h1>
    @if(auth()->user()->user_type !== 'student')
        <a href="{{ route('questions.create', $course) }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Ajouter une question
        </a>
    @endif
</div>


        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="questions-table-container">
            <table class="questions-table">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th class="type-column">Type</th>
                        <th>Options</th>
                        <th class="actions-column">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                        <tr>
                            <td class="question-text">{{ $question->question_text }}</td>
                            <td>
                                <span class="question-type {{ $question->type }}">
                                    {{ $question->type == 'qcm' ? 'QCM' : 'Ouverte' }}
                                </span>
                            </td>
                            <td>
                                @if($question->type == 'qcm')
                                    <ul class="options-list">
                                        @foreach(json_decode($question->options, true) ?? [] as $index => $opt)
                                            <li class="{{ $index === 0 ? 'correct-answer' : '' }}">
                                                {{ $opt }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="no-options">-</span>
                                @endif
                            </td>
<td>
    <div class="action-buttons">
        @if(auth()->user()->user_type !== 'student')
            <a href="{{ route('questions.edit', $question) }}" class="btn-action btn-edit">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <form action="{{ route('questions.destroy', $question) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-action btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?')">
                    <i class="fas fa-trash-alt"></i> Supprimer
                </button>
            </form>
        @endif
    </div>
</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination-container">
            {{ $questions->links() }}
        </div>

        <div class="back-link">
            <a href="{{ route('courses.show', $course) }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Retour au cours
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Questions List Section */
.questions-list {
    padding: var(--space-12) 0;
    background-color: var(--color-background-alt);
}

.container {
    max-width: 1200px;
}

/* Header Styles */
.questions-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-6);
    flex-wrap: wrap;
    gap: var(--space-4);
}

.page-title {
    font-size: var(--font-size-2xl);
    color: var(--color-primary);
    margin: 0;
}

.course-name {
    color: var(--color-text);
    font-weight: var(--font-weight-normal);
}

/* Alert Styles */
.alert-success {
    background-color: rgba(16, 185, 129, 0.1);
    color: var(--color-success);
    padding: var(--space-4);
    border-radius: var(--border-radius);
    margin-bottom: var(--space-6);
    border-left: 4px solid var(--color-success);
    display: flex;
    align-items: center;
    gap: var(--space-3);
}

/* Table Styles */
.questions-table-container {
    overflow-x: auto;
    margin-bottom: var(--space-6);
    background-color: var(--color-background);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-sm);
}

.questions-table {
    width: 100%;
    border-collapse: collapse;
}

.questions-table thead {
    background-color: var(--color-primary);
    color: white;
}

.questions-table th {
    padding: var(--space-4) var(--space-6);
    text-align: left;
    font-weight: var(--font-weight-semibold);
}

.questions-table td {
    padding: var(--space-4) var(--space-6);
    border-bottom: 1px solid var(--color-border);
    vertical-align: top;
}

.questions-table tbody tr:last-child td {
    border-bottom: none;
}

.questions-table tbody tr:hover {
    background-color: var(--color-secondary);
}

/* Column Specific Styles */
.type-column {
    width: 120px;
}

.actions-column {
    width: 200px;
}

/* Question Text */
.question-text {
    max-width: 400px;
    word-wrap: break-word;
}

/* Question Type Badge */
.question-type {
    display: inline-block;
    padding: var(--space-1) var(--space-3);
    border-radius: var(--border-radius-full);
    font-size: var(--font-size-sm);
    font-weight: var(--font-weight-bold);
    text-transform: uppercase;
}

.question-type.qcm {
    background-color: rgba(59, 130, 246, 0.1);
    color: var(--color-primary);
}

.question-type.open {
    background-color: rgba(16, 185, 129, 0.1);
    color: var(--color-success);
}

/* Options List */
.options-list {
    margin: 0;
    padding-left: var(--space-4);
    list-style-type: none;
}

.options-list li {
    padding: var(--space-1) 0;
    position: relative;
}

.options-list li:before {
    content: "•";
    color: var(--color-text-light);
    position: absolute;
    left: -15px;
}

.correct-answer {
    font-weight: var(--font-weight-bold);
    color: var(--color-success);
}

.correct-answer:before {
    color: var(--color-success);
}

.no-options {
    color: var(--color-text-light);
    font-style: italic;
}

/* Action Buttons */
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

/* Pagination */
.pagination-container {
    margin: var(--space-6) 0;
    display: flex;
    justify-content: center;
}

/* Back Link */
.back-link {
    margin-top: var(--space-6);
    text-align: center;
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

/* Dark Mode Styles */
.dark .questions-list {
    background-color: var(--color-background-alt-dark-theme);
}

.dark .course-name {
    color: var(--color-text-dark-theme);
}

.dark .questions-table-container {
    background-color: var(--color-background-dark-theme);
    border: 1px solid var(--color-border-dark-theme);
}

.dark .questions-table td {
    border-bottom-color: var(--color-border-dark-theme);
}

.dark .questions-table tbody tr:hover {
    background-color: var(--color-background-alt-dark-theme);
}

.dark .question-type.qcm {
    background-color: rgba(96, 165, 250, 0.1);
    color: var(--color-primary-dark-theme);
}

.dark .question-type.open {
    background-color: rgba(16, 185, 129, 0.1);
    color: var(--color-success);
}

.dark .options-list li:before {
    color: var(--color-text-light-dark-theme);
}

.dark .no-options {
    color: var(--color-text-light-dark-theme);
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
    .questions-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .btn-action {
        width: 100%;
        justify-content: center;
    }
    
    .type-column, .actions-column {
        width: auto;
    }
}
</style>
@endpush