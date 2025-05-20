@extends('layouts.app')

@section('content')
<h1>Ajouter une question au cours : {{ $course->title }}</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('questions.store', $course) }}" method="POST">
    @csrf

    <label>Type de question :</label><br>
    <select name="type" id="type" required onchange="toggleOptions()">
        <option value="">-- Choisir --</option>
        <option value="qcm" {{ old('type') == 'qcm' ? 'selected' : '' }}>QCM</option>
        <option value="open" {{ old('type') == 'open' ? 'selected' : '' }}>Question ouverte</option>
    </select><br><br>

    <label>Question :</label><br>
    <textarea name="question_text" required>{{ old('question_text') }}</textarea><br><br>

<div id="options_div" style="display:none;">
    <label>Options (une par ligne) :</label><br>
    <textarea name="options_text" rows="5" id="options_textarea">{{ old('options_text') }}</textarea><br><br>
    <small>Les options seront automatiquement séparées par ligne.</small>
</div>


    <button type="submit">Ajouter</button>
</form>

<a href="{{ route('questions.index', $course) }}">Retour à la liste</a>

<script>
function toggleOptions() {
    var type = document.getElementById('type').value;
    document.getElementById('options_div').style.display = (type === 'qcm') ? 'block' : 'none';
}
window.onload = toggleOptions;
</script>
@endsection
