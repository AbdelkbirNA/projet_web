<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Application</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Styles globaux */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fc;
        }
        
        /* Boutons principaux */
        .auth-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .btn {
            padding: 10px 15px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary {
            background-color: #4e73df;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #2e59d9;
        }
        
        .btn-secondary {
            background-color: #858796;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #6c757d;
        }
        
        /* Styles pour les modals */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 25px;
            border-radius: 10px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            animation: modalFadeIn 0.3s;
        }

        @keyframes modalFadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .close-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.2s;
        }

        .close-modal:hover {
            color: #333;
        }

        /* Styles pour les formulaires */
        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #555;
        }

        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: border 0.3s;
        }

        .form-group input:focus, 
        .form-group select:focus {
            border-color: #4e73df;
            outline: none;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.25);
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .btn-block {
            width: 100%;
            padding: 12px;
        }

        .modal-footer {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 15px;
        }

        .modal-footer a {
            color: #4e73df;
            text-decoration: none;
            font-weight: 500;
        }

        .modal-footer a:hover {
            text-decoration: underline;
        }

        .checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .checkbox input {
            width: auto;
            margin-right: 10px;
        }

        .error-message {
            color: #e74a3b;
            font-size: 14px;
            margin-top: 0.3rem;
            display: block;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 1em;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .alert-danger ul {
            padding-left: 20px;
            margin: 5px 0;
        }

        .hidden {
            display: none !important;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .modal-content {
                margin: 20% auto;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="auth-buttons">
    <button id="signin-button" data-target="login-modal" class="btn btn-primary">
        <i class="fas fa-sign-in-alt"></i> Se connecter
    </button>
    <button id="signup-button" data-target="register-modal" class="btn btn-secondary">
        <i class="fas fa-user-plus"></i> S'inscrire
    </button>
</div>

<!-- Modal de connexion -->
<div id="login-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal" data-modal="login-modal">&times;</span>
        <h2>Connexion</h2>
        
        @if($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="login-email">Email</label>
                <input id="login-email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>

            <div class="form-group">
                <label for="login-password">Mot de passe</label>
                <input id="login-password" type="password" name="password" required autocomplete="current-password">
                <a class="forgot-password" href="#" style="display: block; margin-top: 5px; font-size: 14px; color: #4e73df;">Mot de passe oublié?</a>
            </div>

            <div class="checkbox">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Se souvenir de moi</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-sign-in-alt"></i> Se connecter
            </button>
        </form>
        
        <div class="modal-footer">
            <p>Pas encore de compte? <a href="#" id="switch-to-register">S'inscrire</a></p>
        </div>
    </div>
</div>

<!-- Modal d'inscription -->
<div id="register-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal" data-modal="register-modal">&times;</span>
        <h2>Inscription</h2>
        
        @if($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="register-name">Nom complet</label>
                <input id="register-name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>

            <div class="form-group">
                <label for="register-email">Email</label>
                <input id="register-email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="register-password">Mot de passe</label>
                    <input id="register-password" type="password" name="password" required autocomplete="new-password" minlength="8">
                </div>
                
                <div class="form-group">
                    <label for="register-password-confirm">Confirmer mot de passe</label>
                    <input id="register-password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group">
                <label for="user_type">Je suis</label>
                <select id="user_type" name="user_type" class="form-control" required>
                    <option value="">-- Sélectionnez --</option>
                    <option value="student" {{ old('user_type') == 'student' ? 'selected' : '' }}>Étudiant</option>
                    <option value="professor" {{ old('user_type') == 'professor' ? 'selected' : '' }}>Professeur</option>
                </select>
            </div>

            <!-- Champs spécifiques aux étudiants -->
            <div class="form-group student-field {{ old('user_type') != 'student' ? 'hidden' : '' }}">
                <label for="cne">CNE (10 caractères)</label>
                <input id="cne" type="text" name="cne" value="{{ old('cne') }}" maxlength="10" 
                       pattern="[A-Za-z0-9]{10}" title="Le CNE doit contenir exactement 10 caractères alphanumériques"
                       {{ old('user_type') == 'student' ? 'required' : '' }}>
            </div>

            <!-- Champs spécifiques aux professeurs -->
            <div class="form-group professor-field {{ old('user_type') != 'professor' ? 'hidden' : '' }}">
                <label for="matricule">Matricule (8 caractères)</label>
                <input id="matricule" type="text" name="matricule" value="{{ old('matricule') }}" maxlength="8" 
                       pattern="[A-Za-z0-9]{8}" title="Le matricule doit contenir exactement 8 caractères alphanumériques"
                       {{ old('user_type') == 'professor' ? 'required' : '' }}>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-user-plus"></i> S'inscrire
            </button>
        </form>
        
        <div class="modal-footer">
            <p>Déjà un compte? <a href="#" id="switch-to-login">Se connecter</a></p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fonctions pour gérer les modals
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }

    // Gestion du clic sur les boutons de connexion/inscription
    document.getElementById('signin-button').addEventListener('click', function(e) {
        e.preventDefault();
        openModal('login-modal');
    });

    document.getElementById('signup-button').addEventListener('click', function(e) {
        e.preventDefault();
        openModal('register-modal');
    });

    // Gestion de la fermeture des modals
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', function() {
            const modalId = this.getAttribute('data-modal');
            closeModal(modalId);
        });
    });

    // Fermer en cliquant à l'extérieur
    window.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal')) {
            closeModal(e.target.id);
        }
    });

    // Switch entre modals
    document.getElementById('switch-to-register').addEventListener('click', function(e) {
        e.preventDefault();
        closeModal('login-modal');
        openModal('register-modal');
    });

    document.getElementById('switch-to-login').addEventListener('click', function(e) {
        e.preventDefault();
        closeModal('register-modal');
        openModal('login-modal');
    });

    // Gestion des champs dynamiques pour l'inscription
    const userTypeSelect = document.getElementById('user_type');
    if (userTypeSelect) {
        // Initialisation basée sur l'ancienne valeur (en cas d'erreur de validation)
        toggleFields(userTypeSelect.value);
        
        userTypeSelect.addEventListener('change', function() {
            toggleFields(this.value);
        });
    }

    function toggleFields(userType) {
        const studentFields = document.querySelectorAll('.student-field');
        const professorFields = document.querySelectorAll('.professor-field');
        
        studentFields.forEach(el => el.classList.add('hidden'));
        professorFields.forEach(el => el.classList.add('hidden'));
        
        if (userType === 'student') {
            studentFields.forEach(el => {
                el.classList.remove('hidden');
                el.querySelector('input').required = true;
            });
            professorFields.forEach(el => {
                el.querySelector('input').required = false;
            });
        } else if (userType === 'professor') {
            professorFields.forEach(el => {
                el.classList.remove('hidden');
                el.querySelector('input').required = true;
            });
            studentFields.forEach(el => {
                el.querySelector('input').required = false;
            });
        }
    }
});
</script>

</body>
</html>