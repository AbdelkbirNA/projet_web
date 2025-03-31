<!-- Header (Layout Component) -->
<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <img src="{{ asset('IMG/logo.png') }}" alt="Logo ENSIASD" class="logo-img">
            </div>
            
            <!-- Navigation Desktop -->
            <nav class="nav-desktop">
                <ul class="nav-links">
                    <li><a href="#about" class="nav-link">À propos</a></li>
                    <li><a href="#formations" class="nav-link">Cour</a></li>
                    <li><a href="#professors" class="nav-link">Publications</a></li>
                    <li><a href="#contact" class="nav-link">Contact</a></li>
                </ul>
                <div class="nav-actions">
                    <button id="signin-button" class="btn btn-outline-primary">
                        <i class="fas fa-sign-in-alt"></i> Se connecter
                    </button>
                   
                    <button id="theme-toggle" class="theme-toggle" aria-label="Changer de thème">
                        <i class="fas fa-sun"></i>
                    </button>
                </div>
            </nav>
            
            <!-- Navigation Mobile -->
            <div class="nav-mobile">
                <button id="mobile-menu-button" class="mobile-menu-btn" aria-label="Ouvrir le menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        
        <!-- Menu Mobile -->
        <nav id="mobile-menu" class="mobile-menu hidden">
            <ul class="mobile-nav-links">
                <li><a href="#about" class="mobile-nav-link"><i class="fas fa-info-circle"></i> À propos</a></li>
                <li><a href="#formations" class="mobile-nav-link"><i class="fas fa-graduation-cap"></i> Formations</a></li>
                <li><a href="#professors" class="mobile-nav-link"><i class="fas fa-chalkboard-teacher"></i> Professeurs</a></li>
                <li><a href="#contact" class="mobile-nav-link"><i class="fas fa-envelope"></i> Contact</a></li>
        
            </ul>
        </nav>
    </div>
</header>