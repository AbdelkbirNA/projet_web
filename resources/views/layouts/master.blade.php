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
</head>
<body>
    <!-- Header dynamique selon le type d'utilisateur -->
    @if(Auth::check() && Auth::user()->user_type === 'professor')
        @include('layouts.partials.headerprof')
    @else
        @include('layouts.partials.header')
    @endif

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
    @stack('scripts')
</body>
</html>