@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Carte 1 -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Publications</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">Gérer vos publications académiques</p>
                    <a href="{{ route("professor.publications.index") }}" class="btn btn-primary">
                        Accéder <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Carte 2 -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title">Courses</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">Gérer Les Cources</p>
                    <a href=" " class="btn btn-success">
                        Accéder <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Carte 3 -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">Profil</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">Modifier votre profil professeur</p>
                    <a href="" class="btn btn-info">
                        Accéder <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection