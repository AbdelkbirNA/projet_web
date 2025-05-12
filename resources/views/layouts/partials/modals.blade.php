<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Application</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
</head>
<body>

<!-- <div class="auth-buttons">
    <button id="signin-button" data-target="login-modal" class="btn btn-primary">
        <i class="fas fa-sign-in-alt"></i> Se connecterss
    </button>
    <button id="signup-button" data-target="register-modal" class="btn btn-secondary">
        <i class="fas fa-user-plus"></i> S'inscrire
    </button>
</div> -->

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

        <div class="form-group remember-me-container">
    <div class="checkbox-wrapper">
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember" class="remember-label">Se souvenir de moi</label>
        <span class="checkmark"></span>
    </div>
</div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-sign-in-alt"></i> Se connecter
            </button>
        </form>
        
        <div class="modal-footer">
            <p>Pas encore de compte? <a id="signup-button" data-target="register-modal" class="btn btn-secondary">S'inscrire</a></p>
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
                <div class="form-group password-container">
                    <label for="register-password">Mot de passe</label>
                    <div class="password-input-wrapper">
                        <input id="register-password" type="password" name="password" required autocomplete="new-password" minlength="8">
                        <span class="toggle-password" data-target="register-password">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                
                <div class="form-group password-container">
                    <label for="register-password-confirm">Confirmer mot de passe</label>
                    <div class="password-input-wrapper">
                        <input id="register-password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                        <span class="toggle-password" data-target="register-password-confirm">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
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
    // Ajouter les styles CSS nécessaires
    const styleElement = document.createElement('style');
    styleElement.textContent = `
        /* Style pour les modales */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .modal.active {
            display: flex !important;
            opacity: 1;
        }
        
        .modal-content {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            width: 90%;
            max-width: 500px;
            padding: 2rem;
            position: relative;
            transform: translateY(-20px);
            transition: transform 0.3s ease;
            margin: auto;
        }
        
        .modal.active .modal-content {
            transform: translateY(0);
        }
        
        .close-modal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
        }
        
        .close-modal:hover {
            color: #1f2937;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.25);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        @media (min-width: 640px) {
            .form-row {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        .hidden {
            display: none !important;
        }
        
        /* Style pour la case "Se souvenir de moi" */
        /* Styles pour la case "Se souvenir de moi" */
.remember-me-container {
    margin: 1rem 0;
}

.checkbox-wrapper {
    display: flex;
    align-items: center;
}

.remember-me-container input[type="checkbox"] {
    width: auto;
    margin-right: 10px;
    cursor: pointer;
}

.remember-label {
    margin: 0;
    font-size: 0.9rem;
    color: #4a5568;
    cursor: pointer;
    user-select: none;
}

/* Style pour la case à cocher personnalisée */
.checkbox-wrapper {
    position: relative;
    padding-left: 30px;
}

.checkbox-wrapper input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #fff;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    transition: all 0.3s;
}

.checkbox-wrapper:hover .checkmark {
    background-color: #f3f4f6;
}

.checkbox-wrapper input:checked ~ .checkmark {
    background-color: #2563eb;
    border-color: #2563eb;
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.checkbox-wrapper input:checked ~ .checkmark:after {
    display: block;
}

.checkbox-wrapper .checkmark:after {
    left: 7px;
    top: 3px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}
        
        /* Style pour les champs mot de passe avec icône */
        .password-container {
            position: relative;
        }
        
        .password-input-wrapper {
            position: relative;
        }
        
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6b7280;
        }
        
        .toggle-password:hover {
            color: #2563eb;
        }
    `;
    document.head.appendChild(styleElement);

    // Fonctions pour gérer les modals
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            
            setTimeout(() => {
                modal.classList.add('active');
            }, 10);
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('active');
            setTimeout(() => {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }, 300);
        }
    }

    // Gestion du clic sur les boutons de connexion/inscription
    const signinButton = document.getElementById('signin-button');
    if (signinButton) {
        signinButton.addEventListener('click', function(e) {
            e.preventDefault();
            openModal('login-modal');
        });
    }

    const signupButton = document.getElementById('signup-button');
    if (signupButton) {
        signupButton.addEventListener('click', function(e) {
            e.preventDefault();
            openModal('register-modal');
        });
    }

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
    const switchToRegister = document.getElementById('signup-button');
    if (switchToRegister) {
        switchToRegister.addEventListener('click', function(e) {
            e.preventDefault();
            closeModal('login-modal');
            openModal('register-modal');
        });
    }

    const switchToLogin = document.getElementById('switch-to-login');
    if (switchToLogin) {
        switchToLogin.addEventListener('click', function(e) {
            e.preventDefault();
            closeModal('register-modal');
            openModal('login-modal');
        });
    }

    // Gestion des champs dynamiques pour l'inscription
    const userTypeSelect = document.getElementById('user_type');
    if (userTypeSelect) {
        toggleFields(userTypeSelect.value);
        
        userTypeSelect.addEventListener('change', function() {
            toggleFields(this.value);
        });
    }

    function toggleFields(userType) {
        const studentFields = document.querySelectorAll('.student-field');
        const professorFields = document.querySelectorAll('.professor-field');
        
        studentFields.forEach(el => {
            el.classList.add('hidden');
            const input = el.querySelector('input');
            if (input) input.required = false;
        });
        
        professorFields.forEach(el => {
            el.classList.add('hidden');
            const input = el.querySelector('input');
            if (input) input.required = false;
        });
        
        if (userType === 'student') {
            studentFields.forEach(el => {
                el.classList.remove('hidden');
                const input = el.querySelector('input');
                if (input) input.required = true;
            });
        } else if (userType === 'professor') {
            professorFields.forEach(el => {
                el.classList.remove('hidden');
                const input = el.querySelector('input');
                if (input) input.required = true;
            });
        }
    }

    // Fonctionnalité pour afficher/masquer le mot de passe
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
});
</script>

</body>
</html>