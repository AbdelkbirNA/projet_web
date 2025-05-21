@extends('layouts.type')

@section('title', 'ENSIASD - Contact')
@section('description', 'Contactez les professeurs de l\'ENSIASD')

@section('content')
    <style>
        body {
            background: #f8f9fa;
        }
        .contact-container {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            max-width: 700px;
            margin: 48px auto;
            padding: 48px 48px 36px 48px;
            transition: background 0.3s, color 0.3s;
        }
        .contact-title {
            color: #2563eb;
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 22px;
            text-align: center;
            letter-spacing: -1px;
            transition: color 0.3s;
        }
        .contact-label {
            color: #2563eb;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 1.09rem;
            transition: color 0.3s;
        }
        .contact-input, .contact-textarea, .form-select, .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e0e7ef;
            border-radius: 10px;
            font-size: 1.08rem;
            margin-bottom: 20px;
            background: #f4f8ff;
            outline: none;
            box-shadow: none;
            transition: border-color 0.2s, background 0.3s, color 0.3s;
            color: #222;
        }
        .contact-input:focus, .contact-textarea:focus, .form-select:focus, .form-control:focus {
            border-color: #2563eb;
        }
        .contact-btn, button[type="submit"] {
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 14px 0;
            font-size: 1.15rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 10px;
            width: 100%;
            box-shadow: 0 2px 8px rgba(26,35,126,0.08);
        }
        .contact-btn:hover, button[type="submit"]:hover {
            background: #174bbd;
        }
        .contact-success, .alert-success {
            background: #e6f9ec !important;
            color: #217a3a !important;
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            margin-bottom: 22px;
            text-align: center;
            font-weight: 700;
            font-size: 1.08rem;
        }
        .custom-file-upload {
            display: inline-block;
            background: #2563eb;
            color: #fff;
            border-radius: 10px;
            padding: 6px 14px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            border: none;
            margin: 10px 0 0 0;
            box-shadow: 0 2px 8px rgba(26,35,126,0.08);
        }
        .custom-file-upload:hover {
            background: #174bbd;
        }
        .custom-file-upload i {
            margin-right: 6px;
            font-size: 1em;
        }
        input[type="file"] {
            display: none;
        }
        #file-chosen {
            display: block;
            margin-top: 8px;
            color: #888;
            font-size: 0.98rem;
        }
        /* --- DARK MODE --- */
        body.dark-mode {
            background: #181f2a;
        }
        body.dark-mode .contact-container {
            background: #232c3a;
            color: #e3e6ee;
        }
        body.dark-mode .contact-title,
        body.dark-mode .contact-label {
            color: #6ea8ff;
        }
        body.dark-mode .contact-input, body.dark-mode .contact-textarea, body.dark-mode .form-select, body.dark-mode .form-control {
            background: #232c3a;
            color: #e3e6ee;
            border-color: #38445a;
        }
        body.dark-mode .contact-input:focus, body.dark-mode .contact-textarea:focus, body.dark-mode .form-select:focus, body.dark-mode .form-control:focus {
            border-color: #6ea8ff;
        }
        body.dark-mode .contact-btn, body.dark-mode button[type="submit"] {
            background: #6ea8ff;
            color: #232c3a;
        }
        body.dark-mode .contact-btn:hover, body.dark-mode button[type="submit"]:hover {
            background: #2563eb;
            color: #fff;
        }
        body.dark-mode .contact-success, body.dark-mode .alert-success {
            background: #1e2a3a !important;
            color: #7be495 !important;
        }
    </style>

    <!-- Contact Form Section -->
    <section class="section" style="background: #f8f9fa; padding: 40px 0;">
        <div class="container">
            <div class="contact-form-wrapper contact-container">
                <div class="contact-title" style="position: relative;">
                    Contactez un professeur
                    <div style="width: 80px; height: 4px; background: #2563eb; border-radius: 2px; margin: 12px auto 0 auto;"></div>
                </div>
                <p style="text-align: center; color: #444; margin-bottom: 32px;">Remplissez ce formulaire pour envoyer un message à un professeur de l'école.</p>
                @if(session('success'))
                    <div class="alert alert-success contact-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4 pb-4" style="border-bottom:1.5px solid #e0e0e0;">
                        <label for="professor_email" class="contact-label">Professeur</label>
                        <select name="professor_email" id="professor_email" class="form-select contact-input @error('professor_email') is-invalid @enderror" required>
                            <option value="">Sélectionnez un professeur</option>
                            @foreach($professors as $professor)
                                <option value="{{ $professor->email }}">{{ $professor->name }} ({{ $professor->email }})</option>
                            @endforeach
                        </select>
                        @error('professor_email')
                            <div class="invalid-feedback" style="color: #e74c3c;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4 pb-4" style="border-bottom:1.5px solid #e0e0e0;">
                        <label for="subject" class="contact-label">Sujet</label>
                        <input type="text" class="form-control contact-input @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" required>
                        @error('subject')
                            <div class="invalid-feedback" style="color: #e74c3c;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4 pb-4" style="border-bottom:1.5px solid #e0e0e0;">
                        <label for="message" class="contact-label">Message</label>
                        <textarea class="form-control contact-textarea @error('message') is-invalid @enderror" id="message" name="message" rows="10" required>{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback" style="color: #e74c3c;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="attachment" class="contact-label">Pièce jointe (optionnel)</label>
                        <div style="display: flex; align-items: center; gap: 16px; margin-top: 10px;">
                            <label for="attachment" class="custom-file-upload"><i class="fas fa-cloud-upload-alt"></i> Sélectionner un fichier</label>
                            <span id="file-chosen">Aucun fichier sélectionné</span>
                        </div>
                        <input type="file" class="form-control contact-input @error('attachment') is-invalid @enderror" id="attachment" name="attachment">
                        @error('attachment')
                            <div class="invalid-feedback" style="color: #e74c3c;">{{ $message }}</div>
                        @enderror
                        <div style="margin-top: 6px;">
                            <small class="text-muted">Formats acceptés : PDF, images. Taille maximale : 10MB</small>
                        </div>
                    </div>
                    <script>
                        const fileInput = document.getElementById('attachment');
                        const fileChosen = document.getElementById('file-chosen');
                        fileInput.addEventListener('change', function(){
                            fileChosen.textContent = this.files.length ? this.files[0].name : 'Aucun fichier sélectionné';
                        });
                    </script>
                    <div>
                        <button type="submit" class="contact-btn">
                            <i class="fas fa-paper-plane"></i> Envoyer le message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
    // Pour la démo : bascule dark mode avec la touche D
    window.addEventListener('keydown', function(e) {
        if(e.key === 'd' || e.key === 'D') {
            document.body.classList.toggle('dark-mode');
        }
    });
    </script>
@endsection 