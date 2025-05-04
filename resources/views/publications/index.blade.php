@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mes Publications (Professeur)</h2>
    
    @foreach($publications as $pub)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $pub->titre_pub }}</h5>
            <p>{{ $pub->description }}</p>
            <small>Année: {{ $pub->year }}</small>
        </div>
    </div>
    @endforeach
</div>
@endsection