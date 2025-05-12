@extends('layouts.type')
<!-- Ajoutez ces lignes dans la section head de votre layout -->
<link rel="stylesheet" href="{{ asset('css/profile-form.css') }}">
<script src="{{ asset('js/profile-preview.js') }}" defer></script>
@section('content')
<div class="container mx-auto py-8 px-4 max-w-4xl">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Créer votre profil</h2>
        
        <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- Informations personnelles --}}
            <div class="bg-gray-50 p-4 rounded-md">
                <h4 class="text-lg font-semibold mb-4 text-gray-700">Informations personnelles</h4>
                
                <div class="mb-4">
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Photo de profil:</label>
                    <div class="flex items-center">
                        <div class="w-24 h-24 bg-gray-200 rounded-full overflow-hidden mr-4 flex items-center justify-center" id="photo-preview">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <label class="cursor-pointer bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">
                                <span>Choisir une photo</span>
                                <input type="file" name="photo" id="photo" class="hidden" onchange="previewImage(this)">
                            </label>
                            <p class="text-xs text-gray-500 mt-1">JPG, PNG ou GIF. Max 2MB.</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom:</label>
                        <input type="text" name="nom" id="nom" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('nom')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom:</label>
                        <input type="text" name="prenom" id="prenom" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('prenom')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="statut" class="block text-sm font-medium text-gray-700 mb-1">Statut professionnel:</label>
                        <input type="text" name="statut" id="statut" placeholder="Ex: Développeur Web, Designer UX..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="specialite" class="block text-sm font-medium text-gray-700 mb-1">Spécialité:</label>
                        <input type="text" name="specialite" id="specialite" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                        <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone:</label>
                        <input type="text" name="telephone" id="telephone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="mt-4">
                    <label for="adresse" class="block text-sm font-medium text-gray-700 mb-1">Adresse:</label>
                    <input type="text" name="adresse" id="adresse" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Réseaux sociaux:</label>
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 text-center">
                                <i class="fab fa-linkedin text-blue-600"></i>
                            </div>
                            <input type="text" name="linkedin" placeholder="URL LinkedIn" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 text-center">
                                <i class="fab fa-github text-gray-800"></i>
                            </div>
                            <input type="text" name="github" placeholder="URL GitHub" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 text-center">
                                <i class="fab fa-twitter text-blue-400"></i>
                            </div>
                            <input type="text" name="twitter" placeholder="URL Twitter" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="biographie" class="block text-sm font-medium text-gray-700 mb-1">Biographie:</label>
                    <textarea name="biographie" id="biographie" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
            </div>

            {{-- Expériences professionnelles --}}
            <div class="bg-gray-50 p-4 rounded-md">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-lg font-semibold text-gray-700">Expériences professionnelles</h4>
                    <button type="button" onclick="addExperience()" class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded-md text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Ajouter
                    </button>
                </div>
                
                <div id="experiences">
                    <div class="experience bg-white p-4 rounded-md shadow mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Titre du poste:</label>
                                <input type="text" name="experiences[0][titre]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Entreprise / Lieu:</label>
                                <input type="text" name="experiences[0][lieu]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date de début:</label>
                                <input type="date" name="experiences[0][date_debut]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date de fin:</label>
                                <div class="flex items-center space-x-2">
                                    <input type="date" name="experiences[0][date_fin]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="current_job_0" class="mr-1" onchange="toggleEndDate(this, 0)">
                                        <label for="current_job_0" class="text-sm">Poste actuel</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
                            <textarea name="experiences[0][description]" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        
                        <div class="mt-2 text-right">
                            <button type="button" onclick="removeExperience(this)" class="text-red-500 hover:text-red-700 text-sm">
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Formations --}}
            <div class="bg-gray-50 p-4 rounded-md">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-lg font-semibold text-gray-700">Formations</h4>
                    <button type="button" onclick="addFormation()" class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded-md text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Ajouter
                    </button>
                </div>
                
                <div id="formations">
                    <div class="formation bg-white p-4 rounded-md shadow mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Diplôme / Titre:</label>
                                <input type="text" name="formations[0][titre]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Établissement:</label>
                                <input type="text" name="formations[0][etablissement]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date de début:</label>
                                <input type="date" name="formations[0][date_debut]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date de fin:</label>
                                <input type="date" name="formations[0][date_fin]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
                            <textarea name="formations[0][description]" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        
                        <div class="mt-2 text-right">
                            <button type="button" onclick="removeFormation(this)" class="text-red-500 hover:text-red-700 text-sm">
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Compétences --}}
            <div class="bg-gray-50 p-4 rounded-md">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-lg font-semibold text-gray-700">Compétences</h4>
                    <button type="button" onclick="addCompetence()" class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded-md text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Ajouter
                    </button>
                </div>
                
                <div id="competences">
                    <div class="competence bg-white p-4 rounded-md shadow mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Compétence:</label>
                                <input type="text" name="competences[0][nom]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Niveau:</label>
                                <select name="competences[0][niveau]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('home') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-6 rounded-md">Annuler</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-md">Enregistrer le profil</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Prévisualisation de l'image
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('photo-preview');
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Gestion des expériences professionnelles
    let experienceCount = 1;
    
    function addExperience() {
        const experiencesContainer = document.getElementById('experiences');
        const newExperience = document.createElement('div');
        newExperience.className = 'experience bg-white p-4 rounded-md shadow mb-4';
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
        `;
        experiencesContainer.appendChild(newExperience);
        experienceCount++;
    }
    
    function removeExperience(button) {
        const experience = button.closest('.experience');
        if (document.querySelectorAll('.experience').length > 1) {
            experience.remove();
        } else {
            alert('Vous devez avoir au moins une expérience professionnelle.');
        }
    }
    
    function toggleEndDate(checkbox, index) {
        const dateFinInput = checkbox.closest('div').previousElementSibling;
        dateFinInput.disabled = checkbox.checked;
        if (checkbox.checked) {
            dateFinInput.value = '';
        }
    }

    // Gestion des formations
    let formationCount = 1;
    
    function addFormation() {
        const formationsContainer = document.getElementById('formations');
        const newFormation = document.createElement('div');
        newFormation.className = 'formation bg-white p-4 rounded-md shadow mb-4';
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
        `;
        formationsContainer.appendChild(newFormation);
        formationCount++;
    }
    
    function removeFormation(button) {
        const formation = button.closest('.formation');
        if (document.querySelectorAll('.formation').length > 1) {
            formation.remove();
        } else {
            alert('Vous devez avoir au moins une formation.');
        }
    }

    // Gestion des compétences
    let competenceCount = 1;
    
    function addCompetence() {
        const competencesContainer = document.getElementById('competences');
        const newCompetence = document.createElement('div');
        newCompetence.className = 'competence bg-white p-4 rounded-md shadow mb-4';
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
        `;
        competencesContainer.appendChild(newCompetence);
        competenceCount++;
    }
    
    function removeCompetence(button) {
        const competence = button.closest('.competence');
        if (document.querySelectorAll('.competence').length > 1) {
            competence.remove();
        } else {
            alert('Vous devez avoir au moins une compétence.');
        }
    }
</script>
@endpush
@endsection
