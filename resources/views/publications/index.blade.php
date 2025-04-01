<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Publications</title>
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

        .btn-outline-danger {
            border-color: #e74a3b;
            color: #e74a3b;
        }

        .btn-outline-danger:hover {
            background-color: #e74a3b;
            color: white;
        }

        .publication-title {
            color: #2e3a4d;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .publication-description {
            color: #5a6a85;
            line-height: 1.6;
            margin-bottom: 1.25rem;
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

        .container-custom {
            max-width: 800px;
            padding-top: 2rem;
            padding-bottom: 3rem;
        }

        .action-buttons {
            gap: 0.5rem;
        }

        /* Style pour la troncature de texte */
        .description-container {
            position: relative;
        }

        .description-text {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .description-text.expanded {
            -webkit-line-clamp: unset;
            display: block;
        }

        .read-more-btn {
            background: none;
            border: none;
            color: var(--primary-color);
            cursor: pointer;
            padding: 0;
            font-weight: 500;
            margin-top: 0.5rem;
            display: inline-block;
        }

        .read-more-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container container-custom">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="text-center mb-4 text-dark">Nos Publications</h1>

                @foreach ($publication as $elm)
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="publication-title mb-0">{{ $elm->titre_pub }}</h5>
                        <div class="d-flex action-buttons">
                            <!-- Bouton Modifier -->
                            <a class="btn btn-sm btn-outline-primary btn-custom" href="{{ route('edit', $elm->id) }}">
                                <i class="bi bi-pencil-fill"></i> Modifier
                            </a>

                            <!-- Formulaire de suppression -->
                            <form action="{{ route('del', $elm->id) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette publication ?');">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-sm btn-outline-danger btn-custom">
                                    <i class="bi bi-trash-fill"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center px-3">
                            <div class="description-container">
                                <p class="publication-description description-text" id="description-{{ $loop->index }}">
                                    {{ $elm->description }}
                                </p>
                                @if(strlen($elm->description) > 150)
                                <button class="read-more-btn" onclick="toggleDescription({{ $loop->index }})">
                                    Lire plus
                                </button>
                                @endif
                            </div>
                            <div class="mt-3">
                                <img class="publication-image"
                                     style="max-width: 200px; height: auto; object-fit: cover;"
                                     src="{{ asset('storage/' . $elm->image) }}"
                                     alt="Image de la publication">
                            </div>
                            <small class="text-muted d-block mt-3">
                                Publié le {{ \Carbon\Carbon::parse($elm->year)->format('d/m/Y') }}
                            </small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleDescription(index) {
            const description = document.getElementById(`description-${index}`);
            const button = document.querySelector(`#description-${index}`).nextElementSibling;

            description.classList.toggle('expanded');

            if (description.classList.contains('expanded')) {
                button.textContent = 'Lire moins';
            } else {
                button.textContent = 'Lire plus';
            }
        }
    </script>
</body>
</html>
