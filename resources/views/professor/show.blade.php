@extends('layouts.professor-layout')

@section('title', 'Prof. ' . $profile->prenom . ' ' . $profile->nom)
@section('description', 'Portfolio académique du Professeur ' . $profile->prenom . ' ' . $profile->nom)

@section('professor_name', 'Prof. ' . $profile->prenom . ' ' . $profile->nom)
@section('professor_title', 'Professeur en ' .$profile->statut)
@section('professor_speciality', 'Spécialiste en '.$profile->specialite)
@section('professor_image', $profile->photo ? asset('storage/' . $profile->photo) : asset('IMG/prof1.jpeg'))

@section('content')
    <!-- About Section dynamique -->
    <link rel="stylesheet" href="{{ asset('css/prof_content.css') }}">
    <section id="about" class="about section">
        <div class="container">
            <h2 class="section-title">À propos </h2>
            <div class="about-content">
                <div class="about-image">
<img src="{{ $profile->photo ? asset('storage/' . $profile->photo) : asset('IMG/prof1.jpeg') }}" alt="Photo de {{ $profile->prenom }} {{ $profile->nom }}" class="about-img">                </div>
                <div class="about-text">
                    @if($profile->biographie)
                        <p>{{ $profile->biographie }}</p>
                    @else
                        <p>
                            Professeur à l'ENSIASD , spécialisé en {{ $profile->specialite ?? 'Informatique' }}.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>

       <!-- Publications Section -->
    <section id="publications" class="publications section">
        <div class="container">
            <h2 class="section-title">Publications</h2>
            <p class="section-description">
                Une sélection de mes publications récentes dans des revues et conférences internationales.
            </p>

            <div class="publications-filter">
                <button class="filter-btn active">Toutes</button>
                <button class="filter-btn">2023</button>
                <button class="filter-btn">2022</button>
                <button class="filter-btn">2021</button>
            </div>

            <div class="publications-list">
                <!-- Publication 1 -->
                <div class="publication-item">
                    <h3 class="publication-title">Explainable AI for Medical Diagnosis: A Novel Approach Using Attention Mechanisms</h3>
                    <p class="publication-journal">
                        <span class="journal-name">Journal of Artificial Intelligence in Medicine</span>, 2023
                    </p>
                    <p class="publication-authors">Doe J., Smith A., Johnson B.</p>
                    <div class="publication-links">
                        <a href="#" class="publication-link">Lire l'article</a>
                        <a href="#" class="publication-link">Télécharger PDF</a>
                    </div>
                </div>

                <!-- Publication 2 -->
                <div class="publication-item">
                    <h3 class="publication-title">Multi-Agent Reinforcement Learning for Traffic Optimization in Smart Cities</h3>
                    <p class="publication-journal">
                        <span class="journal-name">IEEE Transactions on Intelligent Transportation Systems</span>, 2022
                    </p>
                    <p class="publication-authors">Doe J., Williams C., Brown D.</p>
                    <div class="publication-links">
                        <a href="#" class="publication-link">Lire l'article</a>
                        <a href="#" class="publication-link">Télécharger PDF</a>
                    </div>
                </div>

                <!-- Publication 3 -->
                <div class="publication-item">
                    <h3 class="publication-title">Deep Learning Approaches for Drug Discovery: Challenges and Opportunities</h3>
                    <p class="publication-journal">
                        <span class="journal-name">Nature Machine Intelligence</span>, 2022
                    </p>
                    <p class="publication-authors">Smith A., Doe J., Garcia E., Wilson F.</p>
                    <div class="publication-links">
                        <a href="#" class="publication-link">Lire l'article</a>
                        <a href="#" class="publication-link">Télécharger PDF</a>
                    </div>
                </div>

                <!-- Publication 4 -->
                <div class="publication-item">
                    <h3 class="publication-title">Towards Ethical AI: A Framework for Responsible Development and Deployment</h3>
                    <p class="publication-journal">
                        <span class="journal-name">ACM Conference on Fairness, Accountability, and Transparency (FAccT)</span>, 2021
                    </p>
                    <p class="publication-authors">Doe J., Martinez G.</p>
                    <div class="publication-links">
                        <a href="#" class="publication-link">Lire l'article</a>
                        <a href="#" class="publication-link">Télécharger PDF</a>
                    </div>
                </div>
            </div>

            <div class="publications-more">
                <a href="#" class="btn btn-primary">Voir toutes les publications</a>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section id="courses" class="courses section">
        <div class="container">
            <h2 class="section-title">Cours</h2>
            <div class="courses-grid">
                <!-- Course 1 -->
                <div class="course-item">
                    <div class="course-image">
                        <img src="{{ asset('IMG/cour1.jpg') }}" alt="Intelligence Artificielle">
                        <div class="course-level">Master 1</div>
                    </div>
                    <div class="course-content">
                        <div class="course-header">
                            <h3 class="course-title">Intelligence Artificielle</h3>
                            <span class="course-code">INFO4302</span>
                        </div>
                        <p class="course-semester">Semestre 1</p>
                        <p class="course-description">
                            Introduction aux concepts fondamentaux de l'IA, algorithmes de recherche, représentation des connaissances et apprentissage automatique.
                        </p>
                        <div class="course-links">
                            <a href="#" class="btn btn-small btn-primary">Syllabus</a>
                            <a href="#" class="btn btn-small btn-outline">Ressources</a>
                        </div>
                    </div>
                </div>

                <!-- Course 2 -->
                <div class="course-item">
                    <div class="course-image">
                        <img src="{{ asset('IMG/cour2.jpg') }}" alt="Apprentissage Profond">
                        <div class="course-level">Master 2</div>
                    </div>
                    <div class="course-content">
                        <div class="course-header">
                            <h3 class="course-title">Apprentissage Profond</h3>
                            <span class="course-code">INFO5501</span>
                        </div>
                        <p class="course-semester">Semestre 1</p>
                        <p class="course-description">
                            Réseaux de neurones profonds, CNN, RNN, transformers et applications pratiques avec PyTorch et TensorFlow.
                        </p>
                        <div class="course-links">
                            <a href="#" class="btn btn-small btn-primary">Syllabus</a>
                            <a href="#" class="btn btn-small btn-outline">Ressources</a>
                        </div>
                    </div>
                </div>

                <!-- Course 3 -->
                <div class="course-item">
                    <div class="course-image">
                        <img src="{{ asset('IMG/cour3.jpg') }}" alt="Algorithmique Avancée">
                        <div class="course-level">Licence 3</div>
                    </div>
                    <div class="course-content">
                        <div class="course-header">
                            <h3 class="course-title">Algorithmique Avancée</h3>
                            <span class="course-code">INFO3201</span>
                        </div>
                        <p class="course-semester">Semestre 2</p>
                        <p class="course-description">
                            Analyse et conception d'algorithmes, complexité, programmation dynamique, algorithmes gloutons et diviser pour régner.
                        </p>
                        <div class="course-links">
                            <a href="#" class="btn btn-small btn-primary">Syllabus</a>
                            <a href="#" class="btn btn-small btn-outline">Ressources</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    
@endsection