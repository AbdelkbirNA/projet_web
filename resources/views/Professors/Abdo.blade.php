@extends('layouts.professor-layout')

@section('title', 'Prof. John Doe - Portfolio Académique')
@section('description', 'Portfolio académique du Professeur John Doe, spécialiste en Intelligence Artificielle et Apprentissage Automatique')

@section('professor_name', 'Prof. John Doe')
@section('professor_title', 'Professeur en Informatique')
@section('professor_speciality', 'Spécialiste en Intelligence Artificielle et Apprentissage Automatique')
@section('professor_image', asset('img/prof-john-doe.jpg'))

@section('content')
    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">
            <h2 class="section-title">À propos</h2>
            <div class="about-content">
                <div class="about-image">
                    <img src="{{ asset('img/prof-john-doe.jpg') }}" alt="Professor John Doe" class="about-img">
                </div>
                <div class="about-text">
                    <p>
                        Je suis Professeur en Informatique à l'ENSIASD, spécialisé dans les domaines de l'Intelligence Artificielle et de l'Apprentissage Automatique. Avec plus de 15 ans d'expérience dans l'enseignement et la recherche, j'ai contribué à de nombreux projets innovants et publié dans des revues scientifiques prestigieuses.
                    </p>
                    <p>
                        Mon parcours académique inclut un doctorat de l'École Polytechnique et des collaborations avec des institutions comme le MIT et Stanford. Je dirige actuellement le laboratoire d'IA appliquée où nous développons des solutions pour des problèmes complexes dans les domaines de la santé, de l'environnement et de l'éducation.
                    </p>
                    <div class="about-links">
                        <a href="https://scholar.google.com" target="_blank" rel="noopener noreferrer" class="link-scholar">
                            <i class="fas fa-graduation-cap"></i> Google Scholar
                        </a>
                        <a href="#" class="link-cv">
                            <i class="fas fa-file-alt"></i> Curriculum Vitae
                        </a>
                        <a href="#" class="link-linkedin">
                            <i class="fab fa-linkedin"></i> LinkedIn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Research Section -->
    <section id="research" class="research section">
        <div class="container">
            <h2 class="section-title">Recherche</h2>
            <div class="research-grid">
                <!-- Research Item 1 -->
                <div class="research-item">
                    <div class="research-image">
                        <img src="{{ asset('img/research-xai.jpg') }}" alt="Intelligence Artificielle Explicable">
                    </div>
                    <div class="research-content">
                        <h3 class="research-title">Intelligence Artificielle Explicable</h3>
                        <p class="research-description">
                            Développement de méthodes pour rendre les décisions des systèmes d'IA compréhensibles et transparentes.
                        </p>
                        <a href="#" class="research-link">En savoir plus →</a>
                    </div>
                </div>

                <!-- Research Item 2 -->
                <div class="research-item">
                    <div class="research-image">
                        <img src="{{ asset('img/research-health.jpg') }}" alt="Apprentissage Profond pour la Santé">
                    </div>
                    <div class="research-content">
                        <h3 class="research-title">Apprentissage Profond pour la Santé</h3>
                        <p class="research-description">
                            Application des techniques d'apprentissage profond pour le diagnostic médical et la découverte de médicaments.
                        </p>
                        <a href="#" class="research-link">En savoir plus →</a>
                    </div>
                </div>

                <!-- Research Item 3 -->
                <div class="research-item">
                    <div class="research-image">
                        <img src="{{ asset('img/research-agents.jpg') }}" alt="Systèmes Multi-Agents">
                    </div>
                    <div class="research-content">
                        <h3 class="research-title">Systèmes Multi-Agents</h3>
                        <p class="research-description">
                            Conception de systèmes où plusieurs agents intelligents interagissent pour résoudre des problèmes complexes.
                        </p>
                        <a href="#" class="research-link">En savoir plus →</a>
                    </div>
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
                        <img src="{{ asset('img/course-ia.jpg') }}" alt="Intelligence Artificielle">
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
                        <img src="{{ asset('img/course-deep.jpg') }}" alt="Apprentissage Profond">
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
                        <img src="{{ asset('img/course-algo.jpg') }}" alt="Algorithmique Avancée">
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
    <section id="contact" class="contact section">
        <div class="container">
            <h2 class="section-title">Contact</h2>
            <div class="contact-content">
                <div class="contact-form">
                    <h3 class="contact-subtitle">Envoyez-moi un message</h3>
                    <form id="contact-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subject">Sujet</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer le message</button>
                    </form>
                </div>

                <div class="contact-info">
                    <h3 class="contact-subtitle">Informations de contact</h3>
                    <div class="info-group">
                        <h4 class="info-title">Adresse</h4>
                        <p class="info-text">
                            ENSIASD<br>
                            Département d'Informatique<br>
                            123 Avenue de l'Innovation, 75013 Paris
                        </p>
                    </div>
                    <div class="info-group">
                        <h4 class="info-title">Email</h4>
                        <p class="info-text">john.doe@ensiasd.ma</p>
                    </div>
                    <div class="info-group">
                        <h4 class="info-title">Téléphone</h4>
                        <p class="info-text">+33 1 23 45 67 89</p>
                    </div>
                    <div class="info-group">
                        <h4 class="info-title">Heures de bureau</h4>
                        <p class="info-text">
                            Lundi: 14h - 16h<br>
                            Mercredi: 10h - 12h<br>
                            Ou sur rendez-vous
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection