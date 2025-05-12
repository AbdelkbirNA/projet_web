<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portfolio Professeur - ENSIASD')</title>
    <meta name="description" content="@yield('description', 'Portfolio du professeur à l\'École Nationale Supérieure d\'Intelligence Artificielle et Science des Données')">
    
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- CSS principal -->
    <link rel="stylesheet" href="{{ asset('css/ensiasd.css') }}">

    @stack('styles')
</head>
<body>
    <!-- Toast Container -->
    <div id="toast-container" class="toast-container"></div>
    
    <!-- Header spécifique au portfolio -->
    @include('layouts.partials.professor-header')

    @include('layouts.partials.modals')

    <!-- Main Content -->
    <main>
        <!-- Hero Section (Professor Banner) -->
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1 class="hero-title">@yield('professor_name', 'Prof. John Doe')</h1>
                        <h2 class="hero-subtitle">@yield('professor_title', 'Professeur en Informatique')</h2>
                        <p class="hero-description">@yield('professor_speciality', 'Spécialiste en Intelligence Artificielle et Apprentissage Automatique')</p>
                        
                    </div>
                    <div class="hero-image">
                        <img src="@yield('professor_image', asset('img/default-professor.jpg'))" alt="@yield('professor_name', 'Professeur')" class="professor-img">
                    </div>
                </div>
            </div>
        </section>

        <!-- Contenu principal dynamique -->
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- JavaScript -->
    <script src="{{ asset('js/ensiasd.js') }}"></script>
    @stack('scripts')
</body>
</html>