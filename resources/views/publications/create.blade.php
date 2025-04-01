<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créer une Publication</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #2e59d9;
        }

        body {
            background-color: #f8f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 0.5rem rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 1.5rem;
        }

        .btn-custom {
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .form-container {
            max-width: 600px;
            margin: 2rem auto;
        }

        .form-label {
            font-weight: bold;
        }

        .publication-image {
            border-radius: 0.35rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: transform 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .publication-image:hover {
            transform: scale(1.03);
        }

        /* Style pour l'aperçu de l'image */
        .image-preview {
            max-width: 150px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Créer une Publication</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Titre -->
                    <div class="mb-3">
                        <label for="titre_pub" class="form-label">Titre</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-type"></i></span>
                            <input type="text" name="titre_pub" class="form-control" placeholder="Entrez le titre" required>
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="mb-3">
                        <label for="year" class="form-label">Date</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="date" name="year" class="form-control" required>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Image (max 2M)</label>
                        <input type="file" name="image" class="form-control" id="imageInput" accept="image/*" required>
                        <div class="mt-2">
                            <img id="imagePreview" class="image-preview img-thumbnail" />
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" placeholder="Ajoutez une description"></textarea>
                    </div>

                    <!-- Bouton de soumission -->
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-plus-circle"></i> Créer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fonction de prévisualisation de l'image avant l'upload
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const img = document.getElementById('imagePreview');
                img.src = reader.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
</body>
</html>
    