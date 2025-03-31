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
                <!-- Professor 1 -->
                <div class="professor-card" data-department="data-science">
                    <div class="professor-image">
                        <img src="{{ asset('IMG/prof1.jpeg') }}" alt="Prof. John Doe">
                    </div>
                    <div class="professor-content">
                        <h3 class="professor-name">Prof. John Doe</h3>
                        <p class="professor-title">Sciences Des Données, Big Data & IA</p>
                        <p class="professor-description">
                            Spécialiste en apprentissage automatique et IA explicable avec plus de 15 ans d'expérience.
                        </p>
                        <a href="#" class="btn btn-small btn-primary">Voir le profil</a>
                    </div>
                </div>
                
                <!-- Professor 2 -->
                <div class="professor-card" data-department="security">
                    <div class="professor-image">
                        <img src="{{ asset('IMG/prof2.jpg') }}" alt="Prof. Jane Smith">
                    </div>
                    <div class="professor-content">
                        <h3 class="professor-name">Prof. Jane Smith</h3>
                        <p class="professor-title">Sécurité IT Et Confiance Numérique</p>
                        <p class="professor-description">
                            Experte en sécurité des systèmes d'information et cryptographie avancée.
                        </p>
                        <a href="#" class="btn btn-small btn-primary">Voir le profil</a>
                    </div>
                </div>
                
                <!-- Professor 3 -->
                <div class="professor-card" data-department="management">
                    <div class="professor-image">
                        <img src="{{ asset('IMG/prof3.jpg') }}" alt="Prof. Ahmed Benali">
                    </div>
                    <div class="professor-content">
                        <h3 class="professor-name">Prof. Ahmed Benali</h3>
                        <p class="professor-title">Management et Gouvernance des SI</p>
                        <p class="professor-description">
                            Chercheur renommé en gouvernance des systèmes d'information et transformation digitale.
                        </p>
                        <a href="#" class="btn btn-small btn-primary">Voir le profil</a>
                    </div>
                </div>
                
                <!-- Professor 4 -->
                <div class="professor-card" data-department="software">
                    <div class="professor-image">
                        <img src="{{ asset('IMG/prof1.jpeg') }}" alt="Prof. Maria Garcia">
                    </div>
                    <div class="professor-content">
                        <h3 class="professor-name">Prof. Maria Garcia</h3>
                        <p class="professor-title">Ingénierie Logicielle</p>
                        <p class="professor-description">
                            Spécialiste en génie logiciel, architecture des systèmes et méthodes agiles.
                        </p>
                        <a href="#" class="btn btn-small btn-primary">Voir le profil</a>
                    </div>
                </div>
                
                <!-- Professor 5 -->
                <div class="professor-card" data-department="security">
                    <div class="professor-image">
                        <img src="{{ asset('IMG/prof2.jpg') }}" alt="Prof. David Chen">
                    </div>
                    <div class="professor-content">
                        <h3 class="professor-name">Prof. David Chen</h3>
                        <p class="professor-title">Sécurité IT Et Confiance Numérique</p>
                        <p class="professor-description">
                            Expert en sécurité des réseaux et analyse forensique numérique.
                        </p>
                        <a href="#" class="btn btn-small btn-primary">Voir le profil</a>
                    </div>
                </div>
                
                <!-- Professor 6 -->
                <div class="professor-card" data-department="data-science">
                    <div class="professor-image">
                        <img src="{{ asset('IMG/prof3.jpg') }}" alt="Prof. Sarah Johnson">
                    </div>
                    <div class="professor-content">
                        <h3 class="professor-name">Prof. Sarah Johnson</h3>
                        <p class="professor-title">Sciences Des Données, Big Data & IA</p>
                        <p class="professor-description">
                            Spécialiste en statistiques avancées et modélisation prédictive.
                        </p>
                        <a href="#" class="btn btn-small btn-primary">Voir le profil</a>
                    </div>
                </div>
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