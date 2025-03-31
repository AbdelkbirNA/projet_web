<!-- Sign In Modal -->
<div id="signin-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2>Connexion</h2>
        <form id="signin-form">
            <div class="form-group">
                <label for="signin-email">Email</label>
                <input type="email" id="signin-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="signin-password">Mot de passe</label>
                <input type="password" id="signin-password" name="password" required>
                <a href="#" class="forgot-password">Mot de passe oublié?</a>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Se connecter</button>
        </form>
        <div class="modal-footer">
            <p>Pas encore de compte? <a href="#" id="switch-to-signup">S'inscrire</a></p>
        </div>
    </div>
</div>

<!-- Sign Up Modal -->
<div id="signup-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2>Inscription</h2>
        <form id="signup-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="signup-firstname">Prénom</label>
                    <input type="text" id="signup-firstname" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="signup-lastname">Nom</label>
                    <input type="text" id="signup-lastname" name="lastname" required>
                </div>
            </div>
            <div class="form-group">
                <label for="signup-email">Email</label>
                <input type="email" id="signup-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="signup-password">Mot de passe</label>
                <input type="password" id="signup-password" name="password" required>
            </div>
            <div class="form-group">
                <label for="signup-confirm-password">Confirmer le mot de passe</label>
                <input type="password" id="signup-confirm-password" name="confirm-password" required>
            </div>
            <div class="form-group checkbox">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de confidentialité</a></label>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-user-plus"></i> S'inscrire</button>
        </form>
        <div class="modal-footer">
            <p>Déjà inscrit? <a href="#" id="switch-to-signin">Se connecter</a></p>
        </div>
    </div>
</div>