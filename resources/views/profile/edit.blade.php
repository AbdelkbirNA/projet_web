@extends('layouts.type')
<link rel="stylesheet" href="{{ asset('css/profile-form.css') }}">
<script src="{{ asset('js/profile-preview.js') }}" defer></script>

@section('title', 'Modifier mon profil - ENSIASD')
@section('description', 'Modifier le profil professeur ENSIASD')

@section('content')
<div class="container mx-auto py-8 px-4 max-w-4xl">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white border-b pb-2">Modifier mon profil</h2>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')
            {{-- Informations personnelles --}}
            <div class="bg-gray-50 p-4 rounded-md">
                <h4 class="text-lg font-semibold mb-4 text-gray-700">Informations personnelles</h4>
                <div class="mb-4">
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Photo de profil:</label>
                    <div class="flex items-center">
                        <div class="w-24 h-24 bg-gray-200 rounded-full overflow-hidden mr-4 flex items-center justify-center" id="photo-preview">
                            @if($profile->photo)
                                <img src="{{ asset('storage/' . $profile->photo) }}" class="w-full h-full object-cover" alt="Photo de profil">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            @endif
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
                        <input type="text" name="nom" id="nom" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('nom', $profile->nom) }}">
                        @error('nom')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom:</label>
                        <input type="text" name="prenom" id="prenom" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('prenom', $profile->prenom) }}">
                        @error('prenom')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="statut" class="block text-sm font-medium text-gray-700 mb-1">Statut professionnel:</label>
                        <input type="text" name="statut" id="statut" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('statut', $profile->statut) }}">
                    </div>
                    <div>
                        <label for="specialite" class="block text-sm font-medium text-gray-700 mb-1">Spécialité:</label>
                        <input type="text" name="specialite" id="specialite" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('specialite', $profile->specialite) }}">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                        <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('email', $profile->email) }}">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone:</label>
                        <input type="text" name="telephone" id="telephone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('telephone', $profile->telephone) }}">
                    </div>
                </div>
                <div class="mt-4">
                    <label for="adresse" class="block text-sm font-medium text-gray-700 mb-1">Adresse:</label>
                    <input type="text" name="adresse" id="adresse" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('adresse', $profile->adresse) }}">
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Réseaux sociaux:</label>
                    <input type="text" name="reseaux_sociaux" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('reseaux_sociaux', $profile->reseaux_sociaux) }}">
                </div>
                <div class="mt-4">
                    <label for="biographie" class="block text-sm font-medium text-gray-700 mb-1">Biographie:</label>
                    <textarea name="biographie" id="biographie" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('biographie', $profile->biographie) }}</textarea>
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
                    @foreach($profile->experiences as $i => $experience)
                    <div class="experience bg-white p-4 rounded-md shadow mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Titre du poste:</label>
                                <input type="text" name="experiences[{{ $i }}][titre]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('experiences.'.$i.'.titre', $experience->titre) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Entreprise / Lieu:</label>
                                <input type="text" name="experiences[{{ $i }}][lieu]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('experiences.'.$i.'.lieu', $experience->lieu) }}">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date de début:</label>
                                <input type="date" name="experiences[{{ $i }}][date_debut]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('experiences.'.$i.'.date_debut', $experience->date_debut) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date de fin:</label>
                                <input type="date" name="experiences[{{ $i }}][date_fin]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('experiences.'.$i.'.date_fin', $experience->date_fin) }}">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
                            <textarea name="experiences[{{ $i }}][description]" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('experiences.'.$i.'.description', $experience->description) }}</textarea>
                        </div>
                        <div class="mt-2 text-right">
                            <button type="button" onclick="removeExperience(this)" class="text-red-500 hover:text-red-700 text-sm">
                                Supprimer
                            </button>
                        </div>
                    </div>
                    @endforeach
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
                    @foreach($profile->formations as $i => $formation)
                    <div class="formation bg-white p-4 rounded-md shadow mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Diplôme / Titre:</label>
                                <input type="text" name="formations[{{ $i }}][titre]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('formations.'.$i.'.titre', $formation->titre) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Établissement:</label>
                                <input type="text" name="formations[{{ $i }}][etablissement]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('formations.'.$i.'.etablissement', $formation->etablissement) }}">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date de début:</label>
                                <input type="date" name="formations[{{ $i }}][date_debut]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('formations.'.$i.'.date_debut', $formation->date_debut) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date de fin:</label>
                                <input type="date" name="formations[{{ $i }}][date_fin]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('formations.'.$i.'.date_fin', $formation->date_fin) }}">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
                            <textarea name="formations[{{ $i }}][description]" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('formations.'.$i.'.description', $formation->description) }}</textarea>
                        </div>
                        <div class="mt-2 text-right">
                            <button type="button" onclick="removeFormation(this)" class="text-red-500 hover:text-red-700 text-sm">
                                Supprimer
                            </button>
                        </div>
                    </div>
                    @endforeach
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
                    @foreach($profile->competences as $i => $competence)
                    <div class="competence bg-white p-4 rounded-md shadow mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Compétence:</label>
                                <input type="text" name="competences[{{ $i }}][nom]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('competences.'.$i.'.nom', $competence->nom) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Niveau:</label>
                                <select name="competences[{{ $i }}][niveau]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="Débutant" @if(old('competences.'.$i.'.niveau', $competence->niveau) == 'Débutant') selected @endif>Débutant</option>
                                    <option value="Intermédiaire" @if(old('competences.'.$i.'.niveau', $competence->niveau) == 'Intermédiaire') selected @endif>Intermédiaire</option>
                                    <option value="Avancé" @if(old('competences.'.$i.'.niveau', $competence->niveau) == 'Avancé') selected @endif>Avancé</option>
                                    <option value="Expert" @if(old('competences.'.$i.'.niveau', $competence->niveau) == 'Expert') selected @endif>Expert</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2 text-right">
                            <button type="button" onclick="removeCompetence(this)" class="text-red-500 hover:text-red-700 text-sm">
                                Supprimer
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('profile.about', ['id' => $profile->user_id]) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-6 rounded-md">Annuler</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-md">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>
@push('styles')
<style>
    body.dark {
        background: #181f2a !important;
        color: #f9fafb !important;
    }
    body.dark .container, body.dark .bg-white, body.dark .bg-gray-50 {
        background-color: #232b39 !important;
        color: #f9fafb !important;
    }
    body.dark .form-label, body.dark label, body.dark .text-gray-800, body.dark .text-gray-700, body.dark h2, body.dark h4 {
        color: #f9fafb !important;
    }
    body.dark input, body.dark textarea, body.dark select {
        background: #232b39 !important;
        color: #f9fafb !important;
        border-color: #374151 !important;
    }
    body.dark input::placeholder, body.dark textarea::placeholder {
        color: #b0b8c1 !important;
    }
    body.dark .border-gray-300 {
        border-color: #374151 !important;
    }
    body.dark .bg-gray-50 {
        background-color: #1f2937 !important;
    }
    body.dark .bg-white {
        background-color: #232b39 !important;
    }
    body.dark .shadow-lg {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.2) !important;
    }
    body.dark .btn-outline-primary {
        border-color: #3b82f6 !important;
        color: #3b82f6 !important;
    }
    body.dark .btn-outline-primary:hover {
        background-color: #3b82f6 !important;
        color: #ffffff !important;
    }
</style>
@endpush
@endsection 