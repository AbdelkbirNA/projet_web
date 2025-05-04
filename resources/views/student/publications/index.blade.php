@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Toutes les Publications (Étudiant)</h2>
    
    @foreach($publications as $pub)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $pub->titre_pub }}</h5>
            <p>{{ $pub->description }}</p>
            <small>
                Par: {{ $pub->user->name }} | 
                Année: {{ $pub->year }}
            </small>
        </div>
    </div>
    @endforeach
</div>
@endsection