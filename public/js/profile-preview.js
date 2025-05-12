// Fonction de prévisualisation de l'image
function previewImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader()
    reader.onload = (e) => {
      const preview = document.getElementById("photo-preview")

      // Créer l'élément image avec une animation
      const img = document.createElement("img")
      img.src = e.target.result
      img.className = "w-full h-full object-cover"
      img.style.opacity = "0"
      img.style.transform = "scale(0.8)"

      // Vider le conteneur et ajouter la nouvelle image
      preview.innerHTML = ""
      preview.appendChild(img)

      // Déclencher l'animation
      setTimeout(() => {
        img.style.transition = "all 0.5s ease"
        img.style.opacity = "1"
        img.style.transform = "scale(1)"
      }, 10)

      // Ajouter une animation à la section photo
      const photoSection = preview.closest(".mb-4")
      photoSection.style.boxShadow = "0 0 0 3px rgba(59, 130, 246, 0.3)"

      // Revenir à l'état normal après l'animation
      setTimeout(() => {
        photoSection.style.boxShadow = ""
      }, 1500)
    }
    reader.readAsDataURL(input.files[0])
  }
}

// Variables pour suivre le nombre d'éléments
let experienceCount = 1
let formationCount = 1
let competenceCount = 1

// Fonction pour ajouter une expérience professionnelle
function addExperience() {
  const experiencesContainer = document.getElementById("experiences")
  const newExperience = document.createElement("div")
  newExperience.className = "experience bg-white p-4 rounded-md shadow mb-4"

  // Contenu HTML de l'expérience
  newExperience.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Titre du poste:</label>
                <input type="text" name="experiences[${experienceCount}][titre]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Entreprise / Lieu:</label>
                <input type="text" name="experiences[${experienceCount}][lieu]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date de début:</label>
                <input type="date" name="experiences[${experienceCount}][date_debut]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date de fin:</label>
                <div class="flex items-center space-x-2">
                    <input type="date" name="experiences[${experienceCount}][date_fin]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="flex items-center">
                        <input type="checkbox" id="current_job_${experienceCount}" class="mr-1" onchange="toggleEndDate(this, ${experienceCount})">
                        <label for="current_job_${experienceCount}" class="text-sm">Poste actuel</label>
                    </div>
                </div>
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
            <textarea name="experiences[${experienceCount}][description]" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
        
        <div class="mt-2 text-right">
            <button type="button" onclick="removeExperience(this)" class="text-red-500 hover:text-red-700 text-sm">
                Supprimer
            </button>
        </div>
    `

  // Animation d'entrée
  newExperience.style.opacity = "0"
  newExperience.style.transform = "translateY(20px)"
  experiencesContainer.appendChild(newExperience)

  // Déclencher l'animation
  setTimeout(() => {
    newExperience.style.transition = "all 0.4s ease"
    newExperience.style.opacity = "1"
    newExperience.style.transform = "translateY(0)"
  }, 10)

  experienceCount++
}

// Fonction pour supprimer une expérience
function removeExperience(button) {
  const experience = button.closest(".experience")
  if (document.querySelectorAll(".experience").length > 1) {
    // Animation de sortie
    experience.style.transition = "all 0.3s ease"
    experience.style.opacity = "0"
    experience.style.transform = "translateY(10px)"

    // Supprimer après l'animation
    setTimeout(() => {
      experience.remove()
    }, 300)
  } else {
    alert("Vous devez avoir au moins une expérience professionnelle.")
  }
}

// Fonction pour activer/désactiver la date de fin
function toggleEndDate(checkbox, index) {
  const dateFinInput = checkbox.closest("div").previousElementSibling
  dateFinInput.disabled = checkbox.checked
  if (checkbox.checked) {
    dateFinInput.value = ""
    dateFinInput.style.backgroundColor = "var(--bg-section)"
  } else {
    dateFinInput.style.backgroundColor = ""
  }
}

// Fonction pour ajouter une formation
function addFormation() {
  const formationsContainer = document.getElementById("formations")
  const newFormation = document.createElement("div")
  newFormation.className = "formation bg-white p-4 rounded-md shadow mb-4"

  // Contenu HTML de la formation
  newFormation.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Diplôme / Titre:</label>
                <input type="text" name="formations[${formationCount}][titre]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Établissement:</label>
                <input type="text" name="formations[${formationCount}][etablissement]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date de début:</label>
                <input type="date" name="formations[${formationCount}][date_debut]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date de fin:</label>
                <input type="date" name="formations[${formationCount}][date_fin]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
            <textarea name="formations[${formationCount}][description]" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
        
        <div class="mt-2 text-right">
            <button type="button" onclick="removeFormation(this)" class="text-red-500 hover:text-red-700 text-sm">
                Supprimer
            </button>
        </div>
    `

  // Animation d'entrée
  newFormation.style.opacity = "0"
  newFormation.style.transform = "translateY(20px)"
  formationsContainer.appendChild(newFormation)

  // Déclencher l'animation
  setTimeout(() => {
    newFormation.style.transition = "all 0.4s ease"
    newFormation.style.opacity = "1"
    newFormation.style.transform = "translateY(0)"
  }, 10)

  formationCount++
}

