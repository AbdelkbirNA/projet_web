@extends('layouts.master')

@section('title', 'À propos - ENSIASD')
@section('description', 'Page à propos du profil professeur ENSIASD')

@section('content')
<style>
    .profile-section {
        background-color: #f8f9fa;
        padding: 40px 0;
        min-height: calc(100vh - 300px);
    }
    .profile-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        margin-bottom: 32px;
    }
    .profile-card:hover {
        transform: translateY(-5px);
    }
    .profile-header {
        background: linear-gradient(135deg, #1e88e5, #1565c0);
        color: white;
        padding: 12px 10px 12px 10px;
        border-radius: 15px 15px 0 0;
        text-align: center;
    }
    .profile-image {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        border: 6px solid white;
        margin-bottom: 8px;
        object-fit: cover;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .profile-info {
        padding: 36px 30px 36px 30px;
        line-height: 2.1;
    }
    .section-title {
        color: #1565c0;
        border-bottom: 2px solid #1e88e5;
        padding-bottom: 14px;
        margin-bottom: 28px;
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: 1px;
        line-height: 1.3;
    }
    h3, h5, h6 {
        line-height: 1.4;
    }
    h3 {
        font-size: 1.7rem;
        font-weight: 700;
    }
    h5 {
        font-size: 1.3rem;
        font-weight: 600;
    }
    h6 {
        font-size: 1.1rem;
        font-weight: 600;
    }
    .contact-info i {
        color: #1e88e5;
        margin-right: 10px;
    }
    .contact-info p {
        margin-bottom: 18px;
    }
    .experience-item, .formation-item, .competence-item {
        border-left: 3px solid #1e88e5;
        padding-left: 24px;
        margin-bottom: 32px;
    }
    .experience-item h6, .formation-item h6 {
        color: #1565c0;
        margin-bottom: 12px;
    }
    .competence-item {
        background: #f8f9fa;
        padding: 18px;
        border-radius: 8px;
        margin-bottom: 18px;
    }
    .competence-item strong {
        color: #1565c0;
    }
    /* Mode sombre */
    body.dark .profile-section {
        background-color: #181f2a;
    }
    body.dark .profile-card {
        background: #232b39;
        color: #f9fafb;
    }
    body.dark .profile-header {
        background: linear-gradient(135deg, #2563eb, #1a237e);
        color: #fff;
    }
    body.dark .section-title,
    body.dark h3, body.dark h5, body.dark h6 {
        color: #90caf9;
    }
    body.dark .profile-info,
    body.dark .contact-info p,
    body.dark .formation-item,
    body.dark .competence-item,
    body.dark .experience-item {
        color: #f9fafb;
    }
    body.dark .competence-item {
        background: #232b39;
    }
    body.dark .formation-item, body.dark .experience-item {
        border-left: 3px solid #90caf9;
    }
    body.dark .contact-info i {
        color: #90caf9;
    }
    body.dark input, body.dark textarea, body.dark select {
        background: #232b39;
        color: #f9fafb;
        border-color: #374151;
    }
    body.dark input::placeholder, body.dark textarea::placeholder {
        color: #b0b8c1;
    }
</style>

<div class="profile-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-card mb-4">
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
                            <button class="btn btn-sm btn-outline-primary mt-2" onclick="document.getElementById('photo-import-form').style.display='block'">
                                <i class="fas fa-camera"></i> Importer une photo
                            </button>
                            <form id="photo-import-form" action="{{ route('profile.updatePhoto', $profile->id) }}" method="POST" enctype="multipart/form-data" style="display:none; margin-top:10px;">
                                @csrf
                                @method('PUT')
                                <input type="file" name="photo" accept="image/*" required>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Enregistrer</button>
                                <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="this.parentElement.style.display='none'">Annuler</button>
                            </form>
                        @endif
                    </div>
                    <div class="profile-info">
                        <h5 class="section-title">Contact</h5>
                        <div id="contact-display">
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
            </div>

            <div class="col-md-8">
                <div class="profile-card mb-4">
                    <div class="profile-info">
                        <h5 class="section-title">Biographie</h5>
                        <p>{{ $profile->biographie }}</p>
                    </div>
                </div>

                @if($profile->formations->count() > 0)
                <div class="profile-card mb-4">
                    <div class="profile-info">
                        <h5 class="section-title">Formation</h5>
                        @foreach($profile->formations as $formation)
                            <div class="formation-item">
                                <h6>{{ $formation->titre }}</h6>
                                <p class="text-muted">{{ $formation->etablissement }}</p>
                                <p><i class="far fa-calendar-alt text-primary"></i> {{ $formation->date_debut }} - {{ $formation->date_fin }}</p>
                                <p>{{ $formation->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($profile->competences->count() > 0)
                <div class="profile-card mb-4">
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

                @if($profile->experiences->count() > 0)
                <div class="profile-card mb-4">
                    <div class="profile-info">
                        <h5 class="section-title">Expérience</h5>
                        @foreach($profile->experiences as $experience)
                            <div class="experience-item">
                                <h6>{{ $experience->titre }}</h6>
                                <p class="text-muted">{{ $experience->lieu }}</p>
                                <p><i class="far fa-calendar-alt text-primary"></i> {{ $experience->date_debut }} - {{ $experience->date_fin }}</p>
                                <p>{{ $experience->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

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