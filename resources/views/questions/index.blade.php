@extends('layouts.app')

@section('content')
<h1>Questions du cours : {{ $course->title }}</h1>

<a href="{{ route('questions.create', $course) }}" class="btn btn-primary mb-3">Ajouter une question</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="5" style="width:100%">
    <thead>
        <tr>
            <th>Question</th>
            <th>Type</th>
            <th>Options (pour QCM)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($questions as $question)
            <tr>
                <td>{{ $question->question_text }}</td>
                <td>{{ strtoupper($question->type) }}</td>
                <td>
                    @if($question->type == 'qcm')
                        <ul>
                        @foreach(json_decode($question->options, true) ?? [] as $opt)
                            <li>{{ $opt }}</li>
                        @endforeach
                        </ul>
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('questions.edit', $question) }}">Modifier</a> |
                    <form action="{{ route('questions.destroy', $question) }}" method="POST" style="display:inline" onsubmit="return confirm('Supprimer cette question ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color:red; background:none; border:none; cursor:pointer;">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $questions->links() }}

<a href="{{ route('courses.show', $course) }}" class="btn btn-secondary mt-3">Retour au cours</a>
@endsection
