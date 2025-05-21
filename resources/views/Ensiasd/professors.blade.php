@extends('layouts.master')

@section('title', 'Professeurs - ENSIASD')
@section('description', 'Découvrez les professeurs de l\'ENSIASD')

@push('styles')
@endpush

@section('content')
    <!-- Page Header -->
    <section class="page-header">
    <link rel="stylesheet" href="{{ asset('css/profs-content.css') }}">
        <div class="container">
            <h1 class="page-title">Nos Professeurs</h1>
            <p class="page-description">
                Découvrez notre corps professoral d'excellence, composé d'experts reconnus dans leurs domaines respectifs.
            </p>
        </div>
    </section>

    <!-- Professors Section -->
    <section class="professors-section section">
        <div class="container">
            <!-- Filters -->
            <div class="filter-container">
                <div class="filter-group">
                    <label for="department-filter">Filière:</label>
                    <select id="department-filter" class="filter-select">
                        <option value="all">Toutes les filières</option>
                        <option value="data-science">Sciences Des Données, Big Data & IA</option>
                        <option value="security">Sécurité IT Et Confiance Numérique</option>
                        <option value="management">Management et Gouvernance des SI</option>
                        <option value="software">Ingénierie Logicielle</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="search-professors">Rechercher:</label>
                    <input type="text" id="search-professors" class="filter-input" placeholder="Nom, spécialité...">
                </div>
            </div>
            
            <!-- Professors Grid -->
            <div class="professors-grid">
                @forelse($professors as $professor)
                    <div class="professor-card" data-department="{{ strtolower($professor->specialite) }}">
                        <div class="professor-image">
                            @if($professor->photo)
                                <img src="{{ asset('storage/' . $professor->photo) }}" alt="{{ $professor->prenom }} {{ $professor->nom }}">
                            @else
                                <img src="{{ asset('IMG/prof1.jpeg') }}" alt="{{ $professor->prenom }} {{ $professor->nom }}">
                            @endif
                        </div>
                        <div class="professor-content">
                            <h3 class="professor-name">{{ $professor->prenom }} {{ $professor->nom }}</h3>
                            <p class="professor-title">{{ $professor->specialite }}</p>
                            <p class="professor-description">
                                {{ $professor->statut }}
                            </p>
<a href="{{ route('professor.show', $professor->user_id) }}" class="btn btn-small btn-primary">Voir le profil</a>    
{{-- <a href="{{ route('student.professor.publications', $professor) }}" class="btn btn-small btn-primary">
    Voir les publications
</a> --}}                    </div> 
                    </div>
                @empty
                    <div class="alert alert-info text-center w-100">
                        Aucun professeur n'est disponible pour le moment.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // JavaScript spécifique à la page des professeurs
    document.addEventListener('DOMContentLoaded', function() {
        // Filtrage par département
        const departmentFilter = document.getElementById('department-filter');
        const searchInput = document.getElementById('search-professors');
        const professorCards = document.querySelectorAll('.professor-card');
        
        departmentFilter.addEventListener('change', filterProfessors);
        searchInput.addEventListener('input', filterProfessors);
        
        function filterProfessors() {
            const departmentValue = departmentFilter.value;
            const searchValue = searchInput.value.toLowerCase();
            
            professorCards.forEach(card => {
                const department = card.getAttribute('data-department');
                const professorName = card.querySelector('.professor-name').textContent.toLowerCase();
                const professorTitle = card.querySelector('.professor-title').textContent.toLowerCase();
                const professorDescription = card.querySelector('.professor-description').textContent.toLowerCase();
                
                const matchesDepartment = departmentValue === 'all' || department === departmentValue;
                const matchesSearch = searchValue === '' || 
                    professorName.includes(searchValue) || 
                    professorTitle.includes(searchValue) || 
                    professorDescription.includes(searchValue);
                
                if (matchesDepartment && matchesSearch) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    });
</script>
@endpush