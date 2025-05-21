<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ENSIASD - École Nationale Supérieure d\'Intelligence Artificielle et Science des Données')</title>
    <meta name="description" content="@yield('description', 'École Nationale Supérieure d\'Intelligence Artificielle et Science des Données - Formation d\'excellence en IA et Data Science')">

    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS principal -->
    <link rel="stylesheet" href="{{ asset('css/ensiasd.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')
    <style>
        body.dark-mode {
            background: #181a1b !important;
            color: #e0e0e0 !important;
        }
        .section.dark-mode, .container.dark-mode {
            background: #181a1b !important;
            color: #e0e0e0 !important;
        }
        .contact-form-wrapper.dark-mode {
            background: #23272b !important;
            color: #e0e0e0 !important;
            box-shadow: 0 4px 24px rgba(0,0,0,0.4);
        }
        .contact-form-wrapper.dark-mode input,
        .contact-form-wrapper.dark-mode select,
        .contact-form-wrapper.dark-mode textarea {
            background: #181a1b !important;
            color: #e0e0e0 !important;
            border-color: #444 !important;
        }
        .contact-form-wrapper.dark-mode input:focus,
        .contact-form-wrapper.dark-mode select:focus,
        .contact-form-wrapper.dark-mode textarea:focus {
            border-color: #1976d2 !important;
        }
        .contact-form-wrapper.dark-mode button[type="submit"] {
            background: #1976d2 !important;
            color: #fff !important;
        }
        .contact-form-wrapper.dark-mode .form-label {
            color: #90caf9 !important;
        }
        .contact-form-wrapper.dark-mode .alert-success {
            background: #244b2f !important;
            color: #b9f6ca !important;
        }
        .contact-form-wrapper.dark-mode .text-muted {
            color: #b0b0b0 !important;
        }
    </style>
</head>
<body>
    <!-- Header dynamique selon le type d'utilisateur -->
    @auth
        @if(Auth::user()->user_type === 'professor')
            @include('layouts.partials.headerprof')
        @else
            @include('layouts.partials.header')
        @endif
    @else
        @include('layouts.partials.header')
    @endauth
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- Modals -->
    @include('layouts.partials.modals')

    <!-- Toast Notifications -->
    <div id="toast-container" class="toast-container"></div>

    <!-- JavaScript -->
    <script src="{{ asset('js/ensiasd.js') }}"></script>
    <script>
        // Gestion du mode sombre
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            const body = document.body;
            const formWrapper = document.querySelector('.contact-form-wrapper');
            const sections = document.querySelectorAll('.section');
            const containers = document.querySelectorAll('.container');
            // Récupérer le mode depuis le localStorage
            if(localStorage.getItem('theme') === 'dark') {
                body.classList.add('dark-mode');
                if(formWrapper) formWrapper.classList.add('dark-mode');
                sections.forEach(s => s.classList.add('dark-mode'));
                containers.forEach(c => c.classList.add('dark-mode'));
            }
            if(themeToggle) {
                themeToggle.addEventListener('click', function() {
                    body.classList.toggle('dark-mode');
                    if(formWrapper) formWrapper.classList.toggle('dark-mode');
                    sections.forEach(s => s.classList.toggle('dark-mode'));
                    containers.forEach(c => c.classList.toggle('dark-mode'));
                    // Sauvegarder le mode
                    if(body.classList.contains('dark-mode')) {
                        localStorage.setItem('theme', 'dark');
                    } else {
                        localStorage.setItem('theme', 'light');
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>