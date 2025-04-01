<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Publication</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .form-container {
            max-width: 700px;
            margin: 2rem auto;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .form-header {
            background: linear-gradient(135deg, #6b73ff 0%, #000dff 100%);
            color: white;
            padding: 1.5rem;
        }
        .form-body {
            padding: 2rem;
            background-color: #f8f9fa;
        }
        .input-group-text {
            background-color: #e9ecef;
            min-width: 45px;
            justify-content: center;
        }
        .img-preview-container {
            position: relative;
            display: inline-block;
        }
        .img-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
            border-radius: 0.25rem;
        }
        .img-preview-container:hover .img-overlay {
            opacity: 1;
        }
        .btn-submit {
            background: linear-gradient(135deg, #6b73ff 0%, #000dff 100%);
            border: none;
            transition: all 0.3s;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-control:focus, .form-select:focus {
            border-color: #6b73ff;
            box-shadow: 0 0 0 0.25rem rgba(107, 115, 255, 0.25);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h2 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Modifier la publication</h2>
            </div>

            <div class="form-body">
                <form action="{{ route('update', $publication->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <!-- Titre -->
                    <div class="mb-4">
                        <label for="titre_pub" class="form-label fw-bold">Titre de publication</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-type"></i></span>
                            <input type="text" name="titre_pub" class="form-control" value="{{ old('titre_pub', $publication->titre_pub) }}" required>
                        </div>
                        @error('titre_pub')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Entrez un titre descriptif pour votre publication</small>
                    </div>

                    <!-- Année -->
                    <div class="mb-4">
                        <label for="year" class="form-label fw-bold">Date de publication</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="date" name="year" class="form-control" value="{{ old('year', \Carbon\Carbon::parse($publication->year)->format('Y-m-d') ?? date('Y-m-d')) }}" required>
                        </div>
                        @error('year')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Sélectionnez la date de publication</small>
                    </div>

                    <!-- Image -->
                    <div class="mb-4">
                        <label for="image" class="form-label fw-bold">Image de la publication</label>
                        <input type="file" name="image" class="form-control" id="imageInput" accept="image/*">
                        @error('image')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format recommandé : JPG/PNG (max 150kb)</small>

                        <div class="mt-3 text-center">
                            <div class="img-preview-container">
                                <img id="imagePreview" class="img-thumbnail shadow" style="max-width: 200px;"
                                     src="{{ asset('storage/' . $publication->image) }}" alt="Aperçu de l'image">
                                <div class="img-overlay">
                                    <span class="text-white"><i class="bi bi-arrows-angle-expand fs-4"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">Description détaillée</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Décrivez en détail le contenu de votre publication...">{{ old('description', $publication->description) }}</textarea>
                        @error('description')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimum 50 caractères recommandés</small>
                    </div>

                    <!-- Boutons -->
                    <div class="d-grid gap-3 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-md-2">
                            <i class="bi bi-arrow-left"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-submit text-white px-4">
                            <i class="bi bi-save"></i> Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script pour afficher l'aperçu de l'image avant modification -->
    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const img = document.getElementById('imagePreview');
                img.src = reader.result;
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        });
    </script>
</body>
</html>
