// Attendre que le DOM soit chargé
document.addEventListener("DOMContentLoaded", () => {
  // ===== ÉLÉMENTS DOM =====
  // Navigation et menu mobile
  const mobileMenuButton = document.getElementById("mobile-menu-button")
  const mobileMenu = document.getElementById("mobile-menu")
  const currentYearElement = document.getElementById("current-year")

  // Formulaires
  const contactForm = document.getElementById("contact-form")
  const loginForm = document.querySelector("#login-modal form")
  const registerForm = document.querySelector("#register-modal form")

  // Boutons d'authentification
  const signinButton = document.getElementById("signin-button")
  const signupButton = document.getElementById("signup-button")
  const signinMobile = document.getElementById("signin-mobile")
  const signupMobile = document.getElementById("signup-mobile")

  // Modals
  const loginModal = document.getElementById("login-modal")
  const registerModal = document.getElementById("register-modal")
  const closeModalButtons = document.querySelectorAll(".close-modal")
  const switchToLogin = document.getElementById("switch-to-login")

  // Conteneur de notifications
  let toastContainer = document.getElementById("toast-container")
  if (!toastContainer) {
    toastContainer = document.createElement("div")
    toastContainer.id = "toast-container"
    document.body.appendChild(toastContainer)
  }

  // Éléments pour le thème
  const themeToggle = document.getElementById("theme-toggle")
  const themeToggleMobile = document.getElementById("theme-toggle-mobile")
  const themeIcon = themeToggle ? themeToggle.querySelector("i") : null
  const themeIconMobile = themeToggleMobile ? themeToggleMobile.querySelector("i") : null
  const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)")

  // Autres éléments
  const viewTeamButton = document.getElementById("view-team-button")
  const userTypeSelect = document.getElementById("user_type")

  // Éléments pour le menu utilisateur
  const userDropdownButton = document.getElementById("user-dropdown-button")
  const userDropdown = document.getElementById("user-dropdown")

  // ===== GESTION DU THÈME =====
  // Fonction pour définir le thème
  function setTheme(theme) {
    if (theme === "dark") {
      document.body.classList.add("dark")
      localStorage.setItem("theme", "dark")
      if (themeIcon) {
        themeIcon.classList.remove("fa-sun")
        themeIcon.classList.add("fa-moon")
      }
      if (themeIconMobile) {
        themeIconMobile.classList.remove("fa-sun")
        themeIconMobile.classList.add("fa-moon")
      }
    } else {
      document.body.classList.remove("dark")
      localStorage.setItem("theme", "light")
      if (themeIcon) {
        themeIcon.classList.remove("fa-moon")
        themeIcon.classList.add("fa-sun")
      }
      if (themeIconMobile) {
        themeIconMobile.classList.remove("fa-moon")
        themeIconMobile.classList.add("fa-sun")
      }
    }
  }

  // Vérifier le thème enregistré ou les préférences du système
  const savedTheme = localStorage.getItem("theme")
  if (savedTheme === "dark") {
    setTheme("dark")
  } else {
    // Mode clair par défaut
    setTheme("light")
  }

  // Gérer le clic sur le bouton de thème
  if (themeToggle) {
    themeToggle.addEventListener("click", () => {
      if (document.body.classList.contains("dark")) {
        setTheme("light")
      } else {
        setTheme("dark")
      }
    })
  }

  // Gérer le clic sur le bouton de thème mobile
  if (themeToggleMobile) {
    themeToggleMobile.addEventListener("click", (e) => {
      e.preventDefault()
      if (document.body.classList.contains("dark")) {
        setTheme("light")
      } else {
        setTheme("dark")
      }

      // Fermer le menu mobile après le changement de thème
      if (mobileMenu && !mobileMenu.classList.contains("hidden")) {
        mobileMenu.classList.add("hidden")
        const icon = mobileMenuButton.querySelector("i")
        if (icon) {
          icon.classList.remove("fa-times")
          icon.classList.add("fa-bars")
        }
      }
    })
  }

  // Écouter les changements de préférence du système
  prefersDarkScheme.addEventListener("change", (e) => {
    if (!localStorage.getItem("theme")) {
      if (e.matches) {
        setTheme("dark")
      } else {
        setTheme("light")
      }
    }
  })

  // ===== GESTION DES MODALS =====
  // Fonction pour ouvrir une modal avec animation
  function openModal(modal) {
    if (modal) {
      modal.style.display = "block"
      document.body.style.overflow = "hidden"
      // Ajouter une classe pour l'animation d'entrée
      setTimeout(() => {
        modal.classList.add("active")
      }, 10)
    }
  }

  // Fonction pour fermer une modal avec animation
  function closeModal(modal) {
    if (modal) {
      modal.classList.remove("active")
      setTimeout(() => {
        modal.style.display = "none"
        document.body.style.overflow = "auto"
      }, 300) // Correspond à la durée de l'animation
    }
  }

  // Fonction pour fermer toutes les modals
  function closeAllModals() {
    const modals = document.querySelectorAll(".modal")
    modals.forEach((modal) => {
      closeModal(modal)
    })
  }

  // Ouvrir les modals
  if (signinButton) {
    signinButton.addEventListener("click", (e) => {
      e.preventDefault()
      openModal(loginModal)
    })
  }

  if (signupButton) {
    signupButton.addEventListener("click", (e) => {
      e.preventDefault()
      openModal(registerModal)
    })
  }

  if (signinMobile) {
    signinMobile.addEventListener("click", (e) => {
      e.preventDefault()
      openModal(loginModal)
      if (mobileMenu) {
        mobileMenu.classList.add("hidden")
        const icon = mobileMenuButton.querySelector("i")
        if (icon) {
          icon.classList.remove("fa-times")
          icon.classList.add("fa-bars")
        }
      }
    })
  }

  if (signupMobile) {
    signupMobile.addEventListener("click", (e) => {
      e.preventDefault()
      openModal(registerModal)
      if (mobileMenu) {
        mobileMenu.classList.add("hidden")
        const icon = mobileMenuButton.querySelector("i")
        if (icon) {
          icon.classList.remove("fa-times")
          icon.classList.add("fa-bars")
        }
      }
    })
  }

  // Fermer les modals
  closeModalButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const modalId = button.getAttribute("data-modal")
      const modal = document.getElementById(modalId)
      closeModal(modal)
    })
  })

  // Fermer les modals en cliquant à l'extérieur
  window.addEventListener("click", (e) => {
    if (e.target.classList.contains("modal")) {
      closeModal(e.target)
    }
  })

  // Basculer entre les modals
  if (switchToLogin) {
    switchToLogin.addEventListener("click", (e) => {
      e.preventDefault()
      closeModal(registerModal)
      openModal(loginModal)
    })
  }

  // Bouton dans le footer du modal de connexion pour passer à l'inscription
  const switchToRegister = document.querySelector("#login-modal .modal-footer button")
  if (switchToRegister) {
    switchToRegister.addEventListener("click", (e) => {
      e.preventDefault()
      closeModal(loginModal)
      openModal(registerModal)
    })
  }

  // ===== GESTION DU MENU MOBILE =====
  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden")

      // Changer l'icône
      const icon = mobileMenuButton.querySelector("i")
      if (mobileMenu.classList.contains("hidden")) {
        icon.classList.remove("fa-times")
        icon.classList.add("fa-bars")
      } else {
        icon.classList.remove("fa-bars")
        icon.classList.add("fa-times")
      }
    })

    // Fermer le menu quand on clique sur un lien
    const mobileLinks = mobileMenu.querySelectorAll("a")
    mobileLinks.forEach((link) => {
      link.addEventListener("click", function () {
        if (!this.id.includes("signin") && !this.id.includes("signup") && !this.id.includes("theme-toggle")) {
          mobileMenu.classList.add("hidden")
          const icon = mobileMenuButton.querySelector("i")
          if (icon) {
            icon.classList.remove("fa-times")
            icon.classList.add("fa-bars")
          }
        }
      })
    })
  }

  // ===== GESTION DU MENU UTILISATEUR =====
  if (userDropdownButton && userDropdown) {
    userDropdownButton.addEventListener("click", (e) => {
      e.preventDefault()
      // Basculer la classe hidden
      userDropdown.classList.toggle("hidden")
    })

    // Fermer le menu déroulant en cliquant ailleurs
    document.addEventListener("click", (e) => {
      if (
        userDropdownButton &&
        !userDropdownButton.contains(e.target) &&
        userDropdown &&
        !userDropdown.contains(e.target) &&
        !userDropdown.classList.contains("hidden")
      ) {
        userDropdown.classList.add("hidden")
      }
    })
  }

  // ===== SYSTÈME DE NOTIFICATIONS TOAST =====
  // Fonction pour créer et afficher un toast
  function showToast(type, title, message, duration = 3000) {
    const toast = document.createElement("div")
    toast.className = `toast toast-${type}`

    toast.innerHTML = `
          <div class="toast-icon">
              <i class="fas fa-${type === "success" ? "check-circle" : "exclamation-circle"}"></i>
          </div>
          <div class="toast-content">
              <div class="toast-title">${title}</div>
              <div class="toast-message">${message}</div>
          </div>
          <button class="toast-close">
              <i class="fas fa-times"></i>
          </button>
      `

    toastContainer.appendChild(toast)

    // Animation d'entrée
    setTimeout(() => {
      toast.classList.add("active")
    }, 10)

    // Fermer le toast au clic sur le bouton
    const closeButton = toast.querySelector(".toast-close")
    closeButton.addEventListener("click", () => {
      toast.classList.remove("active")
      setTimeout(() => {
        toast.remove()
      }, 300)
    })

    // Fermer automatiquement après la durée spécifiée
    setTimeout(() => {
      toast.classList.remove("active")
      setTimeout(() => {
        toast.remove()
      }, 300)
    }, duration)
  }

  // ===== GESTION DES FORMULAIRES =====
  // Formulaire de connexion
  if (loginForm) {
    loginForm.addEventListener("submit", (e) => {
      // Ne pas supprimer le comportement par défaut pour permettre l'envoi au serveur
      // Mais on peut ajouter des validations supplémentaires ici

      const submitButton = loginForm.querySelector('button[type="submit"]')
      if (submitButton) {
        const originalText = submitButton.innerHTML
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Connexion en cours...'
        submitButton.disabled = true

        // Réactiver le bouton après un délai (au cas où la soumission échoue)
        setTimeout(() => {
          submitButton.innerHTML = originalText
          submitButton.disabled = false
        }, 5000)
      }
    })
  }

  // Formulaire d'inscription
  if (registerForm) {
    registerForm.addEventListener("submit", (e) => {
      // Vérifier que les mots de passe correspondent
      const password = document.getElementById("register-password")
      const confirmPassword = document.getElementById("register-password-confirm")

      if (password && confirmPassword && password.value !== confirmPassword.value) {
        e.preventDefault() // Empêcher la soumission
        showToast("error", "Erreur", "Les mots de passe ne correspondent pas.")
        return false
      }

      const submitButton = registerForm.querySelector('button[type="submit"]')
      if (submitButton) {
        const originalText = submitButton.innerHTML
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Inscription en cours...'
        submitButton.disabled = true

        // Réactiver le bouton après un délai (au cas où la soumission échoue)
        setTimeout(() => {
          submitButton.innerHTML = originalText
          submitButton.disabled = false
        }, 5000)
      }
    })
  }

  // Formulaire de contact
  if (contactForm) {
    contactForm.addEventListener("submit", (e) => {
      e.preventDefault()

      // Simuler l'envoi du formulaire
      const submitButton = contactForm.querySelector('button[type="submit"]')
      const originalText = submitButton.textContent

      submitButton.textContent = "Envoi en cours..."
      submitButton.disabled = true

      // Simuler un délai d'envoi
      setTimeout(() => {
        // Réinitialiser le formulaire
        contactForm.reset()

        // Afficher un message de succès
        showToast("success", "Message envoyé", "Votre message a été envoyé avec succès!")

        // Restaurer le bouton
        submitButton.textContent = originalText
        submitButton.disabled = false
      }, 1500)
    })
  }

  // ===== GESTION DES CHAMPS DYNAMIQUES =====
  // Gestion des champs dynamiques pour l'inscription
  if (userTypeSelect) {
    // Initialisation basée sur l'ancienne valeur (en cas d'erreur de validation)
    toggleFields(userTypeSelect.value)

    userTypeSelect.addEventListener("change", function () {
      toggleFields(this.value)
    })
  }

  function toggleFields(userType) {
    const studentFields = document.querySelectorAll(".student-field")
    const professorFields = document.querySelectorAll(".professor-field")

    studentFields.forEach((el) => {
      el.classList.add("hidden")
      const input = el.querySelector("input")
      if (input) input.required = false
    })

    professorFields.forEach((el) => {
      el.classList.add("hidden")
      const input = el.querySelector("input")
      if (input) input.required = false
    })

    if (userType === "student") {
      studentFields.forEach((el) => {
        el.classList.remove("hidden")
        const input = el.querySelector("input")
        if (input) input.required = true
      })
    } else if (userType === "professor") {
      professorFields.forEach((el) => {
        el.classList.remove("hidden")
        const input = el.querySelector("input")
        if (input) input.required = true
      })
    }
  }

  // ===== FONCTIONNALITÉS SUPPLÉMENTAIRES =====
  // Définir l'année courante dans le footer
  if (currentYearElement) {
    currentYearElement.textContent = new Date().getFullYear()
  }

  // Fonction pour vérifier si l'utilisateur est connecté
  function isUserLoggedIn() {
    return localStorage.getItem("userLoggedIn") === "true"
  }

  // Gestionnaire d'événement pour le bouton "Voir toute l'équipe"
  // SUPPRIMÉ - Nous laissons le comportement par défaut du lien

  if (viewTeamButton) {
    viewTeamButton.addEventListener("click", (e) => {
      e.preventDefault()

      // Vérifier si l'utilisateur est connecté via une requête AJAX
      fetch("/api/check-auth", {
        headers: {
          "X-Requested-With": "XMLHttpRequest",
          Accept: "application/json",
          // Ajouter le token CSRF pour que Laravel reconnaisse la session
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        // Inclure les cookies dans la requête pour que Laravel reconnaisse la session
        credentials: "same-origin",
      })
        .then((response) => response.json())
        .then((data) => {
          console.log("Statut d'authentification:", data) // Débogage

          if (data.authenticated) {
            // Si l'utilisateur est connecté, rediriger vers la page des professeurs
            window.location.href = viewTeamButton.getAttribute("href")
          } else {
            // Si l'utilisateur n'est pas connecté, ouvrir la modal de connexion
            if (loginModal) {
              // Stocker l'URL de redirection dans un champ caché du formulaire
              const redirectInput = loginModal.querySelector('input[name="redirect_to"]')
              if (redirectInput) {
                redirectInput.value = viewTeamButton.getAttribute("href")
              } else {
                // Créer le champ s'il n'existe pas
                const input = document.createElement("input")
                input.type = "hidden"
                input.name = "redirect_to"
                input.value = viewTeamButton.getAttribute("href")
                loginForm.appendChild(input)
              }

              // Ouvrir la modal de connexion
              openModal(loginModal)
            } else {
              // Fallback si la modal n'existe pas
              window.location.href = "/login?redirect_to=" + encodeURIComponent(viewTeamButton.getAttribute("href"))
            }
          }
        })
        .catch((error) => {
          console.error("Erreur lors de la vérification de l'authentification:", error)
          // En cas d'erreur, rediriger directement vers la page des professeurs
          // C'est plus sûr que d'ouvrir la modal de connexion en cas d'erreur
          window.location.href = viewTeamButton.getAttribute("href")
        })
    })
  }

  // Smooth scroll pour les liens d'ancrage
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      if (
        this.getAttribute("href") !== "#" &&
        !this.id.includes("switch-to") &&
        !this.classList.contains("forgot-password") &&
        !this.id.includes("theme-toggle") &&
        !this.id.includes("view-team-button")
      ) {
        e.preventDefault()

        const targetId = this.getAttribute("href")
        const targetElement = document.querySelector(targetId)

        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop - 80,
            behavior: "smooth",
          })
        }
      }
    })
  })

  // Animation des statistiques
  function animateStats() {
    const statItems = document.querySelectorAll(".stat-number")

    statItems.forEach((item) => {
      const target = Number.parseInt(item.textContent.replace(/[^0-9]/g, ""))
      const suffix = item.textContent.replace(/[0-9]/g, "")
      let current = 0
      const increment = Math.ceil(target / 50)
      const duration = 1500 // ms
      const stepTime = Math.floor(duration / (target / increment))

      item.textContent = "0" + suffix

      const timer = setInterval(() => {
        current += increment
        if (current >= target) {
          item.textContent = target + suffix
          clearInterval(timer)
        } else {
          item.textContent = current + suffix
        }
      }, stepTime)
    })
  }

  // Observer pour déclencher l'animation quand la section est visible
  if ("IntersectionObserver" in window) {
    const aboutSection = document.querySelector(".about-stats")
    if (aboutSection) {
      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              animateStats()
              observer.unobserve(entry.target)
            }
          })
        },
        { threshold: 0.5 },
      )

      observer.observe(aboutSection)
    }
  } else {
    // Fallback pour les navigateurs qui ne supportent pas IntersectionObserver
    setTimeout(animateStats, 1000)
  }

  // Ajouter une classe active aux liens de navigation lors du défilement
  const sections = document.querySelectorAll("section[id]")

  function highlightNavLinks() {
    const scrollPosition = window.scrollY + 100

    sections.forEach((section) => {
      const sectionTop = section.offsetTop
      const sectionHeight = section.offsetHeight
      const sectionId = section.getAttribute("id")

      if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
        document.querySelectorAll(".nav-link").forEach((link) => {
          link.classList.remove("active")
          if (link.getAttribute("href") === "#" + sectionId) {
            link.classList.add("active")
          }
        })

        document.querySelectorAll(".mobile-nav-link").forEach((link) => {
          link.classList.remove("active")
          if (link.getAttribute("href") === "#" + sectionId) {
            link.classList.add("active")
          }
        })
      }
    })
  }

  window.addEventListener("scroll", highlightNavLinks)

  // ===== STYLES CSS POUR LES ANIMATIONS =====
  // Ajouter des styles CSS pour les animations
  const style = document.createElement("style")
  style.textContent = `
      .modal {
          display: none;
          opacity: 0;
          transition: opacity 0.3s ease;
      }
      
      .modal.active {
          opacity: 1;
      }
      
      .modal-content {
          transform: translateY(-20px);
          transition: transform 0.3s ease;
      }
      
      .modal.active .modal-content {
          transform: translateY(0);
      }
      
      .hidden {
          display: none !important;
      }
      
      #toast-container {
          position: fixed;
          top: 20px;
          right: 20px;
          z-index: 9999;
      }
      
      .toast {
          display: flex;
          background-color: white;
          border-radius: 4px;
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
          margin-bottom: 10px;
          padding: 12px;
          width: 300px;
          opacity: 0;
          transform: translateX(50px);
          transition: opacity 0.3s ease, transform 0.3s ease;
      }
      
      .toast.active {
          opacity: 1;
          transform: translateX(0);
      }
      
      .toast-success {
          border-left: 4px solid #4CAF50;
      }
      
      .toast-error {
          border-left: 4px solid #F44336;
      }
      
      .toast-icon {
          margin-right: 12px;
          font-size: 20px;
          display: flex;
          align-items: center;
      }
      
      .toast-success .toast-icon {
          color: #4CAF50;
      }
      
      .toast-error .toast-icon {
          color: #F44336;
      }
      
      .toast-content {
          flex: 1;
      }
      
      .toast-title {
          font-weight: bold;
          margin-bottom: 4px;
      }
      
      .toast-close {
          background: none;
          border: none;
          cursor: pointer;
          font-size: 16px;
          color: #999;
      }
      
      /* Styles pour le thème sombre */
      body.dark .toast {
          background-color: #333;
          color: #fff;
      }
      
      body.dark .toast-close {
          color: #ccc;
      }
      
      /* Styles pour le menu utilisateur */
      .user-dropdown {
          transition: opacity 0.3s ease, transform 0.3s ease;
      }
      
      .user-dropdown.hidden {
          display: block !important;
          opacity: 0;
          transform: translateY(-10px);
          pointer-events: none;
      }
      
      .user-dropdown:not(.hidden) {
          opacity: 1;
          transform: translateY(0);
          pointer-events: auto;
      }
      
      /* Exception pour les formulaires de déconnexion */
      form.hidden {
          display: none !important;
      }
  `
  document.head.appendChild(style)
})
