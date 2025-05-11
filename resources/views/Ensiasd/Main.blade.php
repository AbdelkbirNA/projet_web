@extends('layouts.master')

@section('title', 'ENSIASD - Accueil')
@section('description', 'École Nationale Supérieure d\'Intelligence Artificielle et Science des Données - Formation d\'excellence en IA et Data Science')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">ENSIASD</h1>
                    <h2 class="hero-subtitle">École Nationale Supérieure d'Intelligence Artificielle et Science des Données</h2>
                    <p class="hero-description">
                        Former les experts de demain dans les domaines de l'Intelligence Artificielle et de la Science des Données
                    </p>
                    <div class="hero-buttons">
                        <a href="#formations" class="btn btn-outline"><i class="fas fa-graduation-cap"></i> Découvrir nos formations</a>
                        <a href="#contact" class="btn btn-outline"><i class="fas fa-envelope"></i> Nous contacter</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">
            <h2 class="section-title">À propos de l'ENSIASD</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>
                    L'École Nationale Supérieure de l'Intelligence Artificielle et Sciences des Données (ENSIASD) est un établissement d'enseignement supérieur spécialisé dans la formation des ingénieurs en intelligence artificielle, data science et ingénierie logicielle. Située à Taroudant, l'école vise à préparer une nouvelle génération d'ingénieurs capables de relever les défis technologiques et numériques de demain.
                    </p>
                    <p>
                    Grâce à un programme axé sur l'innovation, la recherche et les nouvelles technologies, l'ENSIASD offre une formation de haut niveau combinant théorie et pratique. Les étudiants développent des compétences en apprentissage automatique, big data, cybersécurité, développement logiciel et systèmes intelligents, tout en étant encouragés à entreprendre et à innover.
                    </p>
                    <div class="about-stats">
                        <div class="stat-item">
                            <span class="stat-number">300+</span>
                            <span class="stat-label">Étudiants</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">25</span>
                            <span class="stat-label">Professeurs</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">95%</span>
                            <span class="stat-label">Taux d'insertion</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">3</span>
                            <span class="stat-label">Partenaires</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formations Section -->
    <section id="formations" class="formations section">
        <div class="container">
            <h2 class="section-title">Nos Formations</h2>
            <p class="section-description">
                Découvrez nos programmes d'études conçus pour vous préparer aux métiers d'avenir dans l'IA et la Data Science.
            </p>
            <div class="formations-grid">
                <!-- Formation DATA -->
                <div class="formation-item">
                    <div class="formation-image">
                        <img src="{{ asset('IMG/data.jpg') }}" alt="Ingénieur en IA">
                        <div class="formation-level">Bac+5</div>
                    </div>
                    <div class="formation-content">
                        <h3 class="formation-title">Sciences Des Données, Big Data & IA</h3>
                        <p class="formation-description">
                        Les Sciences des Données, le Big Data et l'IA traitent de l'analyse de grandes quantités de données. Le Big Data gère des volumes massifs, tandis que les Sciences des Données extraient des informations utiles. L'IA permet aux systèmes d'apprendre et de prendre des décisions autonomes, améliorant ainsi l'efficacité. Ces technologies sont cruciales pour l'innovation.
                        </p>     
                    </div>
                </div>
                
                <!-- Formation Cyber -->
                <div class="formation-item">
                    <div class="formation-image">
                        <img src="{{ asset('IMG/cyber.jpg') }}" alt="Master Data Science">
                        <div class="formation-level">Bac+5</div>
                    </div>
                    <div class="formation-content">
                        <h3 class="formation-title">Sécurité IT Et Confiance Numérique</h3>
                        <p class="formation-description">
                        La filière "Sécurité IT & Confiance Numérique" à l'ENSIASD forme des ingénieurs en cybersécurité, cryptographie et protection des systèmes d'information. Elle couvre la sécurisation des réseaux, la gestion des cybermenaces et la conformité réglementaire. Les étudiants apprennent à utiliser des outils comme Kali Linux, Wireshark et SIEM.
                        </p>
                    </div>
                </div>
                
                <!-- Formation MGSI -->
                <div class="formation-item">
                    <div class="formation-image">
                        <img src="{{ asset('IMG/mgsi.jpg') }}" alt="Doctorat">
                        <div class="formation-level">Bac+5</div>
                    </div>
                    <div class="formation-content">
                        <h3 class="formation-title">Management et Gouvernance des Systèmes d'Information</h3>
                        <p class="formation-description">
                        La filière Management et Gouvernance des Systèmes d'Information (MGSI) forme des professionnels capables de gérer et optimiser les systèmes d'information au sein des organisations. Elle allie compétences techniques en informatique et gestion stratégique. L'objectif est de garantir la sécurité, l'efficacité et l'alignement des SI avec les objectifs d'entreprise.
                        </p>
                    </div>
                </div>
                <!-- Formation IL -->
                <div class="formation-item">
                    <div class="formation-image">
                        <img src="{{ asset('IMG/il.jpg') }}" alt="Doctorat">
                        <div class="formation-level">Bac+5</div>
                    </div>
                    <div class="formation-content">
                        <h3 class="formation-title">Ingénierie Logicielle</h3>
                        <p class="formation-description">
                        L'Ingénierie Logicielle consiste à appliquer des méthodes et des outils pour concevoir, développer et maintenir des logiciels fiables et efficaces. Elle couvre toutes les étapes du cycle de vie du logiciel, en mettant l'accent sur la qualité, la gestion de projet et la collaboration.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Professors Section -->
    <section id="professors" class="professors section">
        <div class="container">
            <h2 class="section-title">Nos Professeurs</h2>
            <p class="section-description">
                Découvrez notre équipe pédagogique composée d'experts reconnus dans leurs domaines respectifs.
            </p>
            <div class="professors-preview">
                <div class="professors-grid">
                    <!-- Professor 1 -->
                    <div class="professor-card">
                        <div class="professor-image">
                            <img src="{{ asset('IMG/abdo1.jpg') }}" alt="Dr. Mohammed Amine" class="imageabdo">
                        </div>
                        <div class="professor-content">
                            <h3 class="professor-name">Dr. Mohammed Amine</h3>
                            <p class="professor-title">Professeur en Intelligence Artificielle</p>
                            <p class="professor-description">
                                Spécialiste en apprentissage automatique et réseaux de neurones profonds avec plus de 15 ans d'expérience dans la recherche et l'enseignement.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Professor 2 -->
                    <div class="professor-card">
                        <div class="professor-image">
                            <img src="{{ asset('IMG/abdo2.jpg') }}" alt="Dr. Fatima Zahra" class="imageabdo">
                        </div>
                        <div class="professor-content">
                            <h3 class="professor-name">Dr. Fatima Zahra</h3>
                            <p class="professor-title">Professeur en Science des Données</p>
                            <p class="professor-description">
                                Experte en analyse statistique et visualisation de données, avec une solide expérience dans l'industrie et plusieurs publications internationales.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Professor 3 -->
                    <div class="professor-card">
                        <div class="professor-image">
                            <img src="{{ asset('IMG/abdo3.jpg') }}" alt="Dr. Youssef" class="imageabdo">
                        </div>
                        <div class="professor-content">
                            <h3 class="professor-name">Dr. Youssef</h3>
                            <p class="professor-title">Professeur en Cybersécurité</p>
                            <p class="professor-description">
                                Spécialiste en sécurité des systèmes d'information et cryptographie, avec une expertise reconnue dans la protection des infrastructures critiques.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="professors-more">
                    <a href="{{ route('professors') }}" id="view-team-button" class="btn btn-outline-primary">
    <i class="fas fa-users"></i> Voir toute l'équipe
