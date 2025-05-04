@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <div class="alert alert-success">
            Vous êtes connecté en tant que {{ auth()->user()->name }} ({{ auth()->user()->user_type }})
        </div>
    @endauth
</div>
@endsection