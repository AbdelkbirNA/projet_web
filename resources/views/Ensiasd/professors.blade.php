<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professeurs - ENSIASD</title>
    <meta name="description" content="Découvrez les professeurs de l'ENSIASD">
    
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS externe -->
    <link rel="stylesheet" href="{{ asset('css/ensiasd.css') }}">
</head>
<body>
    <!-- Toast Container -->
    <div id="toast-container" class="toast-container"></div>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="ENSIASD Logo" class="logo-img">
                        <h1 class="logo-text">ENSIASD</h1>
                    </a>
                </div>
                
                <!-- Navigation Desktop -->
                <nav class="nav-desktop">
                    <ul class="nav-links">
                        <li><a href="{{ route('home') }}" class="nav-link">Accueil</a></li>
                        <li><a href="#" class="nav-link">À propos</a></li>
                        <li><a href="{{ route('professors') }}" class="nav-link active">Professeurs</a></li>
                        <li><a href="#" class="nav-link">Départements</a></li>
                        <li><a href="#" class="nav-link">Recherche</a></li>
                        <li><a href="#contact" class="nav-link">Contact</a></li>
                    </ul>
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <button id="login-button" class="login-btn">
                            <i class="fas fa-user"></i> Connexion
                        </button>
                        
                        <button id="dark-mode-toggle" class="dark-mode-btn" aria-label="Toggle dark mode">
                            <i id="moon-icon" class="fas fa-moon"></i>
                            <i id="sun-icon" class="fas fa-sun hidden"></i>
                        </button>
                    </div>
                </nav>
                
                <!-- Navigation Mobile -->
                <div class="nav-mobile">
                    <button id="login-button-mobile" class="login-btn">
                        <i class="fas fa-user"></i>
                    </button>
                    
                    <button id="dark-mode-toggle-mobile" class="dark-mode-btn" aria-label="Toggle dark mode">
                        <i class="fas fa-moon"></i>
                    </button>
                    <button id="mobile-menu-button" class="mobile-menu-btn" aria-label="Toggle menu">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            
            <!-- Menu Mobile -->
            <nav id="mobile-menu" class="mobile-menu hidden">
                <ul class="mobile-nav-links">
                    <li><a href="{{ route('home') }}" class="mobile-nav-link">Accueil</a></li>
                    <li><a href="#" class="mobile-nav-link">À propos</a></li>
                    <li><a href="{{ route('professors') }}" class="mobile-nav-link active">Professeurs</a></li>
                    <li><a href="#" class="mobile-nav-link">Départements</a></li>
                    <li><a href="#" class="mobile-nav-link">Recherche</a></li>
                    <li><a href="#contact" class="mobile-nav-link">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <!-- Page Header -->
        <section class="page-header">
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
                        <label for="department-filter">Département:</label>
                        <select id="department-filter" class="filter-select">
                            <option value="all">Tous les départements</option>
                            <option value="ia">Intelligence Artificielle</option>
                            <option value="cybersecurity">Cybersécurité</option>
                            <option value="data-science">Science des Données</option>
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
                    <div class="professor-card" data-department="ia">
                        <div class="professor-image">
                            <img src="{{ asset('img/professors/john-doe.jpg') }}" alt="Prof. John Doe">
                        </div>
                        <div class="professor-content">
                            <h3 class="professor-name">Prof. John Doe</h3>
                            <p class="professor-title">Intelligence Artificielle</p>
                            <p class="professor-description">
                                Spécialiste en apprentissage automatique et IA explicable avec plus de 15 ans d'expérience.
                            </p>
                            <a href="#" class="btn btn-small btn-primary">Voir le profil</a>
                        </div>
                    </div>
                    
                    <!-- Professor 2 -->
                    <div class="professor-card" data-department="cybersecurity">
                        <div class="professor-image">
                            <img src="{{ asset('img/professors/jane-smith.jpg') }}" alt="Prof. Jane Smith">
                        </div>
                        <div class="professor-content">
                            <h3 class="professor-name">Prof. Jane Smith</h3>
                            <p class="professor-title">Cybersécurité</p>
                            <p class="professor-description">
                                Experte en sécurité des systèmes d'information et cryptographie avancée.
                            </p>
                            <a href="#" class="btn btn-small btn-primary">Voir le profil</a>
                        </div>
                    </div>
                    
                    <!-- Professor 3 -->
                    <div class="professor-card" data-department="data-science">
                        <div class="professor-image">
                            <img src="{{ asset('img/professors/ahmed-benali.jpg') }}" alt="Prof. Ahmed Benali">
                        </div>
                        <div class="professor-content">
                            <h3 class="professor-name">Prof. Ahmed Benali</h3>
                            <p class="professor-title">Science des Données</p>
                            <p class="professor-description">
                                Chercheur renommé en analyse de données massives et visualisation de l'information.
                            </p>
                            <a href="#" class="btn btn-small btn-primary">Voir le profil</a>
                        </div>
                    </div>
                    
                    <!-- Professor 4 -->
                    <div class="professor-card" data-department="ia">
                        <div class="professor-image">
                            <img src="{{ asset('img/professors/maria-garcia.jpg') }}" alt="Prof. Maria Garcia">
                        </div>
                        <div class="professor-content">
                            <h3 class="professor-name">Prof. Maria Garcia</h3>
                            <p class="professor-title">Intelligence Artificielle</p>
                            <p class="professor-description">
                                Spécialiste en traitement du langage naturel et systèmes de recommandation.
                            </p>
                            <a href="#" class="btn btn-small btn-primary">Voir le profil</a>
                        </div>
                    </div>
                    
                    <!-- Professor 5 -->
                    <div class="professor-card" data-department="cybersecurity">
                        <div class="professor-image">
                            <img src="{{ asset('img/professors/david-chen.jpg') }}" alt="Prof. David Chen">
                        </div>
                        <div class="professor-content">
                            <h3 class="professor-name">Prof. David Chen</h3>
                            <p class="professor-title">Cybersécurité</p>
                            <p class="professor-description">
                                Expert en sécurité des réseaux et analyse forensique numérique.
                            </p>
                            <a href="#" class="btn btn-small btn-primary">Voir le profil</a>
                        </div>
                    </div>
                    
                    <!-- Professor 6 -->
                    <div class="professor-card" data-department="data-science">
                        <div class="professor-image">
                            <img src="{{ asset('img/professors/sarah-johnson.jpg') }}" alt="Prof. Sarah Johnson">
                        </div>
                        <div class="professor-content">
                            <h3 class="professor-name">Prof. Sarah Johnson</h3>
                            <p class="professor-title">Science des Données</p>
                            <p class="professor-description">
                                Spécialiste en statistiques avancées et modélisation prédictive.
                            </p>
                            <a href="#" class="btn btn-small btn-primary">Voir le profil</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <div class="footer-logo">
                        <img src="{{ asset('img/logo.png') }}" alt="ENSIASD Logo" class="logo-img">
                        <h3 class="footer-title">ENSIASD</h3>
                    </div>
                    <p class="footer-description">
                        École Nationale Supérieure d'Informatique et Sciences des Données, formant les experts de demain en informatique, IA et analyse de données.
                    </p>
                </div>
                
                <div class="footer-links">
                    <div class="footer-links-group">
                        <h4 class="footer-links-title">Navigation</h4>
                        <ul class="footer-links-list">
                            <li><a href="{{ route('home') }}">Accueil</a></li>
                            <li><a href="#">À propos</a></li>
                            <li><a href="{{ route('professors') }}">Professeurs</a></li>
                            <li><a href="#">Départements</a></li>
                            <li><a href="#">Recherche</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-links-group">
                        <h4 class="footer-links-title">Ressources</h4>
                        <ul class="footer-links-list">
                            <li><a href="#">Bibliothèque</a></li>
                            <li><a href="#">Laboratoires</a></li>
                            <li><a href="#">Projets étudiants</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-links-group">
                        <h4 class="footer-links-title">Suivez-nous</h4>
                        <ul class="footer-links-list">
                            <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                            <li><a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i> YouTube</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p class="copyright">
                    © <span id="current-year"></span> ENSIASD. Tous droits réservés.
                </p>
                <p class="university">
                    École Nationale Supérieure d'Informatique et Sciences des Données
                </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="{{ asset('js/ensiasd.js') }}"></script>
</body>
</html>