</a>
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
                    <h3 class="contact-subtitle">Nous contacter</h3>
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
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Envoyer le message</button>
                    </form>
                </div>
                
                <div class="contact-info">
                    <h3 class="contact-subtitle">Informations de contact</h3>
                    <div class="info-group">
                        <h4 class="info-title"><i class="fas fa-map-marker-alt"></i> Adresse</h4>
                        <p class="info-text">
                        ENSIASD Taroudant – Lastah - BP: 264
                        </p>
                    </div>
                    <div class="info-group">
                        <h4 class="info-title"><i class="fas fa-envelope"></i> Email</h4>
                        <p class="info-text">contact@ensiasd.ma</p>
                    </div>
                    <div class="info-group">
                        <h4 class="info-title"><i class="fas fa-phone"></i> Téléphone</h4>
                        <p class="info-text">+212525971682</p>
                    </div>
                    <div class="info-group">
                        <h4 class="info-title"><i class="fas fa-clock"></i> Horaires d'ouverture</h4>
                        <p class="info-text">
                            Lundi - Vendredi: 8h30 - 18h15<br>
                            Samedi: 9h00 - 12h00<br>
                            Fermé le dimanche
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Mettre à jour l'année actuelle dans le footer
    document.getElementById('current-year').textContent = new Date().getFullYear();
</script>
@endpush