<!-- Header (Layout Component) -->
<header class="header">
    <div class="container">
        <div class="header-content">
           <div class="logo">
    <a href="{{ route('home') }}">
        <img src="{{ asset('IMG/logo.png') }}" alt="Logo ENSIASD" class="logo-img">
    </a>
</div>
            
            <!-- Navigation Desktop -->
            <nav class="nav-desktop">
                <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="nav-link">Accueil</a></li>
            <li>
                @auth
                    @if(Auth::user()->isProfessor())
                        <a href="{{ route('profile.about', Auth::user()->id) }}" class="nav-link">À propos</a>
                    @else
                        <a href="#about" class="nav-link">À propos</a>
                    @endif
                @else
                    <a href="#about" class="nav-link">À propos</a>
                @endauth
            </li>
            <li><a href="#formations" class="nav-link">Formations</a></li>
            <li>
                @auth
                    @if(Auth::user()->isProfessor())
                        <a href="{{ route('professors') }}" class="nav-link">Professeurs</a>
                    @else
                        <a href="#professors" class="nav-link">Professeurs</a>
                    @endif
                @else
                    <a href="#professors" class="nav-link">Professeurs</a>
                @endauth
            </li>
            <li><a href="{{ route('home') }}#contact" class="nav-link">Contact</a></li>
        </ul>
                <div class="nav-actions">
                    @guest
                        <button id="signin-button" class="btn btn-outline-primary">
                            <i class="fas fa-sign-in-alt"></i> Se connecter
                        </button>
                    @else
                        <div class="user-menu">
                            <button id="user-dropdown-button" class="btn btn-outline-primary">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </button>
            
                           <div id="user-dropdown" class="user-dropdown hidden">
            @if(Auth::check() && Auth::user()->user_type === 'professor')
    <a href="{{ route('professor.show', Auth::user()->id) }}" class="dropdown-item">
        <i class="fas fa-id-badge"></i> Profil
    </a>
@endif
                                <a href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                   class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                   
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
                <li>
                    @auth
                        @if(Auth::user()->isProfessor())
                            <a href="{{ route('profile.about', Auth::user()->id) }}" class="mobile-nav-link"><i class="fas fa-info-circle"></i> À propos</a>
                        @else
                            <a href="#about" class="mobile-nav-link"><i class="fas fa-info-circle"></i> À propos</a>
                        @endif
                    @else
                        <a href="#about" class="mobile-nav-link"><i class="fas fa-info-circle"></i> À propos</a>
                    @endauth
                </li>
                <li><a href="#formations" class="mobile-nav-link"><i class="fas fa-graduation-cap"></i> Formations</a></li>
                <li>
                    @auth
                        @if(Auth::user()->isProfessor())
                            <a href="{{ route('professors') }}" class="mobile-nav-link"><i class="fas fa-chalkboard-teacher"></i> Professeurs</a>
                        @else
                            <a href="#professors" class="mobile-nav-link"><i class="fas fa-chalkboard-teacher"></i> Professeurs</a>
                        @endif
                    @else
                        <a href="#professors" class="mobile-nav-link"><i class="fas fa-chalkboard-teacher"></i> Professeurs</a>
                    @endauth
                </li>
                <li><a href="{{ route('home') }}#contact" class="mobile-nav-link"><i class="fas fa-envelope"></i> Contact</a></li>
                <li><a href="#" id="theme-toggle-mobile" class="mobile-nav-link"><i class="fas fa-sun"></i> Changer de thème</a></li>
                @guest
                    <li><a href="#" id="signin-mobile" class="mobile-nav-link"><i class="fas fa-sign-in-alt"></i> Se connecter</a></li>
                    <li><a href="#" id="signup-mobile" class="mobile-nav-link highlight"><i class="fas fa-user-plus"></i> S'inscrire</a></li>
                @else
                    <li><a href="#" class="mobile-nav-link"><i class="fas fa-user"></i> {{ Auth::user()->name }}</a></li>
                    <li>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" 
                           class="mobile-nav-link logout-link">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </a>
                        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </nav>
    </div>
</header>
