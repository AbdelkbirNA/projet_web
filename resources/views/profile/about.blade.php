@extends('layouts.type')

@section('title', 'À propos - ENSIASD')
@section('description', 'Page à propos du profil professeur ENSIASD')

@section('content')
<link rel="stylesheet" href="{{ asset('css/about-page.css') }}">

<div class="profile-section">
    <div class="container">
        <div class="row">
            <!-- Carte de profil -->
            <div class="col-md-4">
                <div class="profile-card">
                    <div class="profile-header">
                        @if($profile->photo)
                            <img src="{{ asset('storage/' . $profile->photo) }}" alt="Photo de profil" class="profile-image">
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" alt="Photo de profil par défaut" class="profile-image">
                        @endif
                        <h3 class="mb-2">{{ $profile->prenom }} {{ $profile->nom }}</h3>
                        <p class="mb-1">{{ $profile->statut }}</p>
                        <p>{{ $profile->specialite }}</p>
                        @if(!$profile->photo && Auth::check() && Auth::id() === $profile->user_id)
                            <button class="btn btn-sm btn-outline-light mt-3" onclick="document.getElementById('photo-import-form').style.display='block'">
                                <i class="fas fa-camera"></i> Importer une photo
                            </button>
                            <form id="photo-import-form" action="{{ route('profile.updatePhoto', $profile->id) }}" method="POST" enctype="multipart/form-data" style="display:none; margin-top:15px;">
                                @csrf
                                @method('PUT')
                                <input type="file" name="photo" accept="image/*" required class="form-control">
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-light btn-sm">Enregistrer</button>
                                    <button type="button" class="btn btn-outline-light btn-sm" onclick="this.parentElement.parentElement.style.display='none'">Annuler</button>
                                </div>
                            </form>
                        @endif
                    </div>
                    <div class="profile-info">
                        <h5 class="section-title">Contact</h5>
                        <div class="contact-info">
                            <p><i class="fas fa-envelope"></i> {{ $profile->email }}</p>
                            <p><i class="fas fa-phone"></i> {{ $profile->telephone }}</p>
                            <p><i class="fas fa-map-marker-alt"></i> {{ $profile->adresse }}</p>
                            @if($profile->reseaux_sociaux)
                                <p><i class="fas fa-globe"></i> {{ $profile->reseaux_sociaux }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="col-md-8">
                <!-- Biographie -->
                <div class="profile-card">
                    <div class="profile-info">
                        <h5 class="section-title">Biographie</h5>
                        <p>{{ $profile->biographie }}</p>
                    </div>
                </div>

                <!-- Formations -->
                @if($profile->formations->count() > 0)
                <div class="profile-card">
                    <div class="profile-info">
                        <h5 class="section-title">Formation</h5>
                        @foreach($profile->formations as $formation)
                            <div class="formation-item">
                                <h6>{{ $formation->titre }}</h6>
                                <p class="text-muted">{{ $formation->etablissement }}</p>
                                <p><i class="far fa-calendar-alt"></i> {{ $formation->date_debut }} - {{ $formation->date_fin }}</p>
                                <p>{{ $formation->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Compétences -->
                @if($profile->competences->count() > 0)
                <div class="profile-card">
                    <div class="profile-info">
                        <h5 class="section-title">Compétences</h5>
                        <div class="row">
                            @foreach($profile->competences as $competence)
                                <div class="col-md-6">
                                    <div class="competence-item">
                                        <p><strong>{{ $competence->nom }}</strong> - {{ $competence->niveau }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Expériences -->
                @if($profile->experiences->count() > 0)
                <div class="profile-card">
                    <div class="profile-info">
                        <h5 class="section-title">Expérience</h5>
                        @foreach($profile->experiences as $experience)
                            <div class="experience-item">
                                <h6>{{ $experience->titre }}</h6>
                                <p class="text-muted">{{ $experience->lieu }}</p>
                                <p><i class="far fa-calendar-alt"></i> {{ $experience->date_debut }} - {{ $experience->date_fin }}</p>
                                <p>{{ $experience->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Bouton de modification -->
        @if(Auth::check() && Auth::id() === $profile->user_id)
            <div class="text-start mt-4 mb-4">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Modifier mon profil
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 