// Fonction pour supprimer une formation
function removeFormation(button) {
  const formation = button.closest(".formation")
  if (document.querySelectorAll(".formation").length > 1) {
    // Animation de sortie
    formation.style.transition = "all 0.3s ease"
    formation.style.opacity = "0"
    formation.style.transform = "translateY(10px)"

    // Supprimer après l'animation
    setTimeout(() => {
      formation.remove()
    }, 300)
  } else {
    alert("Vous devez avoir au moins une formation.")
  }
}

// Fonction pour ajouter une compétence
function addCompetence() {
  const competencesContainer = document.getElementById("competences")
  const newCompetence = document.createElement("div")
  newCompetence.className = "competence bg-white p-4 rounded-md shadow mb-4"

  // Contenu HTML de la compétence
  newCompetence.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Compétence:</label>
                <input type="text" name="competences[${competenceCount}][nom]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Niveau:</label>
                <select name="competences[${competenceCount}][niveau]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Débutant">Débutant</option>
                    <option value="Intermédiaire">Intermédiaire</option>
                    <option value="Avancé">Avancé</option>
                    <option value="Expert">Expert</option>
                </select>
            </div>
        </div>
        
        <div class="mt-2 text-right">
            <button type="button" onclick="removeCompetence(this)" class="text-red-500 hover:text-red-700 text-sm">
                Supprimer
            </button>
        </div>
    `

  // Animation d'entrée
  newCompetence.style.opacity = "0"
  newCompetence.style.transform = "translateY(20px)"
  competencesContainer.appendChild(newCompetence)

  // Déclencher l'animation
  setTimeout(() => {
    newCompetence.style.transition = "all 0.4s ease"
    newCompetence.style.opacity = "1"
    newCompetence.style.transform = "translateY(0)"
  }, 10)

  competenceCount++
}

// Fonction pour supprimer une compétence
function removeCompetence(button) {
  const competence = button.closest(".competence")
  if (document.querySelectorAll(".competence").length > 1) {
    // Animation de sortie
    competence.style.transition = "all 0.3s ease"
    competence.style.opacity = "0"
    competence.style.transform = "translateY(10px)"

    // Supprimer après l'animation
    setTimeout(() => {
      competence.remove()
    }, 300)
  } else {
    alert("Vous devez avoir au moins une compétence.")
  }
}

// Fonction pour basculer entre les thèmes
function toggleTheme() {
  const currentTheme = document.documentElement.getAttribute("data-theme")
  const newTheme = currentTheme === "dark" ? "light" : "dark"

  // Appliquer le nouveau thème
  document.documentElement.setAttribute("data-theme", newTheme)
  localStorage.setItem("theme", newTheme)

  // Mettre à jour l'icône
  updateThemeIcon(newTheme)
}

// Fonction pour mettre à jour l'icône du bouton de basculement
function updateThemeIcon(theme) {
  const themeToggle = document.getElementById("theme-toggle")
  if (!themeToggle) return

  if (theme === "dark") {
    themeToggle.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="5"></circle>
                <line x1="12" y1="1" x2="12" y2="3"></line>
                <line x1="12" y1="21" x2="12" y2="23"></line>
                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                <line x1="1" y1="12" x2="3" y2="12"></line>
                <line x1="21" y1="12" x2="23" y2="12"></line>
                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
            </svg>
        `
    themeToggle.setAttribute("title", "Passer au mode clair")
  } else {
    themeToggle.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
        `
    themeToggle.setAttribute("title", "Passer au mode sombre")
  }
}

// Initialisation des animations au chargement de la page
document.addEventListener("DOMContentLoaded", () => {
  // Initialiser le basculement de thème
  const themeToggle = document.getElementById("theme-toggle")
  if (themeToggle) {
    themeToggle.addEventListener("click", toggleTheme)

    // Mettre à jour l'icône initiale
    const currentTheme = document.documentElement.getAttribute("data-theme")
    updateThemeIcon(currentTheme)
  }

  // Animer les sections principales
  const sections = document.querySelectorAll(".bg-gray-50.p-4.rounded-md")
  sections.forEach((section, index) => {
    section.style.opacity = "0"
    section.style.transform = "translateY(20px)"

    setTimeout(
      () => {
        section.style.transition = "all 0.5s ease"
        section.style.opacity = "1"
        section.style.transform = "translateY(0)"
      },
      100 + index * 150,
    )
  })

  // Animer les sous-sections
  const subsections = document.querySelectorAll(".experience, .formation, .competence")
  subsections.forEach((subsection, index) => {
    subsection.style.opacity = "0"
    subsection.style.transform = "translateY(10px)"

    setTimeout(
      () => {
        subsection.style.transition = "all 0.4s ease"
        subsection.style.opacity = "1"
        subsection.style.transform = "translateY(0)"
      },
      500 + index * 100,
    )
  })
})
