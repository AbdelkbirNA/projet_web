@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des Professeurs</h2>
    
    <div class="row">
        @foreach($professors as $professor)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $professor->name }}</h5>
                    <p class="card-text">
                        <small class="text-muted">
                            Matricule: {{ $professor->matricule }}
                        </small>
                    </p>
                    <a href="{{ route('student.professor.publications', $professor->id) }}" 
                       class="btn btn-primary">
                        Voir les publications
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection